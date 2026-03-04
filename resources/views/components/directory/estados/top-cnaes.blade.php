@props([
    'uf',
    'topCnaes',
    'preposicao',
    'nomeEstado',
])

<section class="bg-[#050509] text-white py-20 relative border-t border-white/5">
    <div class="container mx-auto px-6 md:px-10 xl:px-16">
        
        <div class="max-w-3xl mb-12">
            <p class="text-amber-400 font-semibold uppercase text-xs tracking-[0.2em]">
                Atividades em Destaque
            </p>
            <h2 class="mt-2 text-3xl md:text-4xl font-black tracking-tight">
                As áreas que dominam {{ $nomeEstado }}
            </h2>
            <p class="mt-4 text-sm md:text-base text-gray-400">
                Descubra quais são os setores e CNAEs com a maior concentração de empresas ativas. Esses dados são valiosos para entender a vocação econômica do estado.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach($topCnaes as $index => $cnae)
                @php
                    // Formatação manual do código CNAE (Ex: de 6204000 para 62.04-0-00)
                    $cod = str_pad($cnae->codigo, 7, '0', STR_PAD_LEFT);
                    $codigoFormatado = substr($cod, 0, 2) . '.' . substr($cod, 2, 2) . '-' . substr($cod, 4, 1) . '-' . substr($cod, 5, 2);
                @endphp

                {{-- Substituído 'a' por 'div' para remover o link --}}
                <div class="group flex items-start sm:items-center gap-4 rounded-2xl border border-white/5 bg-white/[0.02] p-5 hover:bg-white/[0.04] transition-colors">
                    
                    {{-- Badge Numérica --}}
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-black/50 border border-white/5 text-emerald-500/80 font-mono text-sm font-bold group-hover:text-emerald-400 transition-colors">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-1.5">
                            <span class="inline-flex w-fit items-center rounded bg-emerald-500/10 px-2 py-0.5 text-[10px] font-mono font-bold text-emerald-300 border border-emerald-500/20">
                                CNAE {{ $codigoFormatado }}
                            </span>
                            <span class="text-[11px] font-bold text-amber-200">
                                {{ number_format($cnae->ativos_count, 0, ',', '.') }} empresas
                            </span>
                        </div>
                        
                        <p class="text-sm font-bold text-gray-100 leading-snug group-hover:text-white transition-colors">
                            {{ $cnae->descricao }}
                        </p>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</section>