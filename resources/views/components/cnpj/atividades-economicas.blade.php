@props(['data'])

@php
    $principal = $data['cnae_principal'] ?? null;
    $secundarios = $data['cnaes_secundarios'] ?? [];
    $codigo = $principal['codigo'] ?? null;

    $formatCnae = function ($codigo) {
        $str = (string) $codigo;
        if (strlen($str) !== 7) {
            return $str;
        }
        return substr($str, 0, 2) . '.' .
               substr($str, 2, 2) . '-' .
               substr($str, 4, 1) . '-' .
               substr($str, 5);
    };
@endphp

<div id="atividades-economicas" class="rounded-2xl border border-gray-200 bg-white shadow-[0_18px_45px_-28px_rgba(15,23,42,0.55)]">
    <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
        <span class="inline-flex items-center justify-center h-9 w-9 rounded-2xl bg-gray-900/5 text-gray-700">
            <i class="bi bi-diagram-3 text-lg"></i>
        </span>
        <div>
            <h2 class="text-sm font-semibold text-gray-900">Atividades econômicas (CNAE)</h2>
            <p class="text-[11px] text-gray-500">
                Atividade principal e atividades secundárias do CNPJ
            </p>
        </div>
    </div>

    <div class="px-5 py-5 space-y-6 text-sm">
        @if($principal)
            <div>
                <p class="text-[11px] uppercase tracking-[0.18em] text-gray-500 font-medium">
                    Atividade principal
                </p>
                <div class="mt-2 rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <div class="min-w-0">
                            <p class="font-semibold text-gray-900 truncate">
                                {{ $principal['descricao'] ?? 'Descrição não informada' }}
                            </p>
                            @if(!empty($principal['codigo']))
                                <p class="mt-1 font-mono text-[12px] text-gray-600">
                                    CNAE {{ $formatCnae($principal['codigo']) }}
                                </p>
                            @endif
                        </div>

                        @if(!empty($principal['codigo']))
                            <a
                                href="{{ route('empresas.cnae.show', ['codigo_cnae' => $principal['codigo']]) }}"
                                class="inline-flex items-center gap-1 rounded-full border border-amber-300 bg-amber-50 px-3 py-1.5 text-[11px] font-medium text-amber-800 hover:bg-amber-100 hover:border-amber-400 transition"
                            >
                                <i class="bi bi-box-arrow-up-right text-xs"></i>
                                Ver empresas por CNAE
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        @if(!empty($secundarios))
            <div>
                <p class="text-[11px] uppercase tracking-[0.18em] text-gray-500 font-medium">
                    Atividades secundárias
                </p>
                <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach ($secundarios as $cnae)
                        <div class="rounded-2xl border border-gray-200 bg-white px-4 py-3 hover:border-amber-300 hover:bg-amber-50/60 transition-all duration-150">
                            <p class="font-semibold text-gray-900 text-sm">
                                {{ $cnae['descricao'] ?? 'Descrição não informada' }}
                            </p>
                            @if(!empty($cnae['codigo']))
                                <p class="mt-1 font-mono text-[12px] text-gray-600">
                                    CNAE {{ $formatCnae($cnae['codigo']) }}
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
