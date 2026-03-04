@props(['data'])

<div class="rounded-3xl border border-gray-200 bg-white shadow-sm p-6 md:p-8">
    <div class="flex items-center gap-3 mb-6">
        <i class="bi bi-patch-question-fill text-2xl text-gray-300"></i>
        <h2 class="text-xl font-bold text-gray-900">Perguntas Frequentes sobre a empresa</h2>
    </div>

    <div class="space-y-4">
        
        <details class="group bg-gray-50 border border-gray-100 rounded-2xl cursor-pointer">
            <summary class="flex items-center justify-between font-semibold text-sm text-gray-800 p-4 list-none outline-none">
                A empresa {{ $data['razao_social'] }} está ativa?
                <i class="bi bi-chevron-down text-gray-400 group-open:rotate-180 transition-transform"></i>
            </summary>
            <div class="px-4 pb-4 pt-1 text-sm text-gray-600 leading-relaxed">
                De acordo com a Receita Federal, o CNPJ {{ $data['cnpj_completo'] }} encontra-se na situação <strong>{{ mb_strtoupper($data['situacao_cadastral'], 'UTF-8') }}</strong> desde a data {{ $data['data_situacao_cadastral'] }}.
            </div>
        </details>

        <details class="group bg-gray-50 border border-gray-100 rounded-2xl cursor-pointer">
            <summary class="flex items-center justify-between font-semibold text-sm text-gray-800 p-4 list-none outline-none">
                Qual é a atividade principal (CNAE)?
            </summary>
            <div class="px-4 pb-4 pt-1 text-sm text-gray-600 leading-relaxed">
                A atividade econômica principal registrada é <strong>{{ $data['cnae_principal']['descricao'] }}</strong> (CNAE: {{ $data['cnae_principal']['codigo'] }}).
            </div>
        </details>

        <details class="group bg-gray-50 border border-gray-100 rounded-2xl cursor-pointer">
            <summary class="flex items-center justify-between font-semibold text-sm text-gray-800 p-4 list-none outline-none">
                Onde a empresa está localizada?
            </summary>
            <div class="px-4 pb-4 pt-1 text-sm text-gray-600 leading-relaxed">
                A matriz/filial está localizada no município de <strong>{{ $data['cidade'] }} ({{ $data['uf'] }})</strong>. Por motivos de privacidade (LGPD), o logradouro completo não é exibido em nosso diretório.
            </div>
        </details>

    </div>
</div>