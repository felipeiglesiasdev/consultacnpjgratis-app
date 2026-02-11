<?php

namespace App\Console\Commands;

use App\Jobs\GenerateHomeCacheJob;
use Illuminate\Console\Command;

class GenerateHomeCacheCommand extends Command
{
    // ************************************************************************************************************************
    // NOME DO COMANDO NO TERMINAL
    // ************************************************************************************************************************
    protected $signature = 'cache:generate-home';

    // ************************************************************************************************************************
    // DESCRIÇÃO DO COMANDO
    // ************************************************************************************************************************
    protected $description = 'Gera e atualiza o cache dos dados da Home Page (KPIs, Gráficos e CNAEs)';

    public function handle()
    {
        $this->info('Iniciando o Job para gerar o cache da Home Page...');
        
        // ************************************************************************************************************************
        // DESPACHA O JOB PARA A FILA
        // ************************************************************************************************************************
        GenerateHomeCacheJob::dispatch();

        $this->info('Job despachado com sucesso! O cache será atualizado em segundo plano.');
        
        return Command::SUCCESS;
    }
}