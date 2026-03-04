@props(['data'])

<div class="rounded-3xl border border-dashed border-gray-300 bg-white p-6 text-center shadow-sm">
    <div class="h-12 w-12 mx-auto bg-gray-100 text-gray-500 rounded-full flex items-center justify-center mb-4">
        <i class="bi bi-person-slash text-xl"></i>
    </div>
    
    <h3 class="text-sm font-bold text-gray-900 mb-2">
        Você é titular deste CNPJ?
    </h3>
    
    <p class="text-xs text-gray-500 leading-relaxed mb-5">
        Nossa plataforma consolida apenas informações públicas da Receita Federal. Caso prefira manter a privacidade, você pode solicitar a ocultação desta página específica no nosso buscador.
    </p>
    
    {{-- A URL usa apenas os números do CNPJ e possui nofollow para não ser indexada --}}
    <a href="{{ route('remocao.show', ['cnpj' => preg_replace('/[^0-9]/', '', $data['cnpj_completo'])]) }}" rel="nofollow" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-white border border-gray-300 px-4 py-3 text-xs font-bold text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors shadow-sm">
        <i class="bi bi-shield-lock"></i>
        Solicitar Ocultação
    </a>
</div>