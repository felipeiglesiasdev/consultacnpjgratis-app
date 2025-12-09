@props(['topCnaes'])

<section class="bg-white py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
            <div class="max-w-xl">
                <p class="text-amber-500 font-semibold uppercase text-xs md:text-sm tracking-[0.24em]">
                    Atividades em destaque
                </p>
                <h2 class="mt-2 text-2xl md:text-3xl font-black text-[#111827]">
                    Top 10 CNAEs com mais empresas ativas no Brasil
                </h2>
                <p class="mt-3 text-sm md:text-base text-gray-600">
                    Veja quais atividades econômicas concentram o maior número de empresas ativas.
                    Essas são ótimas candidatas para campanhas B2B de maior alcance.
                </p>
            </div>

            <div class="text-xs md:text-sm text-gray-500 max-w-sm">
                <p class="font-medium text-gray-700 mb-1">Dica:</p>
                <p>Combine esses CNAEs com filtros por estado ou município para criar listas
                    de prospecção ainda mais segmentadas.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-5">
            @foreach ($topCnaes as $index => $cnae)

                <a
                    href="{{ route('empresas.cnae.show', ['codigo_cnae' => $cnae->codigo]) }}"
                    class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-gradient-to-br from-white to-amber-50/40 p-5 shadow-[0_18px_45px_-28px_rgba(15,23,42,0.55)] hover:border-amber-400 hover:shadow-[0_22px_60px_-28px_rgba(15,23,42,0.75)] hover:-translate-y-0.5 transition-all duration-150"
                >
                    <div class="absolute -top-4 -left-2 flex h-8 w-8 items-center justify-center rounded-xl bg-amber-400 text-[11px] font-bold text-[#171717] shadow-lg shadow-amber-400/40">
                        #{{ $index + 1 }}
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="mt-1 flex h-9 w-9 items-center justify-center rounded-xl bg-amber-500/15 text-amber-700 text-[11px] font-semibold">
                            CNAE
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-sm md:text-base text-[#111827] truncate">
                                {{ $cnae->descricao }}
                            </p>
                            <p class="mt-1 inline-flex items-center gap-2 text-[11px] md:text-xs text-gray-600">
                                <span class="font-mono inline-flex items-center gap-1 rounded-full bg-white/80 px-2 py-0.5 border border-amber-100">
                                    {{ $cnae->codigo_formatado }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="mt-4 flex items-end justify-between gap-3">
                        <div>
                            <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">
                                Empresas ativas
                            </p>
                            <p class="mt-1 text-lg md:text-xl font-extrabold text-[#111827]">
                                {{ number_format($cnae->estabelecimentos_count, 0, ',', '.') }}
                            </p>
                        </div>
                        <i class="bi bi-arrow-right-short text-2xl text-gray-400 group-hover:text-amber-500"></i>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
