@props(['totalAtivas', 'totalEncerradas'])

<section class="bg-white py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">
            <div class="max-w-2xl">
                <p class="text-amber-500 font-semibold uppercase text-xs md:text-sm tracking-[0.24em]">
                    Panorama em tempo real
                </p>
                <h2 class="mt-2 text-3xl md:text-4xl font-black text-[#111827]">
                    O Brasil empresarial em números
                </h2>
                <p class="mt-3 text-sm md:text-base text-gray-600">
                    Acompanhe quantas empresas estão ativas, quantas foram encerradas
                    e tenha uma visão clara do cenário de negócios no país.
                </p>
            </div>

            <a href="{{ route('home') }}#consultar"
               class="inline-flex items-center gap-2 rounded-full border border-amber-200 bg-amber-50 px-4 py-2 text-xs md:text-sm font-medium text-amber-700 shadow-sm hover:bg-amber-100 hover:-translate-y-0.5 transition-all duration-200">
                Fazer nova consulta
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Empresas ativas --}}
            <div class="group relative overflow-hidden rounded-2xl border border-emerald-100 bg-gradient-to-b from-white to-emerald-50/70 shadow-[0_18px_45px_-28px_rgba(15,23,42,0.55)]">
                <div class="absolute inset-x-0 -top-1 h-1 bg-gradient-to-r from-emerald-400 via-emerald-500 to-emerald-400 opacity-80"></div>
                <div class="p-6 md:p-7">
                    <p class="text-[11px] md:text-xs font-semibold uppercase tracking-[0.22em] text-emerald-700">
                        Empresas ativas
                    </p>
                    <p class="mt-2 text-3xl md:text-4xl font-black text-[#111827]">
                        {{ number_format($totalAtivas, 0, ',', '.') }}
                    </p>
                    <p class="mt-3 text-sm text-gray-600">
                        CNPJs em situação regular na Receita Federal, prontos para fazer negócios.
                    </p>
                </div>
            </div>

            {{-- Empresas encerradas --}}
            <div class="group relative overflow-hidden rounded-2xl border border-rose-100 bg-gradient-to-b from-white to-rose-50/70 shadow-[0_18px_45px_-28px_rgba(15,23,42,0.55)]">
                <div class="absolute inset-x-0 -top-1 h-1 bg-gradient-to-r from-rose-400 via-amber-400 to-rose-500 opacity-80"></div>
                <div class="p-6 md:p-7">
                    <p class="text-[11px] md:text-xs font-semibold uppercase tracking-[0.22em] text-rose-700">
                        Empresas encerradas
                    </p>
                    <p class="mt-2 text-3xl md:text-4xl font-black text-[#111827]">
                        {{ number_format($totalEncerradas, 0, ',', '.') }}
                    </p>
                    <p class="mt-3 text-sm text-gray-600">
                        Negócios baixados, suspensos ou inaptos — importante para evitar riscos na prospecção.
                    </p>
                </div>
            </div>

            {{-- Cobertura nacional --}}
            <div class="group relative overflow-hidden rounded-2xl border border-amber-100 bg-gradient-to-b from-white to-amber-50/70 shadow-[0_18px_45px_-28px_rgba(15,23,42,0.55)]">
                <div class="absolute inset-x-0 -top-1 h-1 bg-gradient-to-r from-amber-400 via-amber-500 to-amber-400 opacity-80"></div>
                <div class="p-6 md:p-7">
                    <p class="text-[11px] md:text-xs font-semibold uppercase tracking-[0.22em] text-amber-700">
                        Cobertura nacional
                    </p>
                    <p class="mt-2 text-3xl md:text-4xl font-black text-[#111827]">
                        100%
                    </p>
                    <p class="mt-3 text-sm text-gray-600">
                        Consulta rápida de qualquer CNPJ, em todos os estados e atividades econômicas (CNAEs).
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
