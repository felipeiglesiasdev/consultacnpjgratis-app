@extends('layouts.app')

@php
    $breadcrumbs = [
        ['title' => 'Empresas', 'url' => route('empresas.index')],
        ['title' => 'Municípios', 'url' => ''],
    ];
@endphp

@section('title', 'Empresas por Município | Consulta CNPJ grátis')
@section('description', 'Veja um panorama dos municípios brasileiros, com totais de empresas, cidades atendidas e ranking por atividade econômica.')

@section('content')
<div class="bg-gray-50/50 mt-16">
    <div class="container mx-auto px-4 py-12 md:py-16">
        <x-directory.breadcrumbs :breadcrumbs="$breadcrumbs" />

        <x-directory.municipios.index-hero :resumo="$resumoMunicipios" />

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mt-12">
            <div class="lg:col-span-2">
                <x-directory.municipios.table :municipios="$municipiosPaginados" />
            </div>
            <div class="lg:col-span-1">
                <x-directory.municipios.faq :faq="$faq" />
            </div>
        </div>
    </div>
</div>
@endsection
