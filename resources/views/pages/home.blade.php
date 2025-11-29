@extends('layouts.app')

{{-- Injetando as tags de SEO --}}
@push('seo')
    <title>Consulta CNPJ grátis - Dados de Empresas, Estados e CNAEs</title>
    <meta name="description" content="Consulte gratuitamente dados de CNPJ de qualquer empresa do Brasil. Explore por estado, cidade ou CNAE com visual sofisticado e rápido.">
    <meta name="keywords" content="consulta cnpj gratis, consulta cnpj, dados de empresas, empresas por estado, consultar cnaes, cnpjs receita federal, lista de empresas no brasil, lista de empresas brasileiras, lista de empresas por municipio">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ route('home') }}" />
@endpush

@section('content')
<div class="bg-[#0b0b0b] text-white">
    <x-home.hero />
</div>
<x-home.pulse :totalAtivas="$totalAtivas" :totalEncerradas="$totalEncerradas" />
<x-home.feature-grid />
<section class="bg-[#0f0f0f] text-white py-16 md:py-20">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-amber-400 font-semibold tracking-wide uppercase text-sm">Dados em foco</p>
            <h2 class="text-3xl md:text-4xl font-black">Atividades mais fortes</h2>
            <p class="mt-4 text-gray-300">Descubra os CNAEs (Atividades) mais frequentes no país.</p>
        </div>
        <div class="rounded-2xl p-6 shadow-2xl shadow-black/20">
            <x-home.top-cnaes :topCnaes="$topCnaes" />
        </div>
    </div>
</section>
<x-home.trends :abertasUltimosAnos="$abertasUltimosAnos" :fechadasUltimosAnos="$fechadasUltimosAnos" />
<x-home.exploration />
<section class="py-16 md:py-20 px-4 bg-white">
    <div class="max-w-5xl mx-auto">
        <x-public-data-notice />
    </div>
</section>
@endsection
