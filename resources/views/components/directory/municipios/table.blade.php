@props(['municipios'])

<div class="bg-white border border-gray-200 rounded-3xl shadow-xl p-6 md:p-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Todos os municípios</h2>
            <p class="text-gray-600">Paginação de 50 por página para não pesar sua navegação.</p>
        </div>
        <div class="flex items-center gap-3 text-sm text-gray-600 bg-gray-50 border border-gray-200 rounded-full px-4 py-2">
            <span class="w-2 h-2 bg-amber-500 rounded-full animate-ping"></span>
            <span class="font-semibold text-gray-800">{{ number_format($municipios->total(), 0, ',', '.') }}</span>
            <span>cidades listadas</span>
        </div>
    </div>

    <div class="overflow-hidden border border-gray-100 rounded-2xl">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-900 text-white">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold">Município</th>
                    <th class="px-6 py-3 text-left font-semibold">UF</th>
                    <th class="px-6 py-3 text-left font-semibold">Empresas ativas</th>
                    <th class="px-6 py-3 text-left font-semibold">Total de empresas</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($municipios as $linha)
                    <tr class="hover:bg-amber-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <a href="{{ route('empresas.municipios.show', ['codigo_municipio' => $linha->codigo]) }}"
                               class="text-base font-semibold text-gray-900 hover:text-amber-600">
                                {{ $linha->nome }}
                            </a>
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-700">{{ $linha->uf }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-2 font-bold text-gray-900">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                                {{ number_format($linha->total_ativas, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-700">{{ number_format($linha->total_empresas, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $municipios->links() }}</div>
</div>
