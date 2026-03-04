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
                    <x-cnpj.faq :data="$data" />
                    <x-cnpj.removal-alert :data="$data" />
                    <x-cnpj.empresas-semelhantes :data="$data" />
                </div>
                <div class="w-full lg:w-1/3 space-y-6 sticky top-24">
                    <div class="rounded-3xl border border-gray-200 bg-white p-6 text-center shadow-sm">
                        <div class="h-12 w-12 mx-auto bg-amber-50 rounded-full flex items-center justify-center text-amber-500 mb-4">
                            <i class="bi bi-search text-xl"></i>
                        </div>
                        <h3 class="text-sm font-bold text-gray-900 mb-2">Consultar outro CNPJ</h3>
                        <p class="text-xs text-gray-500 mb-4">Faça uma nova busca gratuita em nossa base oficial.</p>
                        <a href="{{ route('empresas.index') }}" class="inline-block w-full rounded-xl bg-gray-900 px-4 py-3 text-xs font-bold text-white hover:bg-gray-800 transition-colors">
                            Ir para a Busca
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection