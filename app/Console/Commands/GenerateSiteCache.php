<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\ConsultaAvancadaController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GenerateSiteCache extends Command
{
    /**
     * O nome e assinatura do comando.
     * Use a flag --clear para forçar a limpeza antes de gerar de novo.
     */
    protected $signature = 'cache:warmup {--clear : Limpa o cache existente antes de gerar um novo}';

    /**
     * A descrição do comando.
     */
    protected $description = 'Gera todo o cache do site (Home, Diretório, Estados, Consulta Avançada, Cidades) instanciando os Controllers originais.';

    /**
     * Array estático com as 27 UFs
     */
    private $ufs = [
        'AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 
        'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'
    ];

    /**
     * Executa o comando.
     */
    public function handle()
    {
        // Remove limite de tempo pois gerar cache de milhares de cidades demora
        set_time_limit(0);

        $startTime = microtime(true);
        $this->newLine();
        $this->info('====================================================');
        $this->info('🚀 INICIANDO AQUECIMENTO GERAL DE CACHE (WARMUP) 🚀');
        $this->info('====================================================');
        $this->newLine();

        // 1. Limpeza de Cache (Se a flag --clear foi passada)
        // Isso garante que o Cache::remember() vai executar a query de fato.
        if ($this->option('clear')) {
            $this->warn('🧹 Flag --clear detectada. Limpando todo o cache da aplicação...');
            $this->call('cache:clear');
            $this->info('Cache limpo com sucesso! Gerando novos dados do zero.');
            $this->newLine();
        }

        // =========================================================================
        // 1. HOME CONTROLLER
        // =========================================================================
        $this->runStep('1️⃣  Página Inicial (HomeController@index)', function() {
            app(HomeController::class)->index();
        });

        // =========================================================================
        // 2. DIRETÓRIO INDEX
        // =========================================================================
        $this->runStep('2️⃣  Portal de Empresas (DirectoryController@index)', function() {
            app(DirectoryController::class)->index();
        });

        // =========================================================================
        // 3. CONSULTA AVANÇADA (Filtros)
        // =========================================================================
        $this->runStep('3️⃣  Busca Avançada / Filtros (ConsultaAvancadaController@index)', function() {
            app(ConsultaAvancadaController::class)->index();
        });

        // =========================================================================
        // 4. DIRETÓRIO DE ESTADOS (27 UFs)
        // =========================================================================
        $this->info('4️⃣  Processando Estados (DirectoryController@byState)');
        
        // Simula uma requisição web real para passar pro Controller
        $request = Request::create('/', 'GET');
        
        $barEstados = $this->output->createProgressBar(count($this->ufs));
        $barEstados->setFormat(" %current%/%max% [%bar%] %percent:3s%% -- Processando Estado: %message%");
        $barEstados->start();

        foreach ($this->ufs as $uf) {
            $barEstados->setMessage($uf);
            
            try {
                app(DirectoryController::class)->byState($request, strtolower($uf));
                $barEstados->advance();
            } catch (\Exception $e) {
                $this->newLine(2);
                $this->error("❌ Erro ao gerar cache para o estado {$uf}: " . $e->getMessage());
                // Não paramos o loop, apenas logamos o erro e continuamos.
            }
        }
        $barEstados->finish();
        $this->newLine(2);
        $this->info('✅ Cache de todos os Estados gerado com sucesso!');
        $this->newLine();

        // =========================================================================
        // 5. DIRETÓRIO DE MUNICÍPIOS (Página 1 de todos os municípios ativos)
        // =========================================================================
        $this->info('5️⃣  Processando Municípios (DirectoryController@byCity - Página 1)');
        
        foreach ($this->ufs as $uf) {
            $this->info("   ➜ Buscando cidades ativas em: {$uf}...");
            
            // Busca apenas os municípios que têm empresas ativas nesta UF
            $municipiosAtivos = DB::connection('mysql_dados')->table('estabelecimentos_geral')
                ->join('municipios', 'estabelecimentos_geral.municipio', '=', 'municipios.codigo')
                ->where('estabelecimentos_geral.uf', $uf)
                ->where('estabelecimentos_geral.situacao_cadastral', 2)
                ->select('municipios.descricao')
                ->distinct()
                ->get();

            if ($municipiosAtivos->isEmpty()) {
                $this->line("      Nenhuma cidade ativa encontrada para {$uf}. Pulando.");
                continue;
            }

            $barCidades = $this->output->createProgressBar($municipiosAtivos->count());
            $barCidades->setFormat("      %current%/%max% [%bar%] %percent:3s%% -- Cidade: %message%");
            $barCidades->start();

            foreach ($municipiosAtivos as $mun) {
                $cidade_slug = Str::slug($mun->descricao);
                $barCidades->setMessage($mun->descricao);
                
                try {
                    // Força a requisição a ser sempre da página 1
                    $reqCidade = Request::create("/empresas/estado/" . strtolower($uf) . "/cidade/{$cidade_slug}?page=1", 'GET');
                    app(DirectoryController::class)->byCity(strtolower($uf), $cidade_slug);
                    $barCidades->advance();
                } catch (\Exception $e) {
                    $this->newLine();
                    $this->error("      ❌ Erro em {$mun->descricao} ({$uf}): " . $e->getMessage());
                }
            }
            $barCidades->finish();
            $this->newLine();
        }

        $this->newLine();
        $this->info('✅ Cache da Página 1 de todas as cidades ativas gerado com sucesso!');
        $this->newLine();

        // =========================================================================
        // FINALIZAÇÃO E RELATÓRIO DE DEPURACÃO
        // =========================================================================
        $totalTime = round(microtime(true) - $startTime, 2);
        $memoryUsage = round(memory_get_peak_usage(true) / 1048576, 2);

        $this->line('<bg=green;fg=white;options=bold> 🎉 SUCESSO! CACHE TOTAL GERADO! 🎉 </>');
        $this->table(
            ['Métrica', 'Resultado'],
            [
                ['Tempo Total de Execução', "{$totalTime} Segundos"],
                ['Pico de Uso de Memória', "{$memoryUsage} MB"],
                ['Status', 'Pronto para alta performance']
            ]
        );
        $this->newLine();
    }

    /**
     * Helper para exibir no console cada passo e calcular o tempo
     */
    private function runStep(string $title, \Closure $callback)
    {
        $this->line("<fg=cyan>➜ {$title}...</>");
        $start = microtime(true);
        
        try {
            $callback();
            $time = round(microtime(true) - $start, 2);
            $this->line("   <fg=green>✔ Concluído em {$time}s</>");
        } catch (\Exception $e) {
            $time = round(microtime(true) - $start, 2);
            $this->error("   ❌ Falha após {$time}s: " . $e->getMessage());
        }
        $this->newLine();
    }
}