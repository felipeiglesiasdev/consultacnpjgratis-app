@props([
    'uf',
    'top10Cidades',
    'preposicao',
    'nomeEstado',
])

<section class="bg-gray-50 py-20 relative border-t border-gray-200">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        
        <div class="max-w-3xl mb-12">
            <p class="text-amber-600 font-bold uppercase text-xs tracking-[0.2em]">
                Cidades em Destaque
            </p>
            <h2 class="mt-2 text-3xl md:text-4xl font-black text-gray-900 tracking-tight">
                Top 10 polos de {{ $nomeEstado }}
            </h2>
            <p class="mt-4 text-base text-gray-600">
                Os municípios que mais movimentam a economia local. Utilize esta lista como um excelente ponto de partida para montar suas campanhas de marketing ou prospecção regional.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
            @foreach ($top10Cidades as $index => $cidade)
                <a
                    href="{{ route('empresas.city', ['uf' => strtolower($cidade->uf), 'municipio' => $cidade->municipio_slug]) }}"
                    class="group flex flex-col justify-between rounded-2xl bg-white border border-gray-200 p-5 hover:border-amber-400 hover:shadow-md transition-all duration-200"
                >
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-100 text-amber-700 text-xs font-black">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-gray-900 truncate">
                                {{ Str::title($cidade->nome) }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-100 pt-3">
                        <p class="text-[11px] text-gray-500 font-medium">
                            {{ number_format($cidade->total, 0, ',', '.') }} empresas ativas
                        </p>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</section>