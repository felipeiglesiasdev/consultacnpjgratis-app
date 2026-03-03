@props([])

@php
    // Lista exata das 27 capitais brasileiras
    $capitais = [
        ['nome' => 'Aracaju', 'uf' => 'SE', 'slug' => 'aracaju'],
        ['nome' => 'Belém', 'uf' => 'PA', 'slug' => 'belem'],
        ['nome' => 'Belo Horizonte', 'uf' => 'MG', 'slug' => 'belo-horizonte'],
        ['nome' => 'Boa Vista', 'uf' => 'RR', 'slug' => 'boa-vista'],
        ['nome' => 'Brasília', 'uf' => 'DF', 'slug' => 'brasilia'],
        ['nome' => 'Campo Grande', 'uf' => 'MS', 'slug' => 'campo-grande'],
        ['nome' => 'Cuiabá', 'uf' => 'MT', 'slug' => 'cuiaba'],
        ['nome' => 'Curitiba', 'uf' => 'PR', 'slug' => 'curitiba'],
        ['nome' => 'Florianópolis', 'uf' => 'SC', 'slug' => 'florianopolis'],
        ['nome' => 'Fortaleza', 'uf' => 'CE', 'slug' => 'fortaleza'],
        ['nome' => 'Goiânia', 'uf' => 'GO', 'slug' => 'goiania'],
        ['nome' => 'João Pessoa', 'uf' => 'PB', 'slug' => 'joao-pessoa'],
        ['nome' => 'Macapá', 'uf' => 'AP', 'slug' => 'macapa'],
        ['nome' => 'Maceió', 'uf' => 'AL', 'slug' => 'maceio'],
        ['nome' => 'Manaus', 'uf' => 'AM', 'slug' => 'manaus'],
        ['nome' => 'Natal', 'uf' => 'RN', 'slug' => 'natal'],
        ['nome' => 'Palmas', 'uf' => 'TO', 'slug' => 'palmas'],
        ['nome' => 'Porto Alegre', 'uf' => 'RS', 'slug' => 'porto-alegre'],
        ['nome' => 'Porto Velho', 'uf' => 'RO', 'slug' => 'porto-velho'],
        ['nome' => 'Recife', 'uf' => 'PE', 'slug' => 'recife'],
        ['nome' => 'Rio Branco', 'uf' => 'AC', 'slug' => 'rio-branco'],
        ['nome' => 'Rio de Janeiro', 'uf' => 'RJ', 'slug' => 'rio-de-janeiro'],
        ['nome' => 'Salvador', 'uf' => 'BA', 'slug' => 'salvador'],
        ['nome' => 'São Luís', 'uf' => 'MA', 'slug' => 'sao-luis'],
        ['nome' => 'São Paulo', 'uf' => 'SP', 'slug' => 'sao-paulo'],
        ['nome' => 'Teresina', 'uf' => 'PI', 'slug' => 'teresina'],
        ['nome' => 'Vitória', 'uf' => 'ES', 'slug' => 'vitoria'],
    ];

    // Lista exata dos 27 estados
    $estados = [
        'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas',
        'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo',
        'GO' => 'Goiás', 'MA' => 'Maranhão', 'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais', 'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná',
        'PE' => 'Pernambuco', 'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa Catarina',
        'SP' => 'São Paulo', 'SE' => 'Sergipe', 'TO' => 'Tocantins'
    ];

    // Função auxiliar para dividir em colunas (7, 7, 7, 6)
    $chunkedCapitais = array_chunk($capitais, 7);
    $chunkedEstados = array_chunk($estados, 7, true); // true preserva as chaves (UF)
@endphp

