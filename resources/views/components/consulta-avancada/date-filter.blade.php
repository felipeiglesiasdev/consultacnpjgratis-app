<div class="mb-8 border-b border-white/10 pb-8">
    <h3 class="text-white font-bold text-lg flex items-center gap-2 mb-6">
        <i class="bi bi-calendar-event-fill text-amber-500"></i> Data de Abertura
    </h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Data Início -->
        <div>
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Abertas a partir de</label>
            <div class="relative">
                <input type="date" 
                       name="data_inicio" 
                       value="{{ request('data_inicio') }}"
                       class="w-full bg-[#050509] border border-white/10 text-white rounded-xl py-3 px-4 focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 outline-none transition-all text-sm h-[46px] uppercase placeholder-gray-500 [&::-webkit-calendar-picker-indicator]:invert cursor-pointer">
            </div>
        </div>

        <!-- Data Fim -->
        <div>
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Até a data</label>
            <div class="relative">
                <input type="date" 
                       name="data_fim" 
                       value="{{ request('data_fim') }}"
                       class="w-full bg-[#050509] border border-white/10 text-white rounded-xl py-3 px-4 focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 outline-none transition-all text-sm h-[46px] uppercase placeholder-gray-500 [&::-webkit-calendar-picker-indicator]:invert cursor-pointer">
            </div>
        </div>

    </div>
</div>