@extends('layouts.app')

@push('seo')
    @include('components.directory.empresas.tags')
@endpush

@section('content')
    {{-- Hero focada em explorar estados e cidades --}}
    @include('components.directory.empresas.hero', [
        'totalEmpresasAtivas' => $totalEmpresasAtivas,
    ])

    {{-- Grid de estados (vem em segundo lugar para conversão rápida) --}}
    @include('components.directory.empresas.estados-grid', [
        'estados' => $estados,
    ])

    {{-- Balanço / KPIs nacionais (Fundo Claro para contraste) --}}
    @include('components.directory.empresas.kpis', [
        'totalEmpresasAtivas'    => $totalEmpresasAtivas,
        'municipiosComEmpresas'  => $municipiosComEmpresas,
        'mediaAberturasMensal'   => $mediaAberturasMensal,
        'novasEmpresasTrimestre' => $novasEmpresasTrimestre,
        'totalCnaesCatalogados'  => $totalCnaesCatalogados,
    ])

    {{-- Top cidades e Top Estados em destaque (Substitui os antigos CNAEs) --}}
    @include('components.directory.empresas.top-locations', [
        'top10CidadesAtivas' => $top10CidadesAtivas,
        'topEstadosAtivos'   => $topEstadosAtivos,
    ])

    {{-- Call to action final: consulta de CNPJ --}}
    @include('components.directory.empresas.consulta-footer')
@endsection