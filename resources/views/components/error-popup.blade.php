@if (session()->has('error'))
    {{--
        Este container só é renderizado se houver um erro na sessão.
        A lógica de abrir/fechar é feita com JavaScript nativo para evitar dependências externas.
    --}}
    <div data-error-popup
         class="fixed inset-0 z-50 hidden items-center justify-center px-4 font-sans"
         role="alertdialog"
         aria-modal="true"
         aria-live="assertive">

        {{-- Overlay escuro --}}
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" data-close-error></div>

        {{-- Modal --}}
        <div class="relative bg-white rounded-2xl shadow-2xl p-6 m-4 max-w-sm w-full text-center border border-red-100">

            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>

            <h3 class="text-lg leading-6 font-semibold text-gray-900 mt-4">Atenção!</h3>
            <div class="mt-2 space-y-1">
                {{-- Exibe a mensagem de erro que veio do controller --}}
                <p class="text-sm text-gray-700">{{ session('error') }}</p>
                <p class="text-xs text-gray-500">Revise as informações e tente novamente. Dúvidas? Contate nosso suporte.</p>
            </div>

            <div class="mt-5 space-y-2">
                <button data-close-error type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm cursor-pointer">
                    Entendi
                </button>
                <button data-close-error type="button" class="w-full inline-flex justify-center rounded-md border border-red-200 px-4 py-2 text-sm font-semibold text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-200">
                    Fechar
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const popup = document.querySelector('[data-error-popup]');

                if (!popup) return;

                popup.classList.remove('hidden');

                const closePopup = () => popup.remove();
                popup.querySelectorAll('[data-close-error]').forEach((trigger) => {
                    trigger.addEventListener('click', closePopup);
                });
            });
        </script>
    @endpush
@endif

