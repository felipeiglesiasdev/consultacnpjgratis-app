@props([
    'empresas',
    'municipio',
    'ufReal',
])

@php
    $nomeCidade = Str::title($municipio->descricao);
@endphp

<section id="tabela-empresas" class="bg-gray-50 py-20 relative border-t border-gray-200">
    <div class="container mx-auto px-4 md:px-10 xl:px-16">
        
        <div class="max-w-3xl mb-10">
            <p class="text-amber-600 font-bold uppercase text-xs tracking-[0.2em]">
                Catálogo de CNPJs
            </p>
            <h2 class="mt-2 text-3xl md:text-4xl font-black text-gray-900 tracking-tight">
                Empresas em {{ $nomeCidade }}
            </h2>
            <p class="mt-4 text-base text-gray-600">
                Navegue pelas empresas ativas do município. Cada registro contém informações públicas oficiais. Clique no CNPJ para acessar a ficha completa da empresa.
            </p>
        </div>

        {{-- Container da Tabela --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left whitespace-nowrap border-collapse">
                    <thead>
                        <tr class="bg-gray-50/80 border-b border-gray-200 text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <th scope="col" class="px-6 py-4">Dados da Empresa</th>
                            <th scope="col" class="px-6 py-4">Data de Abertura</th>
                            <th scope="col" class="px-6 py-4 text-right">Ação</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($empresas as $empresa)
                            @php
                                $cnpjCompleto = $empresa->cnpj_basico . $empresa->cnpj_ordem . $empresa->cnpj_dv;
                                $cnpjFormatado = substr($cnpjCompleto, 0, 2) . '.' . substr($cnpjCompleto, 2, 3) . '.' . substr($cnpjCompleto, 5, 3) . '/' . substr($cnpjCompleto, 8, 4) . '-' . substr($cnpjCompleto, 12, 2);
                                $razaoSocial = $empresa->razao_social ?? 'Razão social não informada';
                                $nomeFantasia = $empresa->nome_fantasia ? Str::title($empresa->nome_fantasia) : null;
                                $dataInicio = $empresa->data_inicio_atividade ? \Carbon\Carbon::parse($empresa->data_inicio_atividade)->format('d/m/Y') : 'N/I';
                            @endphp
                            
                            <tr class="hover:bg-gray-50/50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-start gap-3">
                                        <div class="mt-1 h-10 w-10 flex-shrink-0 rounded-lg bg-gray-100 flex items-center justify-center border border-gray-200 group-hover:border-amber-300 group-hover:bg-amber-50 transition-colors">
                                            <i class="bi bi-building text-gray-400 group-hover:text-amber-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-900 line-clamp-2 pr-4 max-w-md">
                                                {{ Str::limit($razaoSocial, 60) }}
                                            </p>
                                            @if($nomeFantasia)
                                                <p class="text-[11px] text-gray-500 mt-0.5 truncate max-w-xs">
                                                    Fantasia: {{ $nomeFantasia }}
                                                </p>
                                            @endif
                                            <div class="flex items-center gap-3 mt-2 text-[11px] font-medium">
                                                <span class="text-gray-700 bg-gray-100 px-2 py-0.5 rounded font-mono">
                                                    {{ $cnpjFormatado }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 align-top">
                                    <div class="space-y-1 mt-1 text-sm text-gray-600">
                                        <p class="flex items-center gap-1.5 text-xs text-gray-500">
                                            <i class="bi bi-calendar3 text-gray-400"></i>
                                            Desde: {{ $dataInicio }}
                                        </p>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 align-middle text-right">
                                    <a 
                                        href="{{ route('cnpj.show', $cnpjCompleto) }}" 
                                        class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-gray-200 bg-white px-4 py-2 text-xs font-bold text-gray-700 hover:border-amber-400 hover:bg-amber-50 hover:text-amber-800 transition-all shadow-sm"
                                    >
                                        Consultar
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center">
                                    <div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="bi bi-inbox text-2xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-base font-bold text-gray-900 mb-1">Nenhum registro encontrado</h3>
                                    <p class="text-sm text-gray-500">Não há empresas ativas listadas para esta região no momento.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Paginação (O design Tailwind é aplicado automaticamente pelo Laravel se configurado no AppServiceProvider) --}}
            @if($empresas->hasPages())
                <div class="border-t border-gray-200 px-6 py-4 bg-gray-50">
                    {{ $empresas->links() }}
                </div>
            @endif
        </div>

    </div>
</section>