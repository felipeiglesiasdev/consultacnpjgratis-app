@extends('layouts.app')

@php
    $nomeCidade = Str::title($municipio->descricao);
@endphp

@push('seo')
    @include('components.directory.municipios.tags', [
        'title' => "Empresas em {$nomeCidade} - ({$ufReal}) - Consulta CNPJ Gratis",
        'description' => "Veja todas as empresas ativas em {$nomeCidade}, acompanhe novas aberturas neste ano e consulte a lista completa de CNPJs da cidade.",
        'keywords' => "empresas {$municipio->descricao}, CNPJs no {$ufReal}, empresas ativas {$nomeEstado}, empresas em {$nomeEstado}"
    ])
@endpush

@section('content')
    {{-- Hero do Município --}}
    @include('components.directory.municipios.header', [
        'municipio'         => $municipio,
        'ufReal'            => $ufReal,
        'totalAtivas'       => $totalAtivas,
        'totalAbertas2025'  => $totalAbertas2025,
        'totalFechadas2025' => $totalFechadas2025,
    ])

    {{-- Tabela de Empresas Paginada --}}
    @include('components.directory.municipios.table', [
        'empresas'  => $empresas,
        'municipio' => $municipio,
        'ufReal'    => $ufReal,
    ])

    {{-- FAQ do Município --}}
    @include('components.directory.municipios.faq', [
        'municipio'         => $municipio,
        'ufReal'            => $ufReal,
        'totalAtivas'       => $totalAtivas,
        'totalAbertas2025'  => $totalAbertas2025,
        'totalFechadas2025' => $totalFechadas2025,
    ])
    
    {{-- CTA Final de Consulta (Reaproveitado) --}}
    @include('components.directory.empresas.consulta-footer')
@endsection