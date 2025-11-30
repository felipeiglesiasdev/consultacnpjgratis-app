<?php
namespace App\Http\Controllers;

use App\Models\Cnae;
use App\Models\Estabelecimento;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $statusCounts = Cache::remember('home_status_counts', now()->addMonths(3), function () {
            return Estabelecimento::select('situacao_cadastral', DB::raw('count(*) as total'))
                ->groupBy('situacao_cadastral')
                ->pluck('total', 'situacao_cadastral')
                ->toArray();
        });

        $statusCounts = collect(['2', '8', '3', '4', '1'])
            ->mapWithKeys(fn ($codigo) => [$codigo => $statusCounts[$codigo] ?? 0])
            ->toArray();

        $abertasUltimosAnos = Cache::remember('abertas_3_anos', now()->addMonths(3), function () {
            $anos = ['2024', '2023', '2022'];
            $dados = collect();

            foreach ($anos as $ano) {
                $total = Estabelecimento::whereBetween('data_inicio_atividade', ["{$ano}-01-01", "{$ano}-12-31"])->count();
                $dados->put($ano, $total);
            }

            return $dados;
        });

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

        $topCnaes = Cache::remember('home_top_cnaes', now()->addMonths(3), function () {
            return Cnae::withCount(['estabelecimentos as ativos_count' => function ($query) {
                $query->where('situacao_cadastral', 2);
            }])
                ->orderByDesc('ativos_count')
                ->limit(5)
                ->get();
        });

        $totalAtivas = $statusCounts['2'] ?? 0;
        $totalEncerradas = collect($statusCounts)->except('2')->sum();

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