@props([
    'uf',
    'municipios',
])

<section class="bg-white py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
            <div class="max-w-xl">
                <p class="text-amber-500 font-semibold uppercase text-xs md:text-sm tracking-[0.24em]">
                    Todos os municípios do estado
                </p>
                <h2 class="mt-2 text-2xl md:text-3xl font-black text-[#111827]">
                    Empresas ativas por município em {{ $uf }}
                </h2>
                <p class="mt-3 text-sm md:text-base text-gray-600">
                    A lista abaixo mostra todos os municípios do estado com pelo menos uma empresa ativa,
                    ordenados da maior para a menor concentração de CNPJs. Use essa visão para planejar
                    ações comerciais, rotas de visita e campanhas regionais.
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
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
                @foreach ($municipios as $municipio)
                    <a
                        href=""
                        class="group flex flex-col justify-between rounded-2xl border border-gray-200 bg-gradient-to-br from-white to-gray-50 px-4 py-3.5 md:px-4 md:py-4 hover:border-amber-400 hover:from-amber-50/70 hover:to-white hover:-translate-y-0.5 transition-all duration-150 shadow-[0_12px_32px_-24px_rgba(15,23,42,0.7)]"
                    >
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-[#111827] truncate">
                                    {{ $municipio->nome }}
                                </p>
                                <p class="text-[11px] text-gray-500">
                                    {{ strtoupper($municipio->uf) }} • município
                                </p>
                            </div>
                            <div class="flex items-center gap-1 text-xs text-amber-600 bg-amber-50 border border-amber-100 rounded-full px-2 py-0.5">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>
                                Ver empresas
                            </div>
                        </div>

                        <div class="mt-3 flex items-end justify-between gap-3">
                            <div>
                                <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">
                                    Empresas ativas
                                </p>
                                <p class="mt-1 text-base md:text-lg font-extrabold text-[#111827]">
                                    {{ number_format($municipio->total_empresas, 0, ',', '.') }}
                                </p>
                            </div>
                            <i class="bi bi-arrow-right-short text-2xl text-gray-400 group-hover:text-amber-500"></i>
                        </div>
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
