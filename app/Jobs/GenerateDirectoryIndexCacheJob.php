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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GenerateDirectoryIndexCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // ************************************************************************************************************************
    // AUMENTA O TEMPO LIMITE DO JOB (Queries Pesadas)
    public $timeout = 1800; 
    // ************************************************************************************************************************

    public function __construct()
    {
        //
    }

    public function handle(): void
    {
        // ************************************************************************************************************************
        // 1. LISTA DE ESTADOS COM O TOTAL DE MUNICÍPIOS
        // ************************************************************************************************************************
        $estados = Estabelecimento::select('uf', DB::raw('count(distinct municipio) as total_municipios'))
            ->where('uf', '!=', 'EX')
            ->groupBy('uf')
            ->orderBy('uf')
            ->get();
        Cache::put('dir_estados_resumo', $estados, now()->addMonths(3));

        // ************************************************************************************************************************
        // 2. KPI: TOTAL DE EMPRESAS ATIVAS
        // ************************************************************************************************************************
        $totalEmpresasAtivas = Estabelecimento::where('situacao_cadastral', 2)->count();
        Cache::put('dir_total_ativas', $totalEmpresasAtivas, now()->addMonths(3));

        // ************************************************************************************************************************
        // 3. KPI: QUANTOS MUNICÍPIOS POSSUEM EMPRESAS
        // ************************************************************************************************************************
        $municipiosComEmpresas = Estabelecimento::distinct('municipio')->count('municipio');
        Cache::put('dir_municipios_com_empresas', $municipiosComEmpresas, now()->addMonths(3));

        // ************************************************************************************************************************
        // 4. KPI: MÉDIA DE ABERTURAS NOS ÚLTIMOS 12 MESES
        // ************************************************************************************************************************
        $aberturasUltimos12Meses = Estabelecimento::where('data_inicio_atividade', '>=', now()->subYear()->startOfMonth())->count();
        $mediaAberturasMensal = (int) ceil($aberturasUltimos12Meses / 12);
        Cache::put('dir_media_aberturas_mensal_calculated', $mediaAberturasMensal, now()->addMonths(3));

        // ************************************************************************************************************************
        // 5. KPI EXTRA: NOVAS EMPRESAS NO ÚLTIMO TRIMESTRE
        // ************************************************************************************************************************
        $novasEmpresasTrimestre = Estabelecimento::whereBetween('data_inicio_atividade', [
            now()->subMonths(3)->startOfDay(),
            now(),
        ])->count();
        Cache::put('dir_aberturas_trimestre', $novasEmpresasTrimestre, now()->addMonths(3));

        // ************************************************************************************************************************
        // 6. KPI EXTRA: TOTAL DE CNAES DISPONÍVEIS
        // ************************************************************************************************************************
        $totalCnaesCatalogados = Cnae::count();
        Cache::put('dir_total_cnaes', $totalCnaesCatalogados, now()->addMonths(3));

        // ************************************************************************************************************************
        // 7. TOP ESTADOS COM MAIS EMPRESAS ATIVAS (Não confundir com a lista de resumo acima)
        // ************************************************************************************************************************
        /* OBS: Você chamou isso de 'dir_top_estados2' no seu código original, mas usei um nome
           diferente da lista principal para não confundir se for usar em outro lugar.
           No controller vamos mapear corretamente.
        */
        $topEstadosAtivos = Estabelecimento::where('situacao_cadastral', 2)
            ->select('uf', DB::raw('count(*) as total'))
            ->groupBy('uf')
            ->orderByDesc('total')
            ->limit(10)
            ->get();
        Cache::put('dir_top_estados_ativos_chart', $topEstadosAtivos, now()->addMonths(3));

        // ************************************************************************************************************************
        // 8. TOP 10 CIDADES COM MAIS EMPRESAS ATIVAS (JÁ FORMATADO)
        // Fazemos o processamento pesado aqui para o controller pegar pronto
        // ************************************************************************************************************************
        $top10CidadesBrutas = Estabelecimento::with('municipioRel')
            ->where('situacao_cadastral', 2)
            ->select('municipio', 'uf', DB::raw('count(*) as total'))
            ->groupBy('municipio', 'uf')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        $top10CidadesAtivas = $top10CidadesBrutas->map(function ($item) {
            $nome = $item->municipioRel->descricao ?? 'Não encontrado';
            return (object) [
                'nome' => $nome,
                'uf' => $item->uf,
                'total' => $item->total,
                'municipio_slug' => Str::slug($nome),
            ];
        });
        Cache::put('dir_top_cidades_ativas_formatted', $top10CidadesAtivas, now()->addMonths(3));

        // ************************************************************************************************************************
        // 9. CNAES MAIS POPULARES (ATIVOS)
        // ************************************************************************************************************************
        $topCnaes = Cnae::withCount(['estabelecimentos as ativos_count' => function ($query) {
            $query->where('situacao_cadastral', 2);
        }])
            ->orderByDesc('ativos_count')
            ->limit(6)
            ->get();
        Cache::put('dir_top_cnaes', $topCnaes, now()->addMonths(3));
    }
}