<?php

namespace App\Jobs;

use App\Models\Cnae;
use App\Models\Estabelecimento;
use App\Models\Municipio;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GenerateStateCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // ************************************************************************************************************************
    // TEMPO LIMITE ALTO (1 HORA) POIS VAI RODAR PARA 27 ESTADOS
    public $timeout = 3600; 
    // ************************************************************************************************************************

    private $estados = [
        'AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 
        'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'
    ];

    private $capitais = [
        'ac' => 'Rio Branco', 'al' => 'Maceió', 'ap' => 'Macapá', 'am' => 'Manaus',
        'ba' => 'Salvador', 'ce' => 'Fortaleza', 'df' => 'Brasília', 'es' => 'Vitória',
        'go' => 'Goiânia', 'ma' => 'São Luís', 'mt' => 'Cuiabá', 'ms' => 'Campo Grande',
        'mg' => 'Belo Horizonte', 'pa' => 'Belém', 'pb' => 'João Pessoa', 'pr' => 'Curitiba',
        'pe' => 'Recife', 'pi' => 'Teresina', 'rj' => 'Rio de Janeiro', 'rn' => 'Natal',
        'rs' => 'Porto Alegre', 'ro' => 'Porto Velho', 'rr' => 'Boa Vista', 'sc' => 'Florianópolis',
        'sp' => 'São Paulo', 'se' => 'Aracaju', 'to' => 'Palmas'
    ];

    public function handle(): void
    {
        $hoje = Carbon::now()->toDateString();
        $inicioAno = Carbon::createFromDate(2025, 1, 1)->toDateString();
        foreach ($this->estados as $uf) {
            $ufUpper = strtoupper($uf);
            $ufLower = strtolower($uf);
            
            // ************************************************************************************************************************
            // 1. TOTAL DE EMPRESAS ATIVAS
            // ************************************************************************************************************************
            $totalAtivas = Estabelecimento::where('uf', $ufUpper)->where('situacao_cadastral', 2)->count();
            Cache::put("estado_total_ativas_{$ufUpper}", $totalAtivas, now()->addMonths(3));

            // ************************************************************************************************************************
            // 2. TOTAL DE MATRIZES
            // ************************************************************************************************************************
            $totalMatrizes = Estabelecimento::where('uf', $ufUpper)->where('situacao_cadastral', 2)->where('identificador_matriz_filial', 1)->count();
            Cache::put("estado_total_matrizes_{$ufUpper}", $totalMatrizes, now()->addMonths(3));

            // ************************************************************************************************************************
            // 3. TOTAL DE FILIAIS
            // ************************************************************************************************************************
            $totalFiliais = Estabelecimento::where('uf', $ufUpper)->where('situacao_cadastral', 2)->where('identificador_matriz_filial', 2)->count();
            Cache::put("estado_total_filiais_{$ufUpper}", $totalFiliais, now()->addMonths(3));

            // ************************************************************************************************************************
            // 4. ABERTAS EM 2025 (ANO ATUAL)
            // ************************************************************************************************************************
            $totalAbertas = Estabelecimento::where('uf', $ufUpper)->whereBetween('data_inicio_atividade', [$inicioAno, $hoje])->count();
            Cache::put("estado_total_abertas_2025_{$ufUpper}", $totalAbertas, now()->addMonths(3));

            // ************************************************************************************************************************
            // 5. FECHADAS EM 2025 (ANO ATUAL)
            // ************************************************************************************************************************
            $totalFechadas = Estabelecimento::where('uf', $ufUpper)->where('situacao_cadastral', '!=', 2)->whereBetween('data_situacao_cadastral', [$inicioAno, $hoje])->count();
            Cache::put("estado_total_fechadas_2025_{$ufUpper}", $totalFechadas, now()->addMonths(3));

            // ************************************************************************************************************************
            // 6. TOTAL ATIVAS NA CAPITAL
            // ************************************************************************************************************************
            $nomeCapital = $this->capitais[$ufLower] ?? '';
            $codigoCapital = null;
            
            if ($nomeCapital) {
                $codigoCapital = Municipio::whereRaw('LOWER(descricao) = ?', [mb_strtolower($nomeCapital, 'UTF-8')])->value('codigo');
            }

            $totalCapitalAtivas = 0;
            if ($codigoCapital) {
                $totalCapitalAtivas = Estabelecimento::where('uf', $ufUpper)
                    ->where('municipio', $codigoCapital)
                    ->where('situacao_cadastral', 2)
                    ->count();
            }
            Cache::put("estado_total_capital_ativas_{$ufUpper}", $totalCapitalAtivas, now()->addMonths(3));

            // ************************************************************************************************************************
            // 7. TOP 10 CIDADES
            // ************************************************************************************************************************
            $top10Cidades = Estabelecimento::with('municipioRel')
                ->select('municipio', DB::raw('count(*) as total'))
                ->where('uf', $ufUpper)
                ->where('situacao_cadastral', 2)
                ->groupBy('municipio')
                ->orderByDesc('total')
                ->limit(10)
                ->get()
                ->map(function ($item) use ($ufLower) {
                    $item->nome = $item->municipioRel->descricao ?? 'N/A';
                    $item->municipio_slug = Str::slug($item->nome);
                    $item->uf = $ufLower;
                    return $item;
                });
            Cache::put("estado_top10_cidades_{$ufUpper}", $top10Cidades, now()->addMonths(3));

            // ************************************************************************************************************************
            // 8. TOP 10 CNAES
            // ************************************************************************************************************************
            $topCnaes = Cnae::withCount(['estabelecimentos as ativos_count' => function ($query) use ($ufUpper){
                $query->where('uf', $ufUpper)->where('situacao_cadastral', 2);
            }])
                ->orderByDesc('ativos_count')
                ->limit(10)
                ->get();
            Cache::put("estado_top10_cnaes_{$ufUpper}", $topCnaes, now()->addMonths(3));

            // ************************************************************************************************************************
            // 9. LISTA COMPLETA DE MUNICÍPIOS (PARA PAGINAÇÃO NO CONTROLLER)
            // ************************************************************************************************************************
            // Ao invés de paginar no banco, buscamos TODOS os municípios ordenados e salvamos no cache.
            // O controller fará a paginação manual dessa collection. É muito mais rápido no load da página.
            $allMunicipios = Estabelecimento::with('municipioRel')
                ->select('municipio', DB::raw('count(*) as total_empresas'))
                ->where('uf', $ufUpper)
                ->where('situacao_cadastral', 2)
                ->groupBy('municipio')
                ->orderBy('total_empresas', 'desc')
                ->get()
                ->map(function ($item) use ($ufLower) {
                    $item->nome = $item->municipioRel->descricao ?? 'N/A';
                    $item->municipio_slug = Str::slug($item->nome);
                    $item->uf = $ufLower;
                    return $item;
                });
            Cache::put("estado_all_municipios_{$ufUpper}", $allMunicipios, now()->addMonths(3));
        }
    }
}