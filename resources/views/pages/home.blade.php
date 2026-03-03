@extends('layouts.app')
@push('seo')
    @include('components.home.tags')
@endpush
@section('content')
    <x-home.hero />
    <x-home.cenario-brasil :totalAtivas="$totalAtivas" :totalEncerradas="$totalEncerradas" />
    <x-home.grid-beneficios />
    <x-home.busca-avancada/>
    <x-home.abertas-encerradas-3-anos :abertasUltimosAnos="$abertasUltimosAnos" :fechadasUltimosAnos="$fechadasUltimosAnos" />
@endsection
