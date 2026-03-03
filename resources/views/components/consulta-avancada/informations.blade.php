@props(['naturezasJuridicas'])

<div class="mb-6"
     x-data='{
        naturezas: @json($naturezasJuridicas ?? []),
        portes: [
            {id: "", texto: "Todos"},
            {id: "01", texto: "ME (Microempresa)"},
            {id: "03", texto: "EPP (Emp Pequeno Porte)"},
            {id: "05", texto: "Demais"}
        ],
        
        natId: @json(request("natureza_juridica")), 
        natTexto: "", 
        natAberto: false,
        
        porteId: @json(request("porte")), 
        porteTexto: "", 
        porteAberto: false,

        init() {
            // Restaura Natureza Jurídica
            if (this.natId) {
                let idStr = String(this.natId);
                let nat = this.naturezas.find(n => String(n.codigo) === idStr);
                if (nat) {
                    this.natTexto = nat.codigo + " - " + nat.descricao;
                }
            }

            // Restaura Porte
            if (this.porteId) {
                let idStr = String(this.porteId);
                let porte = this.portes.find(p => String(p.id) === idStr);
                if (porte) {
                    this.porteTexto = porte.texto;
                }
            }
        },

        get naturezasFiltradas() {
            const termo = this.natTexto.toLowerCase();
            // Retorna tudo se vazio ou filtra
            if (termo === "") return this.naturezas.slice(0, 100);
            
            return this.naturezas.filter(n => {
                const textoCompleto = (n.codigo + " - " + n.descricao).toLowerCase();
                return textoCompleto.includes(termo);
            }).slice(0, 100);
        },

        get portesFiltrados() {
            const termo = this.porteTexto.toLowerCase();
            if (termo === "") return this.portes;
            return this.portes.filter(p => p.texto.toLowerCase().includes(termo));
        },

        selecionarNatureza(nat) {
            this.natId = nat.codigo;
            this.natTexto = nat.codigo + " - " + nat.descricao;
            this.natAberto = false;
        },

        selecionarPorte(porte) {
            this.porteId = porte.id;
            this.porteTexto = porte.texto;
            this.porteAberto = false;
        },

        limparNatureza() {
            this.natId = "";
            this.natTexto = "";
            this.natAberto = false;
        },

        limparPorte() {
            this.porteId = "";
            this.porteTexto = "";
            this.porteAberto = false;
        }
     }'>

    <h3 class="text-white font-bold text-lg flex items-center gap-2 mb-6">
        <i class="bi bi-info-circle-fill text-amber-500"></i> Informações Legais
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        {{-- Natureza Jurídica --}}
        {{-- Usamos style binding para garantir prioridade no z-index --}}
        <div class="relative" 
             x-bind:style="natAberto ? 'z-index: 50;' : 'z-index: 20;'" 
             @click.outside="natAberto = false">
            
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Natureza Jurídica</label>
            <div class="relative">
                <input type="hidden" name="natureza_juridica" :value="natId">
                <input type="text" 
                       x-model="natTexto" 
                       @focus="natAberto = true" 
                       @input="natId = ''; natAberto = true" 
                       placeholder="Ex: 206-2 Sociedade Empresária..."
                       class="w-full bg-[#050509] border border-white/10 text-white rounded-xl py-4 px-4 pr-10 focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 outline-none transition-all placeholder-gray-600 shadow-sm">
                
                <div class="absolute inset-y-0 right-0 flex items-center px-4 cursor-pointer">
                    <template x-if="natTexto">
                        <i class="bi bi-x text-gray-500 hover:text-red-500 transition-colors text-lg" @click="limparNatureza"></i>
                    </template>
                    <template x-if="!natTexto">
                        <i class="bi bi-chevron-down text-gray-500" @click="natAberto = !natAberto"></i>
                    </template>
                </div>

                <div x-show="natAberto" 
                     x-transition
                     class="absolute z-50 w-full mt-2 bg-[#1A1A1E] border border-white/10 rounded-xl shadow-2xl max-h-80 overflow-y-auto"
                     style="display: none;">
                    <ul>
                        <template x-for="nat in naturezasFiltradas" :key="nat.codigo">
                            <li @click="selecionarNatureza(nat)" 
                                class="px-4 py-3 hover:bg-white/5 hover:text-amber-400 cursor-pointer text-sm text-gray-300 border-b border-white/5 last:border-0 transition-colors">
                                <span x-text="nat.codigo"></span> - <span x-text="nat.descricao"></span>
                            </li>
                        </template>
                        <li x-show="naturezasFiltradas.length === 0" class="px-4 py-3 text-sm text-gray-500 text-center">Nenhuma natureza encontrada.</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Porte --}}
        {{-- Também adicionamos z-index dinâmico aqui para evitar conflitos se este estiver aberto --}}
        <div class="relative" 
             x-bind:style="porteAberto ? 'z-index: 50;' : 'z-index: 10;'" 
             @click.outside="porteAberto = false">
            
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Porte da Empresa</label>
            <div class="relative">
                <input type="hidden" name="porte" :value="porteId">
                <input type="text" 
                       x-model="porteTexto" 
                       @focus="porteAberto = true" 
                       @input="porteId = ''; porteAberto = true" 
                       placeholder="Todos os portes"
                       class="w-full bg-[#050509] border border-white/10 text-white rounded-xl py-4 px-4 pr-10 focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 outline-none transition-all placeholder-gray-600 shadow-sm cursor-pointer">
                
                <div class="absolute inset-y-0 right-0 flex items-center px-4 cursor-pointer">
                    <template x-if="porteTexto">
                        <i class="bi bi-x text-gray-500 hover:text-red-500 transition-colors text-lg" @click="limparPorte"></i>
                    </template>
                    <template x-if="!porteTexto">
                        <i class="bi bi-chevron-down text-gray-500" @click="porteAberto = !porteAberto"></i>
                    </template>
                </div>

                <div x-show="porteAberto" 
                     x-transition
                     class="absolute z-50 w-full mt-2 bg-[#1A1A1E] border border-white/10 rounded-xl shadow-2xl max-h-60 overflow-y-auto"
                     style="display: none;">
                    <ul>
                        <template x-for="porte in portesFiltrados" :key="porte.id">
                            <li @click="selecionarPorte(porte)" 
                                class="px-4 py-3 hover:bg-white/5 hover:text-amber-400 cursor-pointer text-sm text-gray-300 border-b border-white/5 last:border-0 transition-colors">
                                <span x-text="porte.texto"></span>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>