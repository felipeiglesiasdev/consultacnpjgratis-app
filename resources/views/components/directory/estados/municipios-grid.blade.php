@props([
    'uf',
    'municipios',
    'preposicao',
    'nomeEstado',
])

<section id="municipios" class="bg-white py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">
            <div class="max-w-2xl">
                <p class="text-amber-600 font-bold uppercase text-xs tracking-[0.2em]">
                    Lista Oficial
                </p>
                <h2 class="mt-2 text-3xl md:text-4xl font-black text-gray-900 tracking-tight">
                    Municípios de {{ $nomeEstado }}
                </h2>
                <p class="mt-4 text-base text-gray-600">
                    Ranking completo com todos os municípios do estado, ordenados pelo volume de empresas ativas. Clique na cidade desejada para pesquisar CNPJs específicos da região.
                </p>
            </div>
            
            <div class="hidden md:block">
                <p class="text-xs text-gray-500 bg-gray-50 px-4 py-2 rounded-lg border border-gray-200">
                    <i class="bi bi-info-circle text-amber-500 mr-1"></i>
                    Selecione uma cidade
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($municipios as $municipio)
                <a 
                    href="{{ route('empresas.city', ['uf' => strtolower($municipio->uf), 'municipio' => $municipio->municipio_slug]) }}"
                    class="group relative flex flex-col justify-between p-5 rounded-2xl border border-gray-200 bg-white hover:border-amber-400 hover:shadow-lg transition-all duration-300 overflow-hidden"
                >
                    {{-- Decoração sutil de fundo --}}
                    <div class="absolute -right-4 -top-4 opacity-0 group-hover:opacity-5 transition-opacity duration-300 text-amber-500">
                        <i class="bi bi-buildings-fill text-6xl"></i>
                    </div>

                    <div class="relative">
                        <div class="flex items-start justify-between gap-2 mb-4">
                            <p class="text-sm font-bold text-gray-900 truncate pr-2 group-hover:text-amber-600 transition-colors">
                                {{ Str::title($municipio->nome) }}
                            </p>
                            <span class="text-[10px] font-bold bg-gray-100 text-gray-500 px-2 py-0.5 rounded">
                                {{ strtoupper($municipio->uf) }}
                            </span>
                        </div>
                        
                        <div>
                            <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-1">
                                Volume Comercial
                            </p>
                            <div class="flex items-end justify-between">
                                <p class="text-2xl font-black text-gray-900">
                                    {{ number_format($municipio->total_empresas, 0, ',', '.') }}
                                </p>
                                <i class="bi bi-arrow-right-circle-fill text-xl text-gray-300 group-hover:text-amber-400 transition-colors"></i>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Controles de Paginação com estilo nativo do Laravel / Tailwind --}}
        <div class="mt-12">
            {{ $municipios->links() }}
        </div>

    </div>
</section>