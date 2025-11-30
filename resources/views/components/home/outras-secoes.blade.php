<section class="bg-gradient-to-r from-[#171717] via-[#111] to-[#0a0a0a] text-white py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-amber-400 font-semibold tracking-[0.26em] uppercase text-xs md:text-sm">
                Explore sem saber o CNPJ
            </p>
            <h2 class="mt-3 text-3xl md:text-4xl font-black">
                Mapeie empresas por estado ou por atividade
            </h2>
            <p class="mt-4 text-sm md:text-base text-gray-300">
                Use nossas ferramentas de exploração para chegar rápido ao tipo de empresa
                que você precisa, seja por localização ou por segmento de mercado.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl mx-auto">
            {{-- Por localização --}}
            <a href="{{ route('empresas.index') }}"
               class="group rounded-2xl border border-white/10 bg-white/[0.03] px-5 py-6 md:px-7 md:py-7 shadow-[0_18px_50px_rgba(0,0,0,0.75)] hover:border-amber-400/60 hover:shadow-amber-500/20 hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs text-amber-300 font-semibold uppercase tracking-[0.2em]">
                            Explorar por localização
                        </p>
                        <h3 class="mt-2 text-xl md:text-2xl font-bold">
                            Consultar empresas por estado
                        </h3>
                        <p class="mt-2 text-sm text-gray-300">
                            Veja quais municípios concentram mais empresas, descubra polos econômicos
                            e liste CNPJs por região para campanhas geolocalizadas.
                        </p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-amber-500/15 border border-amber-400/40 flex items-center justify-center text-amber-200">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                </div>
                <span class="inline-flex items-center gap-2 mt-5 text-sm font-medium text-amber-300">
                    Começar a explorar
                    <i class="bi bi-arrow-up-right"></i>
                </span>
            </a>

            {{-- Por CNAE --}}
            <a href="{{ route('empresas.cnae.index') }}"
               class="group rounded-2xl border border-white/10 bg-white/[0.03] px-5 py-6 md:px-7 md:py-7 shadow-[0_18px_50px_rgba(0,0,0,0.75)] hover:border-amber-400/60 hover:shadow-amber-500/20 hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs text-amber-300 font-semibold uppercase tracking-[0.2em]">
                            Explorar por setor
                        </p>
                        <h3 class="mt-2 text-xl md:text-2xl font-bold">
                            Consultar por atividade (CNAE)
                        </h3>
                        <p class="mt-2 text-sm text-gray-300">
                            Descubra os segmentos mais competitivos, compare setores e visualize
                            detalhes das empresas em cada atividade econômica.
                        </p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-amber-500/15 border border-amber-400/40 flex items-center justify-center text-amber-200">
                        <i class="bi bi-graph-up"></i>
                    </div>
                </div>
                <span class="inline-flex items-center gap-2 mt-5 text-sm font-medium text-amber-300">
                    Ver atividades econômicas
                    <i class="bi bi-arrow-up-right"></i>
                </span>
            </a>
        </div>
    </div>
</section>
