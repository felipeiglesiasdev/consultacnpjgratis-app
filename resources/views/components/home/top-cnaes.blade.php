@props(['topCnaes'])

<div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 border border-gray-200">
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm uppercase tracking-wide text-amber-500 font-semibold">Ranking nacional</p>
            <h3 class="text-2xl font-bold text-gray-900">Top 5 CNAEs com mais empresas ativas</h3>
        </div>
        <div class="hidden md:flex items-center gap-2 px-3 py-2 rounded-full bg-amber-100 text-amber-700 text-xs font-semibold">
            <span class="h-2 w-2 rounded-full bg-amber-500"></span> Atualizado automaticamente
        </div>
    </div>
    <div class="space-y-4">
        @foreach ($topCnaes as $cnae)
            <a href="{{ route('empresas.cnae.show', ['codigo_cnae' => $cnae->codigo]) }}" class="block p-4 border border-gray-200 rounded-xl hover:border-amber-300 hover:-translate-y-1 hover:shadow-lg transition-all duration-300 bg-gradient-to-r from-white to-amber-50/30">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="flex-1 pr-4">
                        <p class="text-base text-gray-900 font-semibold">{{ $cnae->descricao }}</p>
                        <span class="inline-flex items-center gap-2 text-sm font-semibold text-amber-600">CNAE {{ $cnae->codigo_formatado }}<span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span></span>
                    </div>
                    <div class="shrink-0 text-left sm:text-right">
                        <p class="text-2xl font-black text-[#171717]">{{ number_format($cnae->ativos_count, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-500 uppercase">empresas ativas</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>