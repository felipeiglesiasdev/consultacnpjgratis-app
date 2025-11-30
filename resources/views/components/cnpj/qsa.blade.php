@props(['data'])

@php
    $qsa = $data['quadro_societario'] ?? [];
@endphp

@if (!empty($qsa))
<div id="quadro-societario" class="rounded-2xl border border-gray-200 bg-white shadow-[0_18px_45px_-28px_rgba(15,23,42,0.55)]">
    <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
        <span class="inline-flex items-center justify-center h-9 w-9 rounded-2xl bg-gray-900/5 text-gray-700">
            <i class="bi bi-people text-lg"></i>
        </span>
        <div>
            <h2 class="text-sm font-semibold text-gray-900">Quadro societário (QSA)</h2>
            <p class="text-[11px] text-gray-500">
                Sócios e administradores conforme cadastro oficial
            </p>
        </div>
    </div>

    <div class="px-5 py-5">
        <div class="overflow-x-auto rounded-2xl border border-gray-100">
            <table class="min-w-full divide-y divide-gray-100 text-sm">
                <thead class="bg-gray-50 text-[11px] uppercase tracking-[0.18em] text-gray-500">
                    <tr>
                        <th class="px-4 py-3 text-left">Nome</th>
                        <th class="px-4 py-3 text-left">Tipo</th>
                        <th class="px-4 py-3 text-left">Qualificação</th>
                        <th class="px-4 py-3 text-left">Entrada</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($qsa as $socio)
                        <tr class="hover:bg-amber-50/50 transition-colors">
                            <td class="px-4 py-3 whitespace-nowrap text-gray-900 font-medium">
                                {{ $socio['nome'] ?? 'Não informado' }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-gray-600">
                                {{ $socio['tipo_socio'] ?? '—' }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-gray-600">
                                {{ $socio['qualificacao'] ?? '—' }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-gray-600">
                                {{ $socio['data_entrada'] ?? '—' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <p class="mt-3 text-[11px] text-gray-500">
            Essas informações ajudam a identificar quem são os responsáveis formais pela empresa,
            o que é útil em análises de risco, compliance e crédito.
        </p>
    </div>
</div>
@endif
