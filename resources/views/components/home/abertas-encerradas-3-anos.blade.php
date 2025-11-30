@props(['abertasUltimosAnos', 'fechadasUltimosAnos'])

<section class="bg-[#050509] text-white py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
            <div class="max-w-2xl">
                <p class="text-amber-400 font-semibold uppercase text-xs md:text-sm tracking-[0.24em]">
                    Evolução recente
                </p>
                <h2 class="mt-2 text-3xl md:text-4xl font-black">
                    Aberturas e encerramentos nos últimos 3 anos
                </h2>
                <p class="mt-3 text-sm md:text-base text-gray-300">
                    Entenda como o número de novas empresas e de negócios encerrados
                    vem se comportando ano a ano e monitore o ritmo do mercado brasileiro.
                </p>
            </div>

            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-xs md:text-sm text-gray-200 backdrop-blur">
                <span class="h-2 w-2 rounded-full bg-amber-400 animate-ping"></span>
                Dados consolidados e atualizados periodicamente
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Coluna aberturas --}}
            <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-6 md:p-7 shadow-[0_18px_60px_rgba(0,0,0,0.8)]">
                <div class="flex items-center justify-between gap-4 mb-4">
                    <div>
                        <p class="text-xs uppercase tracking-[0.22em] text-emerald-300">Novas empresas</p>
                        <h3 class="mt-1 text-xl font-semibold text-white">Aberturas por ano</h3>
                    </div>
                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-500/10 px-3 py-1 text-[11px] font-medium text-emerald-200 border border-emerald-500/40">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                        Tendência de crescimento
                    </span>
                </div>

                <div class="space-y-3">
                    @foreach ($abertasUltimosAnos as $ano => $total)
                        <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5 border border-white/10">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/15 text-emerald-200 font-semibold">
                                {{ $ano }}
                            </div>
                            <div class="flex-1">
                                <p class="text-xs text-gray-300">Empresas abertas</p>
                                <p class="text-xl md:text-2xl font-extrabold">
                                    {{ number_format($total, 0, ',', '.') }}
                                </p>
                                <div class="mt-2 h-1.5 rounded-full bg-gradient-to-r from-emerald-400 to-emerald-500 w-3/4"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Coluna encerramentos --}}
            <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-6 md:p-7 shadow-[0_18px_60px_rgba(0,0,0,0.8)]">
                <div class="flex items-center justify-between gap-4 mb-4">
                    <div>
                        <p class="text-xs uppercase tracking-[0.22em] text-rose-300">Encerramentos</p>
                        <h3 class="mt-1 text-xl font-semibold text-white">Empresas que fecharam</h3>
                    </div>
                    <span class="inline-flex items-center gap-1 rounded-full bg-rose-500/10 px-3 py-1 text-[11px] font-medium text-rose-200 border border-rose-500/40">
                        <span class="h-1.5 w-1.5 rounded-full bg-rose-400"></span>
                        Risco de mercado
                    </span>
                </div>

                <div class="space-y-3">
                    @foreach ($fechadasUltimosAnos as $ano => $total)
                        <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5 border border-white/10">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-500/15 text-rose-200 font-semibold">
                                {{ $ano }}
                            </div>
                            <div class="flex-1">
                                <p class="text-xs text-gray-300">Empresas encerradas</p>
                                <p class="text-xl md:text-2xl font-extrabold">
                                    {{ number_format($total, 0, ',', '.') }}
                                </p>
                                <div class="mt-2 h-1.5 rounded-full bg-gradient-to-r from-rose-400 to-red-500 w-3/4"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <p class="mt-4 text-[11px] md:text-xs text-gray-400">
                    Use esse histórico para identificar períodos de maior risco
                    e ajustar sua estratégia de entrada em novos mercados.
                </p>
            </div>
        </div>
    </div>
</section>
