@props([
    'uf',
    'municipios',
    'preposicao',
    'nomeEstado',
])

<section class="bg-white py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
            <div class="max-w-xl">
                <p class="text-amber-500 font-semibold uppercase text-xs md:text-sm tracking-[0.24em]">
                    Todos os municípios do estado
                </p>
                <h2 class="mt-2 text-2xl md:text-3xl font-black text-[#111827] leading-tight">
                    Empresas ativas por município no estado {{ strtolower($preposicao) }} {{ $nomeEstado }}
                </h2>
                <p class="mt-3 text-sm md:text-base text-gray-600">
                    Ranking enxuto com todos os municípios do estado, ordenados pelo total de empresas ativas.
                    Clique para abrir o diretório específico de cada cidade.
                </p>
            </div>

            <div class="text-xs md:text-sm text-gray-500 max-w-sm">
                <p class="font-medium text-gray-700 mb-1">Dica prática:</p>
                <p>• Clique em um município para abrir o diretório completo de empresas daquela cidade.</p>
                <p>• Use a paginação para navegar por todos os municípios do estado.</p>
            </div>
        </div>

        <div class="rounded-3xl border border-gray-200 bg-white/90 p-4 md:p-6 shadow-[0_18px_45px_-28px_rgba(15,23,42,0.55)]">
            {{-- Grid responsivo de cards de municípios --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 md:gap-4">
                @foreach ($municipios as $municipio)
                    <a
                        href="{{ route('empresas.city', [$municipio->uf, $municipio->municipio_slug]) }}"
                        class="group rounded-xl border border-gray-200 bg-white px-3.5 py-3 md:px-4 md:py-3.5 hover:border-amber-400 hover:shadow-[0_14px_38px_-28px_rgba(15,23,42,0.8)] transition-all"
                    >
                        <div class="flex items-start justify-between gap-2">
                            <p class="text-sm font-semibold text-[#111827] truncate pr-2">
                                {{ $municipio->nome }}
                            </p>
                            <span class="text-[11px] text-gray-400">{{ strtoupper($municipio->uf) }}</span>
                        </div>
                        <div class="mt-2 flex items-center justify-between">
                            <p class="text-[11px] uppercase tracking-[0.18em] text-gray-500">Empresas ativas</p>
                            <i class="bi bi-arrow-right-short text-xl text-gray-400 group-hover:text-amber-500"></i>
                        </div>
                        <p class="mt-1 text-lg font-extrabold text-[#111827]">
                            {{ number_format($municipio->total_empresas, 0, ',', '.') }}
                        </p>
                    </a>
                @endforeach
            </div>

            {{-- Paginação --}}
            <div class="mt-6">
                {{ $municipios->withQueryString()->links() }}
            </div>
        </div>
    </div>
</section>
