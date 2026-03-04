@if (session()->has('error'))
    <div data-error-popup
         class="fixed inset-0 z-50 flex items-center justify-center px-4 font-sans"
         role="alertdialog"
         aria-modal="true"
         aria-live="assertive">
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" data-close-error></div>
        <div class="relative bg-white rounded-2xl shadow-2xl p-6 m-4 max-w-sm w-full text-center border border-red-100">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <i class="bi bi-exclamation-triangle text-2xl text-red-600"></i>
            </div>
            <h3 class="text-lg leading-6 font-semibold text-gray-900 mt-4">Atenção!</h3>
            <div class="mt-2 space-y-1">
                <p class="text-sm text-gray-700">{{ session('error') }}</p>
            </div>
            <div class="mt-5 space-y-2">
                <button data-close-error type="button" class="cursor-pointer w-full inline-flex justify-center rounded-md border border-red-200 px-4 py-2 text-sm font-semibold text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-200">
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

