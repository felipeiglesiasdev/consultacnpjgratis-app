@props(['data'])

@php
    $tel1 = $data['telefone_1'] ?? null;
    $tel2 = $data['telefone_2'] ?? null;
    $email = $data['email'] ?? null;

    $sanitize = fn($v) => preg_replace('/\D/', '', $v ?? '');
@endphp

@if ($tel1 || $tel2 || $email)
<div id="contato" class="rounded-2xl border border-gray-200 bg-white shadow-[0_18px_45px_-28px_rgba(15,23,42,0.55)]">
    <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
        <span class="inline-flex items-center justify-center h-9 w-9 rounded-2xl bg-gray-900/5 text-gray-700">
            <i class="bi bi-telephone text-lg"></i>
        </span>
        <div>
            <h2 class="text-sm font-semibold text-gray-900">Contato</h2>
            <p class="text-[11px] text-gray-500">
                Canais de contato informados no cadastro
            </p>
        </div>
    </div>

    <div class="px-5 py-5 grid grid-cols-1 gap-y-3 text-sm">
        @if($tel1)
            <div class="flex flex-col">
                <span class="text-[11px] font-medium text-gray-500 uppercase tracking-[0.18em]">Telefone 1</span>
                <a href="tel:{{ $sanitize($tel1) }}" class="mt-1 text-emerald-700 hover:text-emerald-800 hover:underline">
                    {{ $tel1 }}
                </a>
            </div>
        @endif

        @if($tel2)
            <div class="flex flex-col">
                <span class="text-[11px] font-medium text-gray-500 uppercase tracking-[0.18em]">Telefone 2</span>
                <a href="tel:{{ $sanitize($tel2) }}" class="mt-1 text-emerald-700 hover:text-emerald-800 hover:underline">
                    {{ $tel2 }}
                </a>
            </div>
        @endif

        @if($email)
            <div class="flex flex-col">
                <span class="text-[11px] font-medium text-gray-500 uppercase tracking-[0.18em]">E-mail</span>
                <a href="mailto:{!! strtolower($email) !!}" class="mt-1 text-emerald-700 hover:text-emerald-800 hover:underline break-all">
                    {{ strtolower($email) }}
                </a>
            </div>
        @endif

        <p class="mt-2 text-[11px] text-gray-500">
            Use esses canais com responsabilidade e em conformidade com a legislação vigente (como a LGPD),
            especialmente em campanhas de prospecção.
        </p>
    </div>
</div>
@endif
