@props(['topCnaes', 'topCnaesRecentes'])

<section class="mt-16 rounded-3xl border border-gray-100 bg-white p-8 shadow-xl">
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
            <p class="text-sm font-semibold text-[#171717]">Panorama de atividades</p>
            <h3 class="text-3xl font-black text-[#171717]">CNAEs com maior presença e crescimento</h3>
            <p class="text-gray-600 mt-2 max-w-2xl">Combine setores consolidados e atividades que mais cresceram no último ano para guiar sua pesquisa.</p>
        </div>
        <a href="{{ route('empresas.cnae.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-amber-200 text-amber-900 font-semibold hover:bg-amber-50 transition-colors">
            Ver catálogo completo
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>

    <div class="mt-10 grid grid-cols-1 lg:grid-cols-3 gap-6">
        @foreach($topCnaes as $cnae)
            <a href="{{ route('empresas.cnae.show', ['codigo_cnae' => $cnae->codigo]) }}"
               class="group rounded-2xl border border-gray-200 bg-gradient-to-br from-white to-amber-50 p-6 shadow-md transition-all duration-200 hover:-translate-y-1 hover:shadow-xl">
                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">CNAE {{ $cnae->codigo_formatado }}</span>
                <p class="mt-4 text-lg font-semibold text-[#171717] leading-snug group-hover:text-amber-900">{{ $cnae->descricao }}</p>
                <div class="mt-4 flex items-center justify-between text-sm text-gray-600">
                    <span>Empresas ativas</span>
                    <span class="text-lg font-bold text-[#171717]">{{ number_format($cnae->ativos_count, 0, ',', '.') }}</span>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-10">
        <div class="flex items-center gap-2 mb-4">
            <span class="h-2 w-2 rounded-full bg-amber-500"></span>
            <p class="text-sm font-semibold text-[#171717] uppercase tracking-wide">Em alta nos últimos 12 meses</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($topCnaesRecentes as $cnae)
                <div class="rounded-xl border border-gray-100 bg-white p-4 shadow-sm hover:border-amber-200 transition-colors">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-[#171717]">{{ $cnae['codigo_formatado'] ?? $cnae['codigo'] }}</p>
                            <p class="text-base text-gray-700 font-medium">{{ $cnae['descricao'] }}</p>
                        </div>
                        <span class="text-sm font-bold text-amber-700">+{{ number_format($cnae['total'], 0, ',', '.') }}</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">aberturas registradas no último ano</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
