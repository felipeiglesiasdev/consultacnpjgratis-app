@props([
    'totalEmpresasAtivas',
    'municipiosComEmpresas',
    'mediaAberturasMensal',
    'novasEmpresasTrimestre',
    'totalCnaesCatalogados',
])

<section class="bg-white py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
            <div class="max-w-xl">
                <p class="text-amber-500 font-semibold uppercase text-xs md:text-sm tracking-[0.24em]">
                    Balanço do Brasil empresarial
                </p>
                <h2 class="mt-2 text-2xl md:text-3xl font-black text-[#111827]">
                    Entenda o tamanho e o ritmo do mercado
                </h2>
                <p class="mt-3 text-sm md:text-base text-gray-600">
                    Com base em milhões de CNPJs, veja quantas empresas estão ativas, quantos municípios
                    possuem negócios registrados e como novas empresas surgem ao longo do tempo.
                </p>
            </div>

            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-50 border border-amber-100 text-xs md:text-sm text-amber-800">
                <span class="h-2 w-2 rounded-full bg-amber-400"></span>
                Dados oficiais da Receita Federal
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">
            <div class="rounded-2xl border border-gray-200 bg-gradient-to-b from-white to-amber-50/40 p-5 shadow-[0_18px_45px_-30px_rgba(15,23,42,0.55)]">
                <p class="text-[11px] uppercase tracking-[0.22em] text-amber-700 font-semibold">
                    Empresas ativas
                </p>
                <p class="mt-3 text-2xl md:text-3xl font-extrabold text-[#111827]">
                    {{ number_format($totalEmpresasAtivas, 0, ',', '.') }}
                </p>
                <p class="mt-2 text-xs md:text-sm text-gray-600">
                    CNPJs em situação cadastral ativa, aptos para relacionamento comercial.
                </p>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-gradient-to-b from-white to-emerald-50/40 p-5 shadow-[0_18px_45px_-30px_rgba(15,23,42,0.55)]">
                <p class="text-[11px] uppercase tracking-[0.22em] text-emerald-700 font-semibold">
                    Municípios com empresas
                </p>
                <p class="mt-3 text-2xl md:text-3xl font-extrabold text-[#111827]">
                    {{ number_format($municipiosComEmpresas, 0, ',', '.') }}
                </p>
                <p class="mt-2 text-xs md:text-sm text-gray-600">
                    Cidades brasileiras que possuem pelo menos uma empresa registrada.
                </p>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-gradient-to-b from-white to-sky-50/40 p-5 shadow-[0_18px_45px_-30px_rgba(15,23,42,0.55)]">
                <p class="text-[11px] uppercase tracking-[0.22em] text-sky-700 font-semibold">
                    Novas empresas / mês
                </p>
                <p class="mt-3 text-2xl md:text-3xl font-extrabold text-[#111827]">
                    {{ number_format($mediaAberturasMensal, 0, ',', '.') }}
                </p>
                <p class="mt-2 text-xs md:text-sm text-gray-600">
                    Média de aberturas de empresas nos últimos 12 meses.
                </p>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-gradient-to-b from-white to-purple-50/40 p-5 shadow-[0_18px_45px_-30px_rgba(15,23,42,0.55)] flex flex-col gap-3">
                <div>
                    <p class="text-[11px] uppercase tracking-[0.22em] text-purple-700 font-semibold">
                        Novas empresas no último trimestre
                    </p>
                    <p class="mt-2 text-xl md:text-2xl font-extrabold text-[#111827]">
                        {{ number_format($novasEmpresasTrimestre, 0, ',', '.') }}
                    </p>
                </div>
                <div class="h-px bg-gradient-to-r from-purple-200 via-purple-300 to-amber-300"></div>
                <div>
                    <p class="text-[11px] uppercase tracking-[0.22em] text-purple-700 font-semibold">
                        CNAEs catalogados
                    </p>
                    <p class="mt-2 text-xl md:text-2xl font-extrabold text-[#111827]">
                        {{ number_format($totalCnaesCatalogados, 0, ',', '.') }}
                    </p>
                    <p class="mt-1 text-xs md:text-sm text-gray-600">
                        Diferentes atividades econômicas mapeadas na base.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
