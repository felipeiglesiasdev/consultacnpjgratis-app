<?php
// INÍCIO DO ARQUIVO PHP

namespace App\Http\Controllers; // NAMESPACE DO CONTROLADOR

use App\Models\Cnae; // MODEL DE ATIVIDADES ECONÔMICAS
use App\Models\Estabelecimento; // MODEL DE ESTABELECIMENTOS
use App\Models\Municipio; // MODEL DE MUNICÍPIOS
use Illuminate\Support\Facades\Cache; // CACHE PARA OTIMIZAR CONSULTAS
use Illuminate\Support\Facades\DB; // FACADE PARA CONSULTAS SQL

class DirectoryController extends Controller // CONTROLADOR DO DIRETÓRIO DE EMPRESAS
{
    public function index()
    {
        // LISTA DE ESTADOS COM TOTAL DE EMPRESAS
        $estados = Cache::remember('dir_estados', now()->addDay(), function () {
            return Estabelecimento::select('uf', DB::raw('count(*) as total'))
                ->groupBy('uf')
                ->orderBy('uf')
                ->get();
        });

        // KPI: TOTAL DE EMPRESAS ATIVAS
        $totalEmpresasAtivas = Cache::remember('dir_total_ativas', now()->addHours(12), function () {
            return Estabelecimento::where('situacao_cadastral', 2)->count();
        });

        // KPI: QUANTOS MUNICÍPIOS POSSUEM EMPRESAS
        $municipiosComEmpresas = Cache::remember('dir_municipios_com_empresas', now()->addHours(12), function () {
            return Estabelecimento::distinct('municipio')->count('municipio');
        });

        // KPI: MÉDIA DE ABERTURAS NOS ÚLTIMOS 12 MESES
        $aberturasUltimos12Meses = Cache::remember('dir_aberturas_12_meses', now()->addHours(12), function () {
            return Estabelecimento::where('data_inicio_atividade', '>=', now()->subYear()->startOfMonth())->count();
        });
        $mediaAberturasMensal = (int) ceil($aberturasUltimos12Meses / 12);

        // KPI EXTRA: NOVAS EMPRESAS NO ÚLTIMO TRIMESTRE
        $novasEmpresasTrimestre = Cache::remember('dir_aberturas_trimestre', now()->addHours(12), function () {
            return Estabelecimento::whereBetween('data_inicio_atividade', [
                now()->subMonths(3)->startOfDay(),
                now(),
            ])->count();
        });

        // KPI EXTRA: TOTAL DE CNAES DISPONÍVEIS
        $totalCnaesCatalogados = Cache::remember('dir_total_cnaes', now()->addDay(), function () {
            return Cnae::count();
        });

        // TOP ESTADOS COM MAIS EMPRESAS ATIVAS
        $topEstadosAtivos = Cache::remember('dir_top_estados', now()->addHours(6), function () {
            return Estabelecimento::where('situacao_cadastral', 2)
                ->select('uf', DB::raw('count(*) as total'))
                ->groupBy('uf')
                ->orderByDesc('total')
                ->limit(6)
                ->get();
        });

        // TOP CIDADES COM MAIS EMPRESAS ATIVAS
        $topCidadesBrutas = Cache::remember('dir_top_cidades', now()->addHours(6), function () {
            return Estabelecimento::where('situacao_cadastral', 2)
                ->select('municipio', DB::raw('count(*) as total'))
                ->groupBy('municipio')
                ->orderByDesc('total')
                ->limit(6)
                ->get();
        });
        $municipiosLookup = Municipio::whereIn('codigo', $topCidadesBrutas->pluck('municipio'))
            ->get()
            ->keyBy('codigo');
        $topCidadesAtivas = $topCidadesBrutas->map(function ($cidade) use ($municipiosLookup) {
            $municipio = $municipiosLookup[$cidade->municipio] ?? null;

            return [
                'codigo' => $cidade->municipio,
                'nome' => $municipio->descricao ?? 'Município não encontrado',
                'uf' => $municipio->uf ?? null,
                'total' => $cidade->total,
            ];
        });

        // CNAES MAIS POPULARES (ATIVOS)
        $topCnaes = Cache::remember('dir_top_cnaes', now()->addHours(6), function () {
            return Cnae::withCount(['estabelecimentos as ativos_count' => function ($query) {
                $query->where('situacao_cadastral', 2);
            }])
                ->orderByDesc('ativos_count')
                ->limit(6)
                ->get();
        });

        // CNAES QUE MAIS CRESCERAM NO ÚLTIMO ANO
        $cnaesQuentesBrutos = Cache::remember('dir_top_cnaes_recentes', now()->addHours(6), function () {
            return Estabelecimento::where('data_inicio_atividade', '>=', now()->subYear()->startOfMonth())
                ->select('cnae_fiscal_principal', DB::raw('count(*) as total'))
                ->groupBy('cnae_fiscal_principal')
                ->orderByDesc('total')
                ->limit(6)
                ->get();
        });
        $cnaesLookup = Cnae::whereIn('codigo', $cnaesQuentesBrutos->pluck('cnae_fiscal_principal'))
            ->get()
            ->keyBy('codigo');
        $topCnaesRecentes = $cnaesQuentesBrutos->map(function ($registro) use ($cnaesLookup) {
            $cnae = $cnaesLookup[$registro->cnae_fiscal_principal] ?? null;

            return [
                'codigo' => $registro->cnae_fiscal_principal,
                'descricao' => $cnae->descricao ?? 'Descrição não encontrada',
                'codigo_formatado' => $cnae?->codigo_formatado ?? null,
                'total' => $registro->total,
            ];
        });

        return view('pages.directory.empresas.index', [
            'estados' => $estados,
            'topEstadosAtivos' => $topEstadosAtivos,
            'topCidadesAtivas' => $topCidadesAtivas,
            'topCnaes' => $topCnaes,
            'topCnaesRecentes' => $topCnaesRecentes,
            'totalEmpresasAtivas' => $totalEmpresasAtivas,
            'municipiosComEmpresas' => $municipiosComEmpresas,
            'mediaAberturasMensal' => $mediaAberturasMensal,
            'novasEmpresasTrimestre' => $novasEmpresasTrimestre,
            'totalCnaesCatalogados' => $totalCnaesCatalogados,
        ]);
    }

