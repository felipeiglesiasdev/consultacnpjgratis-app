
<div x-data="{ 
        mobileMenuOpen: false, 
        scrolled: false,
        init() {
            window.addEventListener('scroll', () => { this.scrolled = window.scrollY > 20 });
            
            // Bloqueia o scroll do body quando o menu abre
            this.$watch('mobileMenuOpen', value => {
                document.body.style.overflow = value ? 'hidden' : '';
            });
        }
    }"
>
    <!-- BARRA DE NAVEGAÇÃO STICKY -->
    <header 
        :class="{ 'bg-[#050509]/95 backdrop-blur-xl border-b border-white/10 shadow-lg': scrolled, 'bg-[#050509]/90 backdrop-blur-md border-b border-white/5': !scrolled }"
        class="sticky top-0 z-40 w-full transition-all duration-300 py-4 lg:py-5"
    >
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="flex items-center gap-6 lg:gap-10">
                
                <!-- 1. LOGO PRINCIPAL -->
                <a href="{{ route('home') }}" class="group flex items-center gap-3 decoration-0 focus:outline-none shrink-0">
                    <div class="relative flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 text-white shadow-lg shadow-amber-500/20 transition-transform duration-500 ease-out group-hover:scale-110 group-hover:rotate-6">
                        <i class="bi bi-search text-xl drop-shadow-md"></i>
                        <div class="absolute inset-0 rounded-xl bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                    
                    <div class="flex flex-col leading-none">
                        <span class="font-bold text-gray-100 text-xl tracking-tight transition-colors group-hover:text-white">
                            Consulta<span class="text-amber-400">CNPJ</span>
                        </span>
                        <span class="text-[0.65rem] font-bold uppercase tracking-[0.25em] text-gray-500 transition-colors group-hover:text-amber-400/80 mt-0.5">
                            Grátis
                        </span>
                    </div>
                </a>

                <!-- 2. NAVEGAÇÃO DESKTOP -->
                <nav class="hidden lg:flex items-center gap-2">
                    <a href="{{ route('home') }}" class="relative px-4 py-2 text-sm font-medium text-gray-300 transition-all duration-300 hover:text-white group">
                        <span class="relative z-10 flex items-center gap-2">
                            <i class="bi bi-house-door text-amber-500/70 group-hover:text-amber-400 transition-colors"></i>
                            Início
                        </span>
                        <span class="absolute inset-0 rounded-full bg-white/5 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></span>
                    </a>
                    
                    <a href="{{ route('empresas.index') }}" class="relative px-4 py-2 text-sm font-medium text-gray-300 transition-all duration-300 hover:text-white group">
                        <span class="relative z-10 flex items-center gap-2">
                            <i class="bi bi-building text-amber-500/70 group-hover:text-amber-400 transition-colors"></i>
                            Portal de Empresas
                        </span>
                        <span class="absolute inset-0 rounded-full bg-white/5 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></span>
                    </a>

                    <div class="h-4 w-px bg-white/10 mx-2"></div>

                    <a href="{{ route('consulta_avancada.index') }}" class="group relative flex items-center gap-2 rounded-full border border-amber-500/30 bg-amber-500/10 px-5 py-2 text-sm font-bold text-amber-400 transition-all duration-300 hover:border-amber-400 hover:bg-amber-500 hover:text-white hover:shadow-[0_0_20px_rgba(251,191,36,0.3)] hover:-translate-y-0.5">
                        <i class="bi bi-stars transition-transform duration-300 group-hover:rotate-12"></i>
                        <span>Consulta Avançada</span>
                    </a>
                </nav>

                <!-- 3. BUSCA & AÇÕES -->
                <div class="flex items-center justify-end gap-3 flex-1 lg:flex-none ml-auto">
                    
                    <!-- Form Desktop -->
                    <form action="{{ route('cnpj.consultar') }}" method="POST" class="relative group hidden sm:block w-full lg:w-[380px]">
                        @csrf
                        <input 
                            id="header-cnpj-desktop"
                            type="search" 
                            name="cnpj" 
                            class="block w-full rounded-full border border-white/10 bg-white/5 py-2.5 pl-5 pr-[140px] text-sm text-white placeholder-gray-500 shadow-sm transition-all duration-300 focus:border-amber-500/50 focus:bg-white/10 focus:ring-2 focus:ring-amber-500/20 hover:bg-white/10" 
                            placeholder="00.000.000/0000-00" 
                            required 
                            minlength="3"
                            autocomplete="off"
                            @keydown.enter="$el.closest('form').submit()"
                        >
                        <button type="submit" class="absolute right-1.5 top-1.5 bottom-1.5 rounded-full bg-gradient-to-r from-amber-500 to-amber-600 px-4 text-xs font-bold uppercase tracking-wide text-white hover:from-amber-400 hover:to-amber-500 transition-all shadow-lg shadow-amber-500/20 flex items-center gap-2 group/btn">
                            <span>Buscar CNPJ</span>
                            <i class="bi bi-arrow-right transition-transform group-hover/btn:translate-x-1"></i>
                        </button>
                    </form>

                    <!-- Mobile Toggle Button -->
                    <button 
                        @click="mobileMenuOpen = true" 
                        class="lg:hidden relative p-2 text-gray-400 transition-colors hover:text-amber-400 focus:outline-none"
                        aria-label="Open menu"
                    >
                        <i class="bi bi-list text-3xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- 4. MENU MOBILE FULL SCREEN (Slide-Over da Direita) -->
    <template x-teleport="body">
        <div 
            x-show="mobileMenuOpen"
            class="fixed inset-0 z-[9999] flex justify-end lg:hidden"
            role="dialog"
            aria-modal="true"
            style="display: none;"
        >
            <!-- Backdrop (Fundo escuro suave) -->
            <div 
                x-show="mobileMenuOpen"
                x-transition:enter="transition-opacity ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-in duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black/80 backdrop-blur-sm"
                @click="mobileMenuOpen = false"
            ></div>

            <!-- Painel Deslizante (Sólido e Ocupando a tela INTEIRA) -->
            <div 
                x-show="mobileMenuOpen"
                x-transition:enter="transform transition ease-out duration-300"
                x-transition:enter-start="translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition ease-in duration-300"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full"
                class="relative w-full h-full bg-[#050509] shadow-2xl flex flex-col"
            >
                <!-- Cabeçalho do Menu Mobile -->
                <div class="flex items-center justify-between px-6 py-5 border-b border-white/10 bg-[#050509]">
                    
                    <!-- Logo Mobile (Variação de Cor) -->
                    <a href="{{ route('home') }}" class="flex items-center gap-3 decoration-0 focus:outline-none">
                        <!-- Icone mais alaranjado -->
                        <div class="relative flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-orange-500 to-amber-600 text-white shadow-lg shadow-orange-500/20">
                            <i class="bi bi-search text-lg"></i>
                        </div>
                        <div class="flex flex-col leading-none">
                            <span class="font-bold text-gray-100 text-xl tracking-tight">
                                Consulta<span class="text-orange-500">CNPJ</span>
                            </span>
                            <span class="text-[0.6rem] font-bold uppercase tracking-[0.25em] text-gray-500 mt-0.5">
                                Menu
                            </span>
                        </div>
                    </a>

                    <!-- Botão Fechar -->
                    <button 
                        @click="mobileMenuOpen = false" 
                        class="p-2 text-gray-400 hover:text-white hover:bg-white/10 rounded-full transition-all"
                    >
                        <i class="bi bi-x-lg text-2xl"></i>
                    </button>
                </div>

                <!-- Conteúdo -->
                <div class="flex-1 overflow-y-auto p-6 space-y-8 bg-[#050509]">
                    
                    <!-- Busca Mobile -->
                    <div class="space-y-3">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider ml-1">Consultar</label>
                        <form action="{{ route('cnpj.consultar') }}" method="POST" class="relative group">
                            @csrf
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-amber-500">
                                <i class="bi bi-search text-lg"></i>
                            </div>
                            <input 
                                id="header-cnpj-mobile"
                                type="search" 
                                name="cnpj" 
                                class="block w-full rounded-2xl border border-white/10 bg-white/5 py-4 pl-12 pr-14 text-base text-white placeholder-gray-500 focus:border-amber-500 focus:bg-white/[0.07] focus:outline-none focus:ring-1 focus:ring-amber-500 transition-all" 
                                placeholder="00.000.000/0000-00" 
                            >
                            <button type="submit" class="absolute right-2 top-2 bottom-2 aspect-square bg-amber-500 text-black flex items-center justify-center rounded-xl hover:bg-amber-400 transition-colors shadow-lg shadow-amber-500/20">
                                <i class="bi bi-arrow-right text-lg"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Links -->
                    <nav class="flex flex-col space-y-2">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider ml-1 mb-1">Navegação</label>
                        
                        <a href="{{ route('home') }}" class="flex items-center gap-4 rounded-2xl p-4 text-gray-300 hover:bg-white/5 hover:text-white border border-transparent hover:border-white/5 transition-all group">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/5 text-gray-400 group-hover:bg-amber-500/20 group-hover:text-amber-400 transition-colors">
                                <i class="bi bi-house-door-fill text-lg"></i>
                            </div>
                            <span class="font-medium text-lg">Início</span>
                            <i class="bi bi-chevron-right ml-auto text-gray-600 group-hover:text-gray-400"></i>
                        </a>

                        <a href="{{ route('empresas.index') }}" class="flex items-center gap-4 rounded-2xl p-4 text-gray-300 hover:bg-white/5 hover:text-white border border-transparent hover:border-white/5 transition-all group">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/5 text-gray-400 group-hover:bg-amber-500/20 group-hover:text-amber-400 transition-colors">
                                <i class="bi bi-building-fill text-lg"></i>
                            </div>
                            <span class="font-medium text-lg">Portal de Empresas</span>
                            <i class="bi bi-chevron-right ml-auto text-gray-600 group-hover:text-gray-400"></i>
                        </a>

                        <a href="{{ route('consulta_avancada.index') }}" class="flex items-center gap-4 rounded-2xl p-4 text-amber-400 bg-amber-500/5 border border-amber-500/20 hover:bg-amber-500/10 transition-all group mt-2">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-amber-500/10 text-amber-500 group-hover:text-amber-400 transition-colors">
                                <i class="bi bi-stars text-lg"></i>
                            </div>
                            <span class="font-medium text-lg">Consulta Avançada</span>
                            <i class="bi bi-arrow-right ml-auto text-amber-500/50 group-hover:text-amber-500"></i>
                        </a>
                    </nav>
                </div>
                
                <!-- Footer -->
                <div class="mt-auto px-6 py-4 bg-[#050509] border-t border-white/10">
                    <p class="text-xs text-center text-gray-600">
                        &copy; {{ date('Y') }} Consulta CNPJ Grátis. <br>Todos os direitos reservados.
                    </p>
                </div>
            </div>
        </div>
    </template>
</div>

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