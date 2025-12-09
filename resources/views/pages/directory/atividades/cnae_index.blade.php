@extends('layouts.app')

@push('seo')
    @include('components.directory.atividades.tags', [
        'title'       => 'Atividades econômicas com mais empresas ativas no Brasil',
        'description' => 'Consulte os CNAEs que concentram o maior número de empresas ativas e veja o ranking das atividades em destaque.',
        'keywords'    => 'CNAE, atividades econômicas, empresas ativas, ranking CNAE'
    ])
@endpush

@section('content')
    @include('components.directory.atividades.cnae-search', [
        'allCnaes' => $allCnaes,
    ])

    @include('components.directory.atividades.cnae-top-grid', [
        'topCnaes' => $topCnaes,
    ])

    @include('components.directory.atividades.cnae-faq')
@endsection
