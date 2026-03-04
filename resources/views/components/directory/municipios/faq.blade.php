@props([
    'municipio',
    'ufReal',
    'totalAtivas',
    'totalAbertas2025',
    'totalFechadas2025',
])

@php
    $nomeCidade = Str::title($municipio->descricao);
@endphp

<section class="bg-white py-20 relative">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="max-w-3xl mx-auto">
            
            <div class="text-center mb-12">
                <p class="text-blue-600 font-bold uppercase text-xs tracking-[0.2em]">
                    Dados e Curiosidades
                </p>
                <h2 class="mt-2 text-3xl md:text-4xl font-black text-gray-900 tracking-tight">
                    FAQ Econômico de {{ $nomeCidade }}
                </h2>
                <p class="mt-4 text-base text-gray-600">
                    Principais métricas e respostas rápidas para você interpretar o momento e a força comercial da cidade.
                </p>
            </div>

            <div class="space-y-4">
                
                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-6">
                    <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                        <i class="bi bi-info-circle-fill text-blue-500"></i>
                        Quantos CNPJs estão ativos em {{ $nomeCidade }}?
                    </h3>
                    <p class="mt-3 text-sm text-gray-600 leading-relaxed pl-6">
                        Com base nos dados mais recentes da Receita Federal, o município de {{ $nomeCidade }} possui atualmente <strong>{{ number_format($totalAtivas, 0, ',', '.') }} empresas ativas</strong>. Este número reflete desde MEIs a grandes corporações baseadas na cidade.
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-6">
                    <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                        <i class="bi bi-info-circle-fill text-blue-500"></i>
                        Quantas empresas foram abertas neste ano?
                    </h3>
                    <p class="mt-3 text-sm text-gray-600 leading-relaxed pl-6">
                        O clima empreendedor na região resultou no registro de <strong>{{ number_format($totalAbertas2025, 0, ',', '.') }} novos CNPJs</strong> apenas no ano atual. Esse indicador ajuda a medir o ritmo de desenvolvimento da economia local.
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-6">
                    <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                        <i class="bi bi-info-circle-fill text-blue-500"></i>
                        Como está o saldo entre aberturas e encerramentos?
                    </h3>
                    <p class="mt-3 text-sm text-gray-600 leading-relaxed pl-6">
                        Enquanto {{ number_format($totalAbertas2025, 0, ',', '.') }} empresas abriram suas portas, outras <strong>{{ number_format($totalFechadas2025, 0, ',', '.') }} alteraram sua situação para baixada/encerrada</strong>. Cruzar estes dados permite entender se o município está em expansão ou retração comercial.
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-6">
                    <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                        <i class="bi bi-info-circle-fill text-blue-500"></i>
                        Como posso usar a tabela de empresas acima?
                    </h3>
                    <p class="mt-3 text-sm text-gray-600 leading-relaxed pl-6">
                        A tabela paginada é ideal para criar bases de prospecção. Você pode anotar a Razão Social e o número do CNPJ das empresas que considerar potenciais clientes, clicar no botão "Consultar" e ter acesso a mais dados.
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>