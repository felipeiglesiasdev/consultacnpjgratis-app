<?php
namespace App\Http\Controllers; // NAMESPACE DO CONTROLADOR
use App\Models\Cnae; // MODEL DE ATIVIDADES ECONÔMICAS
use App\Models\Estabelecimento; // MODEL DE ESTABELECIMENTOS
use Illuminate\Support\Facades\Cache; // CACHE PARA OTIMIZAR CONSULTAS
use Illuminate\Support\Facades\DB; // FACADE PARA CONSULTAS SQL

class HomeController extends Controller
{
    public function index()
    {
        // TOTAL DE EMPRESAS ATIVAS NO BRASIL 
        $totalAtivas = Cache::remember('total_ativas', now()->addMonths(3), function () {
            return Estabelecimento::where('situacao_cadastral', 2)->count();
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // TOTAL DE EMPRESAS ENCERRADAS NO BRASIL 
        $totalEncerradas = Cache::remember('total_encerradas', now()->addMonths(3), function () {
            return Estabelecimento::where('situacao_cadastral', '!=', 2)->count();
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // EMPRESAS ABERTAS NOS ÚLTIMOS ANOS (2024, 2023, 2022)
        $abertasUltimosAnos = Cache::remember('abertas_3_anos', now()->addMonths(3), function () {
            $anos = ['2024', '2023', '2022'];
            $dados = collect();
            foreach ($anos as $ano) {
                $total = Estabelecimento::whereBetween('data_inicio_atividade', ["{$ano}-01-01", "{$ano}-12-31"])->count();
                $dados->put($ano, $total);
            }
            return $dados;
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // EMPRESAS FECHADAS NOS ÚLTIMOS ANOS (2024, 2023, 2022)
        $fechadasUltimosAnos = Cache::remember('fechadas_3_anos', now()->addMonths(3), function () {
            $anos = ['2024', '2023', '2022'];
            $dados = collect();
            foreach ($anos as $ano) {
                $total = Estabelecimento::where('situacao_cadastral', '!=', 2)
                    ->whereBetween('data_situacao_cadastral', ["{$ano}-01-01", "{$ano}-12-31"])
                    ->count();
                $dados->put($ano, $total);
            }
            return $dados;
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        // TOP 5 CNAES MAIS COMUNS NO BRASIL
        $topCnaes = Cache::remember('home_top_cnaes', now()->addMonths(3), function () {
            return Cnae::withCount(['estabelecimentos as ativos_count' => function ($query) {
                $query->where('situacao_cadastral', 2);
            }])
                ->orderByDesc('ativos_count')
                ->limit(5)
                ->get();
        });
        //************************************************************************************************************************
        //************************************************************************************************************************
        return view('pages.home', [
            'statusCounts'      => $statusCounts,
            'topCnaes'          => $topCnaes,
            'abertasUltimosAnos' => $abertasUltimosAnos,
            'fechadasUltimosAnos' => $fechadasUltimosAnos,
            'totalAtivas'        => $totalAtivas,
            'totalEncerradas'    => $totalEncerradas,
        ]);
    }
}