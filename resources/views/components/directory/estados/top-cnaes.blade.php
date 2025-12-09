@props([
    'uf',
    'topCnaes',
    'preposicao',
    'nomeEstado',
])

<section class="bg-[#050509] text-white py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
            <div class="max-w-xl">
                <p class="text-amber-400 font-semibold uppercase text-xs md:text-sm tracking-[0.24em]">
                    Atividades em destaque no estado
                </p>
                <h2 class="mt-2 text-2xl md:text-3xl font-black leading-tight">
                    CNAEs com mais empresas ativas no estado {{ strtolower($preposicao) }} {{ $nomeEstado }}
                </h2>
                <p class="mt-3 text-sm md:text-base text-gray-300">
                    Veja quais atividades econômicas dominam o estado. Combine essas informações
                    com as cidades em destaque para montar listas de prospecção B2B altamente
                    segmentadas.
                </p>
            </div>

            <div class="inline-flex flex-wrap gap-2 text-[11px] md:text-xs text-gray-300">
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-white/5 border border-white/10">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                    Considera apenas empresas em situação ativa
                </span>
            </div>
        </div>

        <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-6 md:p-7 shadow-[0_18px_60px_rgba(0,0,0,0.8)]">
            <div class="space-y-3">
                @foreach ($topCnaes as $cnae)
                    <a
                        href="{{ route('empresas.cnae.show', $cnae->codigo) }}"
                        class="group flex items-center gap-4 rounded-2xl bg-white/5 border border-white/10 px-4 py-3 hover:border-amber-400/70 hover:bg-white/10 transition-all"
                    >
                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-amber-500/15 text-amber-200 text-[11px] font-semibold">
                            CNAE
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-white truncate">
                                {{ $cnae->descricao }}
                            </p>
                            <p class="mt-0.5 flex flex-wrap items-center gap-2 text-[11px] text-gray-300">
                                <span class="inline-flex items-center gap-1 rounded-full bg-white/5 px-2 py-0.5 border border-amber-400/40 font-mono">
                                    {{ $cnae->codigo_formatado }}
                                </span>
                                <span>
                                    {{ number_format($cnae->ativos_count, 0, ',', '.') }} empresas ativas em {{ $uf }}
                                </span>
                            </p>
                        </div>
                        <i class="bi bi-arrow-right-short text-xl text-gray-400 group-hover:text-amber-300"></i>
                    </a>
                @endforeach
            </div>

            <p class="mt-5 text-[11px] text-gray-400">
                Combine este ranking com as cidades em destaque para montar listas de potenciais clientes
                por região e segmento dentro do estado.
            </p>
        </div>
    </div>
</section>
