@extends('layouts.app')

@push('seo')

@endpush

@section('content')
    @include('components.directory.municipios.header', [
        'municipio'         => $municipio,
        'ufReal'            => $ufReal,
        'totalAtivas'       => $totalAtivas,
        'totalAbertas2025'  => $totalAbertas2025,
        'totalFechadas2025' => $totalFechadas2025,
    ])

    @include('components.directory.municipios.table', [
        'empresas'  => $empresas,
        'municipio' => $municipio,
        'ufReal'    => $ufReal,
    ])

    @include('components.directory.municipios.faq')
@endsection
