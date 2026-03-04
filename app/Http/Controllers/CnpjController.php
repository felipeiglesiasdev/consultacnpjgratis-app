<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Estabelecimento; 
use App\Models\Cnae;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class CnpjController extends Controller
{
    // Busca centralizada de todos os dados do CNPJ em uma única query otimizada
    // Retorna o estabelecimento com dados da matriz, município, natureza e simples anexados
    private function findValidEstabelecimento(string $cnpj): ?object 
    {
        $cnpjBase = substr($cnpj, 0, 8);
        $cnpjOrdem = substr($cnpj, 8, 4);
        $cnpjDv = substr($cnpj, 12, 2);
        $estabelecimento = DB::connection('mysql_dados')->table('estabelecimentos_geral as e')
            // JOIN com a tabela principal da Empresa (Matriz)
            ->join('empresas as emp', 'e.cnpj_basico', '=', 'emp.cnpj_basico')
            // LEFT JOIN com Municípios (nem todo CNPJ tem o código correto salvo)
            ->leftJoin('municipios as mun', 'e.municipio', '=', 'mun.codigo')
            // LEFT JOIN com Natureza Jurídica
            ->leftJoin('naturezas_juridicas as nat', 'emp.natureza_juridica', '=', 'nat.codigo')
            ->select(
                'e.*', // Pega todos os dados do estabelecimento
                'emp.razao_social', 'emp.natureza_juridica', 'emp.qualificacao_responsavel', 'emp.capital_social', 'emp.porte_empresa', 'emp.ente_federativo_responsavel',
                'mun.descricao as nome_municipio',
                'nat.descricao as nome_natureza_juridica'
            )
            ->where('e.cnpj_basico', $cnpjBase)
            ->where('e.cnpj_ordem', $cnpjOrdem)
            ->where('e.cnpj_dv', $cnpjDv)
            ->first(); 
        return $estabelecimento; 
    }
    //################################################################################################
    //################################################################################################
    // Processa o formulário de consulta.
    // Se encontrar, redireciona. Se não, volta com erro para o popup.
    public function consultar(Request $request): RedirectResponse
    {
        $request->validate(['cnpj'          => 'required|string|max:18'], [
                            'cnpj.required' => 'O campo CNPJ é obrigatório.',
                            'cnpj.string'   => 'O CNPJ deve ser um texto.',
                            'cnpj.max'      => 'O CNPJ não pode ter mais que 18 caracteres.',]);
                            
        $cnpjLimpo = preg_replace('/[^0-9]/', '', $request->input('cnpj'));
        
        if (strlen($cnpjLimpo) !== 14) {
            return redirect()->back()->withInput($request->only('cnpj'))->with('error', 'CNPJ inválido. Por favor, digite os 14 números do CNPJ.');
        }

        $estabelecimentoCompleto = $this->findValidEstabelecimento($cnpjLimpo);

        // Se encontrou o estabelecimento...
        if ($estabelecimentoCompleto) {
            // Redireciona e passa todo o objeto gigante na sessão de uma vez só
            return redirect()->route('cnpj.show', ['cnpj' => $cnpjLimpo])
                             ->with('dados_cnpj_completo', $estabelecimentoCompleto);
        } 
        // Se não encontrou...
        else {
            return redirect()->back()
                             ->withInput($request->only('cnpj')) 
                             ->with('error', 'CNPJ não encontrado em nossa base de dados.');
        }
    }
    //################################################################################################
    // FUNÇÃO QUE EXIBE RETORNANDO OS DADOS DA EMPRESA PARA VIEW
    public function show(string $cnpj): View
    {
        $cnpjApenasNumeros = preg_replace('/[^0-9]/', '', $cnpj);

        if (strlen($cnpjApenasNumeros) !== 14) {
            abort(404, 'CNPJ inválido.');
        }

        // Tenta pegar da sessão (se veio do form), senão vai no banco (acesso direto URL)
        if (session()->has('dados_cnpj_completo')) {
            $dadosCnpj = session('dados_cnpj_completo');
        } else {
            $dadosCnpj = $this->findValidEstabelecimento($cnpjApenasNumeros);
            // Se ainda assim for nulo, joga 404 pro Googlebot/Usuário
            if (!$dadosCnpj) {
                abort(404, 'CNPJ não encontrado em nossa base de dados.');
            }
        } 


        $situacao = $this->traduzirSituacaoCadastral($dadosCnpj->situacao_cadastral);                   // SITUAÇÃO CADASTRAL
        $cnaePrincipal = Cnae::find($dadosCnpj->cnae_fiscal_principal);                                 // CNAE PRINCIPAL
        $cnaesSecundarios = [];                                                                         // CNAEs SECUNDÁRIOS
        if (!empty($dadosCnpj->cnae_fiscal_secundaria)) {
            $codigosSecundarios = array_filter(explode(',', $dadosCnpj->cnae_fiscal_secundaria));
            if (count($codigosSecundarios) > 0) {
                $cnaeObjects = DB::connection('mysql_dados')->table('cnaes')
                    ->whereIn('codigo', $codigosSecundarios)
                    ->get();
                $cnaesSecundarios = $cnaeObjects->map(function ($cnae) {
                    return [
                        'codigo' => method_exists($this, 'formatarCnae') ? $this->formatarCnae($cnae->codigo) : $cnae->codigo,
                        'descricao' => $cnae->descricao
                    ];
                })->toArray();
            }
        }
        $nomeMunicipio = $dadosCnpj->nome_municipio;                    // NOME MUNICIPIO (MAISCULO)
        $uf = $dadosCnpj->uf;                                           // UF
        
    

        // --- LÓGICA PARA EMPRESAS SEMELHANTES ---
        $empresasSemelhantes = $this->findSimilarCompanies($dadosCnpj);
        // --- FIM DA LÓGICA ---

        // Prepara os dados para os cards
        $dadosParaExibir = [
            // Card: Informações do CNPJ (dados existentes)
            'cnpj_desformatado' => $cnpjApenasNumeros,
            'cnpj_completo' => $this->formatarCnpj($cnpjApenasNumeros),
            'razao_social' => $dadosCnpj->razao_social,
            'nome_fantasia' => $dadosCnpj->nome_fantasia,
            'natureza_juridica' => $dadosCnpj->nome_natureza_juridica ?? 'Não informado',
            'capital_social' => number_format($dadosCnpj->capital_social, 2, ',', '.'),
            'porte' => $this->traduzirPorte($dadosCnpj->porte_empresa),
            'matriz_ou_filial' => $dadosCnpj->identificador_matriz_filial == 1 ? 'Matriz' : 'Filial',
            'data_abertura' => date('d/m/Y', strtotime($dadosCnpj->data_inicio_atividade)),

            // Card: Situação Cadastral (NOVOS DADOS)
            'situacao_cadastral' => $situacao['texto'],
            'situacao_cadastral_classe' => $situacao['classe'],
            'data_situacao_cadastral' => date('d/m/Y', strtotime($dadosCnpj->data_situacao_cadastral)),

            // Card: Atividades Econômicas (DADOS ATUALIZADOS)
            'cnae_principal' => [
                'codigo' => $cnaePrincipal ? $this->formatarCnae($cnaePrincipal->codigo) : 'Não informado',
                'descricao' => $cnaePrincipal->descricao ?? 'Não informado'
            ],
            'cnaes_secundarios' => $cnaesSecundarios,

            // Card: Endereço (APENAS CIDADE E ESTADO)
            'uf' => $uf,
            'cidade' => $nomeMunicipio,

            // DADOS DE CONTEXTO PARA O SUBTÍTULO (NOVO)
            'similar_context' => [
                'cnae_descricao' => $cnaePrincipal->descricao ?? 'Não informado',
                'cidade' => $estabelecimento->municipioRel->descricao ?? 'região'
            ],

            'empresas_semelhantes' => $empresasSemelhantes,
        ];

        return view('cnpj.show', ['data' => $dadosParaExibir]);
    }
    
    private function findSimilarCompanies($estabelecimento): array
    {
        $limit = 10;

        // ETAPA 1: Busca na mesma CIDADE
        $semelhantesNaCidade = DB::connection('mysql_dados')->table('estabelecimentos_geral as e')
            ->join('empresas as emp', 'e.cnpj_basico', '=', 'emp.cnpj_basico')
            ->leftJoin('municipios as mun', 'e.municipio', '=', 'mun.codigo')
            ->select(
                'e.*', 
                'emp.razao_social',  
                'mun.descricao as nome_municipio',
            )
            ->where('e.uf', $estabelecimento->uf)
            ->where('e.situacao_cadastral', '=', 2)
            ->where('e.municipio', $estabelecimento->municipio)
            ->where('e.cnae_fiscal_principal', $estabelecimento->cnae_fiscal_principal)
            ->where('e.cnpj_basico', '!=', $estabelecimento->cnpj_basico)
            ->limit($limit)
            ->get();
            
        if ($semelhantesNaCidade->count() >= $limit) {
            return $this->formatSimilarCompanies($semelhantesNaCidade);
        }

        // ETAPA 2: Busca no ESTADO para completar
        $necessarios = $limit - $semelhantesNaCidade->count();
        $cnpjsJaEncontrados = $semelhantesNaCidade->pluck('cnpj_basico')->push($cnpjBaseAtual);
        $semelhantesNoEstado = DB::connection('mysql_dados')->table('estabelecimentos_geral as e')
            ->join('empresas as emp', 'e.cnpj_basico', '=', 'emp.cnpj_basico')
            ->leftJoin('municipios as mun', 'e.municipio', '=', 'mun.codigo')
            ->select(
                'e.*', 
                'emp.razao_social',  
                'mun.descricao as nome_municipio',
            )
            ->where('e.uf', $estabelecimento->uf)
            ->where('e.situacao_cadastral', '=', 2)
            ->whereNotIn('cnpj_basico', $cnpjsJaEncontrados)
            ->where('e.cnae_fiscal_principal', $estabelecimento->cnae_fiscal_principal)
            ->where('e.cnpj_basico', '!=', $estabelecimento->cnpj_basico)
            ->limit($limit)
            ->get();
        
        $empresasSemelhantes = $semelhantesNaCidade->merge($semelhantesNoEstado);
        return $this->formatSimilarCompanies($empresasSemelhantes);
    }


    private function formatSimilarCompanies($collection): array
    {
        return $collection->map(function ($est) {
            $cnpjCompleto = $est->cnpj_basico . $est->cnpj_ordem . $est->cnpj_dv;
            return [
                'razao_social' => $est->razao_social,
                'cidade_uf' => $est->nome_municipio . ' / ' . $est->uf,
                'url' => route('cnpj.show', ['cnpj' => $cnpjCompleto]),
            ];
        })->toArray();
    }

    // ###########################################################################################################################
    // FUNÇÃO FORMATAR CNAE
    private function formatarCnae(string $codigo): string
    {
        return preg_replace('/\D/', '', $codigo);
    }
    // ###########################################################################################################################
    // FUNÇÃO TRADUZIR PORTE DA EMPRESA
    private function traduzirPorte(int $codigoPorte): string
    {
        switch ($codigoPorte) {
            case 1:
                return 'Micro Empresa';
            case 3:
                return 'Empresa de Pequeno Porte';
            case 5:
                return 'Demais';
            default:
                return 'Não Informado';
        }
    }
    // ###########################################################################################################################
    // FUNÇÃO TRADUZIR SITUAÇÃO CADASTRAL
    private function traduzirSituacaoCadastral(int $codigo): array
    {
        switch ($codigo) {
            case 2:
                return ['texto' => 'ATIVA', 'classe' => 'status-active'];
            case 3:
                return ['texto' => 'SUSPENSA', 'classe' => 'status-suspended'];
            case 4:
                return ['texto' => 'BAIXADA', 'classe' => 'status-inactive'];
            case 8:
                return ['texto' => 'NULA', 'classe' => 'status-inactive'];
            default:
                return ['texto' => 'NÃO INFORMADO', 'classe' => 'status-inactive'];
        }
    }
    // ###########################################################################################################################
    // FUNÇÃO FORMATAR CNPJ
    private function formatarCnpj(string $cnpj): string
    {
        return vsprintf('%s.%s.%s/%s-%s', [
            substr($cnpj, 0, 2), substr($cnpj, 2, 3), substr($cnpj, 5, 3),
            substr($cnpj, 8, 4), substr($cnpj, 12, 2)
        ]);
    }
    // ###########################################################################################################################

}