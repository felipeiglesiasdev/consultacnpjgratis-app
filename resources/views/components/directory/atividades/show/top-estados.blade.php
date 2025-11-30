@props([
    'cnae',
    'topEstados',
])

<section class="bg-white py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
            <div class="max-w-xl">
                <p class="text-amber-500 font-semibold uppercase text-xs md:text-sm tracking-[0.24em]">
                    Distribuição geográfica
                </p>
                <h2 class="mt-2 text-2xl md:text-3xl font-black text-[#111827]">
                    Estados com mais empresas neste CNAE
                </h2>
                <p class="mt-3 text-sm md:text-base text-gray-600">
                    Veja em quais estados esta atividade econômica é mais presente. Use esses dados
                    para priorizar regiões em campanhas e ações comerciais.
                </p>
            </div>

            <div class="text-xs md:text-sm text-gray-500 max-w-sm">
                <p class="font-medium text-gray-700 mb-1">Dica:</p>
                <p>Combine os estados com mais empresas neste CNAE com o portal de empresas por UF
                    para aprofundar a análise e montar listas ainda mais específicas.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            @foreach ($topEstados as $estado)
                @php
                    $uf = $estado->uf;
                    // você pode aproveitar o mesmo map de nomes de UF usado em outros componentes, se quiser
                @endphp

                <a
                    href="{{ route('empresas.state', ['uf' => strtolower($uf)]) }}"
                    class="group rounded-2xl border border-gray-200 bg-gradient-to-b from-white to-amber-50/40 px-4 py-4 shadow-[0_14px_35px_-24px_rgba(15,23,42,0.6)] hover:-translate-y-0.5 hover:border-amber-400 hover:shadow-[0_18px_45px_-24px_rgba(15,23,42,0.8)] transition-all duration-150"
                >
                    <div class="flex items-center justify-between gap-2 mb-2">
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-xl bg-amber-500/15 text-amber-700 text-sm font-bold group-hover:bg-amber-500 group-hover:text-[#171717] transition">
                            {{ $uf }}
                        </span>
                        <i class="bi bi-arrow-up-right text-gray-400 text-xs group-hover:text-amber-500"></i>
                    </div>

                    <div class="space-y-1">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">
                            Empresas ativas neste CNAE
                        </p>
                        <p class="text-lg font-extrabold text-[#111827]">
                            {{ number_format($estado->total, 0, ',', '.') }}
                        </p>
                    </div>

                    <p class="mt-2 text-[11px] text-gray-500">
                        Ver painel de empresas do estado
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</section>
