@props(['data'])

@php
    $empresas = $data['empresas_semelhantes'] ?? [];
    $context  = $data['similar_context'] ?? [];
@endphp

@if (!empty($empresas))
<div id="empresas-semelhantes" class="rounded-2xl border border-gray-200 bg-white shadow-[0_18px_45px_-28px_rgba(15,23,42,0.55)]">
    <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
        <span class="inline-flex items-center justify-center h-9 w-9 rounded-2xl bg-gray-900/5 text-gray-700">
            <i class="bi bi-building text-lg"></i>
        </span>
        <div>
            <h2 class="text-sm font-semibold text-gray-900">Empresas semelhantes</h2>
            <p class="text-[11px] text-gray-500">
                Outras empresas com perfil parecido
            </p>
        </div>
    </div>

    <div class="px-5 py-5 space-y-4 text-sm">
        <p class="text-gray-600">
            Listando empresas com a mesma atividade principal
            @if(!empty($context['cnae_descricao']))
                (<span class="font-semibold">{{ $context['cnae_descricao'] }}</span>)
            @endif
            @if(!empty($context['cidade']))
                na região de <span class="font-semibold">{{ $context['cidade'] }}</span>
            @endif
            @if(!empty($context['uf']))
                / <span class="font-semibold">{{ $context['uf'] }}</span>
            @endif
            . Use essa lista como ponto de partida para prospecção B2B ou análise de mercado local.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            @foreach ($empresas as $semelhante)
                <a
                    href="{{ $semelhante['url'] ?? '#' }}"
                    class="group rounded-2xl border border-gray-200 bg-white px-4 py-3 hover:border-emerald-300 hover:bg-emerald-50/60 transition-all duration-150"
                >
                    <p class="font-semibold text-gray-900 text-sm truncate">
                        {{ $semelhante['razao_social'] ?? 'Razão social não informada' }}
                    </p>
                    @if(!empty($semelhante['cidade_uf']))
                        <p class="mt-1 text-xs text-gray-500">
                            {{ $semelhante['cidade_uf'] }}
                        </p>
                    @endif
                    <p class="mt-2 inline-flex items-center gap-1 text-[11px] text-emerald-700 group-hover:text-emerald-800">
                        <i class="bi bi-arrow-right-short text-lg"></i>
                        Ver detalhes do CNPJ semelhante
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endif
