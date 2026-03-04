@props(['data'])
@php
    $titulo = "{$data['razao_social']} - {$data['cnpj_completo']}";
    $url = "https://www.consultacnpjgratis.com/cnpj/{$data['cnpj_desformatado']}";
    $descricao = "Consulte os dados públicos de {$data['razao_social']}. Empresa localizada em {$data['cidade']}/{$data['uf']}. Dados estruturados e em total conformidade com a LGPD.";
    $keywords = "cnpj {$data['cnpj_completo']}, {$data['cnpj_completo']}, {$data['cnpj_desformatado']}, cnpj {$data['cnpj_desformatado']}, consulta cnpj gratuito, consulta empresas, consulta cnpj gratis, consultar cnpj";
@endphp
@push('seo')
    <title>{{ $titulo }} | Consulta CNPJ Grátis</title>
    <meta name="description" content="{{ $descricao }}">
    <meta name="keywords" content="{{ $keywords }}">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $titulo }}">
    <meta property="og:description" content="{{ $descricao }}">
    <meta property="og:url" content="{{ $url }}">
    <meta property="og:site_name" content="Consulta CNPJ Grátis">
    <link rel="canonical" href="{{ $url }}" />
@endpush