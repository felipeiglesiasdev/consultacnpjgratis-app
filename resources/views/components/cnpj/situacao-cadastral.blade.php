@props(['data'])

@php
    $classe = $data['situacao_cadastral_classe'] ?? 'gray';
    
    // Paleta de cores dinâmica baseada no status
    $temas = [
        'green'  => ['bg' => 'bg-emerald-50', 'border' => 'border-emerald-200', 'text' => 'text-emerald-800', 'icon' => 'text-emerald-500', 'icone' => 'bi-check-circle-fill', 'pulse' => 'bg-emerald-500'],
        'red'    => ['bg' => 'bg-red-50', 'border' => 'border-red-200', 'text' => 'text-red-800', 'icon' => 'text-red-500', 'icone' => 'bi-x-circle-fill', 'pulse' => 'bg-red-500'],
        'yellow' => ['bg' => 'bg-amber-50', 'border' => 'border-amber-200', 'text' => 'text-amber-800', 'icon' => 'text-amber-500', 'icone' => 'bi-exclamation-circle-fill', 'pulse' => 'bg-amber-500'],
        'gray'   => ['bg' => 'bg-gray-50', 'border' => 'border-gray-200', 'text' => 'text-gray-800', 'icon' => 'text-gray-500', 'icone' => 'bi-info-circle-fill', 'pulse' => 'bg-gray-500'],
    ];

    $tema = $temas[$classe] ?? $temas['gray'];
@endphp

<div class="rounded-3xl border {{ $tema['border'] }} {{ $tema['bg'] }} p-6 shadow-sm relative overflow-hidden">
    {{-- Detalhe visual de fundo --}}
    <i class="bi {{ $tema['icone'] }} absolute -bottom-6 -right-6 text-[120px] opacity-[0.03]"></i>

    <div class="relative z-10">
        <p class="text-[11px] uppercase tracking-[0.2em] font-bold text-gray-500 mb-4">
            Status na Receita Federal
        </p>
        
        <div class="flex items-center gap-3 mb-6">
            <span class="relative flex h-4 w-4">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $tema['pulse'] }} opacity-75"></span>
                <span class="relative inline-flex rounded-full h-4 w-4 {{ $tema['pulse'] }}"></span>
            </span>
            <p class="text-2xl font-black uppercase {{ $tema['text'] }}">
                {{ $data['situacao_cadastral'] }}
            </p>
        </div>

        <div class="border-t {{ $tema['border'] }} pt-4 opacity-80">
            <p class="text-[11px] uppercase tracking-wider font-bold text-gray-500 mb-1">Data da Situação</p>
            <p class="text-sm font-semibold {{ $tema['text'] }}">{{ $data['data_situacao_cadastral'] }}</p>
        </div>
    </div>
</div>