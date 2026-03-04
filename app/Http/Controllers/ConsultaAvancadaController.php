<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ConsultaAvancadaController extends Controller
{
    // MÉTODO PRIVADO PARA OBTER DADOS DO FORMULÁRIO (CACHEADO)
    private function getDadosFormulario()
    {
        // CACHE V7: DADOS DO FORMULÁRIO (1440 MINUTOS = 24H)
        $dados = Cache::remember('consulta_avancada', 525600, function () {
            
            // BUSCA NATUREZAS JURÍDICAS ORDENADAS (QUERY BUILDER)
            $naturezas = DB::connection('mysql_dados')->table('naturezas_juridicas')
                ->select('codigo', 'descricao')
                ->orderBy('descricao')
                ->get();

            // BUSCA E FORMATA CNAES PARA EXIBIÇÃO (ZERO À ESQUERDA) (QUERY BUILDER)
            $cnaes = DB::connection('mysql_dados')->table('cnaes')
                ->select('codigo', 'descricao')
                ->orderBy('codigo')
                ->get()
                ->map(function ($item) {
                    // FORMATAÇÃO VISUAL: ADICIONA ZERO À ESQUERDA SE NECESSÁRIO
                    $codigoLimpo = str_pad($item->codigo, 7, '0', STR_PAD_LEFT);
                    // FORMATAÇÃO VISUAL: MÁSCARA CNAE (0000-0/00)
                    $codigoFormatado = preg_replace('/^(\d{4})(\d{1})(\d{2})$/', '$1-$2/$3', $codigoLimpo);
                    return [
                        'id' => $codigoLimpo, 
                        'texto' => "{$codigoFormatado} - {$item->descricao}",
                        'descricao' => $item->descricao
                    ];
                });

            // LÓGICA OTIMIZADA PARA CIDADES: 27 CONSULTAS POR UF (QUERY BUILDER)
            $ufs = ['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 
                    'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 
                    'RR', 'SC', 'SP', 'SE', 'TO'];
            $cidadesPorEstadoTemp = [];
            $todosCodigosMunicipios = [];

            foreach ($ufs as $uf) {
                // BUSCA CÓDIGOS DE MUNICÍPIOS COM EMPRESAS ATIVAS NA UF
                $codigos = DB::connection('mysql_dados')->table('estabelecimentos_geral')
                    ->where('uf', $uf)
                    ->where('situacao_cadastral', '02') 
                    ->distinct()
                    ->pluck('municipio')
                    ->toArray();
                
                if (!empty($codigos)) {
                    $cidadesPorEstadoTemp[$uf] = $codigos;
                    $todosCodigosMunicipios = array_merge($todosCodigosMunicipios, $codigos);
                }
            }

            // BUSCA NOMES DOS MUNICÍPIOS ENCONTRADOS (QUERY BUILDER)
            $nomesMunicipios = DB::connection('mysql_dados')->table('municipios')
                ->whereIn('codigo', array_unique($todosCodigosMunicipios))
                ->pluck('descricao', 'codigo');

            // MONTA ARRAY FINAL DE CIDADES POR ESTADO
            $cidadesPorEstado = [];
            foreach ($cidadesPorEstadoTemp as $uf => $codigos) {
                $listaCidades = [];
                foreach ($codigos as $codigo) {
                    if (isset($nomesMunicipios[$codigo])) {
                        $listaCidades[] = [
                            'codigo' => $codigo,
                            'nome' => $nomesMunicipios[$codigo]
                        ];
                    }
                }
                // ORDENA CIDADES ALFABETICAMENTE
                usort($listaCidades, fn($a, $b) => strcmp($a['nome'], $b['nome']));
                $cidadesPorEstado[$uf] = $listaCidades;
            }
            // ORDENA ESTADOS ALFABETICAMENTE
            ksort($cidadesPorEstado);

            return [
                'naturezasJuridicas' => $naturezas,
                'cnaes' => $cnaes,
                'cidadesPorEstado' => $cidadesPorEstado
            ];
        });

        // LISTA MANUAL DE ESTADOS (UF)
        $dados['estados'] = [
            'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas', 'BA' => 'Bahia',
            'CE' => 'Ceará', 'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo', 'GO' => 'Goiás',
            'MA' => 'Maranhão', 'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul', 'MG' => 'Minas Gerais',
            'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná', 'PE' => 'Pernambuco', 'PI' => 'Piauí',
            'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte', 'RS' => 'Rio Grande do Sul',
            'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa Catarina', 'SP' => 'São Paulo',
            'SE' => 'Sergipe', 'TO' => 'Tocantins'
        ];

        return $dados;
    }

    // MÉTODO INDEX: EXIBE O FORMULÁRIO INICIAL
    public function index()
    {
        $dadosFormulario = $this->getDadosFormulario(); // CARREGA DADOS DOS FILTROS
        return view('consulta-avancada.index', $dadosFormulario); // RETORNA VIEW
    }

    // MÉTODO SEARCH: PROCESSA A BUSCA E RETORNA RESULTADOS
    public function search(Request $request)
    {
        // VERIFICA SE HÁ FILTROS (EVITA FULL SCAN)
        if (count($request->except(['page'])) === 0) {
            return redirect()->route('consulta_avancada.index');
        }

        // INICIA QUERY NO QUERY BUILDER (Substituindo o Estabelecimento::query()->with())
        $query = DB::connection('mysql_dados')->table('estabelecimentos_geral as e')
            ->join('empresas as emp', 'e.cnpj_basico', '=', 'emp.cnpj_basico')
            ->leftJoin('municipios as mun', 'e.municipio', '=', 'mun.codigo')
            ->leftJoin('cnaes as cnae', 'e.cnae_fiscal_principal', '=', 'cnae.codigo')
            ->select(
                'e.*', 
                'emp.razao_social', 'emp.natureza_juridica', 'emp.porte_empresa', 'emp.capital_social',
                'mun.descricao as municipio_descricao',
                'cnae.descricao as cnae_descricao'
            );

        // 1. FILTROS DE LOCALIZAÇÃO
        if ($request->filled('uf')) {
            $query->where('e.uf', $request->uf); // FILTRA POR UF
        }

        if ($request->filled('cidade')) {
            $query->where('e.municipio', (int) $request->cidade); // FILTRA POR CÓDIGO IBGE (INT)
        }

        if ($request->filled('bairro')) {
            $query->where('e.bairro', 'like', "%{$request->bairro}%"); // FILTRA POR BAIRRO (LIKE)
        }

        // 2. SITUAÇÃO CADASTRAL
        if ($request->filled('situacao') && is_array($request->situacao)) {
            $query->whereIn('e.situacao_cadastral', $request->situacao); // FILTRA POR ARRAY DE SITUAÇÕES
        }

        // 3. ATIVIDADE PRINCIPAL (CNAE)
        if ($request->filled('cnae_principal')) {
            // REMOVE NÃO NUMÉRICOS E CONVERTE PARA INT
            $cnaePrincipal = (int) preg_replace('/[^0-9]/', '', $request->cnae_principal);
            $query->where('e.cnae_fiscal_principal', $cnaePrincipal);
        }

        // 3.1 CNAES SECUNDÁRIOS (CORRIGIDO: BUSCA EM CAMPO TEXTO)
        if ($request->filled('cnaes_secundarios') && is_array($request->cnaes_secundarios)) {
            $cnaesSecundarios = array_map(function($cnae) {
                return preg_replace('/[^0-9]/', '', $cnae); // LIMPA ITEM (Mantemos como string para o LIKE)
            }, $request->cnaes_secundarios);

            // COMO É CAMPO TEXTO (CSV), USAMOS LIKE PARA CADA CNAE
            // AGRUPA AS CONDIÇÕES OR EM UM BLOCO AND PARA NÃO QUEBRAR OUTROS FILTROS
            $query->where(function ($q) use ($cnaesSecundarios) {
                foreach ($cnaesSecundarios as $cnae) {
                    // BUSCA SE A STRING CONTÉM O CNAE (cnae_fiscal_secundaria LIKE '%12345%')
                    $q->orWhere('e.cnae_fiscal_secundaria', 'like', "%{$cnae}%");
                }
            });
        }

        // 4. NATUREZA JURÍDICA E PORTE (AGORA DIRETO NA TABELA EMPRESAS VIA JOIN)
        if ($request->filled('natureza_juridica')) {
            // LIMPA E CONVERTE NATUREZA PARA INT
            $natureza = (int) preg_replace('/[^0-9]/', '', $request->natureza_juridica);
            $query->where('emp.natureza_juridica', $natureza);
        }

        if ($request->filled('porte')) {
            // LIMPA E CONVERTE PORTE PARA INT
            $porte = (int) $request->porte;
            $query->where('emp.porte_empresa', $porte);
        }

        // 5. DATAS DE ABERTURA
        if ($request->filled('data_inicio')) {
            $query->whereDate('e.data_inicio_atividade', '>=', $request->data_inicio); // DATA INICIAL
        }

        if ($request->filled('data_fim')) {
            $query->whereDate('e.data_inicio_atividade', '<=', $request->data_fim); // DATA FINAL
        }

        // EXECUTA QUERY COM LIMIT 10 E RETORNA COLLECTION (SEM PAGINAÇÃO)
        $resultados = $query->limit(10)->get();
        
        // Mapeia os resultados para simular a estrutura que o Eloquent retornava para a view
        // Isso evita que você tenha que alterar a view `consulta-avancada.index`
        $resultadosFormatados = $resultados->map(function($item) {
            $item->empresa = (object) [
                'razao_social' => $item->razao_social,
                'natureza_juridica' => $item->natureza_juridica,
                'porte_empresa' => $item->porte_empresa,
                'capital_social' => $item->capital_social,
            ];
            $item->municipioRel = (object) [
                'descricao' => $item->municipio_descricao
            ];
            $item->cnaePrincipal = (object) [
                'descricao' => $item->cnae_descricao
            ];
            return $item;
        });

        // RECARREGA DADOS DO FORMULÁRIO PARA A VIEW
        $dadosFormulario = $this->getDadosFormulario();

        // RETORNA VIEW COM DADOS + RESULTADOS + FILTROS APLICADOS
        return view('consulta-avancada.index', array_merge($dadosFormulario, [
            'resultados' => $resultadosFormatados,
            'filtros' => $request->all()
        ]));
    }
}