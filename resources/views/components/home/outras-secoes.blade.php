<section class="bg-gradient-to-r from-[#171717] via-[#111] to-[#0a0a0a] text-white py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-amber-400 font-semibold tracking-wide uppercase text-sm">
                Explore sem saber o CNPJ
            </p>
            <h2 class="text-3xl md:text-4xl font-black mt-2">
                Mapeie empresas por estado ou por atividade
            </h2>
            <p class="mt-4 text-gray-300">
                Use nossas ferramentas de exploração para chegar rápido ao que precisa, navegando por localização
                ou por segmento de mercado.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl mx-auto">
            {{-- Card: empresas por estado --}}
            <a
                href="{{ route('empresas.index') }}"
                class="group relative rounded-3xl border border-white/10 bg-white/[0.03] px-5 py-6 md:px-6 md:py-7 shadow-[0_22px_70px_rgba(0,0,0,0.85)] hover:border-amber-400/70 hover:bg-white/[0.06] hover:-translate-y-1 transition-all duration-150"
            >
                {{-- Ícone flutuando no canto superior esquerdo, acima da borda --}}
                <div class="absolute -top-5 left-5 flex h-10 w-10 items-center justify-center rounded-2xl bg-amber-500/80 border border-amber-400/60 text-amber-200 shadow-lg shadow-amber-500/30">
                    <i class="bi bi-geo-alt text-lg"></i>
                </div>

                <div class="mt-4">
                    <p class="text-sm text-amber-300 font-semibold">
                        Explorar por localização
                    </p>
                    <h3 class="text-2xl font-bold mt-2">
                        Consultar empresas por estado
                    </h3>
                    <p class="text-gray-300 mt-3 text-sm">
                        Veja os estados com mais empresas ativas, descubra os municípios mais fortes em cada região
                        e liste CNPJs por cidade para planejar suas ações comerciais.
                    </p>
                </div>

                <span class="inline-flex items-center gap-2 mt-6 text-sm font-semibold text-amber-200 group-hover:text-amber-100">
                    Abrir mapa de empresas
                    <i class="bi bi-arrow-up-right text-base"></i>
                </span>
            </a>

            {{-- Card: empresas por atividade (CNAE) --}}
            <a
                href="{{ route('empresas.cnae') }}"
                class="mt-4 group relative rounded-3xl border border-white/10 bg-white/[0.03] px-5 py-6 md:px-6 md:py-7 shadow-[0_22px_70px_rgba(0,0,0,0.85)] hover:border-amber-400/70 hover:bg-white/[0.06] hover:-translate-y-1 transition-all duration-150"
            >
                {{-- Ícone flutuando no canto superior esquerdo, acima da borda --}}
                <div class="absolute -top-5 left-5 flex h-10 w-10 items-center justify-center rounded-2xl bg-amber-500/80 border border-amber-400/60 text-amber-200 shadow-lg shadow-amber-500/30">
                    <i class="bi bi-graph-up text-lg"></i>
                </div>

                <div class="mt-4">
                    <p class="text-sm text-amber-300 font-semibold">
                        Explorar por setor
                    </p>
                    <h3 class="text-2xl font-bold mt-2">
                        Consultar por atividade (CNAE)
                    </h3>
                    <p class="text-gray-300 mt-3 text-sm">
                        Descubra quais segmentos são mais competitivos, identifique nichos específicos e visualize
                        detalhes das empresas de cada atividade econômica para campanhas altamente segmentadas.
                    </p>
                </div>

                <span class="inline-flex items-center gap-2 mt-6 text-sm font-semibold text-amber-200 group-hover:text-amber-100">
                    Começar a explorar CNAEs
                    <i class="bi bi-arrow-up-right text-base"></i>
                </span>
            </a>
        </div>
    </div>
</section>
