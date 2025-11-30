@extends('layouts.app')

@push('seo')
    {{-- Crie depois se quiser SEO específico por UF --}}
    {{-- @include('components.directory.estados.tags') --}}
@endpush

@section('content')
    @include('components.directory.estados.hero', [
        'uf'           => $uf,
        'totalAtivas'  => $totalAtivas,
    ])

    {{-- 🔹 novo componente: grid com todos os municípios paginados --}}
    @include('components.directory.estados.municipios-grid', [
        'uf'         => $uf,
        'municipios' => $municipios,
    ])

    @include('components.directory.estados.resumo', [
        'uf'               => $uf,
        'totalAtivas'      => $totalAtivas,
        'totalMatrizes'    => $totalMatrizes,
        'totalfiliais'     => $totalfiliais,
        'totalAbertas2025' => $totalAbertas2025,
        'totalFechadas2025'=> $totalFechadas2025,
    ])

    @include('components.directory.estados.top-cidades', [
        'uf'          => $uf,
        'top10Cidades'=> $top10Cidades,
    ])

    @include('components.directory.estados.top-cnaes', [
        'uf'      => $uf,
        'topCnaes'=> $topCnaes,
    ])

    {{-- Reaproveita o CTA lindão de consulta CNPJ do portal --}}
    @include('components.directory.empresas.consulta-footer')
@endsection
