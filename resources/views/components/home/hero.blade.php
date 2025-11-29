<section id="consultar" class="relative overflow-hidden bg-gradient-to-b from-[#171717] via-[#111] to-black text-white">
    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_20%_20%,rgba(251,191,36,0.25),transparent_30%),radial-gradient(circle_at_80%_0%,rgba(251,191,36,0.2),transparent_25%),radial-gradient(circle_at_50%_80%,rgba(251,191,36,0.18),transparent_28%)]"></div>
    <div class="container mx-auto px-4 py-20 md:py-28 relative">
        <div class="max-w-4xl mx-auto text-center space-y-8">
            <p class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-amber-400/50 bg-white/5 text-amber-200 text-sm font-semibold shadow-lg shadow-amber-500/10">
                <span class="h-2 w-2 rounded-full bg-amber-400 animate-ping"></span>
                Consulta CNPJ gratuita com dados oficiais e atualizados
            </p>
            <h1 class="text-4xl md:text-6xl font-black tracking-tight leading-tight">
               Consulte qualquer CNPJ do Brasil em <span class="text-amber-400">segundos</span>.
            </h1>
            <p class="text-lg md:text-xl text-gray-200 max-w-3xl mx-auto">
                Busque CNPJs sem limites, visualize atividades, situação cadastral da empresa, capital social e acompanhe a evolução do mercado de empresas.
            </p>
            <form action="{{ route('cnpj.consultar') }}" method="POST" class="max-w-2xl mx-auto">
                @csrf
                <div class="relative flex items-center bg-white/5 border border-white/10 rounded-full shadow-2xl overflow-hidden focus-within:border-amber-400/60 transition-all">
                    <div class="absolute inset-y-0 left-4 flex items-center text-amber-300">
                        <i class="bi bi-search text-xl"></i>
                    </div>
                    <input
                        type="tel" 
                        name="cnpj" 
                        id="cnpj-input-aside" 
                        class="w-full pl-12 pr-4 py-4 bg-transparent text-white placeholder-gray-400 focus:outline-none"
                        placeholder="Digite o CNPJ (00.000.000/0000-00)"
                        required
                        aria-label="Número do CNPJ"
                    >
                    <button type="submit" class="cursor-pointer relative bg-amber-400 text-black font-bold px-6 md:px-8 py-3 md:py-4 h-full hover:bg-amber-300 transition-all duration-300">
                        <span class="flex items-center gap-2">
                            Consultar
                            <i class="bi bi-arrow-right"></i>
                        </span>
                    </button>
                </div>
            </form>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-left">
                <div class="p-4 rounded-xl bg-white/5 border border-white/10 backdrop-blur">
                    <p class="text-xs uppercase tracking-wide text-gray-400">Base oficial</p>
                    <p class="text-lg font-semibold text-amber-300">Receita Federal atualizada</p>
                </div>
                <div class="p-4 rounded-xl bg-white/5 border border-white/10 backdrop-blur">
                    <p class="text-xs uppercase tracking-wide text-gray-400">Sem limites</p>
                    <p class="text-lg font-semibold text-amber-300">Consultas ilimitadas</p>
                </div>
                <div class="p-4 rounded-xl bg-white/5 border border-white/10 backdrop-blur">
                    <p class="text-xs uppercase tracking-wide text-gray-400">Foco em segurança</p>
                    <p class="text-lg font-semibold text-amber-300">Dados públicos protegidos</p>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.1.3/imask.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cnpjInput = document.getElementById('cnpj-input-aside');
        if (cnpjInput) {
            const mask = IMask(cnpjInput, { mask: '00.000.000/0000-00' });
            const form = cnpjInput.closest('form');
            if (form) {
                form.addEventListener('submit', function() { mask.updateValue(); });
            }
        }
    });
</script>
@endpush