@if (session('success'))
    <div class="bg-emerald-50 border-b border-emerald-200 text-emerald-900">
        <div class="container mx-auto px-6 md:px-10 xl:px-16 py-3">
            <p class="text-sm font-semibold text-center">{{ session('success') }}</p>
        </div>
    </div>
@endif
