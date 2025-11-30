@props(['uf', 'nomeEstado', 'municipio', 'totalEmpresasAtivas'])

@php
    $nomeCidade = $municipio->descricao;

    $breadcrumbs = [
        ['title' => 'Empresas', 'url' => route('empresas.index')],
        ['title' => $nomeEstado, 'url' => route('empresas.state', ['uf' => strtolower($uf)])],
        ['title' => Str::ucfirst(Str::lower($nomeCidade)), 'url' => ''],
    ];
@endphp

<x-directory.breadcrumbs :breadcrumbs="$breadcrumbs" />

<div class="bg-white border border-gray-200 rounded-3xl shadow-xl p-6 md:p-8">
    <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
        <div class="space-y-3">
            <p class="text-sm font-semibold tracking-wider text-amber-600 uppercase">Município</p>
            <h1 class="text-4xl lg:text-5xl font-black text-gray-900 leading-tight">
                Empresas em {{ $nomeCidade }} - {{ $uf }}
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl">
                Panorama das empresas ativas, com amostra das últimas aberturas e as atividades econômicas mais presentes na cidade.
            </p>
        </div>
        <div class="bg-gray-900 text-white rounded-2xl p-6 shadow-lg w-full lg:w-72">
            <p class="text-xs uppercase tracking-[0.18em] text-amber-300 font-semibold">Empresas ativas</p>
            <p class="text-4xl font-black mt-3">{{ number_format($totalEmpresasAtivas, 0, ',', '.') }}</p>
            <p class="text-sm text-gray-300 mt-1">CNPJs com situação 2</p>
        </div>
    </div>
</div>