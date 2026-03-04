@props([
    'top10CidadesAtivas',
    'topEstadosAtivos',
])

@php
    $nomesEstadosLista = [
        'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas',
        'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo',
        'GO' => 'Goiás', 'MA' => 'Maranhão', 'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais', 'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná',
        'PE' => 'Pernambuco', 'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa Catarina',
        'SP' => 'São Paulo', 'SE' => 'Sergipe', 'TO' => 'Tocantins'
    ];
@endphp

<section class="bg-[#050509] text-white py-20 relative border-t border-white/5">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        
        {{-- Cabeçalho da seção --}}
        <div class="max-w-3xl mb-12">
            <p class="text-amber-400 font-semibold uppercase text-xs tracking-[0.2em]">
                Ranking Nacional
            </p>
            <h2 class="mt-2 text-3xl md:text-4xl font-black tracking-tight">
                Maiores polos comerciais
            </h2>
            <p class="mt-4 text-sm md:text-base text-gray-400">
                Identifique onde está a maior concentração de empresas ativas no país. Uma visão clara das capitais, regiões metropolitanas e estados que movem a economia do Brasil.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 xl:gap-12">
            
            {{-- Coluna 1: TOP 10 Cidades --}}
            <div class="space-y-4">
                <div class="flex items-center gap-3 mb-6">
                    <div class="h-8 w-8 rounded-lg bg-blue-500/10 text-blue-400 flex items-center justify-center">
                        <i class="bi bi-buildings-fill text-sm"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-100">Top 10 Municípios</h3>
                </div>

                <div class="grid gap-3">
                    @foreach($top10CidadesAtivas as $index => $cidade)
                        <a href="{{ route('empresas.city', ['uf' => strtolower($cidade->uf), 'municipio' => $cidade->municipio_slug]) }}" class="group flex items-center gap-4 rounded-2xl border border-white/5 bg-white/[0.02] p-4 hover:bg-white/[0.04] hover:border-white/10 transition-all">
                            
                            {{-- Posição do Ranking --}}
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-black/50 border border-white/5 text-amber-500/80 font-mono text-sm font-bold group-hover:text-amber-400 transition-colors">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <p class="text-base font-bold text-gray-100 truncate group-hover:text-white transition-colors">
                                        {{ Str::title($cidade->nome) }}
                                    </p>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-white/10 text-gray-300">
                                        {{ $cidade->uf }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-400 mt-0.5">
                                    {{ number_format($cidade->total, 0, ',', '.') }} ativas
                                </p>
                            </div>

                            <i class="bi bi-chevron-right text-gray-600 group-hover:text-amber-400 transition-colors"></i>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Coluna 2: TOP 10 Estados --}}
            <div class="space-y-4">
                <div class="flex items-center gap-3 mb-6">
                    <div class="h-8 w-8 rounded-lg bg-emerald-500/10 text-emerald-400 flex items-center justify-center">
                        <i class="bi bi-map-fill text-sm"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-100">Top 10 Estados</h3>
                </div>

                <div class="grid gap-3">
                    @foreach($topEstadosAtivos as $index => $estado)
                        @php
                            $nomeCompleto = $nomesEstadosLista[$estado->uf] ?? $estado->uf;
                        @endphp
                        <a href="{{ route('empresas.state', ['uf' => strtolower($estado->uf)]) }}" class="group flex items-center gap-4 rounded-2xl border border-white/5 bg-white/[0.02] p-4 hover:bg-white/[0.04] hover:border-white/10 transition-all">
                            
                            {{-- Posição do Ranking --}}
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-black/50 border border-white/5 text-emerald-500/80 font-mono text-sm font-bold group-hover:text-emerald-400 transition-colors">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <p class="text-base font-bold text-gray-100 truncate group-hover:text-white transition-colors">
                                        {{ $nomeCompleto }}
                                    </p>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-white/10 text-gray-300">
                                        {{ $estado->uf }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-400 mt-0.5">
                                    {{ number_format($estado->total, 0, ',', '.') }} empresas registradas
                                </p>
                            </div>

                            <i class="bi bi-chevron-right text-gray-600 group-hover:text-emerald-400 transition-colors"></i>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>