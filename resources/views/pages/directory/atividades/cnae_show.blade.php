@extends('layouts.app')

@push('seo')
    {{-- Se quiser tags específicas de SEO pra CNAE, cria depois aqui --}}
    {{-- @include('components.directory.atividades.show.tags', ['cnae' => $cnae]) --}}
@endpush

@section('content')
    @include('components.directory.atividades.show.hero', [
        'cnae'      => $cnae,
        'topEstados'=> $topEstados,
        'empresas'  => $empresas,
    ])

    @include('components.directory.atividades.show.top-estados', [
        'cnae'       => $cnae,
        'topEstados' => $topEstados,
    ])

    @include('components.directory.atividades.show.empresas-sample', [
        'cnae'     => $cnae,
        'empresas' => $empresas,
    ])
@endsection
