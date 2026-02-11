<?php

namespace App\Jobs;

use App\Models\Cnae;
use App\Models\Estabelecimento;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class GenerateHomeCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // ************************************************************************************************************************
    // AUMENTA O TEMPO LIMITE DO JOB PARA 30 MINUTOS (CONSULTAS PESADAS)
    public $timeout = 1800; 
    // ************************************************************************************************************************

    public function __construct()
    {
        //
    }

    public function handle(): void
    {
        // ************************************************************************************************************************
        // TOTAL DE EMPRESAS ATIVAS NO BRASIL
        // ************************************************************************************************************************
        $totalAtivas = Estabelecimento::where('situacao_cadastral', 2)->count();
        Cache::put('total_ativas', $totalAtivas, now()->addMonths(3));

        // ************************************************************************************************************************
        // TOTAL DE EMPRESAS ENCERRADAS NO BRASIL
        // ************************************************************************************************************************
        $totalEncerradas = Estabelecimento::where('situacao_cadastral', '!=', 2)->count();
        Cache::put('total_encerradas', $totalEncerradas, now()->addMonths(3));

        // ************************************************************************************************************************
        // EMPRESAS ABERTAS NOS ÚLTIMOS ANOS (2024, 2023, 2022)
        // ************************************************************************************************************************
        $anos = ['2024', '2023', '2022'];
        $abertasUltimosAnos = collect();
        
        foreach ($anos as $ano) {
            $total = Estabelecimento::whereBetween('data_inicio_atividade', ["{$ano}-01-01", "{$ano}-12-31"])->count();
            $abertasUltimosAnos->put($ano, $total);
        }
        Cache::put('abertas_3_anos', $abertasUltimosAnos, now()->addMonths(3));

        // ************************************************************************************************************************
        // EMPRESAS FECHADAS NOS ÚLTIMOS ANOS (2024, 2023, 2022)
        // ************************************************************************************************************************
        $fechadasUltimosAnos = collect();
        
        foreach ($anos as $ano) {
            $total = Estabelecimento::where('situacao_cadastral', '!=', 2)
                ->whereBetween('data_situacao_cadastral', ["{$ano}-01-01", "{$ano}-12-31"])
                ->count();
            $fechadasUltimosAnos->put($ano, $total);
        }
        Cache::put('fechadas_3_anos', $fechadasUltimosAnos, now()->addMonths(3));

        // ************************************************************************************************************************
        // TOP 5 CNAES MAIS COMUNS NO BRASIL
        // ************************************************************************************************************************
        $topCnaes = Cnae::withCount(['estabelecimentos as ativos_count' => function ($query) {
            $query->where('situacao_cadastral', 2);
        }])
            ->orderByDesc('ativos_count')
            ->limit(6)
            ->get();
            
        Cache::put('home_top_cnaes', $topCnaes, now()->addMonths(3));
    }
}