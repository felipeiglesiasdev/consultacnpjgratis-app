<section class="rounded-2xl border border-gray-200 bg-white p-6 md:p-8 shadow-sm space-y-6">
    <div class="flex items-start justify-between gap-4 flex-wrap">
        <div>
            <p class="text-sm uppercase tracking-wide text-gray-400">Perguntas frequentes</p>
            <h2 class="text-2xl font-bold text-gray-900">FAQ sobre a empresa</h2>
            <p class="mt-2 text-sm text-gray-600">Detalhes resumidos da ficha cadastral e orientações de atualização.</p>
        </div>
        <a href="{{ route('remocao.show', ['cnpj' => preg_replace('/[^0-9]/', '', $data['cnpj_completo'])]) }}" class="inline-flex items-center gap-2 rounded-full bg-amber-50 border border-amber-200 px-3 py-1 text-sm font-semibold text-amber-800">
            <i class="bi bi-shield-check"></i>
            Solicitar remoção
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
        <div class="p-4 rounded-xl bg-gray-50 border border-gray-200">
            <p class="text-xs font-semibold text-amber-700">Situação</p>
            <p class="mt-1 text-lg font-bold text-gray-900">{{ $data['situacao_cadastral'] ?? 'Não informada' }}</p>
            <p class="text-sm text-gray-600">Atualizada em {{ $data['data_situacao_cadastral'] ?? 'data não informada' }}.</p>
        </div>

        <div class="p-4 rounded-xl bg-gray-50 border border-gray-200">
            <p class="text-xs font-semibold text-amber-700">Endereço</p>
            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $data['logradouro'] ?? 'Endereço não informado' }}</p>
            <p class="text-sm text-gray-600">{{ $data['cidade_uf'] ?? '' }}</p>
        </div>

        <div class="p-4 rounded-xl bg-gray-50 border border-gray-200">
            <p class="text-xs font-semibold text-amber-700">CNAE principal</p>
            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $data['cnae_principal']['codigo'] ?? '' }}</p>
            <p class="text-sm text-gray-600">{{ $data['cnae_principal']['descricao'] ?? '' }}</p>
        </div>

        <div class="p-4 rounded-xl bg-gray-50 border border-gray-200">
            <p class="text-xs font-semibold text-amber-700">Abertura</p>
            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $data['data_abertura'] ?? 'Não informada' }}</p>
            <p class="text-sm text-gray-600">Categoria: {{ $data['porte'] ?? 'Não informado' }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        <div class="p-4 rounded-xl bg-white border border-gray-200">
            <h3 class="text-base font-semibold text-gray-900">Quais dados são públicos?</h3>
            <p class="mt-2 text-sm text-gray-600 leading-relaxed">O Cadastro Nacional da Pessoa Jurídica é público, conforme Lei 14.129/2021 (Governo Digital) e Lei de Acesso à Informação. Reutilizamos o mesmo acervo divulgado pela Receita Federal.</p>
        </div>
        <div class="p-4 rounded-xl bg-white border border-gray-200">
            <h3 class="text-base font-semibold text-gray-900">Como pedir remoção ou correção?</h3>
            <p class="mt-2 text-sm text-gray-600 leading-relaxed">Use o formulário dedicado para informar seu vínculo com o CNPJ, o motivo e aceite os termos de privacidade. Respeitamos a LGPD para analisar ajustes pontuais.</p>
        </div>
    </div>
</section>
