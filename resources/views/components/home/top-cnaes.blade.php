@props(['topCnaes'])

<section class="bg-gray-50 py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 border border-gray-200">
                <div class="flex items-center justify-between gap-4 mb-6">
                    <div>
                        <p class="text-xs md:text-sm uppercase tracking-[0.24em] text-amber-500 font-semibold">
                            Ranking nacional
                        </p>
                        <h3 class="mt-1 text-2xl md:text-3xl font-bold text-gray-900">
                            Top 5 CNAEs com mais empresas ativas
                        </h3>
                        <p class="mt-2 text-sm text-gray-500 max-w-md">
                            Descubra quais atividades econômicas concentram mais CNPJs
                            e direcione melhor sua prospecção B2B.
                        </p>
                    </div>
                    <div class="hidden md:inline-flex items-center gap-2 px-3 py-2 rounded-full bg-amber-50 text-amber-700 text-xs font-semibold border border-amber-100">
                        <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                        Atualizado automaticamente
                    </div>
                </div>

                <div class="space-y-3">
                    @foreach ($topCnaes as $cnae)
                        <a
                            href="{{ route('empresas.cnae.show', ['codigo_cnae' => $cnae->codigo]) }}"
                            class="group block rounded-2xl border border-gray-200 bg-gradient-to-r from-white to-amber-50/40 px-4 py-3.5 md:px-5 md:py-4 transition-all duration-200 hover:-translate-y-0.5 hover:border-amber-300 hover:shadow-[0_18px_45px_-28px_rgba(15,23,42,0.65)]"
                        >
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                <div class="flex-1 pr-2">
                                    <p class="text-sm md:text-base text-gray-900 font-semibold">
                                        {{ $cnae->descricao }}
                                    </p>
                                    <div class="mt-1 flex flex-wrap items-center gap-2 text-[11px] md:text-xs text-gray-500">
                                        <span class="inline-flex items-center gap-1 rounded-full bg-white/80 px-2 py-0.5 border border-amber-100 text-amber-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>
                                            CNAE {{ $cnae->codigo }}
                                        </span>
                                        <span class="hidden sm:inline text-gray-400">
                                            • Clique para ver todas as empresas desse segmento
                                        </span>
                                    </div>
                                </div>

                                <div class="shrink-0 text-left sm:text-right">
                                    <p class="text-xl md:text-2xl font-black text-[#111827]">
                                        {{ number_format($cnae->ativos_count, 0, ',', '.') }}
                                    </p>
                                    <p class="text-[11px] md:text-xs text-gray-500 uppercase tracking-[0.18em]">
                                        empresas ativas
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
