@props(['totalEmpresasAtivas'])

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
                    Portal de empresas por estado
                </p>

                <div>
                    <h1 class="text-3xl md:text-4xl xl:text-5xl font-black tracking-tight leading-tight">
                        Explore empresas em todos os
                        <span class="text-amber-400">estados brasileiros</span>.
                    </h1>
                    <p class="mt-3 text-sm md:text-base text-gray-200 max-w-lg">
                        Navegue pelo mapa empresarial do Brasil: veja quantos municípios possuem CNPJs,
                        quais estados concentram mais empresas e quais atividades econômicas dominam
                        cada região.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">Empresas ativas</p>
                        <p class="mt-1 text-2xl md:text-3xl font-extrabold">
                            {{ number_format($totalEmpresasAtivas, 0, ',', '.') }}
                        </p>
                        <p class="mt-1 text-[11px] text-gray-300">
                            CNPJs em situação ativa na Receita Federal.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">Como navegar</p>
                        <p class="mt-1 text-sm text-gray-200">
                            Desça a página para ver a grade com todos os estados e clique em uma UF
                            para abrir o painel detalhado.
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3 pt-4 border-t border-white/5 text-[11px] md:text-xs text-gray-300">
                    <a href="#estados"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-400 text-[#171717] font-semibold shadow-lg shadow-amber-500/30 hover:bg-amber-300 hover:-translate-y-0.5 transition">
                        <i class="bi bi-geo-alt"></i>
                        Ver todos os estados
                    </a>
                    <a href="{{ route('empresas.cnae.index') }}"
                       class="inline-flex items-center gap-2 px-3 py-2 rounded-full bg-white/5 border border-white/10 hover:border-amber-400/70 hover:text-amber-200 transition">
                        <i class="bi bi-diagram-3"></i>
                        Explorar por atividade (CNAE)
                    </a>
                    <span class="inline-flex items-center gap-1 text-gray-400">
                        <i class="bi bi-info-circle"></i>
                        No final da página você pode consultar um CNPJ específico.
                    </span>
                </div>
            </div>

            {{-- Cartão visual de "mapa" / resumo --}}
            <div class="lg:w-[420px] xl:w-[460px]">
                <div class="relative rounded-3xl border border-white/10 bg-white/[0.03] p-6 md:p-7 shadow-[0_22px_70px_rgba(0,0,0,0.85)] backdrop-blur">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.22em] text-gray-400">Mapa empresarial</p>
                            <p class="mt-1 text-sm font-semibold text-white">Navegue por UF e município</p>
                        </div>
                        <span class="inline-flex items-center gap-2 rounded-full bg-amber-500/10 px-3 py-1 text-[11px] font-medium text-amber-200 border border-amber-400/30">
                            <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>
                            27 unidades federativas
                        </span>
                    </div>

                    <div class="mt-5 grid grid-cols-3 gap-3 text-xs">
                        <div class="rounded-2xl border border-white/10 bg-black/40 px-3 py-3">
                            <p class="text-[11px] uppercase tracking-[0.16em] text-gray-400">Por estado</p>
                            <p class="mt-1 text-gray-100">
                                Clique em uma UF para ver cidades em destaque e atividades líderes.
                            </p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-black/40 px-3 py-3">
                            <p class="text-[11px] uppercase tracking-[0.16em] text-gray-400">Por cidade</p>
                            <p class="mt-1 text-gray-100">
                                Acompanhe quantas empresas existem em cada município.
                            </p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-black/40 px-3 py-3">
                            <p class="text-[11px] uppercase tracking-[0.16em] text-gray-400">Por atividade</p>
                            <p class="mt-1 text-gray-100">
                                Veja quais CNAEs dominam cada região do país.
                            </p>
                        </div>
                    </div>

                    <p class="mt-5 text-[11px] text-gray-400">
                        Dados públicos oficiais de CNPJs, ideal para inteligência de mercado e prospecção B2B.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
