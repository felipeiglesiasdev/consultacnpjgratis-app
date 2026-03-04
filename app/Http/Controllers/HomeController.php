<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Define o tempo de expiração do cache para 3 meses
        $tempoCache = now()->addMonths(3);

        // ************************************************************************************************************************
        // TOTAL DE EMPRESAS ATIVAS (Situação Cadastral = 2)
        // ************************************************************************************************************************
        $totalAtivas = Cache::remember('total_ativas', $tempoCache, function () {
            return DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->where('situacao_cadastral', 2)->count();
        });

        // ************************************************************************************************************************
        // TOTAL DE EMPRESAS ENCERRADAS (Situação Cadastral != 2)
        // ************************************************************************************************************************
        $totalEncerradas = Cache::remember('total_encerradas', $tempoCache, function () {
            return DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->where('situacao_cadastral', '!=', 2)->count();
        });

        // ************************************************************************************************************************
        // ABERTURAS NOS ÚLTIMOS 3 ANOS
        // ************************************************************************************************************************
        $abertasUltimosAnos = Cache::remember('abertas_3_anos', $tempoCache, function () {
            $anos = ['2025', '2024', '2023'];
            $dados = collect();
            foreach ($anos as $ano) {
                $total = DB::connection('mysql_dados')->table('estabelecimentos_geral')
                    ->whereBetween('data_inicio_atividade', ["{$ano}-01-01", "{$ano}-12-31"])
                    ->count();
                $dados->put($ano, $total);
            }
            return $dados;
        });

        // ************************************************************************************************************************
        // FECHAMENTOS NOS ÚLTIMOS 3 ANOS
        // ************************************************************************************************************************
        $fechadasUltimosAnos = Cache::remember('fechadas_3_anos', $tempoCache, function () {
            $anos = ['2025', '2024', '2023'];
            $dados = collect();
            foreach ($anos as $ano) {
                $total = DB::connection('mysql_dados')->table('estabelecimentos_geral')
                    ->where('situacao_cadastral', '!=', 2)
                    ->whereBetween('data_situacao_cadastral', ["{$ano}-01-01", "{$ano}-12-31"])
                    ->count();
                $dados->put($ano, $total);
            }
            return $dados;
        });

        // ************************************************************************************************************************
        // RETORNA A VIEW COM OS DADOS CARREGADOS
        // ************************************************************************************************************************
        return view('pages.home', compact(
            'totalAtivas', 
            'totalEncerradas', 
            'abertasUltimosAnos', 
            'fechadasUltimosAnos', 
        ));
    }
}