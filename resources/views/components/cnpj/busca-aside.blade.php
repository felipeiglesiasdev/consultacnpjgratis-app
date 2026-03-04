<div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
    
    {{-- Cabeçalho da Busca (Ícone + Título na mesma linha) --}}
    <div class="flex items-center justify-center md:justify-start gap-3 mb-2">
        <div class="h-10 w-10 shrink-0 bg-amber-50 rounded-full flex items-center justify-center text-amber-500">
            <i class="bi bi-search text-lg"></i>
        </div>
        <h3 class="text-base font-bold text-gray-900">Consultar outro CNPJ</h3>
    </div>
    
    <p class="text-xs text-gray-500 mb-5 leading-relaxed text-center md:text-left">
        Faça uma nova busca gratuita em nossa base oficial da Receita Federal.
    </p>
    
    <form action="{{ route('cnpj.consultar') }}" method="POST" class="space-y-3">
        @csrf
        <div>
            <label for="cnpj_aside" class="sr-only">Número do CNPJ</label>
            <div class="relative">
                <input 
                    type="tel" 
                    name="cnpj" 
                    id="cnpj_aside" 
                    placeholder="00.000.000/0000-00" 
                    required
                    class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/20 transition-all"
                >
                <i class="bi bi-building absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>
        
        {{-- Botão com cursor-pointer e hover aprimorado --}}
        <button 
            type="submit" 
            class="cursor-pointer inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gray-900 px-4 py-3 text-sm font-bold text-white hover:bg-black transition-all duration-200 hover:-translate-y-0.5 shadow-md hover:shadow-lg"
        >
            <i class="bi bi-search"></i> Consultar
        </button>
    </form>

    {{-- Bloco de Erro: Aparece se o CNPJ digitado for inválido ou não for encontrado --}}
    @if(session('error'))
        <div class="mt-4 rounded-xl bg-red-50 p-3 text-left border border-red-100 flex items-start gap-2 animate-pulse">
            <i class="bi bi-exclamation-circle-fill text-red-500 mt-0.5"></i>
            <p class="text-[11px] text-red-700 font-medium leading-tight">
                {{ session('error') }}
            </p>
        </div>
    @endif
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.1.3/imask.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cnpjInput = document.getElementById('cnpj_aside');
        if (cnpjInput) {
            const mask = IMask(cnpjInput, { mask: '00.000.000/0000-00' });
            const form = cnpjInput.closest('form');
            if (form) {
                form.addEventListener('submit', function() { mask.updateValue(); });
            }
        }
    });
</script>
@endpush