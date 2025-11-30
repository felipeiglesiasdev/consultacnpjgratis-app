@props(['resumo'])

<div class="bg-white rounded-3xl shadow-xl border border-gray-200 p-8 md:p-10">
    <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
        <div class="space-y-4">
            <p class="text-sm font-semibold tracking-wider text-amber-600 uppercase">Panorama nacional</p>
            <h1 class="text-4xl lg:text-5xl font-black text-gray-900 leading-tight">
                Empresas por município em todo o Brasil
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl">
                Consulte o ranking de municípios com empresas ativas, visualize totais consolidados e avance para ver exemplos de empresas em cada cidade.
            </p>
            @if($resumo['ufCampeaoMunicipios'])
                <div class="inline-flex items-center gap-3 bg-amber-50 border border-amber-200 text-amber-800 px-4 py-2 rounded-full text-sm font-semibold">
                    <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                    Estado com mais municípios: <span class="font-bold">{{ $resumo['ufCampeaoMunicipios']->uf }}</span>
                    <span class="text-gray-500">({{ number_format($resumo['ufCampeaoMunicipios']->total, 0, ',', '.') }} cidades)</span>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-2 gap-4 lg:w-2/5">
            <div class="bg-gray-900 text-white rounded-2xl p-6 shadow-lg hover:-translate-y-1 transition-transform duration-200">
                <p class="text-xs uppercase tracking-[0.18em] text-amber-300 font-semibold">Municípios</p>
                <p class="text-4xl font-black mt-3">{{ number_format($resumo['totalMunicipios'], 0, ',', '.') }}</p>
                <p class="text-sm text-gray-300 mt-1">Registrados na base</p>
            </div>
            <div class="bg-white border border-amber-200 text-gray-900 rounded-2xl p-6 shadow-lg hover:-translate-y-1 transition-transform duration-200">
                <p class="text-xs uppercase tracking-[0.18em] text-amber-600 font-semibold">Cidades com empresas</p>
                <p class="text-4xl font-black mt-3">{{ number_format($resumo['municipiosComEmpresas'], 0, ',', '.') }}</p>
                <p class="text-sm text-gray-600 mt-1">Com pelo menos um CNPJ</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-lg hover:-translate-y-1 transition-transform duration-200">
                <p class="text-xs uppercase tracking-[0.18em] text-gray-500 font-semibold">Média de empresas</p>
                <p class="text-3xl font-extrabold text-gray-900 mt-3">{{ number_format($resumo['mediaEmpresasPorMunicipio'], 0, ',', '.') }}</p>
                <p class="text-sm text-gray-600 mt-1">Por município brasileiro</p>
            </div>
            <div class="bg-amber-500 text-gray-900 rounded-2xl p-6 shadow-lg hover:-translate-y-1 transition-transform duration-200">
                <p class="text-xs uppercase tracking-[0.18em] text-gray-900 font-semibold">Atualização</p>
                <p class="text-3xl font-extrabold text-gray-900 mt-3">Cache 6h</p>
                <p class="text-sm text-amber-900/80 mt-1">Para performance</p>
            </div>
        </div>
    </div>
</div>
