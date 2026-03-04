@props(['resultados'])

@if($resultados->count() > 0)
    <div id="resultsArea" class="mt-16 scroll-mt-24">
        <div class="mb-6 flex items-center gap-3 rounded-xl border border-amber-500/20 bg-amber-500/10 px-4 py-3 text-sm text-amber-200/90">
                <i class="bi bi-info-circle text-amber-500"></i>
                <p>A exibição de qualquer pesquisa nesta ferramenta é limitada a <strong>10 resultados</strong>. Refine seus filtros caso necessário.</p>
            </div>
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-white flex items-center gap-3">
                <i class="bi bi-list-check text-amber-500"></i>
                Resultados Encontrados
            </h2>
            <span class="px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs font-mono text-gray-400">
                {{ $resultados->count() }} empresas
            </span>            
        </div>

        <div class="grid gap-4">
            @foreach($resultados as $empresa)
                @php
                    // Mapeamento dinâmico de cores e nomes para as situações cadastrais (pelos números reais do BD)
                    $statusMap = [
                        '1' => ['label' => 'NULA', 'style' => 'bg-slate-500/10 text-slate-400 border-slate-500/20'],
                        '2' => ['label' => 'ATIVA', 'style' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20'],
                        '3' => ['label' => 'SUSPENSA', 'style' => 'bg-amber-500/10 text-amber-400 border-amber-500/20'],
                        '4' => ['label' => 'INAPTA', 'style' => 'bg-orange-500/10 text-orange-400 border-orange-500/20'],
                        '8' => ['label' => 'BAIXADA', 'style' => 'bg-rose-500/10 text-rose-400 border-rose-500/20'],
                    ];
                    
                    // Garante que é string para buscar na chave
                    $codigoSituacao = (string) $empresa->situacao_cadastral;
                    $situacao = $statusMap[$codigoSituacao] ?? ['label' => 'DESCONHECIDA', 'style' => 'bg-gray-500/10 text-gray-400 border-gray-500/20'];
                @endphp
                
                <a href="{{ route('cnpj.show', ['cnpj' => $empresa->cnpj_basico . $empresa->cnpj_ordem . $empresa->cnpj_dv]) }}" class="group block bg-[#0F0F11] border border-white/10 rounded-2xl p-5 hover:border-amber-500/50 hover:bg-white/[0.02] transition-all duration-300 relative overflow-hidden">
                    {{-- Hover Glow --}}
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/[0.03] to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out pointer-events-none"></div>
                    
                    <div class="flex items-start justify-between gap-4 relative z-10">
                        <div class="flex items-start gap-4">
                            <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-gray-800 to-black border border-white/10 flex items-center justify-center text-amber-500 group-hover:text-amber-400 group-hover:scale-110 transition-all shadow-lg">
                                <i class="bi bi-building text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white group-hover:text-amber-400 transition-colors line-clamp-1">
                                    {{ $empresa->empresa->razao_social ?? 'Razão Social Indisponível' }}
                                </h3>
                                <div class="flex flex-wrap items-center gap-3 mt-1.5 text-sm text-gray-400">
                                    {{-- CNPJ Formatado --}}
                                    <span class="font-mono text-xs bg-white/5 px-1.5 py-0.5 rounded">
                                        {{ preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $empresa->cnpj_basico . $empresa->cnpj_ordem . $empresa->cnpj_dv) }}
                                    </span>
                                    
                                    {{-- Município e UF pelo Relacionamento --}}
                                    <span class="flex items-center gap-1">
                                        <i class="bi bi-geo-alt text-gray-600"></i> 
                                        {{ $empresa->municipioRel->descricao ?? 'N/A' }} - {{ $empresa->uf }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            {{-- Situação Cadastral via Mapa de Cores --}}
                            <span class="px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wide border {{ $situacao['style'] }}">
                                {{ $situacao['label'] }}
                            </span>
                            <span class="text-xs text-gray-500">Desde {{ date('d/m/Y', strtotime($empresa->data_inicio_atividade)) }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@else
    <div id="resultsArea" class="mt-16 bg-[#0F0F11] border border-white/10 rounded-3xl p-12 text-center scroll-mt-24">
        <div class="h-20 w-20 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-6 text-gray-600">
            <i class="bi bi-search text-3xl"></i>
        </div>
        <h3 class="text-xl font-bold text-white mb-2">Nenhum resultado encontrado</h3>
        <p class="text-gray-400">Tente ajustar os filtros para encontrar o que procura.</p>
    </div>
@endif