@props([
    'cnae',
    'empresas',
])

@php
    $codigoNormalizado = str_pad((string) $cnae->codigo, 7, '0', STR_PAD_LEFT);
    $codigoFormatado = $cnae->codigo_formatado ??
        substr($codigoNormalizado, 0, 2) . '.' .
        substr($codigoNormalizado, 2, 2) . '-' .
        substr($codigoNormalizado, 4, 1) . '-' .
        substr($codigoNormalizado, 5);
@endphp

<section class="bg-gray-50 py-16 md:py-20">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-6">
            <div>
                <p class="text-amber-500 font-semibold uppercase text-xs md:text-sm tracking-[0.24em]">
                    Amostra de empresas
                </p>
                <h2 class="mt-2 text-2xl md:text-3xl font-black text-[#111827]">
                    Empresas ativas com CNAE {{ $codigoFormatado }}
                </h2>
                <p class="mt-3 text-sm md:text-base text-gray-600">
                    Abaixo você encontra as últimas 50 empresas abertas no Brasil com este CNAE principal,
                    ordenadas pelas datas de início de atividade mais recentes.
                </p>
            </div>

            <div class="text-xs md:text-sm text-gray-500 max-w-xs">
                <p class="font-medium text-gray-700 mb-1">Navegação:</p>
                <p>Use a busca do navegador (Ctrl+F) para localizar uma razão social específica. Esta
                    lista é uma amostra e não representa todas as empresas existentes no CNAE.</p>
            </div>
        </div>

        <div class="overflow-x-auto rounded-2xl border border-gray-200 bg-white shadow-[0_18px_45px_-28px_rgba(15,23,42,0.55)]">
            <table class="min-w-full text-left text-sm text-gray-700">
                <thead class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-[0.18em] text-gray-500">
                    <tr>
                        <th class="px-4 md:px-6 py-3">CNPJ</th>
                        <th class="px-4 md:px-6 py-3">Razão social</th>
                        <th class="px-4 md:px-6 py-3">UF</th>
                        <th class="px-4 md:px-6 py-3">Início atividade</th>
                        <th class="px-4 md:px-6 py-3 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($empresas as $estab)
                        @php
                            $cnpjLimpo = $estab->cnpj_basico . $estab->cnpj_ordem . $estab->cnpj_dv;

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

                            $razao = $estab->empresa->razao_social ?? 'Razão social não informada';

                            $inicio = $estab->data_inicio_atividade
                                ? \Carbon\Carbon::parse($estab->data_inicio_atividade)->format('d/m/Y')
                                : '—';

                            $urlCnpj = url('/cnpj/' . $cnpjLimpo); // ajuste para sua named route se tiver
                        @endphp

                        <tr class="border-b border-gray-100 hover:bg-amber-50/60 transition-colors">
                            <td class="px-4 md:px-6 py-3 align-top font-mono text-[13px] text-gray-900">
                                {{ $cnpjFormatado }}
                            </td>
                            <td class="px-4 md:px-6 py-3 align-top">
                                <p class="font-semibold text-gray-900 text-sm">
                                    {{ $razao }}
                                </p>
                            </td>
                            <td class="px-4 md:px-6 py-3 align-top text-sm text-gray-700">
                                {{ $estab->uf ?? '—' }}
                            </td>
                            <td class="px-4 md:px-6 py-3 align-top text-sm text-gray-700">
                                {{ $inicio }}
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
                            <td colspan="5" class="px-4 md:px-6 py-6 text-center text-sm text-gray-500">
                                Nenhuma empresa ativa encontrada na amostra deste CNAE.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <p class="mt-4 text-[11px] md:text-xs text-gray-500">
            Esta é apenas uma amostra com limite de registros. A base completa de empresas para este CNAE
            pode ser muito maior, dependendo do setor.
        </p>
    </div>
</section>
