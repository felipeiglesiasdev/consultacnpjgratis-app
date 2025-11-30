<section class="bg-gradient-to-r from-[#171717] via-[#111] to-[#0a0a0a] text-white py-16 md:py-20">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-amber-400 font-semibold tracking-wide uppercase text-sm">Explore sem saber o CNPJ</p>
            <h2 class="text-3xl md:text-4xl font-black mt-2">Mapeie empresas por estado ou por atividade</h2>
            <p class="mt-4 text-gray-300">Use nossas ferramentas de exploração para chegar rápido ao que precisa.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl mx-auto">
            <a href="{{ route('empresas.index') }}" class="group block rounded-2xl bg-white/5 border border-white/10 p-8 backdrop-blur shadow-xl shadow-amber-500/10 hover:-translate-y-2 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-amber-300 font-semibold">Explorar por localização</p>
                        <h3 class="text-2xl font-bold mt-2">Consultar empresas por estado</h3>
                        <p class="text-gray-300 mt-2">Veja municípios mais fortes e liste CNPJs por região.</p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-amber-500/20 border border-amber-400/40 flex items-center justify-center text-amber-200">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                </div>
                <span class="inline-flex items-center gap-2 mt-6 text-amber-200 font-semibold">Abrir mapa <i class="bi bi-arrow-up-right"></i></span>
            </a>
            <a href="{{ route('empresas.cnae.index') }}" class="group block rounded-2xl bg-white/5 border border-white/10 p-8 backdrop-blur shadow-xl shadow-amber-500/10 hover:-translate-y-2 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-amber-300 font-semibold">Explorar por setor</p>
                        <h3 class="text-2xl font-bold mt-2">Consultar por atividade (CNAE)</h3>
                        <p class="text-gray-300 mt-2">Descubra os segmentos mais competitivos e visualize detalhes das empresas.</p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-amber-500/20 border border-amber-400/40 flex items-center justify-center text-amber-200">
                        <i class="bi bi-graph-up"></i>
                    </div>
                </div>
                <span class="inline-flex items-center gap-2 mt-6 text-amber-200 font-semibold">Começar a explorar <i class="bi bi-arrow-up-right"></i></span>
            </a>
        </div>
    </div>
</section>
