@props([
    'uf',
    'totalAtivas',
    'totalMatrizes',
    'totalfiliais',
    'totalAbertas2025',
    'totalFechadas2025',
    'preposicao',
    'nomeEstado',
])

<section class="bg-white py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
            <div class="max-w-xl">
                <p class="text-amber-500 font-semibold uppercase text-xs md:text-sm tracking-[0.24em]">
                    Balanço das empresas no estado
                </p>
                <h2 class="mt-2 text-2xl md:text-3xl font-black text-[#111827]">
                Como as empresas se distribuem no estado {{ strtolower($preposicao) }} {{ $nomeEstado }}
                </h2>
                <p class="mt-3 text-sm md:text-base text-gray-600">
                    Veja quantas empresas estão ativas hoje, quantas são matrizes ou filiais
                    e como o ano atual se comporta em termos de aberturas e encerramentos.
                </p>
            </div>

            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-50 border border-amber-100 text-xs md:text-sm text-amber-800">
                <span class="h-2 w-2 rounded-full bg-amber-400"></span>
                Dados consolidados a partir de CNPJs do estado
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">
            {{-- Total ativas --}}
            <div class="rounded-2xl border border-gray-200 bg-gradient-to-b from-white to-amber-50/40 p-5 shadow-[0_18px_45px_-30px_rgba(15,23,42,0.55)]">
                <p class="text-[11px] uppercase tracking-[0.22em] text-amber-700 font-semibold">
                    Empresas ativas no estado
                </p>
                <p class="mt-3 text-2xl md:text-3xl font-extrabold text-[#111827]">
                    {{ number_format($totalAtivas, 0, ',', '.') }}
                </p>
                <p class="mt-2 text-xs md:text-sm text-gray-600">
                    Total de CNPJs com situação cadastral ativa em {{ $uf }}.
                </p>
            </div>

            {{-- Matrizes --}}
            <div class="rounded-2xl border border-gray-200 bg-gradient-to-b from-white to-emerald-50/40 p-5 shadow-[0_18px_45px_-30px_rgba(15,23,42,0.55)]">
                <p class="text-[11px] uppercase tracking-[0.22em] text-emerald-700 font-semibold">
                    Matrizes
                </p>
                <p class="mt-3 text-2xl md:text-3xl font-extrabold text-[#111827]">
                    {{ number_format($totalMatrizes, 0, ',', '.') }}
                </p>
                <p class="mt-2 text-xs md:text-sm text-gray-600">
                    Empresas matriz, onde a gestão principal do CNPJ é realizada.
                </p>
            </div>

            {{-- Filiais --}}
            <div class="rounded-2xl border border-gray-200 bg-gradient-to-b from-white to-sky-50/40 p-5 shadow-[0_18px_45px_-30px_rgba(15,23,42,0.55)]">
                <p class="text-[11px] uppercase tracking-[0.22em] text-sky-700 font-semibold">
                    Filiais
                </p>
                <p class="mt-3 text-2xl md:text-3xl font-extrabold text-[#111827]">
                    {{ number_format($totalfiliais, 0, ',', '.') }}
                </p>
                <p class="mt-2 text-xs md:text-sm text-gray-600">
                    Pontos adicionais de atuação das empresas dentro ou fora do estado.
                </p>
            </div>

            {{-- Abertas x fechadas em 2025 --}}
            <div class="rounded-2xl border border-gray-200 bg-gradient-to-b from-white to-purple-50/40 p-5 shadow-[0_18px_45px_-30px_rgba(15,23,42,0.55)] flex flex-col gap-3">
                <div>
                    <p class="text-[11px] uppercase tracking-[0.22em] text-purple-700 font-semibold">
                        Abertas em 2025
                    </p>
                    <p class="mt-2 text-xl md:text-2xl font-extrabold text-[#111827]">
                        {{ number_format($totalAbertas2025, 0, ',', '.') }}
                    </p>
                </div>
                <div class="h-px bg-gradient-to-r from-purple-200 via-purple-300 to-amber-300"></div>
                <div>
                    <p class="text-[11px] uppercase tracking-[0.22em] text-purple-700 font-semibold">
                        Encerradas em 2025
                    </p>
                    <p class="mt-2 text-xl md:text-2xl font-extrabold text-[#111827]">
                        {{ number_format($totalFechadas2025, 0, ',', '.') }}
                    </p>
                    <p class="mt-1 text-xs md:text-sm text-gray-600">
                        Empresas que mudaram de situação cadastral no ano corrente,
                        indicando o ritmo de renovações e encerramentos no estado.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
