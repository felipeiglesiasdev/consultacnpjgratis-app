@props(['topEstados'])

<div class="bg-white rounded-3xl shadow-xl p-6 border border-gray-200 sticky top-8">
    <h3 class="text-lg font-bold text-gray-900 mb-1">Análise do setor</h3>
    <p class="text-sm text-gray-600 mb-6">Top 5 estados com mais empresas ativas neste CNAE.</p>

    <div class="border-t border-gray-200 pt-6 space-y-3">
        @foreach($topEstados as $estado)
            <div class="flex items-center justify-between bg-amber-50 border border-amber-100 rounded-2xl px-4 py-3">
                <div class="flex items-center gap-3">
                    <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                    <span class="text-sm font-semibold text-gray-900">{{ $estado->uf }}</span>
                </div>
                <span class="text-sm font-bold text-gray-900">{{ number_format($estado->total, 0, ',', '.') }}</span>
            </div>
        @endforeach
    </div>
</div>