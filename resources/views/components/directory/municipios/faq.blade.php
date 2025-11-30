@props(['faq'])

<div class="bg-white border border-gray-200 rounded-3xl shadow-xl p-6 md:p-8">
    <div class="flex items-center justify-between gap-3 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Perguntas frequentes</h2>
            <p class="text-gray-600">Dúvidas comuns sobre a navegação por municípios.</p>
        </div>
        <span class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-amber-100 text-amber-700 font-bold">?</span>
    </div>

    <div class="divide-y divide-gray-100">
        @foreach($faq as $item)
            <details class="group py-4">
                <summary class="flex items-start justify-between cursor-pointer">
                    <span class="text-base font-semibold text-gray-900 group-hover:text-amber-600">{{ $item['pergunta'] }}</span>
                    <span class="ml-4 text-amber-500 group-open:rotate-45 transition-transform">+</span>
                </summary>
                <p class="mt-2 text-gray-600 leading-relaxed">{{ $item['resposta'] }}</p>
            </details>
        @endforeach
    </div>
</div>
