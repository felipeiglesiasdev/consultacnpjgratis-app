@props([
    'empresas',
    'municipio',
    'ufReal',
])

@php
    $nomeCidade = ucwords(mb_strtolower($municipio->descricao, 'UTF-8'));
@endphp

<section class="bg-white py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-6">
            <div>
                <p class="text-amber-500 font-semibold uppercase text-xs md:text-sm tracking-[0.24em]">
                    Lista de empresas
                </p>
            <h2 class="mt-2 text-2xl md:text-3xl font-black text-[#111827]">
                    Empresas ativas em {{ $nomeCidade }} / {{ $ufReal->uf }}
                </h2>
                <p class="mt-3 text-sm md:text-base text-gray-600">
                    Abaixo estão listadas as empresas ativas do município. Cada linha exibe o CNPJ,
                    razão social, capital social e um atalho para acessar a página completa do CNPJ.
                </p>
            </div>

            <div class="text-xs md:text-sm text-gray-500 max-w-xs">
                <p class="font-medium text-gray-700 mb-1">Navegação:</p>
                <p>Use a paginação para ver mais empresas. Você também pode usar a busca do navegador (Ctrl+F) para localizar um nome específico.</p>
            </div>
        </div>

        <div class="overflow-x-auto rounded-2xl border border-gray-200 bg-white shadow-[0_18px_45px_-28px_rgba(15,23,42,0.55)]">
            <table class="min-w-full text-left text-sm text-gray-700">
                <thead class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-[0.18em] text-gray-500">
                    <tr>
                        <th class="px-4 md:px-6 py-3">CNPJ</th>
                        <th class="px-4 md:px-6 py-3">Razão social</th>
                        <th class="px-4 md:px-6 py-3">Capital social</th>
                        <th class="px-4 md:px-6 py-3 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($empresas as $empresa)
                        @php
                            $cnpjLimpo = $empresa->cnpj_basico . $empresa->cnpj_ordem . $empresa->cnpj_dv;

                            if (strlen($cnpjLimpo) === 14) {
                                $cnpjFormatado =
                                    substr($cnpjLimpo, 0, 2) . '.' .
                                    substr($cnpjLimpo, 2, 3) . '.' .
                                    substr($cnpjLimpo, 5, 3) . '/' .
                                    substr($cnpjLimpo, 8, 4) . '-' .
                                    substr($cnpjLimpo, 12);
                            } else {
                                $cnpjFormatado = $cnpjLimpo;
                            }

                            $capital = $empresa->empresa->capital_social ?? null;
                            $capitalFormatado = $capital !== null
                                ? 'R$ ' . number_format($capital, 2, ',', '.')
                                : '—';

                            // URL da página do CNPJ (ajusta se tiver uma named route específica)
                            $urlCnpj = url('/cnpj/' . $cnpjLimpo);
                        @endphp

                        <tr class="border-b border-gray-100 hover:bg-amber-50/60 transition-colors">
                            <td class="px-4 md:px-6 py-3 align-top font-mono text-[13px] text-gray-900">
                                {{ $cnpjFormatado }}
                            </td>
                            <td class="px-4 md:px-6 py-3 align-top">
                                <p class="font-semibold text-gray-900 text-sm">
                                    {{ $empresa->empresa->razao_social ?? 'Razão social não informada' }}
                                </p>
                            </td>
                            <td class="px-4 md:px-6 py-3 align-top text-sm text-gray-700">
                                {{ $capitalFormatado }}
                            </td>
                            <td class="px-4 md:px-6 py-3 align-top text-right">
                                <a
                                    href="{{ $urlCnpj }}"
                                    class="inline-flex items-center gap-1 rounded-full border border-amber-300 bg-amber-50 px-3 py-1.5 text-[11px] md:text-xs font-medium text-amber-800 hover:bg-amber-100 hover:border-amber-400 transition"
                                >
                                    <i class="bi bi-box-arrow-up-right text-xs"></i>
                                    Ver CNPJ
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 md:px-6 py-6 text-center text-sm text-gray-500">
                                Nenhuma empresa ativa encontrada para este município.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $empresas->links() }}
        </div>
    </div>
</section>
