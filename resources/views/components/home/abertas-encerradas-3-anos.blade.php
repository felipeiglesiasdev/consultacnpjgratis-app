@props(['abertasUltimosAnos', 'fechadasUltimosAnos'])

<section class="bg-[#050509] text-white py-16 md:py-20 border-t border-white/5">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        
        {{-- Header da Seção (Texto Largo e Direto) --}}
        <div class="mb-12">
            <p class="text-amber-400 font-bold uppercase text-xs tracking-[0.2em] mb-3">
                Novas empresas vs empresas encerradas
            </p>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-white leading-tight mb-4">
                Acompanhe o ritmo dos negócios no Brasil
            </h2>
            <p class="text-base md:text-lg text-gray-300 max-w-4xl leading-relaxed">
                Veja os números reais de empresas que abriram e fecharam as portas nos últimos anos. 
                Uma visão clara de como o empreendedorismo está caminhando no país.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Coluna aberturas --}}
            <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-6 md:p-7 shadow-[0_18px_60px_rgba(0,0,0,0.8)] hover:border-white/20 transition-colors duration-300">
                <div class="flex items-center justify-between gap-4 mb-6">
                    <div>
                        <p class="text-xs uppercase tracking-[0.22em] text-emerald-400 font-bold">Novas empresas</p>
                        <h3 class="mt-1 text-xl font-bold text-white">Aberturas por ano</h3>
                    </div>
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500/10 px-3 py-1 text-[11px] font-medium text-emerald-200 border border-emerald-500/30">
                        <i class="bi bi-graph-up-arrow text-emerald-400"></i>
                        Crescimento
                    </span>
                </div>

                <div class="space-y-4">
                    @foreach ($abertasUltimosAnos as $ano => $total)
                        <div class="group flex items-center gap-4 p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-emerald-500/30 hover:bg-white/[0.07] transition-all duration-300">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-400 font-bold border border-emerald-500/20 group-hover:scale-110 transition-transform">
                                {{ $ano }}
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-baseline mb-1">
                                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Empresas abertas</p>
                                    <p class="text-lg font-black text-white group-hover:text-emerald-300 transition-colors">
                                        {{ number_format($total, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="h-1.5 w-full bg-white/10 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-emerald-500 to-emerald-300 rounded-full w-3/4 group-hover:w-full transition-all duration-1000 ease-out"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Coluna encerramentos --}}
            <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-6 md:p-7 shadow-[0_18px_60px_rgba(0,0,0,0.8)] hover:border-white/20 transition-colors duration-300">
                <div class="flex items-center justify-between gap-4 mb-6">
                    <div>
                        <p class="text-xs uppercase tracking-[0.22em] text-rose-400 font-bold">Encerramentos</p>
                        <h3 class="mt-1 text-xl font-bold text-white">Empresas que fecharam</h3>
                    </div>
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-rose-500/10 px-3 py-1 text-[11px] font-medium text-rose-200 border border-rose-500/30">
                        <i class="bi bi-exclamation-triangle text-rose-400"></i>
                        Baixas
                    </span>
                </div>

                <div class="space-y-4">
                    @foreach ($fechadasUltimosAnos as $ano => $total)
                        <div class="group flex items-center gap-4 p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-rose-500/30 hover:bg-white/[0.07] transition-all duration-300">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-rose-500/10 text-rose-400 font-bold border border-rose-500/20 group-hover:scale-110 transition-transform">
                                {{ $ano }}
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-baseline mb-1">
                                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Empresas encerradas</p>
                                    <p class="text-lg font-black text-white group-hover:text-rose-300 transition-colors">
                                        {{ number_format($total, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="h-1.5 w-full bg-white/10 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-rose-500 to-rose-300 rounded-full w-2/3 group-hover:w-5/6 transition-all duration-1000 ease-out"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Badge Movido para Baixo e Centralizado --}}
        <div class="mt-12 flex justify-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-xs md:text-sm text-gray-400 backdrop-blur">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                </span>
                Dados consolidados e atualizados periodicamente
            </div>
        </div>
    </div>
</section>