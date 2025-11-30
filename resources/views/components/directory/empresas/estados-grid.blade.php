@props(['estados'])

@php
    // Mapeia o nome completo das UFs
    $nomesEstados = [
        'AC' => 'Acre', 'AL' => 'Alagoas', 'AM' => 'Amazonas', 'AP' => 'Amapá',
        'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo',
        'GO' => 'Goiás', 'MA' => 'Maranhão', 'MG' => 'Minas Gerais', 'MS' => 'Mato Grosso do Sul',
        'MT' => 'Mato Grosso', 'PA' => 'Pará', 'PB' => 'Paraíba', 'PE' => 'Pernambuco',
        'PI' => 'Piauí', 'PR' => 'Paraná', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
        'RO' => 'Rondônia', 'RR' => 'Roraima', 'RS' => 'Rio Grande do Sul', 'SC' => 'Santa Catarina',
        'SE' => 'Sergipe', 'SP' => 'São Paulo', 'TO' => 'Tocantins',
    ];
@endphp

<section id="estados" class="bg-gray-50 py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
            <div class="max-w-xl">
                <p class="text-amber-500 font-semibold uppercase text-xs md:text-sm tracking-[0.24em]">
                    Todos os estados
                </p>
                <h2 class="mt-2 text-2xl md:text-3xl font-black text-[#111827]">
                    Escolha uma UF para ver o painel completo
                </h2>
                <p class="mt-3 text-sm md:text-base text-gray-600">
                    Ao clicar em um estado, você terá acesso a um painel com distribuição de empresas,
                    principais cidades e atividades econômicas mais comuns naquela região.
                </p>
            </div>

            <div class="text-xs md:text-sm text-gray-500 max-w-sm">
                <p class="font-medium text-gray-700 mb-1">Como usar esse grid:</p>
                <p>• Passe o mouse para ver o nome completo do estado.</p>
                <p>• Clique em uma UF para abrir o diretório filtrado para aquela unidade federativa.</p>
            </div>
        </div>

        {{-- 27 estados = 9 colunas x 3 linhas no desktop --}}
        <div class="rounded-3xl border border-gray-200 bg-white/80 p-4 md:p-5 shadow-[0_18px_45px_-28px_rgba(15,23,42,0.55)]">
            <div class="grid grid-cols-3 sm:grid-cols-6 lg:grid-cols-9 gap-3 md:gap-4">
                @foreach ($estados as $estado)
                    @php
                        $uf = $estado->uf;
                        $nomeCompleto = $nomesEstados[$uf] ?? $uf;
                    @endphp

                    <a
                        href="{{ route('empresas.state', ['uf' => strtolower($uf)]) }}"
                        class="group flex flex-col items-center justify-center rounded-2xl border border-gray-200 bg-white px-2 py-3 md:px-3 md:py-4 shadow-[0_12px_32px_-24px_rgba(15,23,42,0.7)] hover:border-amber-400 hover:bg-amber-50/70 hover:-translate-y-0.5 transition-all duration-150"
                    >
                        <span class="text-lg md:text-xl font-black text-[#111827] tracking-wide">
                            {{ $uf }}
                        </span>
                        <span class="mt-1 text-[11px] md:text-xs text-gray-500 text-center leading-snug">
                            {{ $nomeCompleto }}
                        </span>
                        <span class="mt-2 text-[10px] md:text-[11px] text-gray-400">
                            {{ number_format($estado->total_municipios, 0, ',', '.') }} municípios com empresas
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
