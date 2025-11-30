@extends('layouts.app')

@push('seo')
    @include('components.directory.empresas.tags')
@endpush

@section('content')
    {{-- Hero focada em explorar estados --}}
    @include('components.directory.empresas.hero', [
        'totalEmpresasAtivas' => $totalEmpresasAtivas,
    ])

    {{-- Grid de estados (vem em segundo lugar) --}}
    @include('components.directory.empresas.estados-grid', [
        'estados' => $estados,
    ])

    {{-- Balanço / KPIs nacionais --}}
    @include('components.directory.empresas.kpis', [
        'totalEmpresasAtivas'     => $totalEmpresasAtivas,
        'municipiosComEmpresas'   => $municipiosComEmpresas,
        'mediaAberturasMensal'    => $mediaAberturasMensal,
        'novasEmpresasTrimestre'  => $novasEmpresasTrimestre,
        'totalCnaesCatalogados'   => $totalCnaesCatalogados,
    ])

    {{-- Top cidades e CNAEs em destaque --}}
    @include('components.directory.empresas.top-cidades-cnaes', [
        'top10CidadesAtivas' => $top10CidadesAtivas,
        'topCnaes'           => $topCnaes,
    ])

    {{-- Call to action final: consulta de CNPJ --}}
    @include('components.directory.empresas.consulta-footer')
@endsection
