@php
    // Recupera os valores selecionados da requisição para manter os checkboxes marcados
    $situacoesSelecionadas = request()->input('situacao', []);
    
    // Garante que é um array para evitar erros no in_array
    if (!is_array($situacoesSelecionadas)) {
        $situacoesSelecionadas = [$situacoesSelecionadas];
    }
@endphp

<div class="mb-8 border-b border-white/10 pb-8">
    <h3 class="text-white font-bold text-lg flex items-center gap-2 mb-6">
        <i class="bi bi-person-vcard text-amber-500"></i> Situação Cadastral
    </h3>
    
    <div>
        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Status (Selecione um ou mais)</label>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3">
            
            {{-- Todas (Value vazio) --}}
            <label class="cursor-pointer group">
                <input type="checkbox" name="situacao[]" value="" class="peer sr-only" 
                       {{ empty($situacoesSelecionadas) || in_array(null, $situacoesSelecionadas) || in_array('', $situacoesSelecionadas) ? 'checked' : '' }}>
                <div class="px-3 py-2.5 rounded-xl border border-white/10 bg-[#050509] text-center text-sm font-medium text-gray-400 peer-checked:border-amber-500 peer-checked:bg-amber-500/10 peer-checked:text-amber-400 hover:border-white/30 transition-all select-none">
                    Todas
                </div>
            </label>

            {{-- Ativas (2) --}}
            <label class="cursor-pointer group">
                <input type="checkbox" name="situacao[]" value="02" class="peer sr-only" 
                       {{ in_array('2', $situacoesSelecionadas) ? 'checked' : '' }}>
                <div class="px-3 py-2.5 rounded-xl border border-white/10 bg-[#050509] text-center text-sm font-medium text-gray-400 peer-checked:border-amber-500 peer-checked:bg-amber-500/10 peer-checked:text-amber-400 hover:border-white/30 transition-all select-none">
                    Ativas
                </div>
            </label>

            {{-- Baixadas (8) --}}
            <label class="cursor-pointer group">
                <input type="checkbox" name="situacao[]" value="08" class="peer sr-only" 
                       {{ in_array('8', $situacoesSelecionadas) ? 'checked' : '' }}>
                <div class="px-3 py-2.5 rounded-xl border border-white/10 bg-[#050509] text-center text-sm font-medium text-gray-400 peer-checked:border-amber-500 peer-checked:bg-amber-500/10 peer-checked:text-amber-400 hover:border-white/30 transition-all select-none">
                    Baixadas
                </div>
            </label>

            {{-- Inaptas (4) --}}
            <label class="cursor-pointer group">
                <input type="checkbox" name="situacao[]" value="04" class="peer sr-only" 
                       {{ in_array('4', $situacoesSelecionadas) ? 'checked' : '' }}>
                <div class="px-3 py-2.5 rounded-xl border border-white/10 bg-[#050509] text-center text-sm font-medium text-gray-400 peer-checked:border-amber-500 peer-checked:bg-amber-500/10 peer-checked:text-amber-400 hover:border-white/30 transition-all select-none">
                    Inaptas
                </div>
            </label>

            {{-- Nulas (1) --}}
            <label class="cursor-pointer group">
                <input type="checkbox" name="situacao[]" value="01" class="peer sr-only" 
                       {{ in_array('1', $situacoesSelecionadas) ? 'checked' : '' }}>
                <div class="px-3 py-2.5 rounded-xl border border-white/10 bg-[#050509] text-center text-sm font-medium text-gray-400 peer-checked:border-amber-500 peer-checked:bg-amber-500/10 peer-checked:text-amber-400 hover:border-white/30 transition-all select-none">
                    Nulas
                </div>
            </label>

            {{-- Suspensas (3) --}}
            <label class="cursor-pointer group">
                <input type="checkbox" name="situacao[]" value="03" class="peer sr-only" 
                       {{ in_array('3', $situacoesSelecionadas) ? 'checked' : '' }}>
                <div class="px-3 py-2.5 rounded-xl border border-white/10 bg-[#050509] text-center text-sm font-medium text-gray-400 peer-checked:border-amber-500 peer-checked:bg-amber-500/10 peer-checked:text-amber-400 hover:border-white/30 transition-all select-none">
                    Suspensas
                </div>
            </label>

        </div>
    </div>
</div>