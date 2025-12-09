<div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 space-y-3">
    <div class="flex items-center gap-3 text-amber-800">
        <i class="bi bi-exclamation-triangle-fill text-lg"></i>
        <div>
            <p class="text-sm font-semibold">É responsável por este CNPJ?</p>
            <p class="text-xs text-amber-900">Dados públicos da Receita Federal, publicados conforme Lei 14.129/2021 e Lei de Acesso à Informação.</p>
        </div>
    </div>
    <p class="text-sm text-amber-900">Caso seja sócio ou representante, solicite remoção ou correção preenchendo o formulário dedicado.</p>
    <a href="{{ route('remocao.show', ['cnpj' => preg_replace('/[^0-9]/', '', $data['cnpj_completo'])]) }}" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-amber-500 px-4 py-3 text-sm font-semibold text-[#111827] hover:bg-amber-400 shadow-lg shadow-amber-500/30">
        <i class="bi bi-shield-lock"></i>
        Pedir remoção do CNPJ
    </a>
    <p class="text-[11px] text-amber-900 leading-relaxed">Buscas externas (Google, Bing, etc.) podem levar até 7 dias para refletir o pedido após aprovação.</p>
</div>
