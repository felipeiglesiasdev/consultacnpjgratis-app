<?php
namespace App\Http\Controllers;
use App\Models\Cnae;
use App\Models\Estabelecimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    
    public function index()
    {
        // 1. Contagem de empresas Ativas (situacao_cadastral = 2)
        $totalAtivas = Cache::remember('total_ativas', now()->addMonths(3), function () {
            return Estabelecimento::where('situacao_cadastral', 2)
                ->count();
        });

        // 2. Contagem de empresas Encerradas (situacao_cadastral != 2)
        $totalEncerradas = Cache::remember('total_encerradas', now()->addMonths(3), function () {
            return Estabelecimento::where('situacao_cadastral', '!=', 2)
                ->count();
        });

        // 3. Abertas em 2024, 2023 e 2022
        $abertasUltimosAnos = Cache::remember('abertas_3_anos', now()->addMonths(3), function () {
            $anos = ['2024', '2023', '2022'];
            $dados = collect();
            foreach($anos as $ano) {
                $total = Estabelecimento::whereBetween('data_inicio_atividade', ["{$ano}-01-01", "{$ano}-12-31"])->count();
                $dados->put($ano, $total);
            }
            return $dados;
        });

        // 4. Fechadas em 2024, 2023 e 2022
        $fechadasUltimosAnos = Cache::remember('fechadas_3_anos', now()->addMonths(3), function () {
            $anos = ['2024', '2023', '2022'];
            $dados = collect();
            foreach($anos as $ano) {
            $total = Estabelecimento::where('situacao_cadastral','!=', 2)
                ->whereBetween('data_situacao_cadastral', ["{$ano}-01-01", "{$ano}-12-31"])
                ->count();
            $dados->put($ano, $total);
            }
            return $dados;
        });



        // 2. Top 5 CNAEs (usando Models + cache)
        $topCnaes = Cache::remember('home_top_cnaes', now()->addMonths(3), function () {
                // Busca os 5 CNAEs mais frequentes na tabela de estabelecimentos
                $topCodes = Estabelecimento::where('situacao_cadastral', 2)
                    ->select('cnae_fiscal_principal', DB::raw('count(*) as total'))
                    ->groupBy('cnae_fiscal_principal')
                    ->orderByDesc('total')
                    ->limit(5)
                    ->pluck('cnae_fiscal_principal')
                    ->toArray();
                    
                // Retorna os CNAEs com contagem de estabelecimentos
                return Cnae::withCount('estabelecimentos')
                    ->whereIn('codigo', $topCodes)
                    ->orderByDesc('estabelecimentos_count')
                    ->get();
            }
        );


        // 3. Retorna para a view page.home
        return view('pages.home', [
            'statusCounts' => $statusCounts,
            'topCnaes'     => $topCnaes,
        ]);
    }
}