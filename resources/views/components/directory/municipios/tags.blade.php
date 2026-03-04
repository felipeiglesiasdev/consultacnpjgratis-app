@props(['title', 'description', 'keywords'])
<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ url()->current() }}" />
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:site_name" content="Consultar CNPJ Grátis">
