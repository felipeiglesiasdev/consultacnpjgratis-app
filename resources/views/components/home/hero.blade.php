<section id="consultar" class="relative overflow-hidden bg-gradient-to-b from-[#050509] via-[#050608] to-black text-white">
    {{-- Glows de fundo --}}
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -left-40 -top-40 h-80 w-80 rounded-full bg-amber-500/10 blur-3xl"></div>
        <div class="absolute right-[-120px] top-1/3 h-96 w-96 rounded-full bg-amber-400/5 blur-3xl"></div>
        <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-black via-black/60 to-transparent"></div>
    </div>

    <div class="relative container mx-auto px-6 md:px-10 xl:px-16 py-16 md:py-24">
        <div class="grid gap-12 xl:gap-16 items-center lg:grid-cols-[minmax(0,1.25fr)_minmax(0,1fr)]">
            {{-- Texto + formulário --}}
            <div class="space-y-8">
                <p class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs md:text-sm font-medium text-amber-200 shadow-lg shadow-amber-500/15">
                    <span class="h-2 w-2 rounded-full bg-amber-400 animate-ping"></span>
                    Consulta CNPJ grátis com dados oficiais e atualizados
                </p>

                <h1 class="text-4xl md:text-5xl xl:text-6xl font-black tracking-tight leading-tight">
                    Descubra qualquer empresa brasileira em
                    <span class="text-amber-400">segundos</span>.
                </h1>

                <p class="text-base md:text-lg text-gray-200 max-w-2xl">
                    Consulte CNPJs sem limites, visualize quadro societário, endereço, CNAEs
                    e acompanhe a evolução do mercado com uma interface rápida e agradável.
                </p>

                <form action="{{ route('cnpj.consultar') }}" method="POST" class="max-w-2xl">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-3 items-stretch">
                        <div class="relative flex-1">
                            <label for="cnpj" class="sr-only">CNPJ</label>
                            <input
                                id="cnpj"
                                name="cnpj"
                                type="text"
                                inputmode="numeric"
                                autocomplete="off"
                                placeholder="Digite o CNPJ ou o nome da empresa"
                                class="w-full rounded-2xl border border-white/15 bg-white/5 px-4 py-3.5 pr-10 text-sm md:text-base text-white placeholder:text-gray-400 shadow-[0_18px_50px_rgba(0,0,0,0.75)] focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-500/40"
                            >
                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-500">
                                <i class="bi bi-building"></i>
                            </span>
                        </div>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-2xl px-6 md:px-8 py-3.5 text-sm md:text-base font-semibold bg-amber-400 text-[#171717] hover:bg-amber-300 shadow-lg shadow-amber-500/30 transition-transform duration-200 hover:-translate-y-0.5"
                        >
                            <i class="bi bi-search mr-2"></i>
                            Consultar agora
                        </button>
                    </div>

                    <p class="mt-3 flex items-center gap-2 text-[11px] md:text-xs text-gray-400">
                        <i class="bi bi-shield-check text-amber-300"></i>
                        Consulta 100% gratuita • Dados oficiais da Receita Federal • Ambiente seguro
                    </p>
                </form>

                {{-- Mini benefícios abaixo do formulário --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-white/5">
                    <div class="p-4 rounded-xl bg-white/5 border border-white/10 backdrop-blur">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">Dados oficiais</p>
                        <p class="mt-1 text-sm font-semibold text-amber-300">Receita Federal atualizada</p>
                    </div>
                    <div class="p-4 rounded-xl bg-white/5 border border-white/10 backdrop-blur">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">Sem limite</p>
                        <p class="mt-1 text-sm font-semibold text-amber-300">Consultas ilimitadas e gratuitas</p>
                    </div>
                    <div class="p-4 rounded-xl bg-white/5 border border-white/10 backdrop-blur">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">Uso B2B</p>
                        <p class="mt-1 text-sm font-semibold text-amber-300">Base ideal para prospecção</p>
                    </div>
                </div>
            </div>

            {{-- Card visual / “preview” --}}
            <div class="lg:pl-4">
                <div class="relative rounded-3xl border border-white/10 bg-white/[0.03] p-6 md:p-7 shadow-[0_22px_70px_rgba(0,0,0,0.85)] backdrop-blur">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.22em] text-gray-400">Exemplo de retorno</p>
                            <p class="mt-1 text-sm font-semibold text-white">Consulta CNPJ em tempo real</p>
                        </div>
                        <span class="inline-flex items-center gap-2 rounded-full bg-emerald-500/10 px-3 py-1 text-[11px] font-medium text-emerald-300 border border-emerald-500/30">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                            Ativa na Receita
                        </span>
                    </div>

                    <div class="mt-5 space-y-4 text-sm">
                        <div class="rounded-2xl border border-white/10 bg-black/40 px-4 py-3 flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs text-gray-400">Razão social</p>
                                <p class="text-sm font-semibold">Empresa Exemplo de Tecnologia Ltda</p>
                                <p class="mt-1 text-[11px] text-gray-400">
                                    CNPJ <span class="font-mono">12.345.678/0001-90</span>
                                </p>
                            </div>
                            <span class="inline-flex h-8 items-center rounded-full bg-amber-500/10 px-3 text-[11px] font-medium text-amber-200 border border-amber-400/30">
                                <i class="bi bi-lightning-charge mr-1"></i>
                                Consulta instantânea
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                                <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">CNAE principal</p>
                                <p class="mt-1 text-xs font-semibold text-gray-100">62.01-5-01 • Desenvolvimento de sistemas</p>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                                <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">UF</p>
                                <p class="mt-1 text-xs font-semibold text-gray-100">São Paulo • SP</p>
                            </div>
                        </div>

                        <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 flex items-center justify-between gap-3">
                            <div>
                                <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">Prospecção B2B</p>
                                <p class="mt-1 text-xs text-gray-200">
                                    Liste empresas por segmento e região para seu time comercial vender mais.
                                </p>
                            </div>
                            <i class="bi bi-graph-up-arrow text-amber-300 text-xl"></i>
                        </div>
                    </div>

                    <div class="mt-5 flex items-center justify-between text-[11px] text-gray-400">
                        <p>Dados públicos, com base no cadastro nacional de CNPJs.</p>
                        <span class="inline-flex items-center gap-1">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                            Atualização periódica
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
