@props([
    'top10CidadesAtivas',
    'topCnaes',
])

<section class="bg-[#050509] text-white py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        {{-- Cabeçalho da seção --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
            <div class="max-w-xl">
                <p class="text-amber-400 font-semibold uppercase text-xs md:text-sm tracking-[0.24em]">
                    Onde estão as empresas
                </p>
                <h2 class="mt-2 text-2xl md:text-3xl font-black">
                    Cidades mais ativas e atividades em destaque
                </h2>
                <p class="mt-3 text-sm md:text-base text-gray-300">
                    Descubra os principais polos empresariais do país e os CNAEs com maior
                    concentração de empresas ativas. Use essas informações para montar listas
                    de prospecção B2B altamente segmentadas.
                </p>
            </div>

            <div class="inline-flex flex-wrap gap-2 text-[11px] md:text-xs text-gray-300">
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-white/5 border border-white/10">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                    Considera apenas empresas com situação ativa
                </span>
            </div>
        </div>

        {{-- Dois cards lado a lado, mesma estrutura --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
            {{-- CARD: Cidades com mais empresas --}}
            <div class="flex flex-col h-full rounded-3xl border border-white/10 bg-white/[0.03] p-6 md:p-7 shadow-[0_18px_60px_rgba(0,0,0,0.8)]">
                <div class="flex items-center justify-between gap-4 mb-5">
                    <div>
                        <p class="text-xs uppercase tracking-[0.22em] text-emerald-300">
                            Cidades com mais empresas ativas
                        </p>
                        <h3 class="mt-1 text-xl font-semibold text-white">
                            Principais municípios
                        </h3>
                    </div>
                </div>

                <div class="space-y-3">
                    @foreach ($top10CidadesAtivas->take(10) as $index => $cidade)
                        @php
                            $nomeCidade = $cidade->nome ?? 'Município não informado';
                            $ufCidade   = strtoupper($cidade->uf ?? '');
                            $slug       = $cidade->municipio_slug ?? \Illuminate\Support\Str::slug($nomeCidade);

                            $urlCidade  = route('empresas.city', [
                                'uf'        => strtolower($ufCidade),
                                'municipio' => $slug,
                            ]);
                        @endphp

                        <a
                            href="{{ $urlCidade }}"
                            class="group flex items-center gap-4 rounded-2xl border border-white/5 px-3.5 py-3 hover:border-amber-400/70 hover:bg-white/10 transition-all"
                        >
                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-500/15 text-emerald-200 text-xs font-semibold">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-white truncate">
                                    {{ $nomeCidade }} • {{ $ufCidade }}
                                </p>
                                <p class="text-[11px] text-gray-300">
                                    {{ number_format($cidade->total, 0, ',', '.') }} empresas ativas
                                </p>
                            </div>
                            <i class="bi bi-arrow-right-short text-xl text-gray-400 group-hover:text-amber-300"></i>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- CARD: CNAEs em destaque --}}
            <div class="flex flex-col h-full rounded-3xl border border-white/10 bg-white/[0.03] p-6 md:p-7 shadow-[0_18px_60px_rgba(0,0,0,0.8)]">
                <div class="flex items-center justify-between gap-4 mb-5">
                    <div>
                        <p class="text-xs uppercase tracking-[0.22em] text-amber-300">
                            CNAEs com mais empresas
                        </p>
                        <h3 class="mt-1 text-xl font-semibold text-white">
                            Atividades em destaque
                        </h3>
                    </div>
                </div>

                <div class="space-y-3">
                    @foreach ($topCnaes as $index => $cnae)
                        @php
                            $codigoFormatado = $cnae->CodigoFormatado ?? $cnae->codigo ?? null;
                            $totalAtivos     = $cnae->ativos_count ?? $cnae->estabelecimentos_count ?? 0;

                            $urlCnae = route('empresas.cnae.show', [
                                'codigo_cnae' => $cnae->codigo,
                            ]);
                        @endphp

                        <a
                            href="{{ $urlCnae }}"
                            class="group flex items-start gap-4 rounded-2xl border border-white/5 px-3.5 py-3 hover:border-amber-400/70 hover:bg-white/10 transition-all"
                        >
                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-amber-500/15 text-amber-200 text-xs font-semibold">
                                {{ $index + 1 }}
                            </div>

                            <div class="flex-1 min-w-0 space-y-1">
                                @if($codigoFormatado)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-amber-500/10 border border-amber-300 px-2.5 py-0.5 text-[11px] font-mono text-amber-200">
                                        CNAE {{ $codigoFormatado }}
                                    </span>
                                @endif

                                <p class="text-sm font-semibold text-white line-clamp-2">
                                    {{ $cnae->descricao }}
                                </p>

                                <p class="text-[11px] text-emerald-200">
                                    {{ number_format($totalAtivos, 0, ',', '.') }} empresas ativas
                                </p>
                            </div>

                            <i class="bi bi-arrow-right-short text-xl text-gray-400 group-hover:text-amber-300"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <p class="mt-5 text-[11px] text-gray-400">
            Combine cidades e CNAEs para criar listas altamente qualificadas de empresas
            e turbinar a prospecção da sua equipe comercial.
        </p>
    </div>
</section>
