<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class GenerateNorteSitemap extends Command
{
    /**
     * Assinatura do comando no terminal.
     */
    protected $signature = 'sitemap:norte';

    /**
     * Descrição do comando.
     */
    protected $description = 'Gera sitemaps estáticos em formato TXT (50k URLs cada) para as empresas da Região Norte.';

    /**
     * Limite de URLs por arquivo TXT (O limite oficial do Google é 50.000)
     */
    private $chunkSize = 50000;

    /**
     * Estados da Região Norte
     */
    private $estadosNorte = ['AC', 'AP', 'AM', 'PA', 'RO', 'RR', 'TO'];

    /**
     * Executa o comando.
     */
    public function handle()
    {
        // Garante que o comando rode o tempo que precisar sem cair
        set_time_limit(0);
        
        // Desativa log de queries para não estourar a memória RAM do servidor
        DB::connection('mysql_dados')->disableQueryLog();

        $startTime = microtime(true);
        
        $this->newLine();
        $this->info('===========================================================');
        $this->info('🗺️  INICIANDO GERAÇÃO DE SITEMAP - REGIÃO NORTE (TXT) 🗺️');
        $this->info('===========================================================');
        $this->newLine();

        // 1. Preparação dos Diretórios
        $sitemapPath = public_path('sitemaps');
        if (!File::exists($sitemapPath)) {
            File::makeDirectory($sitemapPath, 0755, true);
            $this->info('📁 Diretório public/sitemaps criado com sucesso.');
        } else {
            // Limpa os sitemaps antigos do Norte para não acumular lixo
            $oldFiles = File::glob("{$sitemapPath}/sitemap_norte_*.txt");
            File::delete($oldFiles);
            $this->warn('🧹 Sitemaps antigos da região norte deletados.');
        }

        $this->newLine();
        $this->line('<fg=cyan>➜ Contando empresas na região Norte...</>');

        // 2. Query Base
        $query = DB::connection('mysql_dados')->table('estabelecimentos_geral')
            ->select('cnpj_basico', 'cnpj_ordem', 'cnpj_dv')
            ->whereIn('uf', $this->estadosNorte);

        $totalEmpresas = $query->count();

        if ($totalEmpresas === 0) {
            $this->error('Nenhuma empresa encontrada na Região Norte.');
            return Command::FAILURE;
        }

        $this->info("   Encontradas " . number_format($totalEmpresas, 0, ',', '.') . " empresas.");
        $this->newLine();

        // Obtém a URL base do site via .env (ex: https://meusite.com.br)
        $baseUrl = 'https://www.consultacnpjgratis.com';
        
        if (empty($baseUrl) || $baseUrl === 'http://localhost') {
            $this->warn('⚠️  Atenção: A variável APP_URL do seu .env parece estar com o valor padrão ou vazia.');
            $this->warn("URLs serão geradas com: {$baseUrl}");
            $this->newLine();
        }

        $bar = $this->output->createProgressBar($totalEmpresas);
        $bar->setFormat(" %current%/%max% [%bar%] %percent:3s%% -- Arquivo Atual: %message%");
        $bar->start();

        $fileIndex = 1;
        $sitemapUrls = [];

        // 3. Processamento em Lotes (Chunks) de 50.000 para salvar memória
        $query->orderBy('cnpj_basico')->chunk($this->chunkSize, function ($empresas) use (&$fileIndex, &$sitemapUrls, $baseUrl, $sitemapPath, $bar) {
            
            $filename = "sitemap_{$fileIndex}.txt";
            $bar->setMessage($filename);
            
            $content = "";
            
            foreach ($empresas as $empresa) {
                // Monta o CNPJ diretamente (sem helpers de rota do Laravel para máxima velocidade)
                $cnpj = $empresa->cnpj_basico . $empresa->cnpj_ordem . $empresa->cnpj_dv;
                
                // Concatena a URL com quebra de linha (formato TXT padrão do Google)
                $content .= "{$baseUrl}/cnpj/{$cnpj}\n";
                
                $bar->advance();
            }

            // Salva o arquivo de texto (substituindo se existir)
            File::put("{$sitemapPath}/{$filename}", rtrim($content)); // rtrim tira a última quebra de linha vazia
            
            // Adiciona a URL deste sitemap TXT para colocar no Index XML depois
            $sitemapUrls[] = "{$baseUrl}/sitemaps/{$filename}";

            $fileIndex++;
            
            // Libera memória forçadamente
            unset($content);
        });

        $bar->finish();
        $this->newLine(2);

        // 4. Geração do Sitemap Index (XML limpo, apenas com <loc>)
        $this->line('<fg=cyan>➜ Gerando arquivo sitemap_index.xml...</>');
        
        $xmlContent  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xmlContent .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        foreach ($sitemapUrls as $sitemapUrl) {
            $xmlContent .= "  <sitemap>\n";
            $xmlContent .= "    <loc>{$sitemapUrl}</loc>\n";
            $xmlContent .= "  </sitemap>\n";
        }
        
        $xmlContent .= '</sitemapindex>';
        
        // Salva na raiz do public
        File::put(public_path('sitemap_index.xml'), $xmlContent);
        $this->info('   ✔ sitemap_index.xml gerado com sucesso!');
        $this->newLine();

        // =========================================================================
        // FINALIZAÇÃO E RELATÓRIO DE DEPURACÃO
        // =========================================================================
        $totalTime = round(microtime(true) - $startTime, 2);
        $memoryUsage = round(memory_get_peak_usage(true) / 1048576, 2);

        $this->line('<bg=green;fg=white;options=bold> 🎉 SUCESSO! SITEMAPS GERADOS COM EXCELÊNCIA! 🎉 </>');
        $this->table(
            ['Métrica', 'Resultado'],
            [
                ['Total de URLs Geradas', number_format($totalEmpresas, 0, ',', '.')],
                ['Arquivos TXT Criados', ($fileIndex - 1)],
                ['Tempo de Processamento', "{$totalTime} Segundos"],
                ['Pico de Uso de Memória', "{$memoryUsage} MB"],
            ]
        );
        $this->newLine();

        $this->line("O seu índice está disponível em: <fg=yellow>{$baseUrl}/sitemap_index.xml</>");
        $this->newLine();

        return Command::SUCCESS;
    }
}