@props([])

@php
    $capitais = [
        ['nome' => 'São Paulo', 'uf' => 'SP', 'slug' => 'sao-paulo'],
        ['nome' => 'Rio de Janeiro', 'uf' => 'RJ', 'slug' => 'rio-de-janeiro'],
        ['nome' => 'Belo Horizonte', 'uf' => 'MG', 'slug' => 'belo-horizonte'],
        ['nome' => 'Brasília', 'uf' => 'DF', 'slug' => 'brasilia'],
        ['nome' => 'Curitiba', 'uf' => 'PR', 'slug' => 'curitiba'],
        ['nome' => 'Porto Alegre', 'uf' => 'RS', 'slug' => 'porto-alegre'],
        ['nome' => 'Salvador', 'uf' => 'BA', 'slug' => 'salvador'],
        ['nome' => 'Fortaleza', 'uf' => 'CE', 'slug' => 'fortaleza'],
        ['nome' => 'Recife', 'uf' => 'PE', 'slug' => 'recife'],
        ['nome' => 'Florianópolis', 'uf' => 'SC', 'slug' => 'florianopolis'],
        ['nome' => 'Manaus', 'uf' => 'AM', 'slug' => 'manaus'],
        ['nome' => 'Belém', 'uf' => 'PA', 'slug' => 'belem'],
        ['nome' => 'Goiânia', 'uf' => 'GO', 'slug' => 'goiania'],
        ['nome' => 'Vitória', 'uf' => 'ES', 'slug' => 'vitoria'],
        ['nome' => 'São Luís', 'uf' => 'MA', 'slug' => 'sao-luis'],
        ['nome' => 'Maceió', 'uf' => 'AL', 'slug' => 'maceio'],
        ['nome' => 'Natal', 'uf' => 'RN', 'slug' => 'natal'],
        ['nome' => 'Teresina', 'uf' => 'PI', 'slug' => 'teresina'],
        ['nome' => 'Campo Grande', 'uf' => 'MS', 'slug' => 'campo-grande'],
        ['nome' => 'Cuiabá', 'uf' => 'MT', 'slug' => 'cuiaba'],
        ['nome' => 'João Pessoa', 'uf' => 'PB', 'slug' => 'joao-pessoa'],
        ['nome' => 'Aracaju', 'uf' => 'SE', 'slug' => 'aracaju'],
        ['nome' => 'Palmas', 'uf' => 'TO', 'slug' => 'palmas'],
        ['nome' => 'Rio Branco', 'uf' => 'AC', 'slug' => 'rio-branco'],
        ['nome' => 'Porto Velho', 'uf' => 'RO', 'slug' => 'porto-velho'],
        ['nome' => 'Boa Vista', 'uf' => 'RR', 'slug' => 'boa-vista'],
        ['nome' => 'Macapá', 'uf' => 'AP', 'slug' => 'macapa'],
    ];

    $estados = [
        'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas', 'BA' => 'Bahia', 'CE' => 'Ceará',
        'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo', 'GO' => 'Goiás', 'MA' => 'Maranhão', 'MT' => 'Mato Grosso',
        'MS' => 'Mato Grosso do Sul', 'MG' => 'Minas Gerais', 'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná',
        'PE' => 'Pernambuco', 'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte', 'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa Catarina', 'SP' => 'São Paulo', 'SE' => 'Sergipe', 'TO' => 'Tocantins'
    ];

    $cnaesLinks = [
        ['codigo' => '4711301', 'descricao' => 'Comércio varejista de mercadorias em geral, com predominância de produtos alimentícios'],
        ['codigo' => '6201501', 'descricao' => 'Desenvolvimento de programas de computador sob encomenda'],
        ['codigo' => '8610101', 'descricao' => 'Atividades de atendimento hospitalar'],
        ['codigo' => '4511100', 'descricao' => 'Comércio a varejo de automóveis, camionetas e utilitários novos'],
        ['codigo' => '5611201', 'descricao' => 'Restaurantes e similares'],
        ['codigo' => '4712100', 'descricao' => 'Comércio varejista de minimercados, mercearias e armazéns'],
    ];

    $formatarCnae = function (string $codigo): string {
        $codigo = str_pad($codigo, 7, '0', STR_PAD_LEFT);
        return substr($codigo, 0, 2) . '.' . substr($codigo, 2, 2) . '-' . substr($codigo, 4, 1) . '/' . substr($codigo, 5);
    };
@endphp

