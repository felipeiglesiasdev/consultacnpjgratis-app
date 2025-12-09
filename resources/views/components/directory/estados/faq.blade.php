@props([
    'preposicao',
    'nomeEstado',
    'totalAtivas',
    'nomeCapital',
    'totalCapitalAtivas',
    'totalAbertas2025',
    'totalFechadas2025',
])

<section class="bg-gray-50 py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-10">
                <p class="text-amber-500 font-semibold uppercase text-xs md:text-sm tracking-[0.24em]">
                    Perguntas frequentes
                </p>
                <h2 class="mt-2 text-2xl md:text-3xl font-black text-[#111827] leading-tight">
                    FAQ sobre empresas no estado {{ strtoupper($preposicao) }} {{ $nomeEstado }}
                </h2>
                <p class="mt-3 text-sm md:text-base text-gray-600">
                    Respostas rápidas para entender o cenário empresarial do estado e usar os números a seu favor.
                </p>
            </div>

            <div class="space-y-4">
                <div class="rounded-2xl border border-gray-200 bg-white p-4 md:p-5">
                    <h3 class="text-sm md:text-base font-semibold text-[#111827]">
                        Quantas empresas ativas existem no estado {{ strtolower($preposicao) }} {{ $nomeEstado }}?
                    </h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Atualmente são {{ number_format($totalAtivas, 0, ',', '.') }} CNPJs ativos, considerando matrizes e filiais que
                        seguem em situação regular na Receita Federal.
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-4 md:p-5">
                    <h3 class="text-sm md:text-base font-semibold text-[#111827]">
                        Quantas empresas ativas ficam na capital, {{ $nomeCapital }}?
                    </h3>
                    <p class="mt-2 text-sm text-gray-600">
                        {{ $nomeCapital }} concentra {{ number_format($totalCapitalAtivas, 0, ',', '.') }} empresas ativas. É um ponto
                        estratégico para planejar ações comerciais e campanhas regionais.
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-4 md:p-5">
                    <h3 class="text-sm md:text-base font-semibold text-[#111827]">
                        Quantas empresas foram abertas em 2025 no estado?
                    </h3>
                    <p class="mt-2 text-sm text-gray-600">
                        O ano já contabiliza {{ number_format($totalAbertas2025, 0, ',', '.') }} novas empresas, um indicador importante
                        para acompanhar o ritmo de crescimento local.
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-4 md:p-5">
                    <h3 class="text-sm md:text-base font-semibold text-[#111827]">
                        Quantas empresas encerraram as atividades em 2025?
                    </h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Até o momento, {{ number_format($totalFechadas2025, 0, ',', '.') }} empresas alteraram a situação cadastral e não
                        estão mais ativas. Comparar aberturas e encerramentos ajuda a avaliar a vitalidade econômica do estado.
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-4 md:p-5">
                    <h3 class="text-sm md:text-base font-semibold text-[#111827]">
                        Posso usar esses dados para prospecção e estudos de mercado?
                    </h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Sim. Os dados são públicos e servem como base para mapear oportunidades B2B, identificar polos regionais e
                        planejar rotas comerciais, desde que você siga as boas práticas de contato e respeito à legislação vigente.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
