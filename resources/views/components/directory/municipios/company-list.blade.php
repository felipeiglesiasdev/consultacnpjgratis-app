@props(['empresas'])

<div class="bg-white rounded-3xl shadow-xl p-6 md:p-8 border border-gray-200">
    <div class="flex items-center justify-between gap-3 mb-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Amostra de empresas ativas</h2>
            <p class="text-gray-600">Listadas por ordem das aberturas mais recentes.</p>
        </div>
        <span class="inline-flex items-center gap-2 text-sm bg-amber-50 text-amber-700 font-semibold px-4 py-2 rounded-full border border-amber-200">
            <span class="w-2 h-2 bg-emerald-500 rounded-full"></span> Atualizadas em tempo real
        </span>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-900 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Razão Social</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">CNPJ</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider">Capital Social</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($empresas as $estabelecimento)
                    <tr class="hover:bg-amber-50/70 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('cnpj.show', ['cnpj' => $estabelecimento->cnpj_completo]) }}"
                               class="text-sm font-semibold text-gray-900 hover:text-amber-600">
                                {{ Str::limit($estabelecimento->empresa->razao_social, 60) }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-mono">
                            {{ $estabelecimento->cnpj_completo_formatado }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold text-right">
                            R$ {{ number_format($estabelecimento->empresa->capital_social ?? 0, 2, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                            Nenhuma empresa ativa encontrada para esta cidade.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

     {{-- Paginação --}}
    <div class="mt-8">
        {{ $empresas->links() }}
    </div>
</div>