<footer class="bg-[#050509] text-gray-400 border-t border-white/10 font-sans">
    
    {{-- ==========================================
         SEÇÃO 1: FOOTER PADRÃO (Institucional)
         ========================================== --}}
    <div class="border-b border-white/5 bg-gradient-to-b from-[#050509] to-black/40">
        <div class="container mx-auto px-4 md:px-6 py-12 lg:py-16">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 md:gap-8">
                
                <!-- Brand & Sobre -->
                <div class="md:col-span-5 lg:col-span-4 space-y-6">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 decoration-0 focus:outline-none group w-fit">
                        {{-- Logo Padronizada com Header (Lupa + Efeitos) --}}
                        <div class="relative flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-orange-500 to-amber-600 text-white shadow-lg shadow-orange-500/20 transition-transform duration-500 ease-out group-hover:scale-110 group-hover:rotate-6">
                            <i class="bi bi-search text-xl drop-shadow-md"></i>
                            {{-- Brilho interno --}}
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>
                        <div class="flex flex-col leading-none">
                            <span class="font-bold text-gray-100 text-xl tracking-tight transition-colors group-hover:text-white">
                                Consulta<span class="text-orange-500">CNPJ</span>
                            </span>
                            <span class="text-[0.6rem] font-bold uppercase tracking-[0.25em] text-gray-500 mt-0.5">
                                Grátis
                            </span>
                        </div>
                    </a>
                    
                    <p class="text-sm leading-relaxed text-gray-400 max-w-sm">
                        Plataforma gratuita para consulta de dados públicos de empresas brasileiras. 
                        Acesse informações completas sobre CNPJ, quadro societário, situação cadastral e muito mais de forma rápida e segura.
                    </p>
                </div>

                <!-- Links Rápidos -->
                <div class="md:col-span-3 lg:col-span-3 lg:col-start-6 space-y-5">
                    <h3 class="text-white font-semibold text-sm uppercase tracking-wider">Plataforma</h3>
                    <ul class="space-y-2 text-sm">
                        <li>
                            <a href="{{ route('home') }}" class="flex items-center gap-2 py-1 hover:text-amber-400 transition-colors group">
                                <i class="bi bi-house-door text-gray-600 group-hover:text-amber-500 transition-colors"></i> Início
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('empresas.index') }}" class="flex items-center gap-2 py-1 hover:text-amber-400 transition-colors group">
                                <i class="bi bi-collection text-gray-600 group-hover:text-amber-500 transition-colors"></i> Diretório Completo
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('consulta_avancada.index') }}" class="flex items-center gap-2 py-1 hover:text-amber-400 transition-colors text-amber-500/90 font-medium group">
                                <i class="bi bi-stars text-amber-600/70 group-hover:text-amber-500 transition-colors"></i> Consulta Avançada
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Legal & Contato -->
                <div class="md:col-span-4 lg:col-span-3 space-y-5">
                    <h3 class="text-white font-semibold text-sm uppercase tracking-wider">Legal & Ajuda</h3>
                    <ul class="space-y-2 text-sm">
                        <li>
                            <a href="{{ route('privacidade') }}" class="flex items-center gap-2 py-1 hover:text-amber-400 transition-colors group">
                                <i class="bi bi-shield-check text-gray-600 group-hover:text-amber-500 transition-colors"></i> Política de Privacidade
                            </a>
                        </li>
                        {{-- Exemplo de link condicional se existir rota --}}
                        @if(Route::has('contact'))
                        <li>
                            <a href="{{ route('contact') }}" class="flex items-center gap-2 py-1 hover:text-amber-400 transition-colors group">
                                <i class="bi bi-envelope text-gray-600 group-hover:text-amber-500 transition-colors"></i> Fale Conosco
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- ==========================================
         SEÇÃO 2: NAVEGAÇÃO POR ESTADOS E CAPITAIS (4 Colunas)
         ========================================== --}}
    <div class="bg-[#030305] py-12 border-t border-black">
        <div class="container mx-auto px-4 md:px-6">
            
            <!-- Grid de Estados -->
            <div class="mb-12">
                <h3 class="text-amber-500 font-bold text-xs uppercase tracking-widest mb-6 flex items-center gap-2">
                    <i class="bi bi-map"></i> Empresas por Estado
                </h3>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-x-6 gap-y-8 text-sm">
                    @foreach($chunkedEstados as $coluna)
                        <ul class="space-y-1.5">
                            @foreach($coluna as $uf => $nome)
                                <li>
                                    <a href="{{ route('empresas.state', ['uf' => strtolower($uf)]) }}" 
                                       class="flex items-center gap-1.5 py-0.5 text-gray-400 hover:text-amber-400 transition-all duration-300 hover:-translate-y-0.5 w-fit">
                                        {{ $nome }} <span class="text-gray-600 text-xs opacity-70">({{ $uf }})</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>

            <!-- Grid de Capitais -->
            <div>
                <h3 class="text-amber-500 font-bold text-xs uppercase tracking-widest mb-6 flex items-center gap-2">
                    <i class="bi bi-building"></i> Empresas por Capital
                </h3>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-x-6 gap-y-8 text-sm">
                    @foreach($chunkedCapitais as $coluna)
                        <ul class="space-y-1.5">
                            @foreach($coluna as $capital)
                                <li>
                                    <a href="{{ route('empresas.city', ['uf' => strtolower($capital['uf']), 'municipio' => $capital['slug']]) }}" 
                                       class="flex items-center gap-1.5 py-0.5 text-gray-400 hover:text-amber-400 transition-all duration-300 hover:-translate-y-0.5 w-fit">
                                        {{ $capital['nome'] }} <span class="text-gray-600 text-xs opacity-70">({{ $capital['uf'] }})</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <!-- Barra Final (Disclaimer Simplificado) -->
    <div class="border-t border-white/5 bg-black py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-center gap-6 text-center md:text-left">
                
                <!-- Ícone Decorativo -->
                <div class="hidden md:flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white/5 text-gray-600 border border-white/5">
                    <i class="bi bi-database text-lg"></i>
                </div>

                <div class="max-w-4xl">
                    <p class="text-xs md:text-sm text-gray-500 leading-relaxed">
                        Os dados exibidos nesta plataforma são de caráter público. Fonte: 
                        <a href="https://dados.gov.br/dados/conjuntos-dados/cadastro-nacional-da-pessoa-juridica---cnpj" target="_blank" rel="nofollow" class="text-gray-400 hover:text-amber-500 transition-colors font-medium">
                            Dados Abertos CNPJ <i class="bi bi-box-arrow-up-right text-[10px] ml-0.5"></i>
                        </a>. 
                        <br>Para saber mais, acesse nossa 
                        <a href="{{ route('privacidade') }}" rel="nofollow" class="text-gray-400 hover:text-amber-500 transition-colors font-medium">
                            Política de Privacidade
                        </a>.
                    </p>
                    <p class="text-xs text-gray-600 mt-2">
                        &copy; {{ date('Y') }} Consulta CNPJ Grátis. Todos os direitos reservados.
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>