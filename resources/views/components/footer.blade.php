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

<footer class="bg-[#050509] text-gray-300 border-top border-white/10 border-t">
    <div class="container mx-auto px-6 md:px-10 xl:px-16 pt-10 pb-8 space-y-8">
        {{-- LOGO E INTRO --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-amber-400 to-amber-500 shadow-[0_0_24px_rgba(251,191,36,0.35)]">
                    <i class="bi bi-search text-lg text-[#111827]"></i>
                </div>
                <div class="flex flex-col leading-tight">
                    <span class="text-base font-bold text-white">Consulta CNPJ <span class="text-amber-300">Grátis</span></span>
                    <span class="text-[12px] text-gray-400">Busque por CNPJ, estados, cidades e CNAE.</span>
                </div>
            </a>
            <a href="{{ route('empresas.index') }}" class="inline-flex items-center gap-2 rounded-full border border-white/20 px-3 py-2 text-xs font-semibold text-white hover:border-amber-300/80 hover:text-amber-200 transition">
                <i class="bi bi-grid"></i> Portal de empresas
            </a>
        </div>

        <div class="space-y-6 text-sm">
            {{-- BLOCOS DE LINKS --}}
            <div class="space-y-3">
                <h3 class="text-xs font-semibold uppercase tracking-[0.22em] text-gray-400">Portais principais</h3>
                <ul class="space-y-2 text-xs md:text-sm">
                    <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-amber-300 transition">Consulta de CNPJ gratuito</a></li>
                    <li><a href="{{ route('empresas.index') }}" class="text-gray-300 hover:text-amber-300 transition">Portal de empresas por estado</a></li>
                    <li><a href="{{ route('empresas.cnae') }}" class="text-gray-300 hover:text-amber-300 transition">Empresas por atividade econômica (CNAE)</a></li>
                    <li><a href="{{ url('/politica-de-privacidade') }}" class="text-gray-300 hover:text-amber-300 transition">Política de privacidade</a></li>
                </ul>
            </div>

            <div class="space-y-3">
                <h3 class="text-xs font-semibold uppercase tracking-[0.22em] text-gray-400">Capitais brasileiras</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 text-xs md:text-sm">
                    @foreach (array_chunk($capitais, 7) as $bloco)
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

            <div class="space-y-3">
                <h3 class="text-xs font-semibold uppercase tracking-[0.22em] text-gray-400">Empresas por estado</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 text-xs md:text-sm">
                    @foreach (array_chunk($estados, 5, true) as $grupo)
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

            <div class="space-y-3">
                <h3 class="text-xs font-semibold uppercase tracking-[0.22em] text-gray-400">Atividades econômicas</h3>
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
        <div class="pt-4 border-t border-white/10 space-y-2 text-[11px] md:text-xs text-gray-500">
            <p>© {{ date('Y') }} Consulta CNPJ Grátis — dados públicos da Receita Federal do Brasil com navegação por CNPJ, UF, municípios e CNAE.</p>
            <p>Links internos para capitais, estados e atividades econômicas ajudam a montar listas de prospecção rapidamente.</p>
        </div>
    </div>
</footer>
