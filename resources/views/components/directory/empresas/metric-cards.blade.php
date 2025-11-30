@props([
    'totalEmpresasAtivas',
    'municipiosComEmpresas',
    'totalCnaesCatalogados',
    'mediaAberturasMensal'
])

<section class="mt-12 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
    <div class="rounded-2xl border border-amber-100 bg-white p-6 shadow-md shadow-amber-50">
        <p class="text-sm font-semibold text-amber-700">Empresas ativas</p>
        <p class="mt-2 text-3xl font-black text-[#171717]">{{ number_format($totalEmpresasAtivas, 0, ',', '.') }}</p>
        <p class="text-sm text-gray-500 mt-2">companhias com situação cadastral regular</p>
    </div>
    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-md hover:shadow-lg transition-shadow">
        <p class="text-sm font-semibold text-[#171717]">Cidades com empresas</p>
        <p class="mt-2 text-3xl font-black text-[#171717]">{{ number_format($municipiosComEmpresas, 0, ',', '.') }}</p>
        <p class="text-sm text-gray-500 mt-2">municípios com presença empresarial</p>
    </div>
    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-md hover:shadow-lg transition-shadow">
        <p class="text-sm font-semibold text-[#171717]">CNAEs catalogados</p>
        <p class="mt-2 text-3xl font-black text-[#171717]">{{ number_format($totalCnaesCatalogados, 0, ',', '.') }}</p>
        <p class="text-sm text-gray-500 mt-2">atividades econômicas disponíveis para consulta</p>
    </div>
    <div class="rounded-2xl border border-amber-100 bg-amber-50 p-6 shadow-md shadow-amber-100">
        <p class="text-sm font-semibold text-amber-800">Ritmo de aberturas</p>
        <p class="mt-2 text-3xl font-black text-[#171717]">{{ number_format($mediaAberturasMensal, 0, ',', '.') }}/mês</p>
        <p class="text-sm text-amber-900/70 mt-2">média dos últimos 12 meses em todo o país</p>
    </div>
</section>
