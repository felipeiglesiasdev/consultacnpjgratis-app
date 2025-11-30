<section class="bg-gradient-to-b from-black via-[#050509] to-black text-white py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="max-w-3xl mx-auto text-center">
            <p class="text-amber-400 font-semibold tracking-[0.26em] uppercase text-xs md:text-sm">
                Quer ir direto ao ponto?
            </p>
            <h2 class="mt-3 text-3xl md:text-4xl font-black">
                Consulte um CNPJ específico agora mesmo
            </h2>
            <p class="mt-4 text-sm md:text-base text-gray-300">
                Se você já tem uma empresa em mente, use o campo abaixo para consultar
                a situação cadastral, endereço, quadro societário, CNAEs e muito mais.
                Tudo isso de forma 100% gratuita, com dados oficiais da Receita Federal.
            </p>
        </div>

        <form action="{{ route('cnpj.consultar') }}" method="POST" class="max-w-2xl mx-auto mt-8">
            @csrf
            <div class="flex flex-col sm:flex-row gap-3 items-stretch">
                <div class="relative flex-1">
                    <label for="cnpj_footer" class="sr-only">CNPJ ou nome da empresa</label>
                    <input
                        id="cnpj_footer"
                        name="cnpj"
                        type="text"
                        inputmode="numeric"
                        autocomplete="off"
                        placeholder="Digite o CNPJ ou o nome da empresa"
                        class="w-full rounded-2xl border border-white/15 bg-white/5 px-4 py-3.5 pr-10 text-sm md:text-base text-white placeholder:text-gray-400 shadow-[0_18px_50px_rgba(0,0,0,0.75)] focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-500/40"
                    >
                    <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-500">
                        <i class="bi bi-building"></i>
                    </span>
                </div>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-2xl px-6 md:px-8 py-3.5 text-sm md:text-base font-semibold bg-amber-400 text-[#171717] hover:bg-amber-300 shadow-lg shadow-amber-500/30 transition-transform duration-200 hover:-translate-y-0.5"
                >
                    <i class="bi bi-search mr-2"></i>
                    Consultar CNPJ
                </button>
            </div>

            <p class="mt-3 flex flex-wrap items-center justify-center gap-2 text-[11px] md:text-xs text-gray-400">
                <span class="inline-flex items-center gap-1">
                    <i class="bi bi-shield-check text-emerald-300"></i>
                    Dados oficiais e atualizados
                </span>
                <span>•</span>
                <span>Consulta gratuita e ilimitada</span>
            </p>
        </form>
    </div>
</section>
