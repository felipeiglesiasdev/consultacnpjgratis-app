@props(['data'])

<section class="relative overflow-hidden bg-gradient-to-b from-[#020617] via-[#0F172A] to-[#1E293B] pt-24 pb-16 md:pt-32 md:pb-24">
    {{-- Efeitos de Luz Premium --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 h-[600px] w-[600px] rounded-full bg-amber-500/10 blur-[120px]"></div>
        <div class="absolute top-20 -left-20 h-[400px] w-[400px] rounded-full bg-blue-500/10 blur-[100px]"></div>
        <div class="absolute bottom-0 w-full h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
    </div>

    <div class="relative container mx-auto px-6 md:px-10 xl:px-16 text-center">
        
        {{-- Badges Superiores --}}
        <div class="flex flex-wrap items-center justify-center gap-3 mb-6">
            <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-1.5 text-xs font-mono font-bold text-gray-300 shadow-sm backdrop-blur-md">
                <i class="bi bi-building text-amber-400"></i>
                CNPJ: {{ $data['cnpj_completo'] }}
            </span>
            <span class="inline-flex items-center rounded-full border border-amber-500/30 bg-amber-500/10 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-amber-300 backdrop-blur-md">
                {{ $data['matriz_ou_filial'] }}
            </span>
        </div>

        {{-- Título Principal --}}
        <h1 class="mx-auto max-w-4xl text-3xl md:text-5xl lg:text-6xl font-black text-white tracking-tight leading-[1.1] mb-4">
            {{ $data['razao_social'] }}
        </h1>

        {{-- Nome Fantasia (Se existir) --}}
        @if($data['nome_fantasia'])
            <p class="text-lg md:text-2xl font-medium text-gray-400 mb-8">
                Conhecida como <span class="text-white">{{ $data['nome_fantasia'] }}</span>
            </p>
        @else
            <div class="h-4"></div> {{-- Espaçador --}}
        @endif

        {{-- Informações Rápidas em Linha --}}
        <div class="flex flex-wrap items-center justify-center gap-4 md:gap-8 text-sm font-medium text-gray-400 mt-6">
            <p class="flex items-center gap-2">
                <i class="bi bi-calendar-event text-amber-500/70"></i>
                Aberta em {{ $data['data_abertura'] }}
            </p>
            <span class="hidden md:block w-1.5 h-1.5 rounded-full bg-gray-700"></span>
            <p class="flex items-center gap-2">
                <i class="bi bi-geo-alt text-blue-400/70"></i>
                {{ $data['cidade'] }} - {{ $data['uf'] }}
            </p>
            <span class="hidden md:block w-1.5 h-1.5 rounded-full bg-gray-700"></span>
            <p class="flex items-center gap-2">
                <i class="bi bi-tag text-emerald-400/70"></i>
                {{ $data['natureza_juridica'] }}
            </p>
        </div>

    </div>
</section>