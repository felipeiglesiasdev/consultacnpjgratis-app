@props(['allCnaes'])

<section class="relative overflow-hidden bg-gradient-to-b from-[#050509] via-[#050608] to-black text-white">
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -left-32 -top-32 h-72 w-72 rounded-full bg-amber-500/10 blur-3xl"></div>
        <div class="absolute right-[-140px] top-1/3 h-96 w-96 rounded-full bg-amber-400/5 blur-3xl"></div>
        <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-black via-black/60 to-transparent"></div>
    </div>

    <div class="relative container mx-auto px-6 md:px-10 xl:px-16 py-16 md:py-20">
        <div class="max-w-4xl mx-auto text-center mb-10">
            <p class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs md:text-sm font-medium text-amber-200">
                <span class="h-2 w-2 rounded-full bg-emerald-400 animate-ping"></span>
                Diretório de atividades econômicas (CNAE)
            </p>

            <h1 class="mt-4 text-3xl md:text-4xl xl:text-5xl font-black tracking-tight leading-tight">
                Encontre qualquer <span class="text-amber-400">atividade econômica</span> pelo CNAE.
            </h1>

            <p class="mt-4 text-sm md:text-base text-gray-200">
                Pesquise em tempo real por código ou descrição do CNAE e acesse as empresas
                ativas em cada atividade econômica. Ideal para segmentar campanhas B2B e
                entender melhor o mercado.
            </p>
        </div>

        {{-- Busca em tempo real --}}
        <div class="max-w-3xl mx-auto">
            <div class="relative">
                <label for="cnae-search-input" class="sr-only">Buscar CNAE</label>
                <input
                    id="cnae-search-input"
                    type="text"
                    autocomplete="off"
                    placeholder="Digite o código (ex: 62.01-5-01) ou o nome da atividade (ex: Comércio varejista)..."
                    class="w-full rounded-2xl border border-white/15 bg-white/5 px-4 py-3.5 pr-10 text-sm md:text-base text-white placeholder:text-gray-400 shadow-[0_18px_50px_rgba(0,0,0,0.75)] focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-500/40"
                >
                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-500">
                    <i class="bi bi-search"></i>
                </span>
            </div>

            <p class="mt-3 text-[11px] md:text-xs text-gray-400">
                Comece a digitar para ver resultados em tempo real. Clique em um CNAE para
                ir para a página com as empresas ativas daquela atividade.
            </p>
        </div>

        {{-- Resultados da busca --}}
        <div class="max-w-4xl mx-auto mt-8">
            <div
                id="cnae-search-results"
                class="hidden rounded-2xl border border-white/10 bg-white/[0.03] max-h-[380px] overflow-y-auto shadow-[0_22px_70px_rgba(0,0,0,0.85)] divide-y divide-white/5"
            >
                {{-- Populado via JS --}}
            </div>

            <p id="cnae-search-empty-hint" class="mt-6 text-center text-xs md:text-sm text-gray-500">
                Digite algo no campo acima para começar a pesquisa em tempo real.
            </p>
        </div>
    </div>

    {{-- Script de busca em tempo real --}}
    <script>
        (function () {
            const CNAES = {!! $allCnaes !!}; // já vem como JSON do controller

            const input       = document.getElementById('cnae-search-input');
            const resultsBox  = document.getElementById('cnae-search-results');
            const emptyHint   = document.getElementById('cnae-search-empty-hint');

            function formatCodigo(codigo) {
                const str = String(codigo);
                if (str.length !== 7) return str;
                // 6201501 -> 62.01-5-01
                return `${str.slice(0,2)}.${str.slice(2,4)}-${str.slice(4,5)}-${str.slice(5)}`;
            }

            function createResultItem(cnae) {
                const wrapper = document.createElement('a');
                wrapper.href = "{{ route('empresas.cnae.show', ['codigo_cnae' => 'COD_PLACEHOLDER']) }}"
                    .replace('COD_PLACEHOLDER', cnae.codigo);
                wrapper.className =
                    'flex items-start gap-3 px-4 py-3 hover:bg-white/5 transition-colors border-b border-white/5 last:border-b-0';

                const badge = document.createElement('div');
                badge.className =
                    'mt-0.5 flex h-8 w-8 items-center justify-center rounded-xl bg-amber-500/15 text-amber-200 text-[11px] font-semibold';
                badge.textContent = 'CNAE';

                const content = document.createElement('div');
                content.className = 'flex-1 min-w-0';

                const title = document.createElement('p');
                title.className = 'text-sm font-semibold text-white truncate';
                title.textContent = cnae.descricao;

                const meta = document.createElement('p');
                meta.className = 'mt-1 text-[11px] text-gray-300 font-mono';
                meta.textContent = formatCodigo(cnae.codigo);

                content.appendChild(title);
                content.appendChild(meta);

                const icon = document.createElement('i');
                icon.className = 'bi bi-arrow-right-short text-xl text-gray-400';

                wrapper.appendChild(badge);
                wrapper.appendChild(content);
                wrapper.appendChild(icon);

                return wrapper;
            }

            function onSearchChange() {
                const term = input.value.trim().toLowerCase();

                if (!term) {
                    resultsBox.innerHTML = '';
                    resultsBox.classList.add('hidden');
                    emptyHint.textContent = 'Digite algo no campo acima para começar a pesquisa em tempo real.';
                    emptyHint.classList.remove('hidden');
                    return;
                }

                const filtered = CNAES.filter((item) => {
                    const codigoStr = String(item.codigo);
                    const descricao = (item.descricao || '').toLowerCase();
                    return (
                        codigoStr.includes(term.replace(/\D/g, '')) ||
                        descricao.includes(term)
                    );
                }).slice(0, 50); // limita a lista pra não ficar gigante

                resultsBox.innerHTML = '';

                if (filtered.length === 0) {
                    resultsBox.classList.add('hidden');
                    emptyHint.textContent = 'Nenhuma atividade encontrada para o termo digitado.';
                    emptyHint.classList.remove('hidden');
                    return;
                }

                filtered.forEach((cnae) => {
                    resultsBox.appendChild(createResultItem(cnae));
                });

                resultsBox.classList.remove('hidden');
                emptyHint.classList.add('hidden');
            }

            if (input) {
                input.addEventListener('input', onSearchChange);
            }
        })();
    </script>
</section>
