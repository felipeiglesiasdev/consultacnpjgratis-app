@props(['totalAtivas', 'totalEncerradas'])

<section class="relative bg-white py-24 lg:py-32 overflow-hidden">
    
    {{-- Background Pattern Sutil --}}
    <div class="absolute inset-0 z-0 opacity-40" 
         style="background-image: radial-gradient(#171717 1px, transparent 1px); background-size: 32px 32px;">
    </div>

    <div class="container mx-auto px-6 md:px-10 xl:px-16 relative z-10">
        
        {{-- Header da Seção --}}
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-16">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 mb-4">
                    <span class="h-px w-8 bg-amber-500"></span>
                    <span class="text-amber-600 font-bold uppercase text-xs tracking-[0.2em]">Panorama em tempo real</span>
                </div>
                {{-- Fonte Aumentada e Cor #171717 --}}
                <h2 class="text-4xl md:text-5xl font-black text-[#171717] leading-tight tracking-tight">
                    O Brasil empresarial <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#171717] via-gray-800 to-gray-600">em números precisos</span>.
                </h2>
                {{-- Fonte Texto #171717 --}}
                <p class="mt-6 text-lg text-[#171717] leading-relaxed max-w-2xl">
                    Acompanhe quantas empresas estão ativas, quantas foram encerradas e tenha uma visão clara e analítica do cenário de negócios no país.
                </p>
            </div>

            <div class="flex-shrink-0">
                <a href="{{ route('home') }}#consultar" 
                   class="group inline-flex items-center gap-3 px-6 py-3 rounded-full bg-gray-50 border border-gray-200 text-[#171717] font-semibold text-sm hover:bg-gray-100 hover:border-amber-500/30 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                    <span>Fazer nova consulta</span>
                    <div class="h-6 w-6 rounded-full bg-amber-500 text-white flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="bi bi-search text-xs"></i>
                    </div>
                </a>
            </div>
        </div>

        {{-- Grid de Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            {{-- Card 1: Empresas Ativas --}}
            <div class="group relative bg-white rounded-[2rem] p-8 border border-gray-100 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_40px_-15px_rgba(16,185,129,0.15)] hover:border-emerald-500/20 transition-all duration-500">
                <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:opacity-20 group-hover:scale-110 transition-all duration-500">
                    <i class="bi bi-graph-up-arrow text-6xl text-emerald-600"></i>
                </div>
                
                <div class="relative z-10">
                    <div class="h-12 w-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-6 group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300 shadow-sm">
                        <i class="bi bi-check-lg text-2xl"></i>
                    </div>
                    
                    <p class="text-xs font-bold uppercase tracking-widest text-emerald-600 mb-2">Empresas Ativas</p>
                    <h3 class="text-4xl lg:text-5xl font-black text-[#171717] tracking-tighter mb-4">
                        {{ number_format($totalAtivas, 0, ',', '.') }}
                    </h3>
                    <p class="text-base text-[#171717] leading-relaxed">
                        CNPJs em situação regular na Receita Federal, prontos para fazer negócios e movimentar a economia.
                    </p>
                </div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 rounded-b-[2rem]"></div>
            </div>

            {{-- Card 2: Empresas Encerradas --}}
            <div class="group relative bg-white rounded-[2rem] p-8 border border-gray-100 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_40px_-15px_rgba(244,63,94,0.15)] hover:border-rose-500/20 transition-all duration-500">
                <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:opacity-20 group-hover:scale-110 transition-all duration-500">
                    <i class="bi bi-x-circle text-6xl text-rose-600"></i>
                </div>
                
                <div class="relative z-10">
                    <div class="h-12 w-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center mb-6 group-hover:bg-rose-500 group-hover:text-white transition-colors duration-300 shadow-sm">
                        <i class="bi bi-archive text-2xl"></i>
                    </div>
                    
                    <p class="text-xs font-bold uppercase tracking-widest text-rose-600 mb-2">Empresas Encerradas</p>
                    <h3 class="text-4xl lg:text-5xl font-black text-[#171717] tracking-tighter mb-4">
                        {{ number_format($totalEncerradas, 0, ',', '.') }}
                    </h3>
                    <p class="text-base text-[#171717] leading-relaxed">
                        Negócios baixados, suspensos ou inaptos. Dado crucial para análise de risco e higienização de base.
                    </p>
                </div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-rose-400 to-rose-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 rounded-b-[2rem]"></div>
            </div>

            {{-- Card 3: Cobertura Nacional --}}
            <div class="group relative bg-white rounded-[2rem] p-8 border border-gray-100 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_40px_-15px_rgba(245,158,11,0.15)] hover:border-amber-500/20 transition-all duration-500">
                <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:opacity-20 group-hover:scale-110 transition-all duration-500">
                    <i class="bi bi-globe-americas text-6xl text-amber-600"></i>
                </div>
                
                <div class="relative z-10">
                    <div class="h-12 w-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mb-6 group-hover:bg-amber-500 group-hover:text-white transition-colors duration-300 shadow-sm">
                        <i class="bi bi-database-check text-2xl"></i>
                    </div>
                    
                    <p class="text-xs font-bold uppercase tracking-widest text-amber-600 mb-2">Cobertura Nacional</p>
                    <h3 class="text-4xl lg:text-5xl font-black text-[#171717] tracking-tighter mb-4">
                        100%
                    </h3>
                    <p class="text-base text-[#171717] leading-relaxed">
                        Base completa com todos os estados e atividades econômicas (CNAEs). Dados oficiais e públicos.
                    </p>
                </div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-amber-400 to-amber-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 rounded-b-[2rem]"></div>
            </div>

        </div>
    </div>
</section>