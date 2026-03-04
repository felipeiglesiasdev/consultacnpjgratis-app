@props(['totalEmpresasAtivas'])

<section class="relative overflow-hidden bg-gradient-to-b from-[#050509] via-[#050608] to-black text-white">
    {{-- Efeitos de Brilho (Glows) ao fundo --}}
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute -left-32 -top-32 h-[500px] w-[500px] rounded-full bg-amber-500/10 blur-[120px]"></div>
        <div class="absolute right-[-200px] top-1/3 h-[600px] w-[600px] rounded-full bg-amber-400/5 blur-[120px]"></div>
        <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-black via-black/80 to-transparent"></div>
    </div>

    <div class="relative container mx-auto px-6 md:px-10 xl:px-16 py-20 md:py-28">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-12 xl:gap-16">
            
            {{-- Texto Principal --}}
            <div class="max-w-2xl space-y-8">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 shadow-lg backdrop-blur-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <p class="text-xs md:text-sm font-medium text-amber-200">
                        Mais de {{ number_format($totalEmpresasAtivas, 0, ',', '.') }} empresas ativas mapeadas
                    </p>
                </div>

                <h1 class="text-4xl md:text-5xl xl:text-6xl font-black tracking-tight leading-[1.1]">
                    Diretório Nacional de <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-amber-200">Empresas e Negócios</span>
                </h1>
                
                <p class="text-base md:text-lg text-gray-300 leading-relaxed max-w-xl">
                    Navegue pela base oficial da Receita Federal segmentada por regiões. 
                    Encontre polos comerciais, descubra os estados mais ativos e analise o volume de negócios por município para suas estratégias B2B.
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-4">
                    <a href="#estados" class="inline-flex items-center justify-center rounded-xl px-6 py-3.5 text-sm font-bold bg-amber-400 text-black hover:bg-amber-300 shadow-lg shadow-amber-500/20 transition-all duration-200 hover:-translate-y-0.5">
                        Explorar por Estados
                        <i class="bi bi-arrow-down ml-2"></i>
                    </a>
                </div>
            </div>

            {{-- Cards Informativos Laterais --}}
            <div class="lg:w-1/3 xl:w-[400px] shrink-0">
                <div class="rounded-3xl border border-white/10 bg-white/[0.02] p-6 backdrop-blur-md shadow-2xl relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-500/5 to-transparent"></div>
                    
                    <div class="relative space-y-4">
                        <div class="rounded-2xl border border-white/5 bg-black/40 p-4 transition-colors hover:bg-black/60">
                            <p class="text-[11px] font-bold uppercase tracking-widest text-amber-400 mb-1">Por Estado</p>
                            <p class="text-sm text-gray-300 leading-relaxed">
                                Clique em uma UF para ver as cidades em destaque e as estatísticas locais.
                            </p>
                        </div>
                        
                        <div class="rounded-2xl border border-white/5 bg-black/40 p-4 transition-colors hover:bg-black/60">
                            <p class="text-[11px] font-bold uppercase tracking-widest text-amber-400 mb-1">Por Município</p>
                            <p class="text-sm text-gray-300 leading-relaxed">
                                Acompanhe o volume exato de negócios e encontre todas as empresas de cada cidade.
                            </p>
                        </div>

                        <p class="pt-2 text-[11px] text-gray-500 text-center flex items-center justify-center gap-2">
                            <i class="bi bi-shield-check text-emerald-500/70"></i>
                            Dados públicos atualizados diariamente
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>