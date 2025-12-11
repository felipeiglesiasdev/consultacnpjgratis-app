@extends('layouts.app')
@push('seo')
    <title>Política de Privacidade | Consulta CNPJ Grátis</title>
    <meta name="description" content="Saiba como tratamos dados públicos do CNPJ, sua base legal (Lei 14.129/2021, LAI e LGPD) e como solicitar remoção de informações.">
    <link rel="canonical" href="{{ route('privacidade') }}" />
@endpush

@section('content')
<section class="bg-gray-50 py-12 md:py-16">
    <div class="container mx-auto px-6 md:px-10 xl:px-16 space-y-10">
        <header class="space-y-3 text-center md:text-left">
            <p class="text-sm uppercase tracking-wide text-gray-400">Transparência</p>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Política de Privacidade</h1>
            <p class="text-sm md:text-base text-gray-600 max-w-3xl">Divulgamos dados públicos do Cadastro Nacional da Pessoa Jurídica (CNPJ) em conformidade com a Lei 14.129/2021 (Governo Digital) e a Lei de Acesso à Informação. Esta página explica como usamos, armazenamos e removemos informações.</p>
        </header>

        <nav class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <a href="#dados-publicos" class="rounded-xl border border-gray-200 bg-white p-4 text-sm font-semibold text-gray-800 hover:border-amber-400">Dados públicos e base legal</a>
            <a href="#uso-dos-dados" class="rounded-xl border border-gray-200 bg-white p-4 text-sm font-semibold text-gray-800 hover:border-amber-400">Como usamos e protegemos</a>
            <a href="#remover-cnpj" class="rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm font-semibold text-amber-900 hover:border-amber-400">Como remover um CNPJ</a>
        </nav>

        <section id="dados-publicos" class="rounded-2xl border border-gray-200 bg-white p-6 md:p-8 space-y-4">
            <h2 class="text-2xl font-bold text-gray-900">1. Dados públicos e fundamentação jurídica</h2>
            <p class="text-sm text-gray-700 leading-relaxed">O CNPJ é um cadastro público da Receita Federal. A Lei 14.129/2021 (Governo Digital) e a Lei de Acesso à Informação autorizam a disponibilização e a republicação de bases públicas em meios digitais. Nossa fonte oficial é o conjunto de dados do CNPJ disponível em <a class="text-amber-600 underline" target="_blank" href="https://dados.gov.br/dados/conjuntos-dados/cadastro-nacional-da-pessoa-juridica---cnpj">dados.gov.br</a>.</p>
            <p class="text-sm text-gray-700 leading-relaxed">A Lei Geral de Proteção de Dados (LGPD) se aplica quando há informações pessoais sensíveis. Nesses casos, analisamos individualmente pedidos para correção ou anonimização pontual.</p>
        </section>

        <section id="uso-dos-dados" class="rounded-2xl border border-gray-200 bg-white p-6 md:p-8 space-y-4">
            <h2 class="text-2xl font-bold text-gray-900">2. Como utilizamos e protegemos os dados</h2>
            <ul class="list-disc list-inside space-y-2 text-sm text-gray-700">
                <li>Exibimos dados de identificação empresarial (razão social, CNPJ, CNAE, cidade/UF) e resumos societários, mas evitamos mostrar nome completo de sócios, endereços ou contatos.</li>
                <li>Não vendemos dados pessoais. O objetivo é facilitar a consulta pública e organizada do acervo governamental.</li>
                <li>Logs técnicos (IP, user agent) podem ser registrados para prevenção de abuso e para documentar solicitações de remoção.</li>
                <li>Adotamos criptografia em trânsito (HTTPS) e controles de acesso aos ambientes internos.</li>
            </ul>
        </section>

        <section id="remover-cnpj" class="rounded-2xl border border-amber-200 bg-amber-50 p-6 md:p-8 space-y-4">
            <div class="space-y-2">
                <h2 class="text-2xl font-bold text-gray-900">3. Como remover ou corrigir um CNPJ</h2>
                <p class="text-sm text-gray-700 leading-relaxed">Se você é sócio, administrador ou representante legal, pode solicitar a remoção ou correção dos dados republicados. Siga o passo a passo:</p>
            </div>
            <ol class="list-decimal list-inside space-y-2 text-sm text-gray-700">
                <li>Abra a página do CNPJ desejado e clique em “Pedir remoção do CNPJ”.</li>
                <li>Preencha o formulário informando seu vínculo, detalhe o motivo e marque as confirmações legais (LGPD e prazos de buscas).</li>
                <li>A retirada local é imediata após a análise; motores de busca podem levar até 7 dias para refletir a alteração.</li>
            </ol>
            <p class="text-xs text-amber-900 leading-relaxed">Fundamentação: Lei 14.129/2021 (Governo Digital) e Lei de Acesso à Informação garantem a publicidade dos dados; a LGPD orienta ajustes quando houver dados pessoais sensíveis.</p>
        </section>

        <section class="rounded-2xl border border-gray-200 bg-white p-6 md:p-8 space-y-3 text-sm text-gray-700">
            <h3 class="text-xl font-semibold text-gray-900">Contato</h3>
            <p>Para dúvidas adicionais, utilize o formulário de remoção ou os canais indicados na página de cada CNPJ.</p>
        </section>
    </div>
</section>
@endsection
