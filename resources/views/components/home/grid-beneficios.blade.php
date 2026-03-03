<section class="bg-white py-16 md:py-20 relative overflow-hidden">
    
    {{-- Background discreto --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none" 
         style="background-image: radial-gradient(#171717 1px, transparent 1px); background-size: 24px 24px;">
    </div>

    <div class="container mx-auto px-6 md:px-10 xl:px-16 relative z-10">
        
        {{-- Header da Seção --}}
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-amber-500 font-bold tracking-[0.2em] uppercase text-xs md:text-sm mb-3">
                Diferenciais
            </p>
            <h2 class="text-3xl md:text-4xl font-black text-[#171717] leading-tight mb-5">
                Uma central de inteligência <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-orange-600">empresarial</span>
            </h2>
            <p class="text-base md:text-lg text-[#171717] max-w-2xl mx-auto opacity-80">
                Mais do que apenas consultar um CNPJ. Dados oficiais para tomar decisões melhores.
            </p>
        </div>

        {{-- Grid Desnivelado (Staggered) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 items-start max-w-5xl mx-auto">
            
            {{-- Coluna Esquerda (Cards 1 e 3) --}}
            <div class="space-y-6 md:space-y-8">
                
                {{-- Card 1 --}}
                <div class="group bg-white p-8 rounded-[2rem] border border-gray-100 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_40px_-10px_rgba(245,158,11,0.15)] hover:border-amber-200 transition-all duration-300 hover:-translate-y-1">
                    <div class="h-12 w-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center text-2xl mb-6 group-hover:bg-amber-500 group-hover:text-white transition-colors duration-300 shadow-sm">
                        <i class="bi bi-piggy-bank"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-black text-[#171717] mb-3">Consulta 100% Gratuita</h3>
                    <p class="text-base text-[#171717] leading-relaxed opacity-80">
                        Pesquise quantos CNPJs precisar, sem custo e sem limites diários. Ideal para rotinas de análise massiva.
                    </p>
                </div>

                {{-- Card 3 --}}
                <div class="group bg-white p-8 rounded-[2rem] border border-gray-100 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_40px_-10px_rgba(14,165,233,0.15)] hover:border-sky-200 transition-all duration-300 hover:-translate-y-1">
                    <div class="h-12 w-12 rounded-xl bg-sky-50 text-sky-500 flex items-center justify-center text-2xl mb-6 group-hover:bg-sky-500 group-hover:text-white transition-colors duration-300 shadow-sm">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-black text-[#171717] mb-3">Prospecção B2B</h3>
                    <p class="text-base text-[#171717] leading-relaxed opacity-80">
                        Monte listas qualificadas por região e atividade econômica. Encontre o cliente ideal para o seu negócio.
                    </p>
                </div>

            </div>

            {{-- Coluna Direita (Cards 2 e 4) - Deslocada para baixo --}}
            <div class="space-y-6 md:space-y-8 md:mt-16"> {{-- Margin Top ajustado para o efeito de "meio" --}}
                
                {{-- Card 2 --}}
                <div class="group bg-white p-8 rounded-[2rem] border border-gray-100 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_40px_-10px_rgba(16,185,129,0.15)] hover:border-emerald-200 transition-all duration-300 hover:-translate-y-1">
                    <div class="h-12 w-12 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center text-2xl mb-6 group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300 shadow-sm">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-black text-[#171717] mb-3">Dados Oficiais</h3>
                    <p class="text-base text-[#171717] leading-relaxed opacity-80">
                        Informações diretas da Receita Federal, atualizadas periodicamente. Segurança e integridade para sua empresa.
                    </p>
                </div>

                {{-- Card 4 --}}
                <div class="group bg-white p-8 rounded-[2rem] border border-gray-100 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_40px_-10px_rgba(168,85,247,0.15)] hover:border-purple-200 transition-all duration-300 hover:-translate-y-1">
                    <div class="h-12 w-12 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center text-2xl mb-6 group-hover:bg-purple-500 group-hover:text-white transition-colors duration-300 shadow-sm">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-black text-[#171717] mb-3">Decisões Estratégicas</h3>
                    <p class="text-base text-[#171717] leading-relaxed opacity-80">
                        Reduza riscos de crédito e foque em mercados com maior potencial de faturamento usando dados reais.
                    </p>
                </div>

            </div>

        </div>
    </div>
</section>