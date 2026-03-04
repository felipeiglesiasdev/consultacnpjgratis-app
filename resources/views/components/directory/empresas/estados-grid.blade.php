@props(['estados'])

@php
    // Array auxiliar para mapear Sigla -> Nome
    $nomesEstados = [
        'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas',
        'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo',
        'GO' => 'Goiás', 'MA' => 'Maranhão', 'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais', 'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná',
        'PE' => 'Pernambuco', 'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa Catarina',
        'SP' => 'São Paulo', 'SE' => 'Sergipe', 'TO' => 'Tocantins'
    ];
@endphp

<section id="estados" class="bg-gradient-to-b from-black via-[#050608] to-[#0a0a0f] text-white py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        
        {{-- Cabeçalho --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">
            <div class="max-w-2xl">
                <p class="text-amber-400 font-semibold uppercase text-xs tracking-[0.2em]">
                    Mapa do Brasil Empresarial
                </p>
                <h2 class="mt-2 text-3xl md:text-4xl font-black tracking-tight">
                    Explore os 27 estados
                </h2>
                <p class="mt-4 text-sm md:text-base text-gray-400">
                    Selecione um estado abaixo para acessar a lista de municípios e descobrir onde estão as maiores oportunidades e concentrações comerciais de cada região.
                </p>
            </div>
            
            <div class="hidden md:block">
                <p class="text-xs text-gray-500 text-right">
                    <i class="bi bi-geo-alt-fill text-amber-500/50 mr-1"></i>
                    Selecione para navegar
                </p>
            </div>
        </div>

        {{-- Grid Responsivo --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-9 gap-3 md:gap-4">
            @foreach($estados as $estado)
                @php
                    $uf = $estado->uf;
                    $nomeEstado = $nomesEstados[$uf] ?? $uf;
                    $totalMunicipios = $estado->total_municipios ?? null;                    
                    $linkRota = route('empresas.state', ['uf' => strtolower($uf)]); 
                @endphp
                
                <a href="{{ $linkRota }}" class="group relative flex flex-col items-center justify-center p-5 rounded-2xl border border-white/5 bg-white/[0.015] hover:bg-amber-400/5 hover:border-amber-400/30 transition-all duration-300 overflow-hidden">
                    
                    {{-- Fundo animado no Hover --}}
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    {{-- Sigla UF --}}
                    <span class="relative inline-flex h-12 w-12 items-center justify-center rounded-xl bg-black border border-white/10 text-amber-300 text-lg font-black group-hover:scale-110 group-hover:border-amber-400/50 group-hover:shadow-[0_0_15px_rgba(251,191,36,0.2)] transition-all duration-300">
                        {{ $uf }}
                    </span>

                    {{-- Textos Alternantes (Nome / Quantidade) --}}
                    <div class="relative mt-3 h-8 w-full flex items-center justify-center text-center">
                        <p class="absolute inset-0 text-xs text-gray-300 font-medium group-hover:opacity-0 group-hover:-translate-y-2 transition-all duration-300 line-clamp-2 leading-tight">
                            {{ $nomeEstado }}
                        </p>
                        
                        @if($totalMunicipios)
                            <p class="absolute inset-0 text-[11px] text-amber-200 font-semibold opacity-0 translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 flex items-center justify-center">
                                {{ $totalMunicipios }} cidades
                            </p>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</section>