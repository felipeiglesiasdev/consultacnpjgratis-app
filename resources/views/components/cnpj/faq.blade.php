<section class="bg-gray-50 py-14 md:py-16" id="faq">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="max-w-4xl mx-auto text-center mb-10">
            <p class="text-amber-500 font-semibold uppercase text-xs md:text-sm tracking-[0.24em]">Perguntas frequentes</p>
            <h2 class="mt-2 text-2xl md:text-3xl font-black text-[#111827]">FAQ sobre este CNPJ</h2>
            <p class="mt-3 text-sm md:text-base text-gray-600">
                Respostas rápidas sobre situação cadastral, CNAE principal e como solicitar ajustes ou remoção.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-5 mb-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-4 md:p-5">
                <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">Situação cadastral</p>
                <p class="mt-1 text-lg font-extrabold text-[#111827]">{{ $data['situacao_cadastral'] ?? 'Não informada' }}</p>
                <p class="text-sm text-gray-600">Atualizada em {{ $data['data_situacao_cadastral'] ?? 'data não informada' }}.</p>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-4 md:p-5">
                <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">CNAE principal</p>
                <div class="mt-1 inline-flex items-center gap-2 rounded-full bg-amber-50 px-3 py-1 border border-amber-200 text-[11px] font-semibold text-amber-800">
                    <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                    {{ $data['cnae_principal']['codigo'] ?? '—' }}
                </div>
                <p class="mt-2 text-sm text-gray-700">{{ $data['cnae_principal']['descricao'] ?? 'Descrição não informada' }}</p>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-4 md:p-5">
                <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">Endereço</p>
                <p class="mt-1 text-base font-semibold text-[#111827]">{{ $data['logradouro'] ?? 'Endereço não informado' }}</p>
                <p class="text-sm text-gray-600">{{ $data['cidade_uf'] ?? 'Cidade/UF não informadas' }}</p>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-4 md:p-5">
                <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400">Abertura</p>
                <p class="mt-1 text-base font-semibold text-[#111827]">{{ $data['data_abertura'] ?? 'Não informada' }}</p>
                <p class="text-sm text-gray-600">Porte cadastrado: {{ $data['porte'] ?? 'Não informado' }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-5">
            <div class="rounded-2xl border border-gray-200 bg-white p-4 md:p-5">
                <h3 class="text-base font-semibold text-[#111827]">Quais dados são públicos?</h3>
                <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                    O Cadastro Nacional da Pessoa Jurídica é público conforme a Lei 14.129/2021 (Governo Digital) e a Lei de
                    Acesso à Informação. As informações exibidas são as mesmas disponibilizadas pela Receita Federal.
                </p>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-4 md:p-5">
                <h3 class="text-base font-semibold text-[#111827]">Como pedir remoção ou correção?</h3>
                <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                    Use o formulário dedicado para relatar seu vínculo com o CNPJ, explicar o motivo e confirmar o aceite dos
                    termos de privacidade. Seguimos a LGPD e avaliamos pedidos individualmente.
                </p>
                <div class="mt-3">
                    <a href="{{ route('remocao.show', ['cnpj' => preg_replace('/[^0-9]/', '', $data['cnpj_completo'])]) }}" class="inline-flex items-center gap-2 rounded-full bg-amber-500 text-[#111827] px-4 py-2 text-sm font-semibold shadow-[0_10px_30px_rgba(251,191,36,0.3)] hover:bg-amber-400 transition">
                        <i class="bi bi-shield-check"></i>
                        Solicitar remoção deste CNPJ
                    </a>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-4 md:p-5">
                <h3 class="text-base font-semibold text-[#111827]">Por que os dados podem estar desatualizados?</h3>
                <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                    A base é atualizada conforme as publicações oficiais. Alterações recentes de endereço, razão social ou
                    QSA podem levar alguns dias para aparecer. Sempre verifique a data de atualização da situação cadastral.
                </p>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-4 md:p-5">
                <h3 class="text-base font-semibold text-[#111827]">Posso usar o CNAE para prospecção?</h3>
                <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                    Sim. O CNAE indica a atividade econômica principal. Ele ajuda a segmentar campanhas B2B, encontrar empresas
                    do mesmo setor e priorizar contatos mais aderentes aos seus produtos ou serviços.
                </p>
            </div>
        </div>
    </div>
</section>
