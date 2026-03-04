@extends('layouts.app')

@push('seo')
    @include('components.consulta-avancada.tags')
@endpush

@section('content')
<div class="min-h-screen bg-[#050509] text-white py-12 relative">
    <div class="pointer-events-none absolute inset-0 z-0">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-[500px] bg-amber-500/5 blur-[120px] rounded-full mix-blend-screen"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 text-xs font-bold uppercase tracking-widest mb-6">
                    <i class="bi bi-stars"></i> Ferramenta Pro
                </span>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-4 tracking-tight">
                    Segmentação de <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-500">Mercado</span>
                </h1>
                <p class="text-gray-400 text-lg font-light max-w-2xl mx-auto leading-relaxed">
                    Utilize os filtros abaixo para encontrar empresas com precisão. Combine localização, atividade e informações legais para gerar listas qualificadas.
                </p>
            </div>
            <div class="bg-[#0F0F11]/80 backdrop-blur-xl border border-white/10 rounded-3xl shadow-2xl relative">
                <form action="{{ route('consulta_avancada.search') }}" method="GET" class="p-3 md:p-5">
                    @include('components.consulta-avancada.location-filter', ['estados' => $estados ?? [], 'cidadesPorEstado' => $cidadesPorEstado ?? []])
                    @include('components.consulta-avancada.situacao-cadastral')
                    @include('components.consulta-avancada.date-filter')
                    @include('components.consulta-avancada.activity-filter', ['cnaes' => $cnaes ?? []])
                    @include('components.consulta-avancada.informations', ['naturezasJuridicas' => $naturezasJuridicas ?? []])
                    <div class="mt-6 pt-6 border-t border-white/10 flex flex-col md:flex-row items-center justify-end gap-4">
                        <a href="{{ route('consulta_avancada.index') }}" class="text-sm text-gray-500 hover:text-white transition-colors flex items-center gap-2 px-4 py-2">
                            <i class="bi bi-trash"></i> Limpar filtros
                        </a>
                        <button type="submit" class="cursor-pointer w-full md:w-auto bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-400 hover:to-orange-500 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-amber-500/20 transition-all hover:-translate-y-0.5 flex items-center justify-center gap-2">
                            <i class="bi bi-search"></i>
                            Filtrar Resultados
                        </button>
                    </div>
                </form>
            </div>
            @isset($resultados)
                @include('components.consulta-avancada.resultados', ['resultados' => $resultados])
            @endisset
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const resultsArea = document.getElementById('resultsArea');
        if (resultsArea) {
            setTimeout(() => {
                resultsArea.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 300);
        }
    });
</script>
@endsection