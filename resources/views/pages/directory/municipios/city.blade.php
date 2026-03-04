@extends('layouts.app')

@push('seo')
    @include('components.directory.municipios.tags', [
        'title' => "Empresas em {$nomeEstado} ({$ufReal}) - Diretório completo",
        'description' => "Veja todas as empresas ativas em {$nomeEstado}, acompanhe novas aberturas neste ano e consulte a lista completa de CNPJs da cidade.",
        'keywords' => "empresas {$nomeEstado}, CNPJ {$ufReal}, empresas ativas {$nomeEstado}, diretório empresas {$nomeEstado}"
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