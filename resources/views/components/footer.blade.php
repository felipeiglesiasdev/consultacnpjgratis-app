@props([])

<footer class="bg-[#050509] text-gray-300 border-t border-white/10">
    <div class="container mx-auto px-6 md:px-10 xl:px-16 pt-12 pb-8">
        {{-- TOPO DO FOOTER: TEXTO + CTA --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 pb-10 border-b border-white/10">
            <div class="max-w-xl space-y-2">
                <p class="text-[11px] md:text-xs uppercase tracking-[0.24em] text-amber-300 font-semibold">
                    CONSULTA CNPJ GRATUITA
                </p>
                <h2 class="text-xl md:text-2xl font-black text-white">
                    Dados oficiais da Receita Federal para potencializar sua prospecção B2B.
                </h2>
                <p class="text-xs md:text-sm text-gray-400">
                    Navegue por empresas, estados, cidades e atividades econômicas. Monte listas inteligentes
                    de clientes em potencial e valide informações cadastrais em segundos.
                </p>
            </div>

            <div class="w-full md:w-auto">
                <form
                    action="{{ url('/') }}" {{-- ajuste para sua rota de consulta de CNPJ --}}
                    method="GET"
                    class="flex flex-col sm:flex-row items-stretch gap-2 rounded-2xl border border-white/15 bg-white/5 px-3 py-2 text-xs text-white"
                >
                    <div class="flex items-center gap-2 flex-1">
                        <i class="bi bi-upc-scan text-xs text-gray-400"></i>
                        <input
                            type="text"
                            name="cnpj"
                            inputmode="numeric"
                            placeholder="Digite um CNPJ para consultar agora..."
                            class="w-full bg-transparent text-xs md:text-sm outline-none placeholder:text-gray-500"
                        >
                    </div>
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-amber-400 px-4 py-1.5 text-[11px] md:text-xs font-semibold text-black hover:bg-amber-300 transition"
                    >
                        Consultar gratuitamente
                    </button>
                </form>
            </div>
        </div>

        {{-- GRID DE LINKS INTERNOS --}}
        <div class="pt-8 pb-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-sm">
            {{-- COLUNA 1: CONSULTAS DE CNPJ --}}
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-[0.22em] text-gray-400 mb-3">
                    Consultas de CNPJ
                </h3>
                <ul class="space-y-2 text-xs md:text-sm">
                    <li>
                        <a href="{{ url('/') }}"
                           class="text-gray-300 hover:text-amber-300 transition">
                            Consulta CNPJ por número
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/busca-razao-social') }}"
                           class="text-gray-300 hover:text-amber-300 transition">
                            Buscar empresa por razão social
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('empresas.index') }}"
                           class="text-gray-300 hover:text-amber-300 transition">
                            Portal de empresas por UF e município
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('empresas.cnae') }}"
                           class="text-gray-300 hover:text-amber-300 transition">
                            Empresas por atividade econômica (CNAE)
                        </a>
                    </li>
                </ul>
            </div>

            {{-- COLUNA 2: EMPRESAS POR LOCALIZAÇÃO --}}
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-[0.22em] text-gray-400 mb-3">
                    Empresas por localização
                </h3>
                <ul class="space-y-2 text-xs md:text-sm">
                    <li>
                        <a href="{{ route('empresas.state', ['uf' => 'sp']) }}"
                           class="text-gray-300 hover:text-amber-300 transition">
                            Empresas em São Paulo (SP)
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('empresas.state', ['uf' => 'rj']) }}"
                           class="text-gray-300 hover:text-amber-300 transition">
                            Empresas no Rio de Janeiro (RJ)
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('empresas.state', ['uf' => 'mg']) }}"
                           class="text-gray-300 hover:text-amber-300 transition">
                            Empresas em Minas Gerais (MG)
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('empresas.index') }}#estados"
                           class="text-gray-300 hover:text-amber-300 transition">
                            Ver todos os estados
                        </a>
                    </li>
                </ul>
            </div>

            {{-- COLUNA 3: ATIVIDADES ECONÔMICAS --}}
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-[0.22em] text-gray-400 mb-3">
                    Atividades econômicas
                </h3>
                <ul class="space-y-2 text-xs md:text-sm">
                    <li>
                        <a href="{{ route('empresas.cnae') }}"
                           class="text-gray-300 hover:text-amber-300 transition">
                            Busca por CNAE
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('empresas.cnae.show', ['codigo_cnae' => '4711301']) }}"
                           class="text-gray-300 hover:text-amber-300 transition">
                            Comércio varejista (exemplo)
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('empresas.cnae.show', ['codigo_cnae' => '6201501']) }}"
                           class="text-gray-300 hover:text-amber-300 transition">
                            Empresas de tecnologia (exemplo)
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('empresas.cnae') }}#faq"
                           class="text-gray-300 hover:text-amber-300 transition">
                            Dúvidas sobre CNAE
                        </a>
                    </li>
                </ul>
            </div>

            {{-- COLUNA 4: INSTITUCIONAL / AJUDA --}}
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-[0.22em] text-gray-400 mb-3">
                    Institucional & Ajuda
                </h3>
                <ul class="space-y-2 text-xs md:text-sm">
                    <li>
                        <a href="{{ url('/politica-de-privacidade') }}"
                           class="text-gray-300 hover:text-amber-300 transition">
                            Política de privacidade
                        </a>
                    </li>

                </ul>
            </div>
        </div>

        {{-- RODAPÉ INFERIOR --}}
        <div class="pt-4 border-t border-white/10 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <p class="text-[11px] md:text-xs text-gray-500">
                © {{ date('Y') }} Consultar CNPJ Grátis. Consulta de CNPJ gratuita com dados públicos da Receita Federal do Brasil.
            </p>
            <p class="text-[10px] md:text-[11px] text-gray-500">
                Termos mais comuns: consulta CNPJ, empresas por cidade, empresas por estado, CNAE, quadro societário, razão social.
            </p>
        </div>
    </div>
</footer>
