@extends('layouts.app')
@section('seo')
    <x-cnpj.tags :data="$data" />
@endsection
@section('content')
    <x-cnpj.intro-text :data="$data" />
    <section class="bg-[#F8FAFC] py-12 md:py-20 relative">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
        <div class="container mx-auto px-6 md:px-10 xl:px-16">
            <div class="flex flex-col lg:flex-row gap-8 items-start">
                <div class="w-full lg:w-2/3 space-y-6">
                    <x-cnpj.informacoes-cnpj :data="$data" />
                    <x-cnpj.atividades-economicas :data="$data" />
                    <x-cnpj.endereco :data="$data" />
                    <x-cnpj.removal-alert :data="$data" />
                    <x-cnpj.empresas-semelhantes :data="$data" />
                </div>
                <div class="w-full lg:w-1/3 space-y-6">
                    <x-cnpj.busca-aside />
                </div>
            </div>
        </div>
    </section>
@endsection