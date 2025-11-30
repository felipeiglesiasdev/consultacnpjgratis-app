@props(['topCnaes'])

<section class="bg-gradient-to-br from-[#050509] via-[#050608] to-black text-white py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        {{-- Título / intro --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
            <div class="max-w-xl">
                <p class="text-amber-400 font-semibold uppercase text-xs md:text-sm tracking-[0.24em]">
                    Ranking nacional
                </p>
                <h2 class="mt-2 text-2xl md:text-3xl font-black tracking-tight">
                    Top 6 atividades econômicas (CNAEs) com mais empresas ativas no Brasil
                </h2>
                <p class="mt-3 text-sm md:text-base text-gray-300">
                    Essas atividades concentram o maior número de CNPJs em funcionamento no país.
                    Use esse ranking para identificar setores com grande volume de oportunidades B2B.
                </p>
            </div>

            <div class="flex items-center gap-2 text-[11px] md:text-xs text-amber-200 bg-white/5 border border-amber-400/30 rounded-full px-4 py-1.5">
                <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Baseado em empresas ativas na Receita Federal</span>
            </div>
        </div>

        {{-- Grid de CNAEs --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 md:gap-5">
            @foreach ($topCnaes as $index => $cnae)
                @php
                    $totalAtivas = $cnae->ativos_count ?? $cnae->estabelecimentos_count ?? 0;
                @endphp

                <a
                    href="{{ route('empresas.cnae.show', ['codigo_cnae' => $cnae->codigo]) }}"
                    class="group relative rounded-2xl border border-white/10 bg-white/[0.03] p-4 md:p-5 shadow-[0_22px_70px_rgba(0,0,0,0.85)] hover:border-amber-400/70 hover:bg-white/[0.06] hover:-translate-y-0.5 transition-all duration-150"
                >
                    {{-- Badge de posição --}}
                    <div class="absolute -top-4 left-4 z-10 flex h-8 w-8 items-center justify-center rounded-2xl bg-amber-400 text-[11px] font-black text-[#171717] shadow-lg shadow-amber-400/30">
                        #{{ $index + 1 }}
                    </div>

                    <div class="mt-4 flex flex-col gap-3">
                        {{-- Cabeçalho do CNAE --}}
                        <div class="space-y-1">
                            {{-- ETIQUETA DO CÓDIGO CNAE (MAIOR) --}}
                            <span class="inline-flex items-center gap-2 text-[12px] md:text-sm font-mono text-amber-100 bg-amber-500/15 border border-amber-400/40 rounded-full px-3.5 py-1.5">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>
                                CNAE {{ $cnae->CodigoFormatado ?? $cnae->codigo }}
                            </span>

                            <p class="text-sm md:text-base font-semibold text-white line-clamp-2">
                                {{ $cnae->descricao }}
                            </p>
                        </div>

                        {{-- Métricas / CTA --}}
                        <div class="flex items-end justify-between gap-3">
                            <div class="space-y-1">
                                <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">
                                    Empresas ativas
                                </p>

                                {{-- NÚMERO MENOR EM ETIQUETA VERDE --}}
                                <span class="inline-flex items-center gap-2 rounded-full bg-emerald-500/10 border border-emerald-400/40 px-3 py-1 text-xs md:text-sm font-semibold text-emerald-200">
                                    {{ number_format($totalAtivas, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="flex flex-col items-end gap-1 text-[11px] text-gray-400">
                                <span>Ver empresas deste CNAE</span>
                                <i class="bi bi-arrow-right-short text-2xl text-gray-400 group-hover:text-amber-400"></i>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <p class="mt-6 text-[11px] md:text-xs text-gray-500 max-w-3xl">
            Os códigos e descrições seguem a Classificação Nacional de Atividades Econômicas (CNAE) oficial.
            Combine este ranking com os filtros por estado e município para montar listas extremamente
            segmentadas de empresas e levar sua prospecção B2B a outro nível.
        </p>
    </div>
</section>