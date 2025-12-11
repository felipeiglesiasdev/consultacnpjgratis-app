@php
    $cnpj          = $data['cnpj_completo'] ?? 'este CNPJ';
    $razao         = $data['razao_social'] ?? 'esta empresa';
    $cidadeUf      = $data['cidade_uf'] ?? 'Cidade/UF não informadas';
    $descricaoCnae = $data['cnae_principal']['descricao'] ?? null;
    $codigoCnae    = $data['cnae_principal']['codigo'] ?? null;
    $nomeFantasia  = $data['nome_fantasia'] ?? null;
    $dataAbertura  = $data['data_abertura'] ?? 'Data de abertura não informada';

    $atividadePrincipal = $descricaoCnae
        ? ($codigoCnae ? $codigoCnae . ' - ' . $descricaoCnae : $descricaoCnae)
        : ($codigoCnae ?? 'Não informada');

    $respostaFantasia = $nomeFantasia
        ? 'O nome fantasia cadastrado é ' . $nomeFantasia . '.'
        : 'A empresa ' . $razao . ' não possui nome fantasia informado.';
@endphp

<section class="bg-gray-50 py-14 md:py-16" id="faq">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        <div class="max-w-3xl mx-auto text-center mb-10">
            <p class="text-amber-500 font-semibold uppercase text-xs md:text-sm tracking-[0.24em]">Perguntas frequentes</p>
            <h2 class="mt-2 text-2xl md:text-3xl font-black text-[#111827]">FAQ sobre este CNPJ</h2>
            <p class="mt-3 text-sm md:text-base text-gray-600">Respostas diretas e claras sobre o registro consultado.</p>
        </div>

        <div class="max-w-3xl mx-auto space-y-4">
            <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 shadow-[0_16px_35px_-28px_rgba(15,23,42,0.35)]">
                <h3 class="text-base md:text-lg font-semibold text-[#111827]">Qual a razão social do CNPJ {{ $cnpj }}?</h3>
                <p class="mt-2 text-sm md:text-base text-gray-700">{{ $razao }}</p>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 shadow-[0_16px_35px_-28px_rgba(15,23,42,0.35)]">
                <h3 class="text-base md:text-lg font-semibold text-[#111827]">Em qual cidade se encontra a empresa {{ $razao }}?</h3>
                <p class="mt-2 text-sm md:text-base text-gray-700">{{ $cidadeUf }}</p>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 shadow-[0_16px_35px_-28px_rgba(15,23,42,0.35)]">
                <h3 class="text-base md:text-lg font-semibold text-[#111827]">Qual a atividade principal da empresa {{ $razao }}?</h3>
                <p class="mt-2 text-sm md:text-base text-gray-700">{{ $atividadePrincipal }}</p>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 shadow-[0_16px_35px_-28px_rgba(15,23,42,0.35)]">
                <h3 class="text-base md:text-lg font-semibold text-[#111827]">Qual o nome fantasia do CNPJ {{ $cnpj }}?</h3>
                <p class="mt-2 text-sm md:text-base text-gray-700">{{ $respostaFantasia }}</p>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 shadow-[0_16px_35px_-28px_rgba(15,23,42,0.35)]">
                <h3 class="text-base md:text-lg font-semibold text-[#111827]">Qual a data de abertura do CNPJ {{ $cnpj }}?</h3>
                <p class="mt-2 text-sm md:text-base text-gray-700">{{ $dataAbertura }}</p>
            </div>
        </div>
    </div>
</section>
