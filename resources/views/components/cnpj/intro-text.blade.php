@props(['data'])

@php
    $razao      = $data['razao_social'] ?? 'Empresa sem razão social';
    $fantasia   = $data['nome_fantasia'] ?? null;
    $cnpj       = $data['cnpj_completo'] ?? null;
    $cidadeUf   = $data['cidade_uf'] ?? null;
    $cnae       = $data['cnae_principal']['descricao'] ?? null;
    $cnaeCodigo = $data['cnae_principal']['codigo'] ?? null;
    $dataAbert  = $data['data_abertura'] ?? null;

    // Formata CNAE
    if (!empty($cnaeCodigo)) {
        $codigoStr = (string) $cnaeCodigo;
        if (strlen($codigoStr) === 7) {
            $cnaeCodigoFormatado =
                substr($codigoStr, 0, 2) . '.' .
                substr($codigoStr, 2, 2) . '-' .
                substr($codigoStr, 4, 1) . '-' .
                substr($codigoStr, 5);
        } else {
            $cnaeCodigoFormatado = $codigoStr;
        }
    } else {
        $cnaeCodigoFormatado = null;
    }
@endphp

<section id="informacoes-gerais" class="relative">
    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-8 xl:gap-10">
        <div class="max-w-2xl space-y-4">
            <div class="inline-flex items-center gap-2 rounded-full bg-white/5 border border-white/15 px-4 py-1.5 text-[11px] md:text-xs text-gray-200">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                Consulta gratuita de CNPJ com dados oficiais da Receita Federal
            </div>

            <div>
                <h1 class="text-2xl md:text-3xl xl:text-4xl font-black tracking-tight leading-snug">
                    {{ $razao }}
                </h1>

                @if($fantasia && $fantasia !== $razao)
                    <p class="mt-1 text-sm md:text-base text-gray-300">
                        Nome fantasia: <span class="font-semibold text-white">{{ $fantasia }}</span>
                    </p>
                @endif
            </div>

            <div class="flex flex-wrap gap-2 pt-2 text-[11px] md:text-xs text-gray-200">
                @if($cnpj)
                    <span class="inline-flex items-center gap-1 rounded-full bg-black/40 border border-white/10 px-3 py-1 font-mono">
                        <i class="bi bi-upc-scan text-[13px]"></i>
                        {{ $cnpj }}
                    </span>
                @endif

                @if($cidadeUf)
                    <span class="inline-flex items-center gap-1 rounded-full bg-black/40 border border-white/10 px-3 py-1">
                        <i class="bi bi-geo-alt"></i>
                        {{ $cidadeUf }}
                    </span>
                @endif

                @if($dataAbert)
                    <span class="inline-flex items-center gap-1 rounded-full bg-black/40 border border-white/10 px-3 py-1">
                        <i class="bi bi-calendar3"></i>
                        Aberta em {{ $dataAbert }}
                    </span>
                @endif
            </div>

            <p class="mt-3 text-sm md:text-base text-gray-200 leading-relaxed">
                A empresa <span class="font-semibold text-white">{{ $razao }}</span>
                está registrada sob o CNPJ
                @if($cnpj)
                    <span class="font-mono font-semibold text-amber-200">{{ $cnpj }}</span>
                @endif
                @if($cidadeUf)
                    , localizada em {{ $cidadeUf }}
                @endif
                @if($cnae)
                    , tendo como atividade principal
                    <span class="font-semibold text-white">
                        {{ $cnae }}
                        @if($cnaeCodigoFormatado)
                            (CNAE {{ $cnaeCodigoFormatado }})
                        @endif
                    </span>.
                @endif
                Esta consulta é baseada em dados públicos da Receita Federal e pode ser utilizada
                para análise de crédito, prospecção B2B e verificação cadastral.
            </p>
        </div>

        <div class="w-full max-w-sm lg:max-w-md">
            <div class="rounded-3xl border border-white/15 bg-white/[0.04] p-5 md:p-6 shadow-[0_22px_70px_rgba(0,0,0,0.85)] backdrop-blur">
                <p class="text-[11px] uppercase tracking-[0.26em] text-gray-400 mb-2">
                    Como usar estes dados
                </p>
                <ul class="space-y-2 text-xs md:text-sm text-gray-200">
                    <li class="flex items-start gap-2">
                        <i class="bi bi-check2 mt-0.5 text-emerald-400"></i>
                        <span>Validar informações cadastrais de fornecedores, clientes e parceiros.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="bi bi-check2 mt-0.5 text-emerald-400"></i>
                        <span>Montar listas de prospecção B2B com base em atividade e localização.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="bi bi-check2 mt-0.5 text-emerald-400"></i>
                        <span>Reduzir risco em operações comerciais verificando situação cadastral.</span>
                    </li>
                </ul>
                <p class="mt-4 text-[11px] text-gray-400">
                    Dados atualizados periodicamente a partir do cadastro nacional de CNPJs
                    mantido pela Receita Federal do Brasil.
                </p>
            </div>
        </div>
    </div>
</section>