    public function cnaeIndex()
    {
        // LISTA COMPLETA PARA BUSCA EM TEMPO REAL
        $allCnaes = Cnae::select('codigo', 'descricao')->get()->toJson();

        // TOP CNAES POR EMPRESAS ATIVAS
        $topCnaes = Cnae::withCount(['estabelecimentos as estabelecimentos_count' => function ($query) {
            $query->where('situacao_cadastral', 2);
        }])
            ->orderByDesc('estabelecimentos_count')
            ->limit(10)
            ->get();

        return view('pages.directory.atividades.cnae_list', compact('allCnaes', 'topCnaes'));
    }

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
            ->limit(10)
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

    public function byStatus(string $status_slug)
    {
        // ROTAS DE STATUS NÃO ESTÃO SENDO PRIORIZADAS ATUALMENTE
        return redirect()->route('empresas.index');
    }

    public function byState(string $uf)
    {
        // RESUMO DO ESTADO SELECIONADO
        $codigosMunicipios = Estabelecimento::where('uf', strtoupper($uf))
            ->select('municipio')
            ->distinct()
            ->pluck('municipio');

        $municipios = Municipio::whereIn('codigo', $codigosMunicipios)
            ->orderBy('descricao')
            ->get();

        $statusCounts = Estabelecimento::where('uf', strtoupper($uf))
            ->select('situacao_cadastral', DB::raw('count(*) as total'))
            ->groupBy('situacao_cadastral')
            ->pluck('total', 'situacao_cadastral')
            ->toArray();

        $totalAtivas = $statusCounts['2'] ?? 0;

        $topCidades = Estabelecimento::where('uf', strtoupper($uf))
            ->where('situacao_cadastral', 2)
            ->select('municipio', DB::raw('count(*) as total'))
            ->groupBy('municipio')
            ->orderByDesc('total')
            ->limit(6)
            ->get();

        $municipiosLookup = $municipios->keyBy('codigo');
        $topCidades = $topCidades->map(function ($cidade) use ($municipiosLookup) {
            $municipio = $municipiosLookup[$cidade->municipio] ?? null;

            return [
                'nome' => $municipio->descricao ?? 'Cidade não encontrada',
                'total' => $cidade->total,
            ];
        });

        $topCnaes = Cnae::whereHas('estabelecimentos', function ($query) use ($uf) {
            $query->where('uf', strtoupper($uf))->where('situacao_cadastral', 2);
        })
            ->withCount(['estabelecimentos as estabelecimentos_count' => function ($query) use ($uf) {
                $query->where('uf', strtoupper($uf))->where('situacao_cadastral', 2);
            }])
            ->orderByDesc('estabelecimentos_count')
            ->limit(6)
            ->get();

        return view('pages.directory.estados.state', [
            'uf' => strtoupper($uf),
            'municipios' => $municipios,
            'statusCounts' => $statusCounts,
            'topCidades' => $topCidades,
            'topCnaes' => $topCnaes,
            'totalAtivas' => $totalAtivas,
        ]);
    }

    public function byCity(string $uf, string $cidade_slug)
    {
        // COMO NÃO HÁ IMPLEMENTAÇÃO DE SLUGS, REDIRECIONAMOS PARA O ESTADO
        return redirect()->route('empresas.state', ['uf' => strtolower($uf)]);
    }
}
