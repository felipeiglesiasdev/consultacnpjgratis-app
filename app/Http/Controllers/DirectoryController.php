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
        // LISTA DE ESTADOS COM RESUMO: EMPRESAS TOTAIS, ATIVAS E MUNICÍPIOS ATENDIDOS
        $estados = Cache::remember('dir_estados_resumo', now()->addDay(), function () {
            return Estabelecimento::select(
                'uf',
                DB::raw('count(*) as total_empresas'),
                DB::raw("sum(case when situacao_cadastral = 2 then 1 else 0 end) as total_ativas"),
                DB::raw('count(distinct municipio) as total_municipios')
            )
                ->groupBy('uf')
                ->orderBy('uf')
                ->get();
        });

        // KPI: TOTAL DE EMPRESAS ATIVAS
        $totalEmpresasAtivas = Cache::remember('dir_total_ativas', now()->addMonths(3), function () {
            return Estabelecimento::where('situacao_cadastral', 2)->count();
        });

        // KPI: QUANTOS MUNICÍPIOS POSSUEM EMPRESAS
        $municipiosComEmpresas = Cache::remember('dir_municipios_com_empresas', now()->addMonths(12), function () {
            return Estabelecimento::distinct('municipio')->count('municipio');
        });

        // KPI: MÉDIA DE ABERTURAS NOS ÚLTIMOS 12 MESES
        $aberturasUltimos12Meses = Cache::remember('dir_aberturas_12_meses', now()->addMonths(12), function () {
            return Estabelecimento::where('data_inicio_atividade', '>=', now()->subYear()->startOfMonth())->count();
        });
        $mediaAberturasMensal = (int) ceil($aberturasUltimos12Meses / 12);

        // KPI EXTRA: NOVAS EMPRESAS NO ÚLTIMO TRIMESTRE
        $novasEmpresasTrimestre = Cache::remember('dir_aberturas_trimestre', now()->addMonths(12), function () {
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

    public function municipiosIndex()
    {
        // RESUMO GERAL DE MUNICÍPIOS, ESTADOS E EMPRESAS ATIVAS
        $resumoMunicipios = Cache::remember('dir_municipios_resumo', now()->addHours(6), function () {
            $totalMunicipios = Municipio::count();
            $municipiosComEmpresas = Estabelecimento::distinct('municipio')->count('municipio');

            $ufComMaisMunicipios = Municipio::select('uf', DB::raw('count(*) as total'))
                ->groupBy('uf')
                ->orderByDesc('total')
                ->first();

            return [
                'totalMunicipios' => $totalMunicipios,
                'municipiosComEmpresas' => $municipiosComEmpresas,
                'mediaEmpresasPorMunicipio' => (int) ceil(Estabelecimento::count() / max($totalMunicipios, 1)),
                'ufCampeaoMunicipios' => $ufComMaisMunicipios,
            ];
        });

        // TABELA DE MUNICÍPIOS COM PAGINAÇÃO DE 50 ITENS
        $municipiosPaginados = Estabelecimento::select(
            'municipio',
            DB::raw('count(*) as total_empresas'),
            DB::raw("sum(case when situacao_cadastral = 2 then 1 else 0 end) as total_ativas")
        )
            ->groupBy('municipio')
            ->orderByDesc('total_ativas')
            ->paginate(50);

        // ENRIQUECE COM NOME E UF DO MUNICÍPIO
        $municipiosLookup = Municipio::whereIn('codigo', $municipiosPaginados->pluck('municipio'))
            ->get()
            ->keyBy('codigo');

        $municipiosPaginados->getCollection()->transform(function ($linha) use ($municipiosLookup) {
            $municipio = $municipiosLookup[$linha->municipio] ?? null;

            return (object) [
                'codigo' => $linha->municipio,
                'nome' => $municipio->descricao ?? 'Município não encontrado',
                'uf' => $municipio->uf ?? null,
                'total_empresas' => $linha->total_empresas,
                'total_ativas' => $linha->total_ativas,
            ];
        });

        // FAQ EM PORTUGUÊS
        $faq = [
            [
                'pergunta' => 'Posso filtrar por município específico?',
                'resposta' => 'Sim, clique no nome da cidade na tabela para ver detalhes e exemplos de empresas ativas.',
            ],
            [
                'pergunta' => 'Quantas empresas são exibidas por município?',
                'resposta' => 'Mostramos totais consolidados e, ao entrar no município, listamos as últimas empresas ativas.',
            ],
            [
                'pergunta' => 'Qual a diferença entre total e empresas ativas?',
                'resposta' => 'O total considera todos os CNPJs cadastrados, enquanto empresas ativas incluem apenas situação cadastral 2.',
            ],
            [
                'pergunta' => 'Os dados são atualizados com que frequência?',
                'resposta' => 'Utilizamos o cache por algumas horas para acelerar a navegação, mas os dados vêm direto da base pública do CNPJ.',
            ],
        ];

        return view('pages.directory.municipios.index', [
            'resumoMunicipios' => $resumoMunicipios,
            'municipiosPaginados' => $municipiosPaginados,
            'faq' => $faq,
        ]);
    }

    public function municipioShow(string $codigo_municipio)
    {
        // DADOS BÁSICOS DO MUNICÍPIO
        $municipio = Municipio::findOrFail($codigo_municipio);

        // TOTAL DE EMPRESAS ATIVAS NA CIDADE
        $totalEmpresasAtivas = Estabelecimento::where('municipio', $codigo_municipio)
            ->where('situacao_cadastral', 2)
            ->count();

        // LISTA DE EMPRESAS MAIS RECENTES
        $empresas = Estabelecimento::with('empresa')
            ->where('municipio', $codigo_municipio)
            ->where('situacao_cadastral', 2)
            ->orderByDesc('data_inicio_atividade')
            ->paginate(25);

        // CNAES MAIS POPULARES NA CIDADE
        $topCnaes = Cnae::whereHas('estabelecimentos', function ($query) use ($codigo_municipio) {
            $query->where('municipio', $codigo_municipio)->where('situacao_cadastral', 2);
        })
            ->withCount(['estabelecimentos as estabelecimentos_count' => function ($query) use ($codigo_municipio) {
                $query->where('municipio', $codigo_municipio)->where('situacao_cadastral', 2);
            }])
            ->orderByDesc('estabelecimentos_count')
            ->limit(5)
            ->get();

        return view('pages.directory.municipios.city', [
            'municipio' => $municipio,
            'uf' => $municipio->uf,
            'totalEmpresasAtivas' => $totalEmpresasAtivas,
            'empresas' => $empresas,
            'topCnaes' => $topCnaes,
        ]);
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
        // MANTÉM COMPATIBILIDADE REDIRECIONANDO PARA O ÍNDICE DE MUNICÍPIOS
        return redirect()->route('empresas.municipios.index');
    }
}
