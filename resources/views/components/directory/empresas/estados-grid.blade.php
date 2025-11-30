{{-- resources/views/components/directory/estados-grid.blade.php --}}
@props(['estados'])

<section class="bg-gradient-to-b from-[#050509] via-[#050608] to-black text-white py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        {{-- Cabeçalho --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-10">
            <div>
                <p class="text-amber-400 font-semibold uppercase text-xs md:text-sm tracking-[0.24em]">
                    Mapa de empresas por UF
                </p>
                <h2 class="mt-2 text-2xl md:text-3xl font-black tracking-tight">
                    Explore os 27 estados brasileiros
                </h2>
                <p class="mt-3 text-sm md:text-base text-gray-300 max-w-2xl">
                    Clique em um estado para ver o painel com empresas ativas, cidades em destaque
                    e atividades econômicas mais presentes na região.
                </p>
            </div>

            <p class="text-[11px] md:text-xs text-gray-400 max-w-xs">
                Ideal para montar rotas comerciais, identificar focos de clientes por região
                e começar sua prospecção B2B pelo mapa do Brasil.
            </p>
        </div>

        @php
            // Mapa UF => nome do estado
            $nomesEstados = [
                'AC' => 'Acre',
                'AL' => 'Alagoas',
                'AP' => 'Amapá',
                'AM' => 'Amazonas',
                'BA' => 'Bahia',
                'CE' => 'Ceará',
                'DF' => 'Distrito Federal',
                'ES' => 'Espírito Santo',
                'GO' => 'Goiás',
                'MA' => 'Maranhão',
                'MT' => 'Mato Grosso',
                'MS' => 'Mato Grosso do Sul',
                'MG' => 'Minas Gerais',
                'PA' => 'Pará',
                'PB' => 'Paraíba',
                'PR' => 'Paraná',
                'PE' => 'Pernambuco',
                'PI' => 'Piauí',
                'RJ' => 'Rio de Janeiro',
                'RN' => 'Rio Grande do Norte',
                'RS' => 'Rio Grande do Sul',
                'RO' => 'Rondônia',
                'RR' => 'Roraima',
                'SC' => 'Santa Catarina',
                'SP' => 'São Paulo',
                'SE' => 'Sergipe',
                'TO' => 'Tocantins',
            ];
        @endphp

        {{-- Grid 9 x 3 em desktop --}}
        <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 xl:grid-cols-9 gap-2.5 md:gap-3">
            @foreach ($estados as $estado)
                @php
                    $ufRaw = $estado->uf ?? $estado->sigla ?? $estado['uf'] ?? $estado['sigla'] ?? '';
                    $uf    = strtoupper($ufRaw);

                    $nomeEstado = $nomesEstados[$uf] ?? $uf;

                    $totalMunicipios =
                        $estado->total_municipios
                            ?? $estado->municipios_count
                            ?? $estado['total_municipios']
                            ?? $estado['municipios_count']
                            ?? null;
                @endphp

                <a
                    href="{{ route('empresas.state', ['uf' => strtolower($uf)]) }}"
                    class="group relative flex flex-col items-center justify-center text-center
                           rounded-xl border border-white/10 bg-white/[0.02]
                           px-3 py-3 md:px-3 md:py-3.5
                           text-[11px] md:text-xs
                           shadow-[0_14px_35px_-30px_rgba(0,0,0,1)]
                           hover:bg-gradient-to-br hover:from-amber-500/20 hover:to-amber-400/10
                           hover:border-amber-400/70 hover:-translate-y-0.5 hover:translate-x-0.5
                           transition-all duration-150"
                >
                    {{-- Sigla grande, centralizada --}}
                    <div class="flex flex-col items-center justify-center gap-1">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-amber-500/25 text-amber-100 text-sm font-bold">
                            {{ $uf }}
                        </span>

                        {{-- Nome do estado (some no hover) --}}
                        <p class="mt-0.5 text-[10px] md:text-[11px] text-gray-200 font-medium
                                  group-hover:opacity-0 group-hover:-translate-y-1
                                  transition-all duration-150">
                            {{ $nomeEstado }}
                        </p>

                        {{-- Quantidade de municípios (aparece no hover) --}}
                        @if($totalMunicipios !== null)
                            <p class="mt-0.5 text-[10px] md:text-[11px] text-emerald-200 font-medium
                                      opacity-0 translate-y-1
                                      group-hover:opacity-100 group-hover:translate-y-0
                                      transition-all duration-150">
                                {{ number_format($totalMunicipios, 0, ',', '.') }} municípios
                            </p>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
