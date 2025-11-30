@props(['abertasUltimosAnos', 'fechadasUltimosAnos'])

<section class="bg-[#0f0f0f] text-white py-16 md:py-20">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
            <div>
                <p class="text-amber-400 font-semibold uppercase text-sm tracking-widest">Evolução recente</p>
                <h2 class="text-3xl md:text-4xl font-black mt-2">Empresas que abriram e fecharam nos últimos 3 anos</h2>
                <p class="text-gray-300 mt-3 max-w-2xl">Acompanhe o dinamismo do mercado e veja como cada ano se comportou para novas aberturas e encerramentos.</p>
            </div>
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-gray-200 text-sm">
                <span class="h-2 w-2 rounded-full bg-amber-400 animate-ping"></span>
                Dados atualizados trimestralmente
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="p-6 rounded-2xl bg-white/5 border border-white/10 shadow-2xl shadow-black/20">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold">Aberturas</h3>
                    <span class="text-amber-300 text-sm font-semibold">Empresas iniciando atividades</span>
                </div>
                <div class="space-y-3">
                    @foreach ($abertasUltimosAnos as $ano => $total)
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5 border border-white/5">
                            <div class="h-12 w-12 rounded-xl bg-amber-500/20 border border-amber-400/40 flex items-center justify-center text-amber-200 font-bold">{{ $ano }}</div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-300">Empresas abertas</p>
                                <p class="text-2xl font-extrabold">{{ number_format($total, 0, ',', '.') }}</p>
                            </div>
                            <div class="h-2 w-16 rounded-full bg-amber-400/40"></div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="p-6 rounded-2xl bg-white/5 border border-white/10 shadow-2xl shadow-black/20">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold">Encerramentos</h3>
                    <span class="text-gray-300 text-sm font-semibold">Empresas que fecharam</span>
                </div>
                <div class="space-y-3">
                    @foreach ($fechadasUltimosAnos as $ano => $total)
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5 border border-white/5">
                            <div class="h-12 w-12 rounded-xl bg-red-500/20 border border-red-400/40 flex items-center justify-center text-red-200 font-bold">{{ $ano }}</div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-300">Empresas fechadas</p>
                                <p class="text-2xl font-extrabold">{{ number_format($total, 0, ',', '.') }}</p>
                            </div>
                            <div class="h-2 w-16 rounded-full bg-red-400/40"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
