@extends('layouts.app')

@php
    $title = 'Explorar Empresas por Estado, Cidade e Atividade | Consulta CNPJ grátis';
    $description = 'Descubra empresas por estado, cidade ou CNAE com um painel visual, dados em tempo real e indicadores recentes.';
    $keywords = 'consulta cnpj, empresas por estado, empresas por cidade, empresas por cnae, cnpj grátis, lista de empresas, busca de cnpj';
@endphp

@push('seo')
    @include('components.directory.empresas.tags', [
        'title' => $title,
        'description' => $description,
        'keywords' => $keywords
    ])
@endpush

@section('content')
<div class="bg-gradient-to-b from-white via-amber-50/40 to-white mt-16">
    <div class="container mx-auto px-4 py-12 md:py-16 space-y-12">
        <x-directory.empresas.hero
            :totalEmpresasAtivas="$totalEmpresasAtivas"
            :mediaAberturasMensal="$mediaAberturasMensal"
            :novasEmpresasTrimestre="$novasEmpresasTrimestre"
        />

        <x-directory.empresas.metric-cards
            :totalEmpresasAtivas="$totalEmpresasAtivas"
            :municipiosComEmpresas="$municipiosComEmpresas"
            :totalCnaesCatalogados="$totalCnaesCatalogados"
            :mediaAberturasMensal="$mediaAberturasMensal"
        />

        <x-directory.empresas.geography-highlights
            :topEstadosAtivos="$topEstadosAtivos"
            :topCidadesAtivas="$topCidadesAtivas"
        />

        <x-directory.empresas.states-section id="estados" :estados="$estados" />

        <x-directory.empresas.cnaes-section
            :topCnaes="$topCnaes"
            :topCnaesRecentes="$topCnaesRecentes"
        />

        <x-public-data-notice />
    </div>
</div>
@endsection
