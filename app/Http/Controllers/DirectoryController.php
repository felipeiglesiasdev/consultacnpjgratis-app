<?php
namespace App\Http\Controllers; // NAMESPACE DO CONTROLADOR
use App\Models\Cnae; // MODEL DE ATIVIDADES ECONÔMICAS
use App\Models\Estabelecimento; // MODEL DE ESTABELECIMENTOS
use App\Models\Municipio; // MODEL DE MUNICÍPIOS
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator; 

class DirectoryController extends Controller // CONTROLADOR DO DIRETÓRIO DE EMPRESAS
{
    // MAPA PARA BUSCAR O NOME COMPLETO DO ESTADO PELA SIGLA
    private $estadosBrasileiros = [
        'ac' => 'Acre', 'al' => 'Alagoas', 'ap' => 'Amapá', 'am' => 'Amazonas',
        'ba' => 'Bahia', 'ce' => 'Ceará', 'df' => 'Distrito Federal', 'es' => 'Espírito Santo',
        'go' => 'Goiás', 'ma' => 'Maranhão', 'mt' => 'Mato Grosso', 'ms' => 'Mato Grosso do Sul',
        'mg' => 'Minas Gerais', 'pa' => 'Pará', 'pb' => 'Paraíba', 'pr' => 'Paraná',
        'pe' => 'Pernambuco', 'pi' => 'Piauí', 'rj' => 'Rio de Janeiro', 'rn' => 'Rio Grande do Norte',
        'rs' => 'Rio Grande do Sul', 'ro' => 'Rondônia', 'rr' => 'Roraima', 'sc' => 'Santa Catarina',
        'sp' => 'São Paulo', 'se' => 'Sergipe', 'to' => 'Tocantins'
    ];

    // (NOVO) MAPA DE PREPOSIÇÕES CORRETAS PARA CADA ESTADO
    private $preposicoesEstado = [
        'ac' => 'do', 'al' => 'de', 'ap' => 'do', 'am' => 'do',
        'ba' => 'da', 'ce' => 'do', 'df' => 'do', 'es' => 'do',
        'go' => 'de', 'ma' => 'do', 'mt' => 'de', 'ms' => 'de',
        'mg' => 'de', 'pa' => 'do', 'pb' => 'da', 'pr' => 'do',
        'pe' => 'de', 'pi' => 'do', 'rj' => 'do', 'rn' => 'do',
        'rs' => 'do', 'ro' => 'de', 'rr' => 'de', 'sc' => 'de',
        'sp' => 'de', 'se' => 'de', 'to' => 'de'
    ];

    

    // (NOVO) MAPA DE CAPITAIS
    private $capitais = [
        'ac' => 'Rio Branco', 'al' => 'Maceió', 'ap' => 'Macapá', 'am' => 'Manaus',
        'ba' => 'Salvador', 'ce' => 'Fortaleza', 'df' => 'Brasília', 'es' => 'Vitória',
        'go' => 'Goiânia', 'ma' => 'São Luís', 'mt' => 'Cuiabá', 'ms' => 'Campo Grande',
        'mg' => 'Belo Horizonte', 'pa' => 'Belém', 'pb' => 'João Pessoa', 'pr' => 'Curitiba',
        'pe' => 'Recife', 'pi' => 'Teresina', 'rj' => 'Rio de Janeiro', 'rn' => 'Natal',
        'rs' => 'Porto Alegre', 'ro' => 'Porto Velho', 'rr' => 'Boa Vista', 'sc' => 'Florianópolis',
        'sp' => 'São Paulo', 'se' => 'Aracaju', 'to' => 'Palmas'
    ];

