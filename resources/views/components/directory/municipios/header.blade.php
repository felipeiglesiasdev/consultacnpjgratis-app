@props([
    'municipio',
    'ufReal',
    'totalAtivas',
    'totalAbertas2025',
    'totalFechadas2025',
])

@php
    $nomeCidade = Str::title($municipio->descricao);
@endphp

<section class="relative overflow-hidden bg-gradient-to-b from-[#050509] via-[#050608] to-black text-white">
    {{-- Glows de fundo (Temática Azul/Dourado) --}}
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -left-32 -top-32 h-[500px] w-[500px] rounded-full bg-blue-500/10 blur-[120px]"></div>
        <div class="absolute right-[-200px] top-1/3 h-[600px] w-[600px] rounded-full bg-amber-400/5 blur-[120px]"></div>
        <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-black via-black/80 to-transparent"></div>
    </div>

    <div class="relative container mx-auto px-6 md:px-10 xl:px-16 py-16 md:py-24">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-10 xl:gap-14">
            
            <div class="max-w-2xl space-y-8">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 shadow-lg backdrop-blur-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                    </span>
                    <p class="text-xs md:text-sm font-medium text-blue-200">
                        {{ number_format($totalAtivas, 0, ',', '.') }} empresas na região
                    </p>
                </div>

                <h1 class="text-4xl md:text-5xl xl:text-6xl font-black tracking-tight leading-[1.1]">
                    Empresas ativas em <br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-amber-200">
                        {{ $nomeCidade }} - {{ $ufReal }}
                    </span>
                </h1>
                
                <p class="text-base md:text-lg text-gray-300 leading-relaxed max-w-xl">
                    Bem-vindo ao diretório completo de CNPJs de {{ $nomeCidade }}. Abaixo você encontra a lista detalhada e atualizada das empresas que operam na cidade, ideal para estruturar suas próximas campanhas de prospecção.
                </p>
                
                {{-- Balanço rápido do município (Embutido no Hero) --}}
                <div class="flex flex-wrap gap-4 pt-2">
                    <div class="bg-white/5 border border-white/10 rounded-xl px-5 py-3 flex items-center gap-3 backdrop-blur-sm">
                        <div class="h-8 w-8 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center">
                            <i class="bi bi-door-open-fill text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium">Aberturas (Ano)</p>
                            <p class="text-lg font-bold text-white">+{{ number_format($totalAbertas2025, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    
                    <div class="bg-white/5 border border-white/10 rounded-xl px-5 py-3 flex items-center gap-3 backdrop-blur-sm">
                        <div class="h-8 w-8 rounded-lg bg-red-500/20 text-red-400 flex items-center justify-center">
                            <i class="bi bi-door-closed-fill text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium">Encerramentos (Ano)</p>
                            <p class="text-lg font-bold text-white">-{{ number_format($totalFechadas2025, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Card Ilustrativo --}}
            <div class="lg:w-1/3 xl:w-[400px] shrink-0 hidden md:block">
                <div class="rounded-3xl border border-white/10 bg-white/[0.02] p-8 backdrop-blur-md shadow-2xl relative overflow-hidden flex flex-col items-center text-center">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent"></div>
                    
                    <div class="relative w-full">
                        <div class="h-20 w-20 mx-auto rounded-full bg-blue-500/10 flex items-center justify-center mb-6">
                            <i class="bi bi-buildings text-4xl text-blue-400"></i>
                        </div>

                        <h3 class="text-xl font-bold text-white mb-2">Diretório Local</h3>
                        <p class="text-sm text-gray-400 leading-relaxed mb-6">
                            Use a tabela abaixo para navegar pela base. Todos os CNPJs exibidos estão em situação regular (ativa) na Receita Federal.
                        </p>

                        <a href="#tabela-empresas" class="w-full inline-flex items-center justify-center rounded-xl px-4 py-3 text-sm font-bold bg-white/10 text-white border border-white/20 hover:bg-white/20 transition-colors">
                            Ver a lista de empresas
                            <i class="bi bi-chevron-down ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>