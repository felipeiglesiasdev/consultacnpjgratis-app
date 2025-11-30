@props(['topCnaes'])

<div class="bg-white rounded-3xl shadow-xl border border-gray-200 p-6 md:p-8">
    <div class="flex items-center justify-between gap-3 mb-6">
        <div>
            <p class="text-sm font-semibold text-amber-600 uppercase tracking-wider">Atividades em destaque</p>
            <h2 class="text-2xl font-bold text-gray-900">Top 5 CNAEs desta cidade</h2>
            <p class="text-gray-600">As atividades com mais empresas ativas no município.</p>
        </div>
        <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-amber-100 text-amber-700 font-black">5</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($topCnaes as $cnae)
            <a href="{{ route('empresas.cnae.show', ['codigo_cnae' => $cnae->codigo]) }}"
               class="group block border border-gray-200 rounded-2xl p-5 bg-white shadow-sm hover:-translate-y-1 hover:shadow-lg transition-all duration-200">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold tracking-[0.18em] text-amber-600 uppercase">CNAE {{ $cnae->codigo_formatado }}</span>
                    <span class="px-2 py-1 text-xs rounded-full bg-emerald-100 text-emerald-700 font-semibold">{{ number_format($cnae->estabelecimentos_count, 0, ',', '.') }} ativas</span>
                </div>
                <h3 class="mt-3 text-base font-bold text-gray-900 group-hover:text-amber-600 leading-tight">{{ $cnae->descricao }}</h3>
            </a>
        @empty
            <p class="text-gray-600">Sem dados suficientes para listar CNAEs aqui.</p>
        @endforelse
    </div>
</div>
