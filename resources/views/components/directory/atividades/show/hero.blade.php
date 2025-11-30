@props([
    'cnae',
    'topEstados',
    'empresas',
])

@php
    $codigo = (string) $cnae->codigo;
    if (strlen($codigo) === 7) {
        $codigoFormatado = substr($codigo, 0, 2) . '.' .
                           substr($codigo, 2, 2) . '-' .
                           substr($codigo, 4, 1) . '-' .
                           substr($codigo, 5);
    } else {
        $codigoFormatado = $codigo;
    }

    $descricao = $cnae->descricao;
    $amostraEmpresas = $empresas->count();
@endphp

<section class="relative overflow-hidden bg-gradient-to-b from-[#050509] via-[#050608] to-black text-white">
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -left-32 -top-32 h-72 w-72 rounded-full bg-amber-500/10 blur-3xl"></div>
        <div class="absolute right-[-140px] top-1/3 h-96 w-96 rounded-full bg-amber-400/5 blur-3xl"></div>
        <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-black via-black/60 to-transparent"></div>
    </div>

    <div class="relative container mx-auto px-6 md:px-10 xl:px-16 py-16 md:py-20">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-10 xl:gap-14">
            <div class="max-w-xl space-y-7">
                <p class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs md:text-sm font-medium text-amber-200">
                    <span class="h-2 w-2 rounded-full bg-emerald-400 animate-ping"></span>
                    Detalhes da atividade econômica (CNAE)
                </p>

            <div>
                    <h1 class="text-3xl md:text-4xl xl:text-5xl font-black tracking-tight leading-tight">
                        CNAE <span class="text-amber-400">{{ $codigoFormatado }}</span>
                    </h1>
                    <p class="mt-3 text-sm md:text-base text-gray-200 max-w-lg">
                        {{ $descricao }}
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">
                            Amostra de empresas
                        </p>
                        <p class="mt-1 text-2xl md:text-3xl font-extrabold">
                            {{ number_format($amostraEmpresas, 0, ',', '.') }}
                        </p>
                        <p class="mt-1 text-[11px] text-gray-300">
                            Empresas ativas exibidas abaixo neste CNAE.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">
                            Foco geográfico
                        </p>
                        <p class="mt-1 text-sm text-gray-200">
                            Veja em quais estados essa atividade concentra mais empresas ativas.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">
                            Aplicação prática
                        </p>
                        <p class="mt-1 text-sm text-gray-200">
                            Use o CNAE para segmentar campanhas B2B, entender o setor e localizar potenciais clientes.
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3 pt-4 border-t border-white/5 text-[11px] md:text-xs text-gray-300">
                    <a href="{{ route('empresas.cnae') }}"
                       class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/5 border border-white/10 hover:border-amber-400/70 hover:text-amber-200 transition">
                        <i class="bi bi-arrow-left"></i>
                        Voltar para lista de atividades
                    </a>
                    <a href="{{ route('empresas.index') }}"
                       class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/5 border border-white/10 hover:border-amber-400/70 hover:text-amber-200 transition">
                        <i class="bi bi-grid"></i>
                        Ver portal de empresas
                    </a>
                </div>
            </div>

            {{-- Card visual com resumo rápido --}}
            <div class="lg:w-[420px] xl:w-[460px]">
                <div class="relative rounded-3xl border border-white/10 bg-white/[0.03] p-6 md:p-7 shadow-[0_22px_70px_rgba(0,0,0,0.85)] backdrop-blur">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.22em] text-gray-400">
                                CNAE principal
                            </p>
                            <p class="mt-1 text-sm font-semibold text-white">
                                {{ $descricao }}
                            </p>
                        </div>
                        <span class="inline-flex items-center justify-center h-10 px-3 rounded-2xl bg-amber-500/15 border border-amber-400/40 text-xs font-semibold text-amber-200 font-mono">
                            {{ $codigoFormatado }}
                        </span>
                    </div>

                    <div class="mt-5 space-y-3 text-xs">
                        <div class="rounded-2xl border border-white/10 bg-black/40 px-4 py-3">
                            <p class="text-[11px] uppercase tracking-[0.16em] text-gray-400">Visão geral</p>
                            <p class="mt-1 text-gray-100">
                                Esta página destaca onde a atividade é mais forte (por estados)
                                e traz uma amostra de empresas ativas que utilizam este CNAE como
                                atividade principal.
                            </p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-black/40 px-4 py-3">
                            <p class="text-[11px] uppercase tracking-[0.16em] text-gray-400">Como usar</p>
                            <p class="mt-1 text-gray-100">
                                Combine estas informações com filtros por estado e município
                                para planejar prospecção B2B, parcerias e estudos setoriais.
                            </p>
                        </div>
                    </div>

                    <p class="mt-5 text-[11px] text-gray-400">
                        Código e descrição seguindo a Classificação Nacional de Atividades Econômicas (CNAE) oficial.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
