@props(['totalAtivas', 'totalEncerradas'])

<section class="bg-white py-14 md:py-16">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <p class="text-amber-500 font-semibold uppercase text-sm tracking-widest">Panorama em tempo real</p>
                <h2 class="text-3xl font-black text-[#171717]">O Brasil empresarial em números</h2>
                <p class="text-gray-600 mt-2">Dados oficiais para ajudar na sua análise e tomada de decisão.</p>
            </div>
            <a href="{{ route('home') }}#consultar" class="inline-flex items-center gap-3 px-5 py-3 rounded-full bg-amber-500 text-black font-semibold shadow-lg shadow-amber-500/30 hover:-translate-y-0.5 transition-all duration-300">
                Fazer nova consulta
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 rounded-2xl border border-gray-200 bg-gradient-to-b from-white to-amber-50/40 shadow-[0_18px_45px_-30px_rgba(0,0,0,0.55)]">
                <p class="text-sm text-gray-500">Empresas ativas</p>
                <p class="text-4xl font-black text-[#171717] mt-1">{{ number_format($totalAtivas, 0, ',', '.') }}</p>
                <p class="text-gray-500 mt-2 text-sm">Estabelecimentos funcionando e cumprindo suas obrigações.</p>
            </div>
            <div class="p-6 rounded-2xl border border-gray-200 bg-gradient-to-b from-white to-gray-50 shadow-[0_18px_45px_-30px_rgba(0,0,0,0.55)]">
                <p class="text-sm text-gray-500">Empresas encerradas</p>
                <p class="text-4xl font-black text-[#171717] mt-1">{{ number_format($totalEncerradas, 0, ',', '.') }}</p>
                <p class="text-gray-500 mt-2 text-sm">Negócios que baixaram, suspenderam ou ficaram inaptos.</p>
            </div>
            <div class="p-6 rounded-2xl border border-gray-200 bg-gradient-to-b from-white to-amber-50/60 shadow-[0_18px_45px_-30px_rgba(0,0,0,0.55)]">
                <p class="text-sm text-gray-500">Cobertura nacional</p>
                <p class="text-4xl font-black text-[#171717] mt-1">100%</p>
                <p class="text-gray-500 mt-2 text-sm">Consulta rápida de qualquer CNPJ, estado ou atividade econômica.</p>
            </div>
        </div>
    </div>
</section>
