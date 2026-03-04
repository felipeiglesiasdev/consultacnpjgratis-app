@props(['data'])

@php
    $empresas = $data['empresas_semelhantes'] ?? [];
    $context  = $data['similar_context'] ?? [];
@endphp

<div id="empresas-semelhantes" class="rounded-3xl border border-gray-200 bg-white shadow-sm overflow-hidden">
    <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-5 flex items-center gap-3">
        <div class="h-8 w-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
            <i class="bi bi-buildings-fill text-lg"></i>
        </div>
        <h2 class="text-base font-bold text-gray-900 uppercase tracking-wide">Empresas Semelhantes</h2>
    </div>

    <div class="p-6 space-y-5">
        <p class="text-sm text-gray-600 leading-relaxed">
            Listando empresas com perfil similar que atuam na atividade de 
            @if(!empty($context['cnae_descricao']))
                <strong class="text-gray-900">{{ $context['cnae_descricao'] }}</strong>
            @endif
            na região de 
                <strong class="text-gray-900">{{ $data['cidade'] }}</strong>
            . Excelente para estudos de concorrentes locais.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            @foreach ($empresas as $semelhante)
                <a
                    href="{{ $semelhante['url'] ?? '#' }}"
                    class="group flex flex-col justify-between rounded-2xl border border-gray-200 bg-white p-4 hover:border-amber-400 hover:shadow-md transition-all duration-200"
                >
                    <p class="font-bold text-gray-900 text-sm truncate mb-1 group-hover:text-amber-600 transition-colors">
                        {{ mb_strtoupper($semelhante['razao_social'] ?? 'Não informada', 'UTF-8') }}
                    </p>
                    
                    @if(!empty($semelhante['cidade_uf']))
                        <p class="text-xs text-gray-500 font-medium flex items-center gap-1.5 mb-3">
                            <i class="bi bi-geo-alt"></i> {{ mb_strtoupper($semelhante['cidade_uf'], 'UTF-8') }}
                        </p>
                    @endif
                    
                    <p class="inline-flex items-center gap-1.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider group-hover:text-amber-500 transition-colors mt-auto pt-3 border-t border-gray-100">
                        Ver detalhes <i class="bi bi-arrow-right"></i>
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</div>