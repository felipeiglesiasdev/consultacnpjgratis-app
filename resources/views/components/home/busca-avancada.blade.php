<section class="relative py-20 lg:py-28 bg-[#050509] overflow-hidden">
    
    {{-- Efeitos de Fundo (Glows & Grid) --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute inset-0 opacity-[0.03]" 
             style="background-image: linear-gradient(#333 1px, transparent 1px), linear-gradient(to right, #333 1px, transparent 1px); background-size: 40px 40px;">
        </div>
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/3 w-[500px] h-[500px] bg-amber-500/10 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/3 w-[400px] h-[400px] bg-indigo-500/5 rounded-full blur-[80px]"></div>
    </div>

    <div class="container mx-auto px-6 md:px-10 xl:px-16 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
            
            {{-- LADO ESQUERDO: Texto Direto e Lista --}}
            <div class="lg:w-1/2 space-y-8">
                <div>
                    <div class="inline-flex items-center gap-2 mb-3">
                        <span class="relative flex h-1.5 w-1.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-amber-500"></span>
                        </span>
                        <span class="text-amber-500 font-bold tracking-[0.15em] uppercase text-[10px]">Busca Avançada de CNPJs</span>
                    </div>
                    
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-white leading-tight tracking-tight">
                        Encontre empresas com <br class="hidden lg:block">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-500">filtros personalizados</span>.
                    </h2>
                </div>
                
                <p class="text-base text-gray-400 leading-relaxed max-w-lg">
                    Não perca tempo com listas genéricas. Combine filtros estratégicos para segmentar o mercado e encontrar exatamente o perfil de empresa que você precisa.
                </p>

                {{-- Lista de Funcionalidades (Ícones + Texto Direto) --}}
                <div class="grid gap-3">
                    
                    {{-- Item 1 --}}
                    <div class="flex items-center gap-4 p-3 rounded-xl bg-white/[0.02] border border-white/5 hover:bg-white/[0.04] hover:border-amber-500/20 transition-all duration-300 group">
                        <div class="h-10 w-10 shrink-0 rounded-lg bg-amber-500/10 flex items-center justify-center text-amber-500 text-lg border border-amber-500/10 group-hover:scale-105 transition-transform">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-sm group-hover:text-amber-400 transition-colors">Por Região</h4>
                            <p class="text-xs text-gray-500">Filtre por Estado, Cidade e Bairro.</p>
                        </div>
                    </div>
                    
                    {{-- Item 2 --}}
                    <div class="flex items-center gap-4 p-3 rounded-xl bg-white/[0.02] border border-white/5 hover:bg-white/[0.04] hover:border-blue-500/20 transition-all duration-300 group">
                        <div class="h-10 w-10 shrink-0 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-400 text-lg border border-blue-500/10 group-hover:scale-105 transition-transform">
                            <i class="bi bi-briefcase-fill"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-sm group-hover:text-blue-300 transition-colors">Por Atividade (CNAE)</h4>
                            <p class="text-xs text-gray-500">Busque pelo código ou nome da atividade.</p>
                        </div>
                    </div>

                    {{-- Item 3 --}}
                    <div class="flex items-center gap-4 p-3 rounded-xl bg-white/[0.02] border border-white/5 hover:bg-white/[0.04] hover:border-emerald-500/20 transition-all duration-300 group">
                        <div class="h-10 w-10 shrink-0 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-400 text-lg border border-emerald-500/10 group-hover:scale-105 transition-transform">
                            <i class="bi bi-calendar-event-fill"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-sm group-hover:text-emerald-300 transition-colors">Por Data de Abertura</h4>
                            <p class="text-xs text-gray-500">Selecione empresas novas ou antigas.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <a href="{{ route('consulta_avancada.index') }}" 
                       class="inline-flex items-center gap-2 bg-white text-black font-bold py-3 px-6 rounded-lg text-sm hover:bg-gray-200 transition-all transform hover:-translate-y-0.5 shadow-[0_0_20px_rgba(255,255,255,0.1)] group">
                        <span>Acessar Filtros Avançados</span>
                        <i class="bi bi-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            {{-- LADO DIREITO: Card Criativo (Interface de Filtro com Seletores) --}}
            <div class="lg:w-1/2 relative perspective-1000 group/visual flex justify-center">
                
                {{-- Card Simulando Interface --}}
                <div class="relative z-20 w-full max-w-sm bg-[#0F0F11] border border-white/10 rounded-[1.5rem] p-6 shadow-2xl transform transition-transform duration-500 hover:rotate-y-0 lg:rotate-y-[-3deg] lg:rotate-x-[3deg]">
                    
                    {{-- Header Fake --}}
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-white/5">
                        <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest flex items-center gap-2">
                            <i class="bi bi-sliders text-amber-500"></i> Filtros de Busca
                        </span>
                        <div class="flex gap-1.5">
                            <div class="w-2 h-2 rounded-full bg-red-500/20"></div>
                            <div class="w-2 h-2 rounded-full bg-amber-500/20"></div>
                            <div class="w-2 h-2 rounded-full bg-emerald-500/20"></div>
                        </div>
                    </div>

                    {{-- Seletores (Options) --}}
                    <div class="space-y-4">
                        
                        {{-- Select 1: Localização --}}
                        <div class="group">
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Localização</label>
                            <div class="relative">
                                <div class="flex items-center justify-between bg-[#151518] text-gray-300 text-sm px-4 py-3 rounded-xl border border-white/10 group-hover:border-amber-500/30 transition-colors cursor-default shadow-sm">
                                    <span class="flex items-center gap-2">
                                        <i class="bi bi-geo-alt text-amber-500"></i>
                                        São Paulo (SP)
                                    </span>
                                    <i class="bi bi-chevron-down text-xs text-gray-600 group-hover:text-amber-500 transition-colors"></i>
                                </div>
                            </div>
                        </div>

                        {{-- Select 2: CNAE --}}
                        <div class="group">
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Atividade Econômica</label>
                            <div class="relative">
                                <div class="flex items-center justify-between bg-[#151518] text-gray-300 text-sm px-4 py-3 rounded-xl border border-white/10 group-hover:border-blue-500/30 transition-colors cursor-default shadow-sm">
                                    <span class="flex items-center gap-2">
                                        <i class="bi bi-code-slash text-blue-500"></i>
                                        62.01-5 (Tecnologia)
                                    </span>
                                    <i class="bi bi-chevron-down text-xs text-gray-600 group-hover:text-blue-500 transition-colors"></i>
                                </div>
                            </div>
                        </div>

                        {{-- Select 3: Data --}}
                        <div class="group">
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Período de Abertura</label>
                            <div class="relative">
                                <div class="flex items-center justify-between bg-[#151518] text-gray-300 text-sm px-4 py-3 rounded-xl border border-white/10 group-hover:border-emerald-500/30 transition-colors cursor-default shadow-sm">
                                    <span class="flex items-center gap-2">
                                        <i class="bi bi-calendar-event text-emerald-500"></i>
                                        Últimos 30 dias
                                    </span>
                                    <i class="bi bi-chevron-down text-xs text-gray-600 group-hover:text-emerald-500 transition-colors"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Botão Fake --}}
                    <div class="mt-8 pt-6 border-t border-white/5">
                        <div class="w-full bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-400 hover:to-orange-500 text-white font-bold text-center py-3 rounded-xl text-xs uppercase tracking-wide shadow-lg shadow-amber-500/20 transition-all cursor-default flex items-center justify-center gap-2">
                            <i class="bi bi-search"></i> Filtrar Resultados
                        </div>
                    </div>
                </div>

                {{-- Glow Decorativo --}}
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-amber-500/10 rounded-full blur-[50px] animate-pulse"></div>
            </div>
        </div>
    </div>
</section>

<style>
    .perspective-1000 { perspective: 1000px; }
</style>