<section class="bg-white text-gray-900 py-16 md:py-20 border-t border-gray-100">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="max-w-3xl mx-auto text-center">
            <p class="text-amber-600 font-bold tracking-[0.26em] uppercase text-xs md:text-sm">
                Quer ir direto ao ponto?
            </p>
            <h2 class="mt-3 text-3xl md:text-4xl font-black text-gray-900">
                Consulte um CNPJ específico agora mesmo
            </h2>
            <p class="mt-4 text-sm md:text-base text-gray-600">
                Se você já tem uma empresa em mente, use o campo abaixo para consultar
                a situação cadastral, cidade, estado, CNAEs e muito mais.
                Tudo isso de forma 100% gratuita, com dados oficiais da Receita Federal.
            </p>
        </div>

        <form action="{{ route('cnpj.consultar') }}" method="POST" class="max-w-2xl mx-auto mt-8">
            @csrf
            <div class="flex flex-col sm:flex-row gap-3 items-stretch">
                <div class="relative flex-1">
                    <label for="cnpj_footer" class="sr-only">CNPJ ou nome da empresa</label>
                    <input
                        type="tel" 
                        name="cnpj" 
                        id="cnpj-input-aside" 
                        placeholder="Digite o CNPJ 00.000.000/0000-00"
                        required
                        aria-label="Número do CNPJ"
                        class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3.5 pr-10 text-sm md:text-base text-gray-900 placeholder:text-gray-400 shadow-sm transition-all focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/20"
                    >
                    <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-gray-400">
                        <i class="bi bi-building"></i>
                    </span>
                </div>

                <button
                    type="submit"
                    class="cursor-pointer inline-flex items-center justify-center rounded-2xl px-6 md:px-8 py-3.5 text-sm md:text-base font-bold bg-amber-400 text-black hover:bg-amber-500 shadow-md shadow-amber-500/20 transition-transform duration-200 hover:-translate-y-0.5"
                >
                    <i class="bi bi-search mr-2"></i>
                    Consultar CNPJ
                </button>
            </div>

            <p class="mt-4 flex flex-wrap items-center justify-center gap-2 text-[11px] md:text-xs text-gray-500 font-medium">
                <span class="inline-flex items-center gap-1">
                    <i class="bi bi-shield-check text-emerald-600"></i>
                    Dados oficiais e atualizados
                </span>
                <span>•</span>
                <span>Consulta gratuita e ilimitada</span>
            </p>
        </form>
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