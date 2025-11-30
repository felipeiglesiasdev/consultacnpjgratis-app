@props(['data'])

@php
    $statusClasses = [
        'green'  => 'bg-emerald-50 text-emerald-800 border-emerald-200',
        'red'    => 'bg-red-50 text-red-800 border-red-200',
        'yellow' => 'bg-amber-50 text-amber-800 border-amber-200',
        'gray'   => 'bg-gray-50 text-gray-800 border-gray-200',
    ];

    $chipClasses = [
        'green'  => 'bg-emerald-100 text-emerald-800',
        'red'    => 'bg-red-100 text-red-800',
        'yellow' => 'bg-amber-100 text-amber-800',
        'gray'   => 'bg-gray-100 text-gray-800',
    ];

    $classe      = $data['situacao_cadastral_classe'] ?? 'gray';
    $cardClass   = $statusClasses[$classe] ?? $statusClasses['gray'];
    $badgeClass  = $chipClasses[$classe] ?? $chipClasses['gray'];
    $situacao    = $data['situacao_cadastral'] ?? 'Não informada';
    $dataSit     = $data['data_situacao_cadastral'] ?? 'Não informada';
@endphp

<div id="situacao-cadastral" class="rounded-2xl border bg-white shadow-[0_18px_45px_-28px_rgba(15,23,42,0.55)]">
    <div class="flex items-center gap-3 px-4 py-3 border-b border-gray-100">
        <span class="inline-flex items-center justify-center h-9 w-9 rounded-2xl bg-gray-900/5 text-gray-700">
            <i class="bi bi-shield-check text-lg"></i>
        </span>
        <div>
            <h2 class="text-sm font-semibold text-gray-900">Situação cadastral</h2>
            <p class="text-[11px] text-gray-500">
                Status oficial deste CNPJ na Receita Federal
            </p>
        </div>
    </div>

    <div class="p-4 space-y-4">
        <div class="rounded-2xl border {{ $cardClass }} px-4 py-3">
            <span class="text-[11px] uppercase tracking-[0.18em] block mb-1">
                Situação atual
            </span>
            <span class="inline-flex items-center gap-2">
                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $badgeClass }}">
                    {{ $situacao }}
                </span>
            </span>
            <p class="mt-2 text-[11px] text-gray-700">
                A situação cadastral é um dos principais indicadores de risco em consultas de CNPJ.
            </p>
        </div>

        <div class="flex items-center justify-between text-xs text-gray-600">
            <div>
                <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">
                    Data da situação
                </p>
                <p class="mt-0.5 font-medium text-gray-800">
                    {{ $dataSit }}
                </p>
            </div>
        </div>

        <p class="text-[11px] text-gray-500 leading-relaxed">
            Utilize esta informação para evitar negócios com empresas baixadas, inaptas ou com
            pendências cadastrais, reduzindo riscos em contratos e operações comerciais.
        </p>
    </div>
</div>
