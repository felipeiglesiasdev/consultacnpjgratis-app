@props(['data'])

<div class="rounded-3xl border border-gray-200 bg-white shadow-sm overflow-hidden">
    <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-5 flex items-center gap-3">
        <div class="h-8 w-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
            <i class="bi bi-geo-alt-fill"></i>
        </div>
        <h2 class="text-base font-bold text-gray-900 uppercase tracking-wide">Localização Base</h2>
    </div>

    <div class="p-6 flex flex-col md:flex-row gap-8 items-center md:items-stretch">
        
        {{-- Info Cidade --}}
        <div class="flex-1 flex flex-col justify-center text-center md:text-left">
            <p class="text-[11px] uppercase tracking-[0.2em] font-bold text-gray-400 mb-1">Município e Estado</p>
            <p class="text-3xl font-black text-gray-900 mb-1">{{ $data['cidade'] }}</p>
            <p class="text-lg font-bold text-emerald-600">{{ $data['uf'] }}</p>
        </div>

        {{-- Alerta Estrito LGPD --}}
        <div class="w-full md:w-72 shrink-0 rounded-2xl bg-gray-900 text-white p-5 relative overflow-hidden">
            <i class="bi bi-shield-lock absolute -right-4 -bottom-4 text-[100px] text-white/5 pointer-events-none"></i>
            <div class="relative z-10">
                <div class="flex items-center gap-2 mb-3">
                    <i class="bi bi-shield-check text-emerald-400 text-lg"></i>
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-200">Em conformidade (LGPD)</p>
                </div>
                <p class="text-xs text-gray-400 leading-relaxed mb-3">
                    Para garantir a privacidade e seguir as diretrizes da Lei Geral de Proteção de Dados (13.709/2018), <strong>os seguintes dados foram ocultados:</strong>
                </p>
                <ul class="space-y-1.5 text-[11px] font-medium text-gray-300">
                    <li class="flex items-center gap-2"><i class="bi bi-x-circle text-red-400"></i> Telefones e E-mails</li>
                    <li class="flex items-center gap-2"><i class="bi bi-x-circle text-red-400"></i> Endereço detalhado (Rua/Nº)</li>
                    <li class="flex items-center gap-2"><i class="bi bi-x-circle text-red-400"></i> Quadro Societário (QSA)</li>
                </ul>
            </div>
        </div>

    </div>
</div>