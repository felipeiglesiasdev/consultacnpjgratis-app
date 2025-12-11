@props([])

<header class="sticky top-0 z-40 border-b border-white/10 bg-[#050509]/90 backdrop-blur">
    <div class="container mx-auto px-5 md:px-8 xl:px-12">
        <div class="flex items-center justify-between gap-4 py-1.5 md:py-2.5">
            {{-- LOGO / NOME DO PROJETO --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 md:gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-2xl bg-gradient-to-br from-amber-400 to-amber-500 shadow-[0_0_25px_rgba(251,191,36,0.45)]">
                    <i class="bi bi-search text-base text-[#111827]"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm md:text-base font-bold text-white leading-tight whitespace-nowrap">
                        Consulta CNPJ <span class="text-amber-300">Grátis</span>
                    </span>
                    {{-- Subtítulo removido a pedido --}}
                </div>
            </a>

            {{-- MENU DESKTOP --}}
            <nav class="hidden lg:flex items-center gap-6 text-sm">
                <a href="{{ route('home') }}"
                   class="inline-flex items-center gap-1 text-gray-200 hover:text-amber-300 transition whitespace-nowrap">
                    <i class="bi bi-search text-xs"></i>
                    Consulta CNPJ
                </a>

                <a href="{{ route('empresas.index') }}"
                   class="inline-flex items-center gap-1 text-gray-300 hover:text-amber-300 transition whitespace-nowrap">
                    <i class="bi bi-building text-xs"></i>
                    Portal de Empresas
                </a>

                <a href="{{ route('empresas.cnae') }}"
                   class="inline-flex items-center gap-1 text-gray-300 hover:text-amber-300 transition whitespace-nowrap">
                    <i class="bi bi-diagram-3 text-xs"></i>
                    Atividades Econômicas (CNAE)
                </a>
            </nav>

            {{-- BUSCA RÁPIDA DE CNPJ (DESKTOP) --}}
            <div class="hidden md:flex flex-col items-end gap-1 text-right">
                <form
                    action="{{ route('home') }}"
                    method="GET"
                    class="flex items-center gap-2.5 rounded-full border border-white/20 bg-white/10 px-2.5 py-1 text-sm text-white shadow-[0_8px_18px_rgba(0,0,0,0.32)] focus-within:border-amber-400 focus-within:ring-1 focus-within:ring-amber-400/50"
                >
                    <i class="bi bi-search text-base text-amber-200"></i>
                    <input
                        type="text"
                        name="cnpj"
                        id="header-cnpj-desktop"
                        inputmode="numeric"
                        maxlength="18"
                        aria-label="Digite o número do CNPJ"
                        placeholder="Digite o CNPJ com ou sem pontuação"
                        class="w-48 lg:w-60 bg-transparent text-xs md:text-sm outline-none placeholder:text-gray-400"
                    >
                    <button
                        type="submit"
                        class="inline-flex items-center gap-1.5 rounded-full bg-amber-400 px-3.5 py-1.5 text-[11px] md:text-xs font-semibold text-[#111827] hover:bg-amber-300 transition whitespace-nowrap"
                    >
                        <span class="hidden lg:inline">Consultar</span>
                        <span class="lg:hidden">OK</span>
                        <i class="bi bi-arrow-right-short text-lg"></i>
                    </button>
                </form>
                <span class="text-[10px] text-gray-400">Formato automático: 00.000.000/0000-00</span>
            </div>

            {{-- HAMBURGER MOBILE --}}
            <button
                type="button"
                class="lg:hidden inline-flex items-center justify-center rounded-xl border border-white/15 bg-white/5 p-2 text-gray-200"
                onclick="document.getElementById('mobile-nav').classList.toggle('hidden')"
            >
                <i class="bi bi-list text-xl"></i>
            </button>
        </div>
    </div>

    {{-- MENU MOBILE --}}
    <div id="mobile-nav" class="lg:hidden hidden border-t border-white/10 bg-[#050509]">
        <div class="container mx-auto px-6 md:px-10 xl:px-16 py-3 space-y-3 text-sm">
            <form
                action="{{ route('home') }}"
                method="GET"
                class="flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-3 py-1.5 text-xs text-white"
            >
                <i class="bi bi-search text-xs text-gray-400"></i>
                <input
                    type="text"
                    name="cnpj"
                    id="header-cnpj-mobile"
                    inputmode="numeric"
                    placeholder="Digite um CNPJ..."
                    class="w-full bg-transparent text-xs outline-none placeholder:text-gray-500"
                >
                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-full bg-amber-400 px-3 py-1 text-[11px] font-semibold text-black hover:bg-amber-300 transition whitespace-nowrap"
                >
                    Consultar grátis
                </button>
            </form>

            <nav class="flex flex-col gap-1 pt-1">
                <a href="{{ route('home') }}"
                   class="flex items-center justify-between rounded-xl px-3 py-2 text-gray-100 hover:bg-white/5">
                    <span class="inline-flex items-center gap-2 whitespace-nowrap">
                        <i class="bi bi-search text-xs text-amber-300"></i>
                        Consulta CNPJ
                    </span>
                    <i class="bi bi-chevron-right text-xs text-gray-500"></i>
                </a>

                <a href="{{ route('empresas.index') }}"
                   class="flex items-center justify-between rounded-xl px-3 py-2 text-gray-200 hover:bg-white/5">
                    <span class="inline-flex items-center gap-2 whitespace-nowrap">
                        <i class="bi bi-building text-xs text-amber-300"></i>
                        Portal de Empresas
                    </span>
                    <i class="bi bi-chevron-right text-xs text-gray-500"></i>
                </a>

                <a href="{{ route('empresas.cnae') }}"
                   class="flex items-center justify-between rounded-xl px-3 py-2 text-gray-200 hover:bg-white/5">
                    <span class="inline-flex items-center gap-2 whitespace-nowrap">
                        <i class="bi bi-diagram-3 text-xs text-amber-300"></i>
                        Atividades Econômicas (CNAE)
                    </span>
                    <i class="bi bi-chevron-right text-xs text-gray-500"></i>
                </a>
            </nav>
        </div>
    </div>
</header>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.1.3/imask.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputs = [document.getElementById('header-cnpj-desktop'), document.getElementById('header-cnpj-mobile')].filter(Boolean);

        inputs.forEach((cnpjInput) => {
            const mask = IMask(cnpjInput, { mask: '00.000.000/0000-00' });
            const form = cnpjInput.closest('form');
            if (form) {
                form.addEventListener('submit', function() { mask.updateValue(); });
            }
        });
    });
</script>
@endpush