    public function index()
    {
        $tempoCache = now()->addMonths(3);
        // ************************************************************************************************************************
        // 1. LISTA DE ESTADOS COM O TOTAL DE MUNICÍPIOS
        // ************************************************************************************************************************
        $estados = Cache::remember('dir_estados_resumo', $tempoCache, function () {
            return DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->select('uf', DB::raw('count(distinct municipio) as total_municipios'))
                ->groupBy('uf')
                ->orderBy('uf')
                ->get();
        });

        // ************************************************************************************************************************
        // 2. KPI: TOTAL DE EMPRESAS ATIVAS
        // ************************************************************************************************************************
        $totalEmpresasAtivas = Cache::remember('dir_total_ativas', $tempoCache, function () {
            return DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->where('situacao_cadastral', 2) // 2 = Ativa
                ->count();
        });

        // ************************************************************************************************************************
        // 3. KPI: QUANTOS MUNICÍPIOS POSSUEM EMPRESAS
        // ************************************************************************************************************************
        $municipiosComEmpresas = Cache::remember('dir_municipios_com_empresas', $tempoCache, function () {
            return DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->distinct()
                ->count('municipio');
        });

        // ************************************************************************************************************************
        // 4. KPI: MÉDIA DE ABERTURAS NOS ÚLTIMOS 12 MESES
        // ************************************************************************************************************************
        $mediaAberturasMensal = Cache::remember('dir_media_aberturas_mensal_calculated', $tempoCache, function () {
            $aberturasUltimos12Meses = DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->where('data_inicio_atividade', '>=', now()->subYear()->startOfMonth())
                ->count();
                
            return (int) ceil($aberturasUltimos12Meses / 12);
        });

        // ************************************************************************************************************************
        // 5. KPI EXTRA: NOVAS EMPRESAS NO ÚLTIMO TRIMESTRE
        // ************************************************************************************************************************
        $novasEmpresasTrimestre = Cache::remember('dir_aberturas_trimestre', $tempoCache, function () {
            return DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->whereBetween('data_inicio_atividade', [
                    now()->subMonths(3)->startOfDay(),
                    now(),
                ])
                ->count();
        });

        // ************************************************************************************************************************
        // 6. KPI EXTRA: TOTAL DE CNAES DISPONÍVEIS
        // ************************************************************************************************************************
        $totalCnaesCatalogados = Cache::remember('dir_total_cnaes', $tempoCache, function () {
            return DB::connection('mysql_dados')->table('cnaes')->count();
        });

        // ************************************************************************************************************************
        // 7. TOP ESTADOS COM MAIS EMPRESAS ATIVAS
        // ************************************************************************************************************************
        $topEstadosAtivos = Cache::remember('dir_top_estados_ativos_chart', $tempoCache, function () {
            return DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->select('uf', DB::raw('count(*) as total'))
                ->where('situacao_cadastral', 2)
                ->groupBy('uf')
                ->orderByDesc('total')
                ->limit(10)
                ->get();
        });

        // ************************************************************************************************************************
        // 8. TOP 10 CIDADES COM MAIS EMPRESAS ATIVAS (JÁ FORMATADO)
        // Substituímos o with('municipioRel') por um Join nativo muito mais rápido
        // ************************************************************************************************************************
        $top10CidadesAtivas = Cache::remember('dir_top_cidades_ativas_formatted', $tempoCache, function () {
            $brutas = DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->join('municipios', 'estabelecimentos_geral.municipio', '=', 'municipios.codigo')
                ->select(
                    'estabelecimentos_geral.municipio', 
                    'estabelecimentos_geral.uf', 
                    'municipios.descricao as nome_municipio', 
                    DB::raw('count(*) as total')
                )
                ->where('estabelecimentos_geral.situacao_cadastral', 2)
                ->groupBy('estabelecimentos_geral.municipio', 'estabelecimentos_geral.uf', 'municipios.descricao')
                ->orderByDesc('total')
                ->limit(10)
                ->get();

            // Mapeia para manter exatamente a mesma estrutura de objeto que você tinha antes
            return $brutas->map(function ($item) {
                $nome = $item->nome_municipio ?? 'Não encontrado';
                return (object) [
                    'nome' => $nome,
                    'uf' => $item->uf,
                    'total' => $item->total,
                    'municipio_slug' => Str::slug($nome),
                ];
            });
        });

        // ************************************************************************************************************************
        // RETORNA VIEW
        // ************************************************************************************************************************
        return view('pages.directory.empresas.index', [
            'estados' => $estados,
            'top10CidadesAtivas' => $top10CidadesAtivas,
            'totalEmpresasAtivas' => $totalEmpresasAtivas,
            'municipiosComEmpresas' => $municipiosComEmpresas,
            'mediaAberturasMensal' => $mediaAberturasMensal,
            'novasEmpresasTrimestre' => $novasEmpresasTrimestre,
            'totalCnaesCatalogados' => $totalCnaesCatalogados,
            'topEstadosAtivos' => $topEstadosAtivos,
        ]);
    }
    //#############################################################################################################################
    //#############################################################################################################################
    public function byState(Request $request, string $uf)
    {
        // VARIÁVEIS BÁSICAS
        $ufUpper = strtoupper($uf);
        $ufLower = strtolower($ufUpper);
        $preposicao = $this->preposicoesEstado[$ufLower] ?? 'de';
        $nomeEstado = $this->estadosBrasileiros[$ufLower] ?? $ufUpper;
        $nomeCapital = $this->capitais[$ufLower] ?? '';
        
        $tempoCache = now()->addMonths(3);
        $hoje = Carbon::now()->toDateString();
        // Em vez de fixar 2025, pega dinamicamente o início do ano atual
        $inicioAno = Carbon::now()->startOfYear()->toDateString(); 

        // ************************************************************************************************************************
        // KPIs DO ESTADO
        // ************************************************************************************************************************
        $totalAtivas = Cache::remember("estado_total_ativas_{$ufUpper}", $tempoCache, function () use ($ufUpper) {
            return DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->where('uf', $ufUpper)->where('situacao_cadastral', 2)->count();
        });

        $totalMatrizes = Cache::remember("estado_total_matrizes_{$ufUpper}", $tempoCache, function () use ($ufUpper) {
            return DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->where('uf', $ufUpper)->where('situacao_cadastral', 2)->where('identificador_matriz_filial', 1)->count();
        });

        $totalfiliais = Cache::remember("estado_total_filiais_{$ufUpper}", $tempoCache, function () use ($ufUpper) {
            return DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->where('uf', $ufUpper)->where('situacao_cadastral', 2)->where('identificador_matriz_filial', 2)->count();
        });

        $totalAbertasAnoAtual = Cache::remember("estado_total_abertas_2025_{$ufUpper}", $tempoCache, function () use ($ufUpper, $inicioAno, $hoje) {
            return DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->where('uf', $ufUpper)->whereBetween('data_inicio_atividade', [$inicioAno, $hoje])->count();
        });

        $totalFechadasAnoAtual = Cache::remember("estado_total_fechadas_2025_{$ufUpper}", $tempoCache, function () use ($ufUpper, $inicioAno, $hoje) {
            return DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->where('uf', $ufUpper)->where('situacao_cadastral', '!=', 2)->whereBetween('data_situacao_cadastral', [$inicioAno, $hoje])->count();
        });

        $totalCapitalAtivas = Cache::remember("estado_total_capital_ativas_{$ufUpper}", $tempoCache, function () use ($ufUpper, $nomeCapital) {
            if (!$nomeCapital) return 0;
            
            $codigoCapital = DB::connection('mysql_dados')->table('municipios')
                ->whereRaw('LOWER(descricao) = ?', [mb_strtolower($nomeCapital, 'UTF-8')])
                ->value('codigo');

            if (!$codigoCapital) return 0;

            return DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->where('uf', $ufUpper)
                ->where('municipio', $codigoCapital)
                ->where('situacao_cadastral', 2)
                ->count();
        });

        // ************************************************************************************************************************
        // TOP 10 CIDADES (JOIN nativo em vez de Eloquent)
        // ************************************************************************************************************************
        $top10Cidades = Cache::remember("estado_top10_cidades_{$ufUpper}", $tempoCache, function () use ($ufUpper, $ufLower) {
            $brutas = DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->join('municipios', 'estabelecimentos_geral.municipio', '=', 'municipios.codigo')
                ->select('estabelecimentos_geral.municipio', 'municipios.descricao as nome', DB::raw('count(*) as total'))
                ->where('estabelecimentos_geral.uf', $ufUpper)
                ->where('estabelecimentos_geral.situacao_cadastral', 2)
                ->groupBy('estabelecimentos_geral.municipio', 'municipios.descricao')
                ->orderByDesc('total')
                ->limit(10)
                ->get();

            return $brutas->map(function ($item) use ($ufLower) {
                $item->nome = $item->nome ?? 'N/A';
                $item->municipio_slug = Str::slug($item->nome);
                $item->uf = $ufLower;
                return $item;
            });
        });

        // ************************************************************************************************************************
        // TOP 10 CNAES (JOIN nativo em vez de withCount)
        // ************************************************************************************************************************
        $topCnaes = Cache::remember("estado_top10_cnaes_{$ufUpper}", $tempoCache, function () use ($ufUpper) {
            return DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->join('cnaes', 'estabelecimentos_geral.cnae_fiscal_principal', '=', 'cnaes.codigo')
                ->select('cnaes.codigo', 'cnaes.descricao', DB::raw('count(*) as ativos_count'))
                ->where('estabelecimentos_geral.uf', $ufUpper)
                ->where('estabelecimentos_geral.situacao_cadastral', 2)
                ->groupBy('cnaes.codigo', 'cnaes.descricao')
                ->orderByDesc('ativos_count')
                ->limit(10)
                ->get();
        });

        // ************************************************************************************************************************
        // LISTA COMPLETA DE MUNICÍPIOS PARA PAGINAÇÃO MANUAL
        // ************************************************************************************************************************
        $allMunicipios = Cache::remember("estado_all_municipios_{$ufUpper}", $tempoCache, function () use ($ufUpper, $ufLower) {
            $brutas = DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->join('municipios', 'estabelecimentos_geral.municipio', '=', 'municipios.codigo')
                ->select('estabelecimentos_geral.municipio', 'municipios.descricao as nome', DB::raw('count(*) as total_empresas'))
                ->where('estabelecimentos_geral.uf', $ufUpper)
                ->where('estabelecimentos_geral.situacao_cadastral', 2)
                ->groupBy('estabelecimentos_geral.municipio', 'municipios.descricao')
                ->orderByDesc('total_empresas')
                ->get();

            return $brutas->map(function ($item) use ($ufLower) {
                $item->nome = $item->nome ?? 'N/A';
                $item->municipio_slug = Str::slug($item->nome);
                $item->uf = $ufLower;
                return $item;
            });
        });
        
        $page = $request->get('page', 1); // Pega a página atual da URL
        $perPage = 20; // Itens por página

        // Cria a instância de paginação manual
        $municipios = new LengthAwarePaginator(
            $allMunicipios->forPage($page, $perPage), // Fatia os dados para a página atual
            $allMunicipios->count(), // Total de itens
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()] // Mantém a URL correta
        );

