@props([
    'uf',
    'top10Cidades',
])

<section class="bg-gray-50 py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
            <div class="max-w-xl">
                <p class="text-amber-500 font-semibold uppercase text-xs md:text-sm tracking-[0.24em]">
                    Cidades em destaque
                </p>
                <h2 class="mt-2 text-2xl md:text-3xl font-black text-[#111827]">
                    Municípios com mais empresas ativas em {{ $uf }}
                </h2>
                <p class="mt-3 text-sm md:text-base text-gray-600">
                    Descubra quais municípios concentram a maior quantidade de empresas ativas
                    no estado. Excelente ponto de partida para prospecção regional.
                </p>
            </div>

            <div class="text-xs md:text-sm text-gray-500 max-w-sm">
                <p class="font-medium text-gray-700 mb-1">Como usar:</p>
                <p>• Clique em um município para ver o diretório de empresas daquela cidade.</p>
            </div>
        </div>

        <div class="rounded-3xl border border-gray-200 bg-white p-6 md:p-7 shadow-[0_18px_45px_-28px_rgba(15,23,42,0.55)]">
            <div class="space-y-3">
                @foreach ($top10Cidades as $index => $cidade)
                    <a
                        href=""
                        class="group flex items-center gap-4 rounded-2xl bg-gradient-to-r from-white to-gray-50 border border-gray-200 px-4 py-3 hover:border-amber-400 hover:from-amber-50/60 hover:to-white transition-all duration-150 shadow-[0_12px_32px_-24px_rgba(15,23,42,0.7)]"
                    >
                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-amber-500/10 text-amber-700 text-xs font-semibold">
                            {{ $index + 1 }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-[#111827] truncate">
                                {{ $cidade->nome }} • {{ strtoupper($cidade->uf) }}
                            </p>
                            <p class="text-[11px] text-gray-500">
                                {{ number_format($cidade->total, 0, ',', '.') }} empresas ativas
                            </p>
                        </div>
                        <i class="bi bi-arrow-right-short text-xl text-gray-400 group-hover:text-amber-500"></i>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
