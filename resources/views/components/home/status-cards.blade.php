@props(['statusCounts'])

@php
    $statusMap = [
        '2' => ['nome' => 'Ativas', 'cor' => 'amber'],
        '8' => ['nome' => 'Baixadas', 'cor' => 'red'],
        '3' => ['nome' => 'Suspensas', 'cor' => 'yellow'],
        '4' => ['nome' => 'Inaptas', 'cor' => 'orange'],
        '1' => ['nome' => 'Nulas', 'cor' => 'gray'],
    ];
@endphp

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-6">
    @foreach ($statusMap as $code => $info)
        <div class="relative overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-[0_10px_45px_-24px_rgba(0,0,0,0.45)] transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">
            <div @class([
                'absolute inset-x-0 top-0 h-1',
                'bg-amber-400' => $info['cor'] === 'amber',
                'bg-red-500' => $info['cor'] === 'red',
                'bg-yellow-400' => $info['cor'] === 'yellow',
                'bg-orange-500' => $info['cor'] === 'orange',
                'bg-gray-400' => $info['cor'] === 'gray',
            ])></div>
            <div class="p-5 md:p-6 space-y-2">
                <p class="text-sm font-semibold text-gray-500">{{ $info['nome'] }}</p>
                <p @class([
                    'text-2xl md:text-4xl font-black tracking-tight',
                    'text-[#171717]' => $info['cor'] === 'amber',
                    'text-red-600' => $info['cor'] === 'red',
                    'text-yellow-600' => $info['cor'] === 'yellow',
                    'text-orange-600' => $info['cor'] === 'orange',
                    'text-gray-700' => $info['cor'] === 'gray',
                ])>
                    {{ number_format($statusCounts[$code] ?? 0, 0, ',', '.') }}
                </p>
                <div class="flex items-center gap-2 text-xs uppercase tracking-wide text-gray-400">
                    <span class="h-2 w-2 rounded-full bg-amber-400/70"></span>
                    Indicadores oficiais
                </div>
            </div>
        </div>
    @endforeach
</div>