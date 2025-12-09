@props([
    'municipio',
    'ufReal',
    'totalAtivas',
    'totalAbertas2025',
    'totalFechadas2025',
])

@php
    $nomeCidade = ucwords(mb_strtolower($municipio->descricao, 'UTF-8'));
@endphp

<section class="bg-gray-50 py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-10">
                <p class="text-amber-500 font-semibold uppercase text-xs md:text-sm tracking-[0.24em]">
                    Perguntas frequentes
                </p>
                <h2 class="mt-2 text-2xl md:text-3xl font-black text-[#111827]">
                    FAQ sobre empresas em {{ $nomeCidade }} / {{ $ufReal->uf }}
                </h2>
                <p class="mt-3 text-sm md:text-base text-gray-600">
                    Dúvidas rápidas para interpretar os números do município e planejar ações locais.
                </p>
            </div>

            <div class="space-y-4">
                <div class="rounded-2xl border border-gray-200 bg-white p-4 md:p-5">
                    <h3 class="text-sm md:text-base font-semibold text-[#111827]">
                        Quantas empresas ativas existem em {{ $nomeCidade }}?
                    </h3>
                    <p class="mt-2 text-sm text-gray-600">
                        São {{ number_format($totalAtivas, 0, ',', '.') }} empresas com situação cadastral ativa na Receita Federal.
                        A lista acima reúne todas elas, incluindo matrizes e filiais.
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-4 md:p-5">
                    <h3 class="text-sm md:text-base font-semibold text-[#111827]">
                        Quantas empresas foram abertas em {{ $nomeCidade }} em 2025?
                    </h3>
                    <p class="mt-2 text-sm text-gray-600">
                        O município registrou {{ number_format($totalAbertas2025, 0, ',', '.') }} novas empresas neste ano. O número ajuda a
                        medir o ritmo de crescimento local e oportunidades para novos negócios.
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-4 md:p-5">
                    <h3 class="text-sm md:text-base font-semibold text-[#111827]">
                        Quantas empresas encerraram as atividades em 2025?
                    </h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Foram {{ number_format($totalFechadas2025, 0, ',', '.') }} empresas com alteração de situação cadastral no ano corrente. Cruzar esse
                        dado com as aberturas mostra o saldo empresarial da cidade.
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-4 md:p-5">
                    <h3 class="text-sm md:text-base font-semibold text-[#111827]">
                        Posso usar esses dados para prospecção comercial?
                    </h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Sim. Os dados exibidos são públicos e podem apoiar estratégias de prospecção B2B, pesquisas de mercado e rotas comerciais,
                        sempre respeitando a legislação vigente e as boas práticas de contato com empresas.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
