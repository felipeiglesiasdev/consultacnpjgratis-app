@props(['data'])

@php
    $statusClasses = [
        'green'  => 'bg-emerald-50 text-emerald-800 border-emerald-200',
        'red'    => 'bg-red-50 text-red-800 border-red-200',
        'yellow' => 'bg-amber-50 text-amber-800 border-amber-200',
        'gray'   => 'bg-gray-50 text-gray-800 border-gray-200',
    ];

    $chipClasses = [
        'green'  => 'bg-emerald-500 text-white',
        'red'    => 'bg-red-500 text-white',
        'yellow' => 'bg-amber-500 text-white',
        'gray'   => 'bg-gray-500 text-white',
    ];

    $classe      = $data['situacao_cadastral_classe'] ?? 'gray';
    $cardClass   = $statusClasses[$classe] ?? $statusClasses['gray'];
    $badgeClass  = $chipClasses[$classe] ?? $chipClasses['gray'];
    $situacao    = $data['situacao_cadastral'] ?? 'Não informada';
    $dataSit     = $data['data_situacao_cadastral'] ?? 'Não informada';
@endphp

<div class="rounded-3xl border border-gray-200 bg-white shadow-sm overflow-hidden">
    <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-5 flex items-center gap-3">
        <div class="h-8 w-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
            <i class="bi bi-card-heading text-lg"></i>
        </div>
        <h2 class="text-base font-bold text-gray-900 uppercase tracking-wide">Ficha Cadastral</h2>
    </div>

    <div class="p-6">
        
        {{-- Bloco Integrado: Situação Cadastral --}}
        <div class="mb-8 rounded-2xl border {{ $cardClass }} p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-[11px] uppercase tracking-widest text-gray-500 font-bold mb-2">Situação na Receita Federal</p>
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded-lg text-xs font-bold {{ $badgeClass }} uppercase tracking-wider shadow-sm">
                        {{ $situacao }}
                    </span>
                </div>
            </div>
            <div class="sm:text-right">
                <p class="text-[11px] uppercase tracking-widest text-gray-500 font-bold mb-1">Data da Situação</p>
                <p class="text-sm font-semibold text-gray-800 flex items-center sm:justify-end gap-1.5">
                    <i class="bi bi-calendar-check text-gray-400"></i> {{ $dataSit }}
                </p>
            </div>
        </div>

        {{-- Grid de Informações Básicas --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            
            <div class="space-y-1">
                <p class="text-[11px] uppercase tracking-[0.15em] text-gray-400 font-semibold flex items-center gap-1.5">
                    <i class="bi bi-wallet2 text-gray-300"></i> Capital Social
                </p>
                <p class="text-sm font-bold text-gray-900 bg-gray-50 px-3 py-1.5 rounded-lg inline-block border border-gray-100">
                    R$ {{ $data['capital_social'] }}
                </p>
            </div>

            <div class="space-y-1">
                <p class="text-[11px] uppercase tracking-[0.15em] text-gray-400 font-semibold flex items-center gap-1.5">
                    <i class="bi bi-building text-gray-300"></i> Porte da Empresa
                </p>
                <p class="text-sm font-bold text-gray-900">
                    {{ $data['porte'] }}
                </p>
            </div>

            <div class="space-y-1">
                <p class="text-[11px] uppercase tracking-[0.15em] text-gray-400 font-semibold flex items-center gap-1.5">
                    <i class="bi bi-briefcase text-gray-300"></i> Natureza Jurídica
                </p>
                <p class="text-sm font-bold text-gray-900">
                    {{ $data['natureza_juridica'] }}
                </p>
            </div>

            <div class="space-y-2 sm:col-span-2 md:col-span-3 border-t border-gray-100 pt-5 mt-2">
                <p class="text-[11px] uppercase tracking-[0.15em] text-gray-400 font-semibold flex items-center gap-1.5">
                    <i class="bi bi-bookmark-check text-gray-300"></i> Razão Social Oficial
                </p>
                <p class="text-base font-bold text-gray-800 break-words">
                    {{ $data['razao_social'] }}
                </p>
            </div>

        </div>
    </div>
</div>