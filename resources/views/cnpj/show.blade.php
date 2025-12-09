@extends('layouts.app')

@section('seo')
    <x-cnpj.tags :data="$data" />
@endsection

@section('content')
    {{-- HERO / CABEÇALHO DO CNPJ --}}
    <section class="relative overflow-hidden bg-gradient-to-b from-[#050509] via-[#050608] to-black text-white pt-20 pb-12">
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute -left-32 -top-32 h-72 w-72 rounded-full bg-amber-500/10 blur-3xl"></div>
            <div class="absolute right-[-140px] top-1/3 h-96 w-96 rounded-full bg-amber-400/5 blur-3xl"></div>
            <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-black via-black/60 to-transparent"></div>
        </div>

        <div class="relative container mx-auto px-6 md:px-10 xl:px-16">
            <x-cnpj.intro-text :data="$data" />
        </div>
    </section>

    {{-- CONTEÚDO PRINCIPAL --}}
    <section class="bg-gray-50 py-12 md:py-16">
        <div class="container mx-auto px-6 md:px-10 xl:px-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10">

                {{-- SIDEBAR ESQUERDA --}}
                <aside class="lg:col-span-4 space-y-6">
                    <x-cnpj.situacao-cadastral :data="$data" />
                    <x-cnpj.contato :data="$data" />
                    <x-cnpj.endereco :data="$data" />
                    <x-cnpj.removal-alert :data="$data" />
                </aside>

                {{-- CONTEÚDO PRINCIPAL À DIREITA --}}
                <main class="lg:col-span-8 space-y-6">
                    <x-cnpj.informacoes-cnpj :data="$data" />
                    <x-cnpj.atividades-economicas :data="$data" />
                    <x-cnpj.qsa :data="$data" />
                    <x-cnpj.faq :data="$data" />
                    <x-cnpj.empresas-semelhantes :data="$data" />
                    {{-- <x-cnpj.removal-section :data="$data" /> se quiser depois --}}
                </main>

            </div>
        </div>
    </section>
@endsection
