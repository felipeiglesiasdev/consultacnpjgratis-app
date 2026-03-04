@props([
    'uf',
    'totalAtivas',
    'totalMatrizes',
    'totalfiliais',
    'totalAbertas2025',
    'totalFechadas2025',
    'preposicao',
    'nomeEstado',
])

<section class="bg-gray-50 py-20 relative border-b border-gray-200">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        
        <div class="max-w-3xl mb-12">
            <p class="text-amber-600 font-bold uppercase text-xs tracking-[0.2em]">
                Termômetro Estadual
            </p>
            <h2 class="mt-2 text-3xl md:text-4xl font-black text-gray-900 tracking-tight">
                Balanço Oficial de Empresas
            </h2>
            <p class="mt-4 text-base text-gray-600">
                Veja como o estado {{ strtolower($preposicao) }} {{ $nomeEstado }} se comporta hoje. Entenda a proporção entre matrizes e filiais e acompanhe o fluxo de aberturas e encerramentos ao longo do ano atual.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 xl:gap-6">
            
            {{-- KPI 1 --}}
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4">
                    <i class="bi bi-building-check text-xl"></i>
                </div>
                <p class="text-xs uppercase tracking-widest text-gray-400 font-bold mb-1">
                    Ativas no Estado
                </p>
                <p class="text-3xl font-black text-gray-900">
                    {{ number_format($totalAtivas, 0, ',', '.') }}
                </p>
            </div>

            {{-- KPI 2 --}}
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                <div>
                    <div class="h-10 w-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4">
                        <i class="bi bi-diagram-3 text-xl"></i>
                    </div>
                    <p class="text-xs uppercase tracking-widest text-gray-400 font-bold mb-1">
                        Matrizes vs Filiais
                    </p>
                    <p class="text-2xl font-black text-gray-900">
                        {{ number_format($totalMatrizes, 0, ',', '.') }} <span class="text-sm font-medium text-gray-400">matrizes</span>
                    </p>
                    <p class="text-lg font-bold text-gray-600 mt-1">
                        {{ number_format($totalfiliais, 0, ',', '.') }} <span class="text-sm font-medium text-gray-400">filiais</span>
                    </p>
                </div>
            </div>

            {{-- KPI 3 --}}
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="h-10 w-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-4">
                    <i class="bi bi-door-open text-xl"></i>
                </div>
                <p class="text-xs uppercase tracking-widest text-gray-400 font-bold mb-1">
                    Aberturas no Ano
                </p>
                <p class="text-3xl font-black text-gray-900">
                    +{{ number_format($totalAbertas2025, 0, ',', '.') }}
                </p>
                <p class="text-[11px] text-gray-400 mt-2 font-medium">
                    Registradas neste ano
                </p>
            </div>

            {{-- KPI 4 --}}
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="h-10 w-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center mb-4">
                    <i class="bi bi-door-closed text-xl"></i>
                </div>
                <p class="text-xs uppercase tracking-widest text-gray-400 font-bold mb-1">
                    Encerramentos no Ano
                </p>
                <p class="text-3xl font-black text-gray-900">
                    -{{ number_format($totalFechadas2025, 0, ',', '.') }}
                </p>
                <p class="text-[11px] text-gray-400 mt-2 font-medium">
                    Baixadas neste ano
                </p>
            </div>

        </div>
    </div>
</section>