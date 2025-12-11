@props(['data'])

@php
    $cidadeUf    = $data['cidade_uf']   ?? null;
@endphp

<div id="endereco" class="rounded-2xl border border-gray-200 bg-white shadow-[0_18px_45px_-28px_rgba(15,23,42,0.55)]">
    <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
        <span class="inline-flex items-center justify-center h-9 w-9 rounded-2xl bg-gray-900/5 text-gray-700">
            <i class="bi bi-geo-alt text-lg"></i>
        </span>
        <div>
            <h2 class="text-sm font-semibold text-gray-900">Endereço</h2>
            <p class="text-[11px] text-gray-500">
                Localização do estabelecimento cadastrado
            </p>
        </div>
    </div>

    <div class="px-5 py-5 grid grid-cols-1 gap-y-3 text-sm">
        <div class="flex flex-col">
            <span class="text-[11px] font-medium text-gray-500 uppercase tracking-[0.18em]">Cidade / UF</span>
            <span class="mt-1 text-gray-900">{{ $cidadeUf ?? 'Localização não informada' }}</span>
        </div>
    </div>
</div>
