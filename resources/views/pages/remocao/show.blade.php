@extends('layouts.app')

@push('seo')
    <title>Remover o CNPJ {{ $cnpjFormatted }} imediatamente | Consulta CNPJ Grátis</title>
    <meta name="description" content="Remova ou corrija os dados do CNPJ {{ $cnpjFormatted }} de forma imediata, com base legal e transparência sobre o uso de dados públicos.">
    <link rel="canonical" href="{{ route('remocao.show', ['cnpj' => $cnpj]) }}" />
@endpush

@section('content')
    <section class="bg-gray-50 py-12 md:py-16">
        <div class="container mx-auto px-6 md:px-10 xl:px-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <aside class="lg:col-span-4 space-y-5">
                    <div class="rounded-2xl bg-white shadow-sm border border-gray-200 p-6 space-y-3">
                        <p class="text-sm font-semibold text-amber-600">É dono ou responsável por este CNPJ?</p>
                        <p class="text-sm text-gray-700 leading-relaxed">
                            Você está na página de remoção do CNPJ <strong>{{ $cnpjFormatted }}</strong>. Caso seja sócio, administrador ou representante legal, confirme abaixo e o registro será removido imediatamente da nossa base.
                        </p>
                        <div class="space-y-2 text-sm text-gray-700">
                            <p class="font-semibold text-gray-900">Base legal e uso responsável</p>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Lei 14.129/2021 (Governo Digital) — autoriza a disponibilização de dados públicos em meios digitais.</li>
                                <li>Lei de Acesso à Informação — dados do CNPJ são públicos e podem ser republicados.</li>
                                <li>Lei Geral de Proteção de Dados — você pode contestar dados pessoais e solicitar correção ou remoção.</li>
                                <li>Fonte oficial: Receita Federal (dados públicos) e espelho em <a class="text-amber-600 underline" target="_blank" href="https://dados.gov.br/dados/conjuntos-dados/cadastro-nacional-da-pessoa-juridica---cnpj">dados.gov.br</a>.</li>
                                <li>Respeitamos a privacidade: não exibimos nome completo de sócios, endereços ou contatos, mesmo quando constam na base pública.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="rounded-2xl bg-amber-50 border border-amber-200 p-5 text-sm text-amber-900 space-y-2">
                        <p class="font-semibold">Transparência e prazos</p>
                        <p>A remoção é processada na hora. Mecanismos de busca (Google, Bing, etc.) podem levar até 7 dias para refletir a alteração.</p>
                        <p>Use o formulário ao lado apenas para contextualizar o pedido e confirmar que você é a pessoa autorizada.</p>
                    </div>
                </aside>

                <div class="lg:col-span-8">
                    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 md:p-8 space-y-6">
                        <div class="flex items-start justify-between gap-4 flex-wrap">
                            <div>
                                <p class="text-sm uppercase tracking-wide text-gray-400">Remoção imediata</p>
                                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Remover o CNPJ {{ $cnpjFormatted }}</h1>
                                <p class="mt-2 text-sm text-gray-600">Estamos republicando dados abertos oficiais. Ao confirmar abaixo, removeremos imediatamente este CNPJ da nossa base e mostraremos o aviso de remoção na página inicial.</p>
                            </div>
                            <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 border border-emerald-200 px-3 py-1 text-sm font-semibold text-emerald-700">
                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                Dados oficiais, base pública
                            </span>
                        </div>

                        @if ($errors->any())
                            <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-red-800 space-y-1">
                                <p class="font-semibold">Revise os campos destacados:</p>
                                <ul class="list-disc list-inside text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('remocao.store', ['cnpj' => $cnpj]) }}" method="POST" class="space-y-5">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="nome" class="block text-sm font-semibold text-gray-800">Seu nome completo</label>
                                    <input id="nome" name="nome" type="text" value="{{ old('nome') }}" required class="mt-1 w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-amber-500 focus:ring-amber-500" placeholder="Ex.: Maria Pereira" />
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-gray-800">E-mail para contato</label>
                                    <input id="email" name="email" type="email" value="{{ old('email') }}" required class="mt-1 w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-amber-500 focus:ring-amber-500" placeholder="voce@empresa.com" />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="vinculo" class="block text-sm font-semibold text-gray-800">Seu vínculo com o CNPJ</label>
                                    <input id="vinculo" name="vinculo" type="text" value="{{ old('vinculo') }}" required class="mt-1 w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-amber-500 focus:ring-amber-500" placeholder="Sócio, administrador, contador..." />
                                </div>
                                <div>
                                    <label for="cnpj-remocao" class="block text-sm font-semibold text-gray-800">CNPJ</label>
                                    <input id="cnpj-remocao" name="cnpj_mostrado" type="text" value="{{ $cnpjFormatted }}" readonly class="mt-1 w-full rounded-xl border border-gray-300 bg-gray-100 px-4 py-3 text-sm text-gray-700" />
                                </div>
                            </div>

                            <div>
                                <label for="motivo" class="block text-sm font-semibold text-gray-800">Explique o motivo do pedido</label>
                                <textarea id="motivo" name="motivo" rows="4" required class="mt-1 w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-amber-500 focus:ring-amber-500" placeholder="Descreva a situação, a necessidade de remoção ou atualização.">{{ old('motivo') }}</textarea>
                                <p class="mt-2 text-xs text-gray-500">Inclua detalhes que ajudem a comprovar o vínculo ou a necessidade de correção.</p>
                            </div>

                            <div class="space-y-3 text-sm text-gray-700">
                                <label class="flex items-start gap-3">
                                    <input type="checkbox" name="confirmacao_responsavel" value="1" class="mt-1 rounded border-gray-300 text-amber-500 focus:ring-amber-500" {{ old('confirmacao_responsavel') ? 'checked' : '' }} required>
                                    <span>Confirmo que sou responsável legal ou autorizado a representar o CNPJ informado.</span>
                                </label>
                                <label class="flex items-start gap-3">
                                    <input type="checkbox" name="aceite_lgpd" value="1" class="mt-1 rounded border-gray-300 text-amber-500 focus:ring-amber-500" {{ old('aceite_lgpd') ? 'checked' : '' }} required>
                                    <span>Li e entendi que os dados do CNPJ são públicos (Lei 14.129/2021 e Lei de Acesso à Informação), mas posso solicitar correções com base na LGPD.</span>
                                </label>
                                <label class="flex items-start gap-3">
                                    <input type="checkbox" name="entende_prazo_buscas" value="1" class="mt-1 rounded border-gray-300 text-amber-500 focus:ring-amber-500" {{ old('entende_prazo_buscas') ? 'checked' : '' }} required>
                                    <span>Entendo que, após a remoção, mecanismos de busca como Google ou Bing podem levar até 7 dias para atualizar seus resultados.</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-between gap-4 flex-wrap text-xs text-gray-500">
                                <div>
                                <p><strong>Base legal:</strong> Lei 14.129/2021 (Governo Digital) e Lei de Acesso à Informação permitem a republicação de dados públicos do CNPJ.</p>
                                <p class="mt-1">Nos casos em que a LGPD se aplica (dados pessoais sensíveis), analisamos ajustes ou remoções pontuais.</p>
                            </div>
                                <a href="{{ route('privacidade') }}#remover-cnpj" class="inline-flex items-center gap-2 text-amber-700 font-semibold">Política de privacidade</a>
                            </div>

                            <div class="pt-2">
                                <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center rounded-2xl bg-amber-500 px-6 py-3 text-base font-semibold text-[#111827] hover:bg-amber-400 shadow-lg shadow-amber-500/30 transition">
                                    Remover CNPJ agora
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.1.3/imask.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cnpjInput = document.getElementById('cnpj-remocao');
        if (cnpjInput) {
            const mask = IMask(cnpjInput, { mask: '00.000.000/0000-00' });
            const form = cnpjInput.closest('form');
            if (form) {
                form.addEventListener('submit', function() { mask.updateValue(); });
            }
        }
    });
</script>
@endpush
