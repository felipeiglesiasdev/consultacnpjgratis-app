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
         // ************************************************************************************************************************
        // DADOS CARREGADOS DO CACHE (Gerados pelo Job: GenerateDirectoryIndexCacheJob)
        // ************************************************************************************************************************

        // 1. Lista de estados com total de municípios
        $estados = Cache::get('dir_estados_resumo', collect());

        // 2. Total de empresas ativas
        $totalEmpresasAtivas = Cache::get('dir_total_ativas', 0);

        // 3. Quantos municípios possuem empresas
        $municipiosComEmpresas = Cache::get('dir_municipios_com_empresas', 0);

        // 4. Média de aberturas (Já calculado no Job)
        $mediaAberturasMensal = Cache::get('dir_media_aberturas_mensal_calculated', 0);

        // 5. Novas empresas no último trimestre
        $novasEmpresasTrimestre = Cache::get('dir_aberturas_trimestre', 0);

        // 6. Total CNAEs catalogados
        $totalCnaesCatalogados = Cache::get('dir_total_cnaes', 0);

        // 7. Top Estados Ativos (Se usar na view, adicionei aqui, mas não estava no array de retorno original, mas calculei no job caso precise)
        // $topEstadosAtivos = Cache::get('dir_top_estados_ativos_chart', collect());

        // 8. Top 10 Cidades Ativas (Já vem formatado com slug e nomes)
        $top10CidadesAtivas = Cache::get('dir_top_cidades_ativas_formatted', collect());

        // 9. CNAEs mais populares
        $topCnaes = Cache::get('dir_top_cnaes', collect());

        // ************************************************************************************************************************
        // RETORNA VIEW
        // ************************************************************************************************************************
        return view('pages.directory.empresas.index', [
            'estados' => $estados,
            'top10CidadesAtivas' => $top10CidadesAtivas,
            'topCnaes' => $topCnaes,
            'totalEmpresasAtivas' => $totalEmpresasAtivas,
            'municipiosComEmpresas' => $municipiosComEmpresas,
            'mediaAberturasMensal' => $mediaAberturasMensal,
            'novasEmpresasTrimestre' => $novasEmpresasTrimestre,
            'totalCnaesCatalogados' => $totalCnaesCatalogados,
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

        // ************************************************************************************************************************
        // RECUPERA DADOS DO CACHE (GERADOS PELO JOB GenerateStateCacheJob)
        // Usamos Cache::get() com um valor padrão seguro (0 ou collect)
        // ************************************************************************************************************************

        // KPIs
        $totalAtivas = Cache::get("estado_total_ativas_{$ufUpper}", 0);
        $totalMatrizes = Cache::get("estado_total_matrizes_{$ufUpper}", 0);
        $totalfiliais = Cache::get("estado_total_filiais_{$ufUpper}", 0);
        $totalAbertas2025 = Cache::get("estado_total_abertas_2025_{$ufUpper}", 0);
        $totalFechadas2025 = Cache::get("estado_total_fechadas_2025_{$ufUpper}", 0);
        $totalCapitalAtivas = Cache::get("estado_total_capital_ativas_{$ufUpper}", 0);

        // TOPS (Listas)
        $top10Cidades = Cache::get("estado_top10_cidades_{$ufUpper}", collect());
        $topCnaes = Cache::get("estado_top10_cnaes_{$ufUpper}", collect());

        // ************************************************************************************************************************
        // PAGINAÇÃO MANUAL DOS MUNICÍPIOS (USANDO DADOS EM CACHE)
        // O Job salva a lista COMPLETA de municípios ordenada. Aqui nós paginamos em memória.
        // ************************************************************************************************************************
        $allMunicipios = Cache::get("estado_all_municipios_{$ufUpper}", collect());
        
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
            'totalAbertas2025' => $totalAbertas2025,
            'totalFechadas2025' => $totalFechadas2025,
            'top10Cidades' => $top10Cidades,
            'topCnaes' => $topCnaes,
            'uf' => $ufUpper,
            'municipios' => $municipios, // Passa o objeto paginado
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
        // VARIÁVEIS
        $ufUpper = strtoupper($uf);
        $ufLower = strtolower($ufUpper); 
        $hoje = Carbon::now()->toDateString();
        $inicioAno = Carbon::createFromDate(2025, 1, 1)->toDateString();
        
        // Busca o município pelo slug E pela UF
        $municipio = Municipio::whereRaw('LOWER(REPLACE(descricao, " ", "-")) = ?', [$cidade_slug])
            ->whereHas('estabelecimentos', function ($query) use ($ufUpper) {
                $query->where('uf', $ufUpper);
            })
            ->first();

        // Descobre a UF real (garantindo consistência)
        $ufReal = Estabelecimento::where('municipio', $municipio->codigo)->select('uf')->first();
        


        //************************************************************************************************************************
        //************************************************************************************************************************
        // TOTAL DE EMPRESAS ATIVAS NO MUNICIPIO
        $totalAtivas = Cache::remember("municipio_total_ativas_{$ufReal->uf}_{$municipio->descricao}", now()->addMonths(2), function () use ($ufReal, $municipio) {
            return Estabelecimento::where('uf', $ufReal->uf)
                ->where('situacao_cadastral', 2)
                ->where('municipio', $municipio->codigo)
                ->count();
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // TOTAL ABERTAS EM 2025
        
        $totalAbertas2025 = Cache::remember("remunicipio_total_abertas_2025_{$ufReal->uf}_{$municipio->descricao}", now()->addMonths(2), function () use ($ufReal, $municipio, $ufUpper, $inicioAno, $hoje) {
            return Estabelecimento::where('uf', $ufUpper)->where('municipio', $municipio->codigo)->whereBetween('data_inicio_atividade', [$inicioAno, $hoje])->count();
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // TOTAL FECHADAS EM 2025
        $totalFechadas2025 = Cache::remember("reestado_total_fechadas_2025_{$ufReal->uf}_{$municipio->descricao}", now()->addMonths(2), function () use ($ufReal, $municipio, $ufUpper, $inicioAno, $hoje) {
            return Estabelecimento::where('uf', $ufUpper)->where('municipio', $municipio->codigo)->where('situacao_cadastral', '!=', 2)->whereBetween('data_situacao_cadastral', [$inicioAno, $hoje])->count();
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // FAQ

        //************************************************************************************************************************
        //************************************************************************************************************************
        //LISTA DE TODAS AS EMPRESAS CONTENDO CPNJ, RAZÃO SOCIAL/NOME FANTASIA, CAPITAL SOCIAL 
        // LISTA PAGINADA DE EMPRESAS ATIVAS NO MUNICÍPIO
        // (CNPJ completo, Razão Social, Capital Social, CEP, etc.)
        $perPage = 50;

        $empresas = Estabelecimento::where('uf', $ufUpper)
            ->where('situacao_cadastral', 2)
            ->where('municipio', $municipio->codigo)
            ->with('empresa:cnpj_basico,razao_social,capital_social')
            ->select('cnpj_basico', 'cnpj_ordem', 'cnpj_dv')
            ->orderBy('cnpj_basico')
            ->paginate($perPage)
            ->withQueryString(); // mantém ?page na URL se tiver mais filtros no futuro

        //************************************************************************************************************************
        //************************************************************************************************************************
        return view('pages.directory.municipios.city', [
            'totalAtivas'       => $totalAtivas,
            'municipio'         => $municipio,
            'ufReal'            => $ufReal,
            'totalAbertas2025'  => $totalAbertas2025,
            'totalFechadas2025' => $totalFechadas2025,
            'empresas'          => $empresas,
        ]);
    }
    //#############################################################################################################################
    //#############################################################################################################################
    public function cnaeIndex()
    {
        // LISTA COMPLETA PARA BUSCA EM TEMPO REAL
        $allCnaes = Cnae::select('codigo', 'descricao')->get()->toJson();
        //************************************************************************************************************************
        //************************************************************************************************************************
        // TOP CNAES POR EMPRESAS ATIVAS
        $topCnaes = Cnae::withCount(['estabelecimentos as estabelecimentos_count' => function ($query) {
            $query->where('situacao_cadastral', 2);
        }])
            ->orderByDesc('estabelecimentos_count')
            ->limit(10)
            ->get(); 
        //************************************************************************************************************************
        //************************************************************************************************************************
        return view('pages.directory.atividades.cnae_index', compact('allCnaes', 'topCnaes'));
    }
    //#############################################################################################################################
    //#############################################################################################################################
    public function byCnae(string $codigo_cnae)
    {
        // DETALHES DO CNAE SELECIONADO
        $cnae = Cnae::findOrFail($codigo_cnae);

        // ESTADOS COM MAIS EMPRESAS NO CNAE
        $topEstados = Estabelecimento::where('cnae_fiscal_principal', $codigo_cnae)
            ->where('situacao_cadastral', 2)
            ->select('uf', DB::raw('count(*) as total'))
            ->groupBy('uf')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // AMOSTRA DE EMPRESAS NO CNAE
        $empresas = Estabelecimento::with('empresa')
            ->where('cnae_fiscal_principal', $codigo_cnae)
            ->where('situacao_cadastral', 2)
            ->orderByDesc('data_inicio_atividade')
            ->limit(50)
            ->get();

        return view('pages.directory.atividades.cnae_show', compact('cnae', 'topEstados', 'empresas'));
    }

    



   

    

}