        // ************************************************************************************************************************
        // RETORNA VIEW
        // ************************************************************************************************************************
        return view('pages.directory.estados.state', [
            'totalAtivas' => $totalAtivas,
            'totalMatrizes' => $totalMatrizes,
            'totalfiliais' => $totalfiliais,
            'totalAbertas2025' => $totalAbertasAnoAtual, // Manteve-se a key para compatibilidade com sua view
            'totalFechadas2025' => $totalFechadasAnoAtual,
            'top10Cidades' => $top10Cidades,
            'topCnaes' => $topCnaes,
            'uf' => $ufUpper,
            'municipios' => $municipios, 
            'nomeCapital' => $nomeCapital,
            'preposicao' => $preposicao,
            'nomeEstado' => $nomeEstado,
            'totalCapitalAtivas' => $totalCapitalAtivas,
        ]);
    }
    //#############################################################################################################################
    //#############################################################################################################################
    public function byCity(string $uf, string $cidade_slug)
    {
        // VARIÁVEIS BÁSICAS
        $ufUpper = strtoupper($uf);
        $ufLower = strtolower($ufUpper); 
        $hoje = Carbon::now()->toDateString();
        $inicioAno = Carbon::now()->startOfYear()->toDateString();
        
        $tempoCache = now()->addMonths(2);

        // ************************************************************************************************************************
        // BUSCA O MUNICÍPIO
        // O slug da rota é gerado a partir do nome, então buscamos por lá.
        // ************************************************************************************************************************
        $municipio = DB::connection('mysql_dados')->table('municipios')
            ->whereRaw('LOWER(REPLACE(descricao, " ", "-")) = ?', [$cidade_slug])
            ->first();

        // Se o município não existir (slug inválido ou digitado errado)
        if (!$municipio) {
            abort(404, 'Município não encontrado.');
        }

        // Descobre a UF real na base (apenas um SELECT rápido para confirmar a UF do município)
        $ufReal = DB::connection('mysql_dados')->table('estabelecimentos_geral')
            ->where('municipio', $municipio->codigo)
            ->value('uf'); // Retorna apenas a string da UF (ex: "SP")

        if (!$ufReal) {
             abort(404, 'Nenhuma empresa encontrada para este município.');
        }

        // ************************************************************************************************************************
        // KPIs DA CIDADE (Em Cache para performance)
        // ************************************************************************************************************************
        $totalAtivas = Cache::remember("municipio_total_ativas_{$ufReal}_{$municipio->codigo}", $tempoCache, function () use ($ufReal, $municipio) {
            return DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->where('uf', $ufReal)
                ->where('situacao_cadastral', 2)
                ->where('municipio', $municipio->codigo)
                ->count();
        });

        $totalAbertasAnoAtual = Cache::remember("municipio_total_abertas_2025_{$ufReal}_{$municipio->codigo}", $tempoCache, function () use ($ufReal, $municipio, $inicioAno, $hoje) {
            return DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->where('uf', $ufReal)
                ->where('municipio', $municipio->codigo)
                ->whereBetween('data_inicio_atividade', [$inicioAno, $hoje])
                ->count();
        });

        $totalFechadasAnoAtual = Cache::remember("municipio_total_fechadas_2025_{$ufReal}_{$municipio->codigo}", $tempoCache, function () use ($ufReal, $municipio, $inicioAno, $hoje) {
            return DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->where('uf', $ufReal)
                ->where('situacao_cadastral', '!=', 2) // Diferente de 2 (Ativa)
                ->where('municipio', $municipio->codigo)
                ->whereBetween('data_situacao_cadastral', [$inicioAno, $hoje])
                ->count();
        });

        // ************************************************************************************************************************
        // LISTA PAGINADA DE EMPRESAS ATIVAS NO MUNICÍPIO
        // Retorna a query *ao vivo*, substituindo o ->with() por um Join direto
        // ************************************************************************************************************************
        $perPage = 50;

        $empresas = DB::connection('mysql_dados')->table('estabelecimentos_geral')
            ->join('empresas', 'estabelecimentos_geral.cnpj_basico', '=', 'empresas.cnpj_basico')
            ->select(
                'estabelecimentos_geral.cnpj_basico',
                'estabelecimentos_geral.cnpj_ordem',
                'estabelecimentos_geral.cnpj_dv',
                'estabelecimentos_geral.nome_fantasia',
                'empresas.razao_social',
                'estabelecimentos_geral.data_inicio_atividade'
            )
            ->where('estabelecimentos_geral.uf', $ufUpper)
            ->where('estabelecimentos_geral.situacao_cadastral', 2)
            ->where('estabelecimentos_geral.municipio', $municipio->codigo)
            ->paginate($perPage)
            ->withQueryString(); 

        // Adiciona as chaves adicionais que seriam geradas pelos Arrays
        $preposicao = $this->preposicoesEstado[$ufLower] ?? 'de';
        $nomeEstado = $this->estadosBrasileiros[$ufLower] ?? $ufUpper;

        return view('pages.directory.municipios.city', [
            'totalAtivas'       => $totalAtivas,
            'municipio'         => $municipio,
            'ufReal'            => $ufReal,
            'totalAbertas2025'  => $totalAbertasAnoAtual,
            'totalFechadas2025' => $totalFechadasAnoAtual,
            'empresas'          => $empresas,
            
            // Variáveis de texto extras que são sempre bem vindas na View
            'ufLower'           => $ufLower,
            'preposicao'        => $preposicao,
            'nomeEstado'        => $nomeEstado,
        ]);
    } 

}
