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
    public function index()
    {
        // LISTA DE ESTADOS COM O TOTAL DE MUNICÍPIOS
        $estados = Cache::remember('dir_estados_resumo2', now()->addDay(), function () {
            return Estabelecimento::select( 'uf', DB::raw('count(distinct municipio) as total_municipios'))
                ->where('uf', '!=', 'EX')
                ->groupBy('uf')
                ->orderBy('uf')
                ->get();
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // KPI: TOTAL DE EMPRESAS ATIVAS
        $totalEmpresasAtivas = Cache::remember('dir_total_ativas', now()->addMonths(3), function () {
            return Estabelecimento::where('situacao_cadastral', 2)->count();
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // KPI: QUANTOS MUNICÍPIOS POSSUEM EMPRESAS
        $municipiosComEmpresas = Cache::remember('dir_municipios_com_empresas', now()->addMonths(12), function () {
            return Estabelecimento::distinct('municipio')->count('municipio');
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // KPI: MÉDIA DE ABERTURAS NOS ÚLTIMOS 12 MESES
        $aberturasUltimos12Meses = Cache::remember('dir_aberturas_12_meses', now()->addMonths(12), function () {
            return Estabelecimento::where('data_inicio_atividade', '>=', now()->subYear()->startOfMonth())->count();
        });
        $mediaAberturasMensal = (int) ceil($aberturasUltimos12Meses / 12);
        //************************************************************************************************************************
        //************************************************************************************************************************
        // KPI EXTRA: NOVAS EMPRESAS NO ÚLTIMO TRIMESTRE
        $novasEmpresasTrimestre = Cache::remember('dir_aberturas_trimestre', now()->addMonths(12), function () {
            return Estabelecimento::whereBetween('data_inicio_atividade', [
                now()->subMonths(3)->startOfDay(),
                now(),
            ])->count();
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // KPI EXTRA: TOTAL DE CNAES DISPONÍVEIS
        $totalCnaesCatalogados = Cache::remember('dir_total_cnaes', now()->addDay(), function () {
            return Cnae::count();
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // TOP ESTADOS COM MAIS EMPRESAS ATIVAS
        $topEstadosAtivos = Cache::remember('dir_top_estados2', now()->addHours(6), function () {
            return Estabelecimento::where('situacao_cadastral', 2)
                ->select('uf', DB::raw('count(*) as total'))
                ->groupBy('uf')
                ->orderByDesc('total')
                ->limit(10)
                ->get();
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // TOP 10 CIDADES COM MAIS EMPRESAS ATIVAS
        $top10CidadesBrutas = Cache::remember('dir_top_cidades', now()->addHours(6), function () {
            return Estabelecimento::with('municipioRel')
                ->where('situacao_cadastral', 2)
                ->select('municipio', 'uf', DB::raw('count(*) as total'))
                ->groupBy('municipio', 'uf')
                ->orderBy('total', 'desc')
                ->limit(10)
                ->get();
        });
        $top10CidadesAtivas = $top10CidadesBrutas->map(function ($item) {
            $nome = $item->municipioRel->descricao ?? 'Não encontrado';
            return (object) [
                'nome' => $nome,
                'uf' => $item->uf,
                'total' => $item->total,
                'municipio_slug' => Str::slug($nome),
            ];
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // CNAES MAIS POPULARES (ATIVOS)
        $topCnaes = Cache::remember('dir_top_cnaes', now()->addHours(6), function () {
            return Cnae::withCount(['estabelecimentos as ativos_count' => function ($query) {
                $query->where('situacao_cadastral', 2);
            }])
                ->orderByDesc('ativos_count')
                ->limit(6)
                ->get();
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
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
        // VARIÁVEIS
        $ufUpper = strtoupper($uf);
        $ufLower = strtolower($ufUpper); 
        $hoje = Carbon::now()->toDateString();
        $inicioAno = Carbon::now()->startOfYear()->toDateString();
        //************************************************************************************************************************
        //************************************************************************************************************************
        // TOTAL DE EMPRESAS ATIVAS NO ESTADO
        $totalAtivas = Cache::remember("estado_total_ativas_{$uf}", now()->addMonths(2), function () use ($ufUpper) {
            return Estabelecimento::where('uf', $ufUpper)->where('situacao_cadastral', 2)->count();
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // TOTAL DE MATRIZES NO ESTADO
        $totalMatrizes = Cache::remember("estado_total_matrizes_{$uf}", now()->addMonths(2), function () use ($ufUpper) {
            return Estabelecimento::where('uf', $ufUpper)->where('situacao_cadastral', 2)->where('identificador_matriz_filial', 1)->count();
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // TOTAL DE FILIAIS NO ESTADO
        $totalfiliais = Cache::remember("estado_total_filiais_{$uf}", now()->addMonths(2), function () use ($ufUpper) {
            return Estabelecimento::where('uf', $ufUpper)->where('situacao_cadastral', 2)->where('identificador_matriz_filial', 2)->count();
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // TOTAL DE EMPRESAS ABERTAS EM 2025 NO ESTADO
        $totalAbertas2025 = Cache::remember("estado_total_abertas_2025_{$uf}", now()->addMonths(2), function () use ($ufUpper, $inicioAno, $hoje) {
            return Estabelecimento::where('uf', $ufUpper)->whereBetween('data_inicio_atividade', [$inicioAno, $hoje])->count();
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // TOTAL DE EMPRESAS FECHADAS EM 2025 NO ESTADO
        $totalFechadas2025 = Cache::remember("estado_total_fechadas_2025_{$uf}", now()->addMonths(2), function () use ($ufUpper, $inicioAno, $hoje) {
            return Estabelecimento::where('uf', $ufUpper)->where('situacao_cadastral', '!=', 2)->whereBetween('data_situacao_cadastral', [$inicioAno, $hoje])->count();
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // TOP 10 CIDADES COM MAIS EMPRESAS ATIVAS NO ESTADO
        $top10Cidades = Cache::remember("estado_top10_cidades_{$uf}", now()->addMonths(2), function () use ($ufUpper, $ufLower) {
            $municipiosPopulares = Estabelecimento::with('municipioRel')
                ->select('municipio', DB::raw('count(*) as total'))
                ->where('uf', $ufUpper)
                ->where('situacao_cadastral', 2)
                ->groupBy('municipio')
                ->orderBy('total', 'desc')
                ->limit(10)
                ->get();
            return $municipiosPopulares->map(function ($item) use ($ufLower) {
                $item->nome = $item->municipioRel->descricao ?? 'N/A';
                $item->municipio_slug = Str::slug($item->nome);
                $item->uf = $ufLower;
                return $item;
            });
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // TOP 10 ATIVIDADES MAIS COMUNS NO ESTADO
        $topCnaes = Cache::remember("estado_top10_cnaes_{$uf}", now()->addMonths(2), function () use ($ufUpper){
            return Cnae::withCount(['estabelecimentos as ativos_count' => function ($query) use ($ufUpper){
                $query->where('uf', $ufUpper)->where('situacao_cadastral', 2);
            }])
                ->orderByDesc('ativos_count')
                ->limit(10)
                ->get();
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // TODOS OS MUNICIPIOS COM PAGINAÇÃO
        
        // TODOS OS MUNICIPIOS DO ESTADO COM PAGINAÇÃO
        $municipiosQuery = Estabelecimento::with('municipioRel')
            ->select('municipio', DB::raw('count(*) as total_empresas'))
            ->where('uf', $ufUpper)
            ->where('situacao_cadastral', 2)
            ->groupBy('municipio')
            ->orderBy('total_empresas', 'desc');

        $municipios = $municipiosQuery->paginate(20)->through(function ($item) use ($ufLower) {
            $item->nome = $item->municipioRel->descricao ?? 'N/A';
            $item->municipio_slug = Str::slug($item->nome);
            $item->uf = $ufLower;
            return $item;
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        return view('pages.directory.estados.state', [
            'totalAtivas' => $totalAtivas,
            'totalMatrizes' => $totalMatrizes,
            'totalfiliais' => $totalfiliais,
            'totalAbertas2025' => $totalAbertas2025,
            'totalFechadas2025' => $totalFechadas2025,
            'top10Cidades' => $top10Cidades,
            'topCnaes' => $topCnaes,
            'uf' => $ufUpper,
            'municipios' => $municipios,
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
        $inicioAno = Carbon::now()->startOfYear()->toDateString();
        
        // Busca o município pelo slug
        $municipio = Municipio::whereRaw('LOWER(REPLACE(descricao, " ", "-")) = ?', [$cidade_slug])->first();
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
        
        $totalAbertas2025 = Cache::remember("municipio_total_abertas_2025_{$ufReal}_{$municipio->descricao}", now()->addMonths(2), function () use ($ufReal, $municipio, $ufUpper, $inicioAno, $hoje) {
            return Estabelecimento::where('uf', $ufUpper)->where('municipio', $municipio->codigo)->whereBetween('data_inicio_atividade', [$inicioAno, $hoje])->count();
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // TOTAL FECHADAS EM 2025
        $totalFechadas2025 = Cache::remember("estado_total_fechadas_2025_{$ufReal}_{$municipio->descricao}", now()->addMonths(2), function () use ($ufReal, $municipio, $ufUpper, $inicioAno, $hoje) {
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
