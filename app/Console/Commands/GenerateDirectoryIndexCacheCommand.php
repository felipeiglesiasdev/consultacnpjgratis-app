<?php

namespace App\Console\Commands;

use App\Jobs\GenerateDirectoryIndexCacheJob;
use Illuminate\Console\Command;

class GenerateDirectoryIndexCacheCommand extends Command
{
    // ************************************************************************************************************************
    // ASSINATURA DO COMANDO
    // ************************************************************************************************************************
    protected $signature = 'cache:generate-directory-index';

    protected $description = 'Gera o cache para a página inicial do diretório de empresas (Estados e Totais)';

    public function handle()
    {
        $this->info('Iniciando job de cache do Diretório (Estados)...');
        
        // ************************************************************************************************************************
        // DISPARA O JOB
        // ************************************************************************************************************************
        GenerateDirectoryIndexCacheJob::dispatch();

        $this->info('Job enviado para a fila com sucesso!');
        
        return Command::SUCCESS;
    }
}