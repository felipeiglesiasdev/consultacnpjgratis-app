@props(['topEstadosAtivos', 'topCidadesAtivas'])

<section class="mt-14 grid grid-cols-1 xl:grid-cols-2 gap-8">
    <div class="rounded-2xl border border-amber-100 bg-white p-6 shadow-lg" id="estados">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-sm font-semibold text-amber-700">Estados líderes</p>
                <h3 class="text-2xl font-black text-[#171717]">Onde a atividade empresarial é mais intensa</h3>
            </div>
            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-100">Top 6</span>
        </div>
        <div class="space-y-3">
            @foreach($topEstadosAtivos as $estado)
                <div class="flex items-center justify-between rounded-xl border border-gray-100 px-4 py-3 hover:border-amber-200 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-full bg-amber-100 text-amber-800 font-bold flex items-center justify-center">{{ $estado->uf }}</div>
                        <div>
                            <p class="text-base font-semibold text-[#171717]">{{ $estado->uf }}</p>
                            <p class="text-xs text-gray-500">empresas ativas registradas</p>
                        </div>
                    </div>
                    <span class="text-lg font-bold text-[#171717]">{{ number_format($estado->total, 0, ',', '.') }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-sm font-semibold text-[#171717]">Cidades em alta</p>
                <h3 class="text-2xl font-black text-[#171717]">Principais polos de negócios</h3>
            </div>
            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-[#171717] border border-gray-200">Top 6</span>
        </div>
        <div class="space-y-3">
            @foreach($topCidadesAtivas as $cidade)
                <div class="flex items-center justify-between rounded-xl border border-gray-100 px-4 py-3 hover:border-amber-200 transition-colors">
                    <div>
                        <p class="text-base font-semibold text-[#171717]">{{ $cidade['nome'] }}</p>
                        <p class="text-xs text-gray-500">{{ $cidade['uf'] ?? 'UF não informada' }}</p>
                    </div>
                    <span class="text-lg font-bold text-[#171717]">{{ number_format($cidade['total'], 0, ',', '.') }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>
