@props(['estados'])

@php
    // Mapeamento de siglas para nomes completos dos estados
    $nomesEstados = [
        'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas', 'BA' => 'Bahia', 'CE' => 'Ceará',
        'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo', 'GO' => 'Goiás', 'MA' => 'Maranhão', 'MT' => 'Mato Grosso',
        'MS' => 'Mato Grosso do Sul', 'MG' => 'Minas Gerais', 'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná',
        'PE' => 'Pernambuco', 'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa Catarina', 'SP' => 'São Paulo',
        'SE' => 'Sergipe', 'TO' => 'Tocantins'
    ];
@endphp

<section {{ $attributes->merge(['class' => 'mt-16']) }}>
    <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
        <div class="max-w-3xl">
            <p class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-amber-100 text-amber-800">Mapa vivo das empresas</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-black text-[#171717]">Navegue por qualquer estado do Brasil</h2>
            <p class="mt-3 text-lg text-gray-600">Abra a lupa regional e veja onde estão as empresas, em um grid organizado por UF. Clique para mergulhar nos municípios e setores mais fortes.</p>
        </div>
        <div class="hidden lg:block">
            <div class="rounded-2xl bg-amber-50 border border-amber-100 px-5 py-4 shadow-inner text-amber-900 font-semibold">
                <span class="block text-xs uppercase tracking-wide text-amber-700">Dica rápida</span>
                <span class="block text-lg">Estados ordenados alfabeticamente para facilitar sua exploração.</span>
            </div>
        </div>
    </div>

    <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-4">
        @foreach($estados as $estado)
            @php
                $nomeCompleto = $nomesEstados[$estado->uf] ?? $estado->uf;
            @endphp
            <a href="{{ route('empresas.state', ['uf' => strtolower($estado->uf)]) }}"
               class="group relative overflow-hidden rounded-xl border border-gray-200 bg-white/80 p-4 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-amber-700">{{ $nomeCompleto }}</span>
                        <p class="text-xl font-bold text-[#171717] leading-tight">{{ $estado->uf }}</p>
                    </div>
                    <span class="inline-flex items-center justify-center rounded-full bg-amber-100 text-amber-800 text-xs font-bold px-3 py-1">
                        {{ number_format($estado->total, 0, ',', '.') }}
                    </span>
                </div>
                <div class="mt-3 flex items-center text-sm text-gray-500 gap-1">
                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                    <span>empresas localizadas</span>
                </div>
                <div class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-amber-200 via-amber-400 to-amber-500 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
            </a>
        @endforeach
    </div>
</section>
