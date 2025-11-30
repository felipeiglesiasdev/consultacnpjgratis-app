@props(['data'])

@php
    $cnpj       = $data['cnpj_completo'] ?? null;
    $razao      = $data['razao_social'] ?? null;
    $fantasia   = $data['nome_fantasia'] ?? null;
    $natureza   = $data['natureza_juridica'] ?? null;
    $capital    = $data['capital_social'] ?? null;
    $porte      = $data['porte'] ?? null;
    $tipo       = $data['matriz_ou_filial'] ?? null;
    $dataAbert  = $data['data_abertura'] ?? null;

    $capitalFormatado = $capital !== null
        ? 'R$ ' . number_format((float) str_replace(',', '.', $capital), 2, ',', '.')
        : null;
@endphp

<div class="rounded-2xl border border-gray-200 bg-white shadow-[0_18px_45px_-28px_rgba(15,23,42,0.55)]">
    <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
        <span class="inline-flex items-center justify-center h-9 w-9 rounded-2xl bg-gray-900/5 text-gray-700">
            <i class="bi bi-file-earmark-text text-lg"></i>
        </span>
        <div>
            <h2 class="text-sm font-semibold text-gray-900">Informações do CNPJ</h2>
            <p class="text-[11px] text-gray-500">
                Dados básicos de registro da empresa
            </p>
        </div>
    </div>

    <div class="px-5 py-5 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm">
        @if($cnpj)
            <div class="flex flex-col">
                <span class="text-[11px] font-medium text-gray-500 uppercase tracking-[0.18em]">CNPJ</span>
                <span class="mt-1 font-mono text-gray-900">{{ $cnpj }}</span>
            </div>
        @endif

        @if($razao)
            <div class="flex flex-col">
                <span class="text-[11px] font-medium text-gray-500 uppercase tracking-[0.18em]">Razão social</span>
                <span class="mt-1 text-gray-900 font-semibold">{{ $razao }}</span>
            </div>
        @endif

        @if($fantasia)
            <div class="flex flex-col">
                <span class="text-[11px] font-medium text-gray-500 uppercase tracking-[0.18em]">Nome fantasia</span>
                <span class="mt-1 text-gray-800">{{ $fantasia }}</span>
            </div>
        @endif

        @if($natureza)
            <div class="flex flex-col">
                <span class="text-[11px] font-medium text-gray-500 uppercase tracking-[0.18em]">Natureza jurídica</span>
                <span class="mt-1 text-gray-800">{{ $natureza }}</span>
            </div>
        @endif

        @if($capitalFormatado)
            <div class="flex flex-col">
                <span class="text-[11px] font-medium text-gray-500 uppercase tracking-[0.18em]">Capital social</span>
                <span class="mt-1 text-gray-800">{{ $capitalFormatado }}</span>
            </div>
        @endif

        @if($porte)
            <div class="flex flex-col">
                <span class="text-[11px] font-medium text-gray-500 uppercase tracking-[0.18em]">Porte da empresa</span>
                <span class="mt-1 text-gray-800">{{ $porte }}</span>
            </div>
        @endif

        @if($tipo)
            <div class="flex flex-col">
                <span class="text-[11px] font-medium text-gray-500 uppercase tracking-[0.18em]">Tipo</span>
                <span class="mt-1 text-gray-800">{{ $tipo }}</span>
            </div>
        @endif

        @if($dataAbert)
            <div class="flex flex-col">
                <span class="text-[11px] font-medium text-gray-500 uppercase tracking-[0.18em]">Data de abertura</span>
                <span class="mt-1 text-gray-800">{{ $dataAbert }}</span>
            </div>
        @endif
    </div>
</div>
