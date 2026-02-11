<?php

namespace App\Console\Commands;

use App\Jobs\GenerateStateCacheJob;
use Illuminate\Console\Command;

class GenerateStateCacheCommand extends Command
{
    // ************************************************************************************************************************
    // NOME DO COMANDO
    // ************************************************************************************************************************
    protected $signature = 'cache:generate-states';

    protected $description = 'Gera o cache para as páginas de todos os Estados (KPIs, Tops e Municípios)';

    public function handle()
    {
        $this->info('Iniciando o Job para gerar o cache dos Estados. Isso pode levar alguns minutos...');
        
        // ************************************************************************************************************************
        // DISPARA O JOB
        // ************************************************************************************************************************
        GenerateStateCacheJob::dispatch();

        $this->info('Job enviado! Verifique o processamento da fila.');
        
        return Command::SUCCESS;
    }
}