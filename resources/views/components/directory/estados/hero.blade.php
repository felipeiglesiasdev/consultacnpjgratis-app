@props(['uf', 'totalAtivas', 'preposicao', 'nomeEstado'])

<section class="relative overflow-hidden bg-gradient-to-b from-[#050509] via-[#050608] to-black text-white">
    {{-- Glows de fundo (Temática Verde/Amarelo Brasil) --}}
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -left-32 -top-32 h-[500px] w-[500px] rounded-full bg-emerald-500/10 blur-[120px]"></div>
        <div class="absolute right-[-200px] top-1/3 h-[600px] w-[600px] rounded-full bg-amber-400/5 blur-[120px]"></div>
        <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-black via-black/80 to-transparent"></div>
    </div>

    <div class="relative container mx-auto px-6 md:px-10 xl:px-16 py-16 md:py-24">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-10 xl:gap-14">
            
            <div class="max-w-2xl space-y-8">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 shadow-lg backdrop-blur-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                    </span>
                    <p class="text-xs md:text-sm font-medium text-emerald-200">
                        {{ number_format($totalAtivas, 0, ',', '.') }} empresas ativas mapeadas
                    </p>
                </div>

                <h1 class="text-4xl md:text-5xl xl:text-6xl font-black tracking-tight leading-[1.1]">
                    Empresas do estado <br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-amber-200">
                        {{ strtolower($preposicao) }} {{ $nomeEstado }}
                    </span>
                </h1>
                
                <p class="text-base md:text-lg text-gray-300 leading-relaxed max-w-xl">
                    Explore o cenário corporativo do estado. Navegue pela lista completa de municípios, descubra as cidades com maior volume de negócios e as atividades econômicas (CNAEs) que mais movimentam a região.
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-4">
                    <a href="#municipios" class="inline-flex items-center justify-center rounded-xl px-6 py-3.5 text-sm font-bold bg-amber-400 text-black hover:bg-amber-300 shadow-lg shadow-amber-500/20 transition-all duration-200 hover:-translate-y-0.5">
                        Ver Municípios
                        <i class="bi bi-arrow-down ml-2"></i>
                    </a>
                </div>
            </div>

            {{-- Card Informativo --}}
            <div class="lg:w-1/3 xl:w-[400px] shrink-0">
                <div class="rounded-3xl border border-white/10 bg-white/[0.02] p-6 backdrop-blur-md shadow-2xl relative overflow-hidden flex flex-col items-center justify-center text-center">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-transparent"></div>
                    
                    <div class="relative w-full">
                        <span class="inline-flex h-20 w-20 items-center justify-center rounded-2xl bg-black border border-white/10 text-emerald-400 text-3xl font-black mb-6 shadow-[0_0_30px_rgba(52,211,153,0.15)]">
                            {{ $uf }}
                        </span>

                        <div class="space-y-3 text-left">
                            <div class="rounded-2xl border border-white/5 bg-black/40 p-4">
                                <p class="text-[11px] font-bold uppercase tracking-widest text-emerald-400 mb-1">Aplicação Prática</p>
                                <p class="text-sm text-gray-300 leading-relaxed">
                                    Ideal para prospecção B2B regional, estudos de mercado e análise de potencial de novos clientes em {{ $nomeEstado }}.
                                </p>
                            </div>
                        </div>

                        <p class="pt-6 text-[11px] text-gray-500 flex items-center justify-center gap-2">
                            <i class="bi bi-info-circle text-gray-400"></i>
                            Dados baseados no Cadastro Nacional de CNPJs.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>