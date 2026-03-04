@props(['title', 'description', 'keywords'])

<title>{{ $title }} | Diretório Nacional</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="robots" content="index, follow">

{{-- Open Graph --}}
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ asset('images/social-tag-og.png') }}">
<meta property="og:site_name" content="Consultar CNPJ Grátis">
<meta property="og:locale" content="pt_BR">

{{-- Twitter --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ url()->current() }}">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ asset('images/social-tag-og.png') }}">

<link rel="canonical" href="{{ url()->current() }}" />