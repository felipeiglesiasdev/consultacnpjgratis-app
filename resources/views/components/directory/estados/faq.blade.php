@props([
    'preposicao',
    'nomeEstado',
    'totalAtivas',
    'nomeCapital',
    'totalCapitalAtivas',
    'totalAbertas2025',
    'totalFechadas2025',
])

<section class="bg-white py-20 relative">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="max-w-3xl mx-auto">
            
            <div class="text-center mb-12">
                <p class="text-amber-600 font-bold uppercase text-xs tracking-[0.2em]">
                    Tire suas dúvidas
                </p>
                <h2 class="mt-2 text-3xl md:text-4xl font-black text-gray-900 tracking-tight">
                    FAQ sobre empresas {{ strtolower($preposicao) }} {{ $nomeEstado }}
                </h2>
                <p class="mt-4 text-base text-gray-600">
                    Respostas rápidas e dados demográficos empresariais para te ajudar a entender o cenário local.
                </p>
            </div>

            <div class="space-y-4">
                
                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-6">
                    <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                        <i class="bi bi-question-circle text-amber-500"></i>
                        Quantas empresas ativas existem no estado {{ strtolower($preposicao) }} {{ $nomeEstado }}?
                    </h3>
                    <p class="mt-3 text-sm text-gray-600 leading-relaxed pl-6">
                        De acordo com o Cadastro Nacional da Receita Federal, o estado {{ strtolower($preposicao) }} {{ $nomeEstado }} conta atualmente com <strong>{{ number_format($totalAtivas, 0, ',', '.') }} empresas com situação cadastral ativa</strong>. Esse número engloba desde Microempreendedores Individuais (MEIs) até grandes sociedades anônimas.
                    </p>
                </div>

                @if($nomeCapital && $totalCapitalAtivas > 0)
                    <div class="rounded-2xl border border-gray-100 bg-gray-50 p-6">
                        <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                            <i class="bi bi-question-circle text-amber-500"></i>
                            Quantas empresas existem na capital {{ $nomeCapital }}?
                        </h3>
                        <p class="mt-3 text-sm text-gray-600 leading-relaxed pl-6">
                            Apenas a cidade de {{ $nomeCapital }} concentra <strong>{{ number_format($totalCapitalAtivas, 0, ',', '.') }}</strong> empresas ativas. Em termos proporcionais, a capital representa aproximadamente {{ number_format(($totalCapitalAtivas / max($totalAtivas, 1)) * 100, 1, ',', '.') }}% do volume total de negócios do estado.
                        </p>
                    </div>
                @endif

                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-6">
                    <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                        <i class="bi bi-question-circle text-amber-500"></i>
                        Como está o cenário de aberturas e encerramentos neste ano?
                    </h3>
                    <p class="mt-3 text-sm text-gray-600 leading-relaxed pl-6">
                        No ano atual, registramos <strong>{{ number_format($totalAbertas2025, 0, ',', '.') }} aberturas</strong> de novas empresas na região, contra <strong>{{ number_format($totalFechadas2025, 0, ',', '.') }} encerramentos</strong> (baixas). Comparar o volume de aberturas com o de fechamentos é um excelente indicador para avaliar o clima econômico do estado.
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-6">
                    <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                        <i class="bi bi-question-circle text-amber-500"></i>
                        Posso usar os dados desta página para prospectar clientes locais?
                    </h3>
                    <p class="mt-3 text-sm text-gray-600 leading-relaxed pl-6">
                        Sim. Todas as informações disponibilizadas nesta página são originadas de fontes públicas governamentais. Você pode utilizar o volume de empresas por município ou CNAE para estruturar territórios de vendas, dimensionar tamanho de mercado (TAM) e montar estratégias comerciais focadas no público B2B da região.
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>