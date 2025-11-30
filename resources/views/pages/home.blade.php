@extends('layouts.app')
@push('seo')
    @include('components.home.tags')
@endpush

@section('content')
    <x-home.hero />
    <x-home.cenario-brasil :totalAtivas="$totalAtivas" :totalEncerradas="$totalEncerradas" />
    <x-home.grid-beneficios />
    <x-home.abertas-encerradas-3-anos :abertasUltimosAnos="$abertasUltimosAnos" :fechadasUltimosAnos="$fechadasUltimosAnos" />
    <x-home.top-cnaes :topCnaes="$topCnaes" />
    <x-home.outras-secoes />
@endsection
