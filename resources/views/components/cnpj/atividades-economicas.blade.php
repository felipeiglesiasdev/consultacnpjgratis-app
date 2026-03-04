@props(['data'])

@php
    // Função local para formatar CNAE
    $formatCnae = function ($codigo) {
        $str = (string) $codigo;
        // Preenche com zeros à esquerda caso venha com menos de 7 dígitos (ex: do banco como inteiro)
        $str = str_pad($str, 7, '0', STR_PAD_LEFT);
        
        if (strlen($str) !== 7) {
            return $str; // Retorna original se for inválido mesmo após o pad
        }
        
        // Formato final: xxxx-x/xx
        return substr($str, 0, 4) . '-' . substr($str, 4, 1) . '/' . substr($str, 5, 2);
    };
@endphp

<div class="rounded-3xl border border-gray-200 bg-white shadow-sm overflow-hidden">
    <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-5 flex items-center gap-3">
        <div class="h-8 w-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
            <i class="bi bi-diagram-3-fill"></i>
        </div>
        <h2 class="text-base font-bold text-gray-900 uppercase tracking-wide">Atividades (CNAE)</h2>
    </div>

    <div class="p-6 space-y-6">
        
        {{-- Atividade Principal --}}
        <div>
            <p class="text-[11px] uppercase tracking-[0.2em] font-bold text-amber-600 mb-3">Atividade Principal</p>
            <div class="flex flex-col sm:flex-row sm:items-center gap-4 rounded-2xl border border-amber-200 bg-amber-50 p-4">
                <span class="shrink-0 inline-flex items-center justify-center px-3 py-1.5 rounded-lg bg-white border border-amber-200 text-xs font-mono font-bold text-amber-800 shadow-sm">
                    {{ $formatCnae($data['cnae_principal']['codigo']) }}
                </span>
                <p class="text-sm font-bold text-gray-900 leading-snug">
                    {{ $data['cnae_principal']['descricao'] }}
                </p>
            </div>
        </div>

        {{-- Atividades Secundárias --}}
        @if(isset($data['cnaes_secundarios']) && count($data['cnaes_secundarios']) > 0)
            <div>
                <p class="text-[11px] uppercase tracking-[0.2em] font-bold text-gray-400 mb-3">Atividades Secundárias</p>
                <div class="grid grid-cols-1 gap-2">
                    @foreach($data['cnaes_secundarios'] as $cnae)
                        <div class="flex flex-col sm:flex-row sm:items-start gap-3 rounded-xl border border-gray-100 bg-gray-50/50 p-3 hover:bg-gray-50 transition-colors">
                            <span class="shrink-0 text-[11px] font-mono font-bold text-gray-500 bg-gray-200/50 px-2 py-1 rounded">
                                {{ $formatCnae($cnae['codigo']) }}
                            </span>
                            <p class="text-xs font-medium text-gray-700 leading-relaxed mt-0.5">
                                {{ $cnae['descricao'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>