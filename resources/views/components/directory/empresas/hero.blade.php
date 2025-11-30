@props(['totalEmpresasAtivas', 'mediaAberturasMensal', 'novasEmpresasTrimestre'])

<section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-amber-100 via-white to-amber-50 border border-amber-100 shadow-xl">
    <div class="absolute inset-0 opacity-50 pointer-events-none" aria-hidden="true">
        <div class="absolute -left-24 -top-24 h-64 w-64 bg-amber-200 blur-3xl rounded-full"></div>
        <div class="absolute -right-20 bottom-0 h-64 w-64 bg-amber-300 blur-3xl rounded-full"></div>
    </div>

    <div class="relative grid grid-cols-1 lg:grid-cols-12 gap-10 p-10 lg:p-14">
        <div class="lg:col-span-7 flex flex-col gap-6">
            <p class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-semibold bg-white/80 text-amber-800 border border-amber-200 shadow-sm">
                <span class="h-2 w-2 rounded-full bg-amber-500 animate-pulse"></span>
                Inteligência empresarial em tempo real
            </p>
            <h1 class="text-4xl md:text-5xl font-black text-[#171717] leading-tight">
                Descubra empresas por estado, cidade ou atividade econômica
            </h1>
            <p class="text-lg text-gray-700 max-w-3xl">
                Filtre o mapa corporativo do Brasil com indicadores atuais e navegação por setores. Tudo em componentes modulares, rápidos e prontos para receber novas fontes de dados.
            </p>

            <div class="flex flex-col sm:flex-row gap-4">
                <a href="#estados" class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-[#171717] text-white font-semibold shadow-lg shadow-amber-200/70 hover:-translate-y-0.5 hover:shadow-xl transition-transform duration-200">
                    Explorar estados
                </a>
                <a href="{{ route('empresas.cnae.index') }}" class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-white text-amber-900 font-semibold border border-amber-200 hover:border-amber-400 hover:text-[#171717] transition-colors duration-200">
                    Atividades em destaque
                </a>
            </div>
        </div>

        <div class="lg:col-span-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="rounded-2xl bg-white/90 border border-amber-100 p-5 shadow-lg">
                <p class="text-sm font-semibold text-amber-700">Empresas ativas</p>
                <p class="text-3xl md:text-4xl font-black text-[#171717] tracking-tight mt-2">{{ number_format($totalEmpresasAtivas, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500 mt-2">base nacional em atualização contínua</p>
            </div>
            <div class="rounded-2xl bg-[#171717] text-white p-5 shadow-lg flex flex-col justify-between">
                <div>
                    <p class="text-sm font-semibold text-amber-200">Abertura média mensal</p>
                    <p class="text-3xl md:text-4xl font-black tracking-tight mt-2">{{ number_format($mediaAberturasMensal, 0, ',', '.') }}</p>
                    <p class="text-sm text-amber-100/80 mt-2">média dos últimos 12 meses</p>
                </div>
                <div class="mt-6 rounded-xl bg-white/10 border border-white/10 px-4 py-3 flex items-center justify-between">
                    <span class="text-sm">Novas empresas no último trimestre</span>
                    <span class="text-lg font-semibold text-amber-200">+{{ number_format($novasEmpresasTrimestre, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</section>