<footer class="bg-[#050509] text-gray-300 border-t border-white/10">
    <div class="container mx-auto px-6 md:px-10 xl:px-16 pt-12 pb-8 space-y-10">
        {{-- TOPO DO FOOTER: TEXTO + CTA --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 rounded-3xl border border-white/10 bg-white/[0.04] px-6 py-5">
            <div class="space-y-2 max-w-3xl">
                <p class="text-[11px] md:text-xs uppercase tracking-[0.24em] text-amber-300 font-semibold">Navegação inteligente</p>
                <h2 class="text-xl md:text-2xl font-black text-white leading-tight">
                    Explore empresas por CNPJ, estados, capitais e CNAEs sem sair do rodapé.
                </h2>
                <p class="text-xs md:text-sm text-gray-400">
                    Links internos para as capitais brasileiras, diretórios por estado e atividades econômicas mais consultadas.
                    Use-os para montar listas B2B ou validar rapidamente um cadastro.
                </p>
            </div>
            <div class="flex flex-col sm:flex-row items-stretch gap-3 w-full lg:w-auto">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center rounded-2xl bg-amber-400 px-4 py-2 text-sm font-semibold text-[#111827] shadow-[0_10px_30px_rgba(251,191,36,0.28)] hover:bg-amber-300 transition">
                    <i class="bi bi-search me-2"></i> Consultar um CNPJ agora
                </a>
                <a href="{{ route('empresas.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-white/20 px-4 py-2 text-sm font-semibold text-white hover:border-amber-300/80 hover:text-amber-200 transition">
                    <i class="bi bi-grid me-2"></i> Ver portal de empresas
                </a>
            </div>
        </div>

        {{-- GRID DE LINKS INTERNOS --}}
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 text-sm">
            {{-- COLUNA 1: CONSULTAS DE CNPJ --}}
            <div class="space-y-4">
                <div>
                    <h3 class="text-xs font-semibold uppercase tracking-[0.22em] text-gray-400 mb-3">Portais principais</h3>
                    <ul class="space-y-2 text-xs md:text-sm">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-amber-300 transition">Consulta de CNPJ gratuito</a></li>
                        <li><a href="{{ route('empresas.index') }}" class="text-gray-300 hover:text-amber-300 transition">Portal de empresas por estado</a></li>
                        <li><a href="{{ route('empresas.cnae') }}" class="text-gray-300 hover:text-amber-300 transition">Empresas por atividade econômica (CNAE)</a></li>
                        <li><a href="{{ url('/politica-de-privacidade') }}" class="text-gray-300 hover:text-amber-300 transition">Política de privacidade</a></li>
                    </ul>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-3 text-xs text-gray-400">
                    <p class="font-semibold text-gray-200 mb-1">Termos que o público procura</p>
                    <p>lista de empresas por cidade, empresas por estado, CNAE, quadro societário, razão social, consulta grátis.</p>
                </div>
            </div>

            {{-- COLUNA 2: CAPITAIS --}}
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-[0.22em] text-gray-400 mb-3">Capitais brasileiras</h3>
                <div class="grid grid-cols-2 gap-3 text-xs md:text-sm">
                    @foreach (array_chunk($capitais, 9) as $bloco)
                        <ul class="space-y-2">
                            @foreach ($bloco as $capital)
                                <li>
                                    <a href="{{ route('empresas.city', [strtolower($capital['uf']), $capital['slug']]) }}" class="text-gray-300 hover:text-amber-300 transition">
                                        Lista de empresas em {{ $capital['nome'] }} ({{ $capital['uf'] }})
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>

            {{-- COLUNA 3: ESTADOS --}}
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-[0.22em] text-gray-400 mb-3">Empresas por estado</h3>
                <div class="grid grid-cols-2 gap-3 text-xs md:text-sm">
                    @foreach (array_chunk($estados, 7, true) as $grupo)
                        <ul class="space-y-2">
                            @foreach ($grupo as $uf => $nome)
                                <li>
                                    <a href="{{ route('empresas.state', ['uf' => strtolower($uf)]) }}" class="text-gray-300 hover:text-amber-300 transition">
                                        Empresas em {{ $nome }} ({{ $uf }})
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>

            {{-- COLUNA 4: CNAE --}}
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-[0.22em] text-gray-400 mb-3">Atividades econômicas</h3>
                <ul class="space-y-2 text-xs md:text-sm">
                    @foreach ($cnaesLinks as $cnae)
                        <li>
                            <a href="{{ route('empresas.cnae.show', ['codigo_cnae' => $cnae['codigo']]) }}" class="text-gray-300 hover:text-amber-300 transition">
                                CNAE {{ $formatarCnae($cnae['codigo']) }} — {{ $cnae['descricao'] }}
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{ route('empresas.cnae') }}#faq" class="text-gray-300 hover:text-amber-300 transition">
                            Como funcionam os códigos CNAE?
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- RODAPÉ INFERIOR --}}
        <div class="pt-4 border-t border-white/10 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <p class="text-[11px] md:text-xs text-gray-500">
                © {{ date('Y') }} Consulta CNPJ Grátis — dados públicos da Receita Federal do Brasil com navegação por CNPJ, UF, municípios e CNAE.
            </p>
            <p class="text-[10px] md:text-[11px] text-gray-500">
                Links internos para capitais, estados e atividades econômicas ajudam a montar listas de prospecção rapidamente.
            </p>
        </div>
    </div>
</footer>
