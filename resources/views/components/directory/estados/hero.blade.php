@props(['uf', 'totalAtivas', 'preposicao'])

@php
    $nomesEstados = [
        'AC' => 'Acre', 'AL' => 'Alagoas', 'AM' => 'Amazonas', 'AP' => 'Amapá',
        'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo',
        'GO' => 'Goiás', 'MA' => 'Maranhão', 'MG' => 'Minas Gerais', 'MS' => 'Mato Grosso do Sul',
        'MT' => 'Mato Grosso', 'PA' => 'Pará', 'PB' => 'Paraíba', 'PE' => 'Pernambuco',
        'PI' => 'Piauí', 'PR' => 'Paraná', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
        'RO' => 'Rondônia', 'RR' => 'Roraima', 'RS' => 'Rio Grande do Sul', 'SC' => 'Santa Catarina',
        'SE' => 'Sergipe', 'SP' => 'São Paulo', 'TO' => 'Tocantins',
    ];

    $nomeEstado = $nomesEstados[$uf] ?? $uf;
@endphp

<section class="relative overflow-hidden bg-gradient-to-b from-[#050509] via-[#050608] to-black text-white">
    {{-- Glows de fundo --}}
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
                    Painel empresarial {{ $preposicao }} {{ $nomeEstado }} ({{ $uf }})
                </p>

                <div>
                    <h1 class="text-3xl md:text-4xl xl:text-5xl font-black tracking-tight leading-tight">
                        Empresas {{ $preposicao }}
                        <span class="text-amber-400">{{ $nomeEstado }}</span>
                    </h1>
                    <p class="mt-3 text-sm md:text-base text-gray-200 max-w-lg">
                        Veja quantas empresas estão ativas no estado, como se dividem entre matrizes
                        e filiais, quais cidades concentram mais CNPJs e quais atividades econômicas
                        lideram a região.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">Empresas ativas</p>
                        <p class="mt-1 text-2xl md:text-3xl font-extrabold">
                            {{ number_format($totalAtivas, 0, ',', '.') }}
                        </p>
                        <p class="mt-1 text-[11px] text-gray-300">
                            CNPJs em situação ativa na Receita Federal em {{ $nomeEstado }}.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">Como navegar</p>
                        <p class="mt-1 text-sm text-gray-200">
                            Desça a página para ver o balanço de matrizes/filiais, cidades em destaque
                            e as atividades (CNAEs) mais comuns no estado.
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3 pt-4 border-t border-white/5 text-[11px] md:text-xs text-gray-300">
                    <a href="{{ route('empresas.index') }}"
                       class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/5 border border-white/10 hover:border-amber-400/70 hover:text-amber-200 transition">
                        <i class="bi bi-arrow-left"></i>
                        Voltar para o portal de empresas
                    </a>
                    <span class="inline-flex items-center gap-1 text-gray-400">
                        <i class="bi bi-info-circle"></i>
                        No fim da página você pode consultar um CNPJ específico.
                    </span>
                </div>
            </div>

            {{-- Cartão visual do estado --}}
            <div class="lg:w-[420px] xl:w-[460px]">
                <div class="relative rounded-3xl border border-white/10 bg-white/[0.03] p-6 md:p-7 shadow-[0_22px_70px_rgba(0,0,0,0.85)] backdrop-blur">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.22em] text-gray-400">Visão geral do estado</p>
                            <p class="mt-1 text-sm font-semibold text-white">Empresas em {{ $nomeEstado }}</p>
                        </div>
                        <span class="inline-flex items-center justify-center h-10 w-10 rounded-2xl bg-amber-500/15 border border-amber-400/40 text-lg font-black text-amber-200">
                            {{ $uf }}
                        </span>
                    </div>

                    <div class="mt-5 space-y-3 text-xs">
                        <div class="rounded-2xl border border-white/10 bg-black/40 px-4 py-3">
                            <p class="text-[11px] uppercase tracking-[0.16em] text-gray-400">Navegação</p>
                            <p class="mt-1 text-gray-100">
                                Use os blocos abaixo para ver o balanço do estado, as principais cidades
                                e as atividades econômicas mais relevantes.
                            </p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-black/40 px-4 py-3">
                            <p class="text-[11px] uppercase tracking-[0.16em] text-gray-400">Aplicação prática</p>
                            <p class="mt-1 text-gray-100">
                                Ideal para prospecção B2B regional, estudos de mercado e análise de potencial
                                de clientes em {{ $nomeEstado }}.
                            </p>
                        </div>
                    </div>

                    <p class="mt-5 text-[11px] text-gray-400">
                        Dados públicos do cadastro nacional de CNPJs, com foco nas empresas ativas do estado.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
