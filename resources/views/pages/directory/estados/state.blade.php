@extends('layouts.app')

@push('seo')
    @include('components.directory.estados.tags', [
        'title' => 'Empresas no estado ' . strtolower($preposicao) . " {$nomeEstado} ({$uf})",
        'description' => 'Veja quantas empresas estão ativas no estado ' . $preposicao . " {$nomeEstado}, quantas abriram ou encerraram neste ano e quais cidades e CNAEs lideram a região.",
        'keywords' => "empresas {$nomeEstado}, CNPJ {$uf}, empresas ativas {$nomeEstado}, CNAE {$uf}"
    ])
@endpush

@section('content')
    {{-- Hero do Estado --}}
    @include('components.directory.estados.hero', [
        'uf'           => $uf,
        'totalAtivas'  => $totalAtivas,
        'preposicao'   => $preposicao,
        'nomeEstado'   => $nomeEstado,
    ])

    {{-- Resumo / KPIs do Estado (Fundo Claro) --}}
    @include('components.directory.estados.resumo', [
        'uf'               => $uf,
        'totalAtivas'      => $totalAtivas,
        'totalMatrizes'    => $totalMatrizes,
        'totalfiliais'     => $totalfiliais,
        'totalAbertas2025' => $totalAbertas2025,
        'totalFechadas2025'=> $totalFechadas2025,
        'preposicao'       => $preposicao,
        'nomeEstado'       => $nomeEstado,
    ])

    {{-- Grid com todos os municípios paginados --}}
    @include('components.directory.estados.municipios-grid', [
        'uf'         => $uf,
        'municipios' => $municipios,
        'preposicao' => $preposicao,
        'nomeEstado' => $nomeEstado,
    ])

    {{-- Top Cidades (Fundo Claro) --}}
    @include('components.directory.estados.top-cidades', [
        'uf'          => $uf,
        'top10Cidades'=> $top10Cidades,
        'preposicao'  => $preposicao,
        'nomeEstado'  => $nomeEstado,
    ])

    {{-- Top CNAEs (Fundo Escuro) - Sem Links --}}
    @include('components.directory.estados.top-cnaes', [
        'uf'          => $uf,
        'topCnaes'    => $topCnaes,
        'preposicao'  => $preposicao,
        'nomeEstado'  => $nomeEstado,
    ])

    {{-- FAQ do Estado (Fundo Claro) --}}
    @include('components.directory.estados.faq', [
        'preposicao'         => $preposicao,
        'nomeEstado'         => $nomeEstado,
        'totalAtivas'        => $totalAtivas,
        'nomeCapital'        => $nomeCapital,
        'totalCapitalAtivas' => $totalCapitalAtivas,
        'totalAbertas2025'   => $totalAbertas2025,
        'totalFechadas2025'  => $totalFechadas2025,
    ])

    {{-- CTA Final de Consulta (Reaproveitado) --}}
    @include('components.directory.empresas.consulta-footer')
@endsection