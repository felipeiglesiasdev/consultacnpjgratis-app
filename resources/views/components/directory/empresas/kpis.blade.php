@props([
    'totalEmpresasAtivas',
    'municipiosComEmpresas',
    'mediaAberturasMensal',
    'novasEmpresasTrimestre',
    'totalCnaesCatalogados',
])

<section class="bg-gray-50 py-20 relative overflow-hidden">
    {{-- Detalhe de fundo --}}
    <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>

    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-12">
            <div class="max-w-2xl">
                <p class="text-amber-500 font-bold uppercase text-xs md:text-sm tracking-[0.2em]">
                    Termômetro Nacional
                </p>
                <h2 class="mt-2 text-3xl md:text-4xl font-black text-gray-900 tracking-tight">
                    O Ritmo do Mercado Brasileiro
                </h2>
                <p class="mt-4 text-base text-gray-600">
                    Acompanhe em tempo real os indicadores vitais do empreendedorismo no país. 
                    Métricas extraídas diretamente da nossa base de dados inteligente para entender o volume de negócios no Brasil.
                </p>
            </div>
        </div>

        {{-- Grid de KPIs (Light Mode para forte contraste com as outras seções) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 xl:gap-6">
            
            {{-- KPI 1 --}}
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4">
                    <i class="bi bi-buildings text-xl"></i>
                </div>
                <p class="text-xs uppercase tracking-widest text-gray-400 font-bold mb-1">
                    Empresas Ativas
                </p>
                <p class="text-3xl font-black text-gray-900">
                    {{ number_format($totalEmpresasAtivas, 0, ',', '.') }}
                </p>
            </div>

            {{-- KPI 2 --}}
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="h-10 w-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4">
                    <i class="bi bi-map text-xl"></i>
                </div>
                <p class="text-xs uppercase tracking-widest text-gray-400 font-bold mb-1">
                    Cidades Cobertas
                </p>
                <p class="text-3xl font-black text-gray-900">
                    {{ number_format($municipiosComEmpresas, 0, ',', '.') }}
                </p>
            </div>

            {{-- KPI 3 --}}
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="h-10 w-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-4">
                    <i class="bi bi-graph-up-arrow text-xl"></i>
                </div>
                <p class="text-xs uppercase tracking-widest text-gray-400 font-bold mb-1">
                    Novas no Trimestre
                </p>
                <p class="text-3xl font-black text-gray-900">
                    +{{ number_format($novasEmpresasTrimestre, 0, ',', '.') }}
                </p>
                <p class="text-[11px] text-gray-400 mt-2">
                    Média de {{ number_format($mediaAberturasMensal, 0, ',', '.') }}/mês (12m)
                </p>
            </div>

            {{-- KPI 4 --}}
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="h-10 w-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center mb-4">
                    <i class="bi bi-tags text-xl"></i>
                </div>
                <p class="text-xs uppercase tracking-widest text-gray-400 font-bold mb-1">
                    CNAEs Catalogados
                </p>
                <p class="text-3xl font-black text-gray-900">
                    {{ number_format($totalCnaesCatalogados, 0, ',', '.') }}
                </p>
            </div>

        </div>
    </div>
</section>