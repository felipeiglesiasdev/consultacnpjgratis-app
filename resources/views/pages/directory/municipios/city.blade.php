@extends('layouts.app')

@push('seo')
    @include('components.directory.municipios.tags', [
        'title' => "Empresas em {$municipio->descricao} ({$ufReal->uf}) - Diretório completo",
        'description' => "Veja todas as empresas ativas em {$municipio->descricao}, quantas abriram ou encerraram em 2025 e consulte a lista paginada de CNPJs da cidade.",
        'keywords' => "empresas {$municipio->descricao}, CNPJ {$ufReal->uf}, empresas ativas {$municipio->descricao}"
    ])
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

    @include('components.directory.municipios.faq', [
        'municipio'         => $municipio,
        'ufReal'            => $ufReal,
        'totalAtivas'       => $totalAtivas,
        'totalAbertas2025'  => $totalAbertas2025,
        'totalFechadas2025' => $totalFechadas2025,
    ])
@endsection
