<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cnae;
use App\Models\Estabelecimento;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DirectoryController extends Controller
{
    public function index()
    {

        // TODOS OS ESTADOS
        $estados = Cache::remember('todos_estados', now()->addMonths(3), function () {
            return Estabelecimento::select('uf')->where('uf', '!=', 'EX')->distinct()->orderBy('uf')->get();
        });
        // ******************************************************************************************************************
        // ******************************************************************************************************************
        // ABERTAS ATÉ O MOMENTO EM 2025
        $abertas2025 = Cache::remember('abertas_2025', now()->addMonths(3), function () {
            $anos = ['2025'];
            $dados = collect();
            foreach ($anos as $ano) {
                $total = Estabelecimento::whereBetween('data_inicio_atividade', ["{$ano}-01-01", "{$ano}-12-31"])->count();
                $dados->put($total, $ano);
            }
            return $dados;
        });
        // ******************************************************************************************************************
        // ******************************************************************************************************************
        //FECHADAS ATÉ O MOMENTO EM 2025
        $fechadas2025 = Cache::remember('fechadas_2025', now()->addMonths(3), function () {
            $anos = ['2025'];
            $dados = collect();
            foreach ($anos as $ano) {
                $total = Estabelecimento::where('situacao_cadastral', '!=', 2)
                    ->whereBetween('data_situacao_cadastral', ["{$ano}-01-01", "{$ano}-12-31"])
                    ->count();
                $dados->put($ano, $total);
            }
            return $dados;
        });
        // ******************************************************************************************************************
        // ******************************************************************************************************************
        // EMPRESAS ABERTAS NOS ULTIMOS 3 ANOS
        $abertasUltimosAnos = Cache::remember('abertas_3_anos', now()->addMonths(3), function () {
            $anos = ['2024', '2023', '2022'];
            $dados = collect();
            foreach ($anos as $ano) {
                $total = Estabelecimento::whereBetween('data_inicio_atividade', ["{$ano}-01-01", "{$ano}-12-31"])->count();
                $dados->put($ano, $total);
            }
            return $dados;
        });
        // ******************************************************************************************************************
        // ******************************************************************************************************************
        // EMPRESAS FECHADAS NOS ULTIMOS 3 ANOS
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
        // ******************************************************************************************************************
        // ******************************************************************************************************************
        // TOP 10 CNAES MAIS FREQUENTES
        $topCnaes = Cache::remember('top_cnaes', now()->addMonths(3), function () {
            return Cnae::withCount(['estabelecimentos as ativos_count' => function ($query) {
                $query->where('situacao_cadastral', 2);
            }])
                ->orderByDesc('ativos_count')
                ->limit(10)
                ->get();
        });
        // ******************************************************************************************************************
        // ******************************************************************************************************************
        return view('pages.directory.empresas.index', [
            'estados'           => $estados,
            'topCnaes'          => $topCnaes,
        ]);
        
        
    }
}
