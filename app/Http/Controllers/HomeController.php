<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // ************************************************************************************************************************
        // RECUPERA OS TOTAIS DO CACHE (GERADOS PELO JOB)
        // SE NÃO EXISTIR NO CACHE, RETORNA 0 COMO PADRÃO
        // ************************************************************************************************************************
        $totalAtivas = Cache::get('total_ativas', 0);
        $totalEncerradas = Cache::get('total_encerradas', 0);

        // ************************************************************************************************************************
        // RECUPERA OS DADOS DOS GRÁFICOS (ABERTAS E ENCERRADAS NOS ÚLTIMOS ANOS)
        // SE NÃO EXISTIR, RETORNA UMA COLLECTION VAZIA
        // ************************************************************************************************************************
        $abertasUltimosAnos = Cache::get('abertas_3_anos', collect());
        $fechadasUltimosAnos = Cache::get('fechadas_3_anos', collect());

        // ************************************************************************************************************************
        // RECUPERA O TOP CNAES
        // ************************************************************************************************************************
        $topCnaes = Cache::get('home_top_cnaes', collect());

        // ************************************************************************************************************************
        // RETORNA A VIEW COM OS DADOS CARREGADOS
        // ************************************************************************************************************************
        return view('pages.home', compact(
            'totalAtivas', 
            'totalEncerradas', 
            'abertasUltimosAnos', 
            'fechadasUltimosAnos', 
            'topCnaes'
        ));
    }
}