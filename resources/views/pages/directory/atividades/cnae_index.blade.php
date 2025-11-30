@extends('layouts.app')

@push('seo')
    {{-- Crie depois tags específicas se quiser --}}
    {{-- @include('components.directory.atividades.tags') --}}
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
