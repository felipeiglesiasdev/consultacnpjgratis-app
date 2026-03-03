<section id="consultar" class="relative overflow-hidden bg-[#050509] text-white min-h-[700px] flex items-center">
    
    {{-- 
        ========================================
        CANVAS DA ANIMAÇÃO DE SINAPSES (NETWORK)
        ========================================
    --}}
    <canvas id="network-canvas" class="absolute inset-0 w-full h-full z-0 opacity-40"></canvas>

    {{-- Vignette e Glows de Fundo --}}
    <div class="pointer-events-none absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-[#050509] via-transparent to-[#050509]"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-[500px] bg-amber-500/10 blur-[120px] rounded-full mix-blend-screen"></div>
    </div>

    <div class="relative container mx-auto px-6 md:px-10 xl:px-16 py-12 md:py-20 z-10">
        <div class="grid gap-16 lg:gap-20 items-center lg:grid-cols-[1.3fr_1fr]">
            
             {{-- 
                ========================================
                LADO ESQUERDO: TEXTO E FORMULÁRIO (Novo Design)
                ========================================
            --}}
            <div class="space-y-10">
                
                {{-- Badge "Novo" --}}
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm shadow-lg shadow-amber-900/10">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                    </span>
                    <span class="text-[10px] uppercase tracking-widest font-bold text-amber-100">Base Receita Federal Atualizada</span>
                </div>

                {{-- Título Principal --}}
                <div class="space-y-4">
                    <h1 class="text-4xl md:text-5xl xl:text-6xl font-black tracking-tight leading-tight">
                        Consulte qualquer CNPJ em
                        <span class="text-amber-400">segundos</span>.
                    </h1>
                    <p class="text-lg text-gray-400 max-w-xl leading-relaxed">
                        Acesso rápido e gratuito ao Quadro de Sócios, Situação Cadastral, CNAEs e muito mais. Inteligência de dados para seus negócios.
                    </p>
                </div>

                {{-- Formulário (Clean e Otimizado) --}}
                <div class="relative max-w-xl">
                    <form action="{{ route('cnpj.consultar') }}" method="POST" class="max-w-2xl">
                        @csrf
                        <div class="flex flex-col sm:flex-row gap-3 items-stretch">
                            <div class="relative flex-1">
                                <label for="cnpj-input-aside" class="sr-only">CNPJ</label>
                                <input
                                    type="tel" 
                                    name="cnpj" 
                                    id="cnpj-input-aside" 
                                    placeholder="Digite o CNPJ 00.000.000/0000-00"
                                    required
                                    aria-label="Número do CNPJ"
                                    class="w-full rounded-2xl border border-white/15 bg-white/5 px-4 py-3.5 pr-10 text-sm md:text-base text-white placeholder:text-gray-500 focus:border-amber-400 focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-amber-500/20 transition-all duration-300"
                                >
                                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-500">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>
                            <button
                                type="submit"
                                class="cursor-pointer inline-flex items-center justify-center rounded-2xl px-6 md:px-8 py-3.5 text-sm md:text-base font-bold bg-gradient-to-r from-amber-400 to-amber-500 text-[#171717] hover:from-amber-300 hover:to-amber-400 shadow-lg shadow-amber-500/20 transition-all duration-200 hover:-translate-y-0.5"
                            >
                                <i class="bi bi-search mr-2"></i>
                                Consultar agora
                            </button>
                        </div>

                        <p class="mt-3 flex items-center gap-2 text-[11px] md:text-xs text-gray-400">
                            <i class="bi bi-shield-check text-amber-300"></i>
                            Consulta 100% gratuita • Dados oficiais da Receita Federal • Ambiente seguro
                        </p>
                    </form>  
                </div>
            </div>

            {{-- 
                ========================================
                LADO DIREITO: CARD HOLOGRÁFICO
                ========================================
            --}}
            <div class="relative lg:flex justify-center items-center perspective-1000">
                
                {{-- Efeito de Fundo do Elemento --}}
                <div class="absolute w-[500px] h-[500px] bg-gradient-to-tr from-amber-500/10 to-purple-500/5 rounded-full blur-3xl animate-pulse-slow"></div>

                {{-- Card Holográfico Principal --}}
                <div class="relative w-full max-w-md bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-2xl transform transition-transform hover:scale-[1.02] duration-500 group">
                    
                    {{-- Header do Card --}}
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center shadow-lg shadow-amber-500/20">
                                <i class="bi bi-building text-white text-lg"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-white">Empresa Exemplo Ltda</div>
                                <div class="text-xs text-gray-400 font-mono">12.345.678/0001-00</div>
                            </div>
                        </div>
                        <div class="flex gap-1.5">
                            <span class="h-2 w-2 rounded-full bg-red-500/50"></span>
                            <span class="h-2 w-2 rounded-full bg-amber-500/50"></span>
                            <span class="h-2 w-2 rounded-full bg-emerald-500/50"></span>
                        </div>
                    </div>

                    {{-- Linhas de Dados (Simulação de Scanner) --}}
                    <div class="space-y-5 relative overflow-hidden">
                        {{-- Linha de Scan --}}
                        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-transparent via-amber-500/5 to-transparent -translate-y-full group-hover:animate-scan"></div>

                        {{-- Dado 1 --}}
                        <div class="flex items-center justify-between p-3 rounded-xl bg-white/5 border border-white/5 hover:border-amber-500/30 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-400">
                                    <i class="bi bi-person-badge"></i>
                                </div>
                                <div class="space-y-1">
                                    <div class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Situação</div>
                                    <div class="text-xs text-emerald-400 font-semibold bg-emerald-500/10 px-2 py-0.5 rounded w-fit">ATIVA</div>
                                </div>
                            </div>
                            <i class="bi bi-check-circle-fill text-emerald-500/50"></i>
                        </div>

                        {{-- Dado 2 --}}
                        <div class="flex items-center justify-between p-3 rounded-xl bg-white/5 border border-white/5 hover:border-amber-500/30 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 rounded-lg bg-purple-500/10 flex items-center justify-center text-purple-400">
                                    <i class="bi bi-cash-stack"></i>
                                </div>
                                <div class="space-y-1">
                                    <div class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Capital Social</div>
                                    <div class="text-sm font-medium text-white">R$ 500.000,00</div>
                                </div>
                            </div>
                        </div>

                        {{-- Dado 3 --}}
                        <div class="flex items-center justify-between p-3 rounded-xl bg-white/5 border border-white/5 hover:border-amber-500/30 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 rounded-lg bg-amber-500/10 flex items-center justify-center text-amber-400">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div class="space-y-1">
                                    <div class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Localização</div>
                                    <div class="text-sm font-medium text-white">São Paulo, SP</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Decorativos Flutuantes --}}
                    <div class="absolute -right-6 -top-6 p-3 bg-[#0A0A0C] border border-amber-500/30 rounded-xl shadow-xl flex items-center gap-2 animate-float">
                        <i class="bi bi-shield-check text-emerald-400"></i>
                        <span class="text-xs font-bold text-white">Verificado</span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.1.3/imask.min.js"></script>
<script>
    // --- Lógica do Formulário (Intacta) ---
    document.addEventListener('DOMContentLoaded', function () {
        const cnpjInput = document.getElementById('cnpj-input-aside');
        if (cnpjInput) {
            const mask = IMask(cnpjInput, { mask: '00.000.000/0000-00' });
            const form = cnpjInput.closest('form');
            if (form) {
                form.addEventListener('submit', function() { mask.updateValue(); });
            }
        }
    });

    // --- Animação de Sinapses (Network Canvas) ---
    (function() {
        const canvas = document.getElementById('network-canvas');
        if (!canvas) return;

        const ctx = canvas.getContext('2d');
        let width, height;
        
        // Configuração dos pontos (Nodes)
        let nodes = [];
        const nodeCount = 40; // Quantidade de pontos
        const connectionDistance = 200; // Distância máx para conectar
        const particles = []; // Partículas viajando

        // Resize
        function resize() {
            width = canvas.width = canvas.offsetWidth;
            height = canvas.height = canvas.offsetHeight;
            initNodes();
        }
        window.addEventListener('resize', resize);

        // Classe do Nó (Ponto)
        class Node {
            constructor() {
                this.x = Math.random() * width;
                this.y = Math.random() * height;
                this.vx = (Math.random() - 0.5) * 0.5; // Velocidade lenta
                this.vy = (Math.random() - 0.5) * 0.5;
                this.size = Math.random() * 2 + 1;
                this.pulse = 0; // Estado de pulso (glow ao receber partícula)
            }

            update() {
                this.x += this.vx;
                this.y += this.vy;

                // Rebater nas bordas
                if (this.x < 0 || this.x > width) this.vx *= -1;
                if (this.y < 0 || this.y > height) this.vy *= -1;

                // Reduzir pulso
                if (this.pulse > 0) this.pulse -= 0.05;
                if (this.pulse < 0) this.pulse = 0;
            }

            draw() {
                ctx.beginPath();
                // O ponto aumenta se tiver pulso
                ctx.arc(this.x, this.y, this.size + (this.pulse * 3), 0, Math.PI * 2);
                ctx.fillStyle = `rgba(255, 255, 255, ${0.3 + (this.pulse)})`;
                ctx.fill();
                
                // Glow extra
                if (this.pulse > 0.1) {
                    ctx.shadowBlur = 15;
                    ctx.shadowColor = "rgba(245, 158, 11, 1)"; // Amber glow
                    ctx.fill();
                    ctx.shadowBlur = 0;
                }
            }
        }

        // Classe da Partícula (Sinapse viajante)
        class Particle {
            constructor(nodeA, nodeB) {
                this.nodeA = nodeA;
                this.nodeB = nodeB;
                this.progress = 0;
                this.speed = 0.02 + Math.random() * 0.03;
                this.finished = false;
                this.pausing = false;
                this.pauseTimer = 0;
            }

            update() {
                if (this.pausing) {
                    this.pauseTimer--;
                    if (this.pauseTimer <= 0) {
                        this.finished = true; // Morre após pausar
                    }
                    return;
                }

                this.progress += this.speed;
                if (this.progress >= 1) {
                    this.progress = 1;
                    this.pausing = true;
                    this.pauseTimer = 20; // Tempo de pausa (frames) no nó destino
                    this.nodeB.pulse = 1; // Ativa o pulso no nó destino
                }
            }

            draw() {
                if (this.pausing) return; // Não desenha enquanto pausa (já chegou)

                const x = this.nodeA.x + (this.nodeB.x - this.nodeA.x) * this.progress;
                const y = this.nodeA.y + (this.nodeB.y - this.nodeA.y) * this.progress;

                ctx.beginPath();
                ctx.arc(x, y, 2, 0, Math.PI * 2);
                ctx.fillStyle = "#fbbf24"; // Amber-400
                ctx.shadowBlur = 10;
                ctx.shadowColor = "#fbbf24";
                ctx.fill();
                ctx.shadowBlur = 0;
            }
        }

        function initNodes() {
            nodes = [];
            for (let i = 0; i < nodeCount; i++) {
                nodes.push(new Node());
            }
        }

        function animate() {
            ctx.clearRect(0, 0, width, height);

            // Atualiza e desenha nós
            nodes.forEach(node => {
                node.update();
                node.draw();
            });

            // Desenha conexões
            for (let i = 0; i < nodes.length; i++) {
                for (let j = i + 1; j < nodes.length; j++) {
                    const dx = nodes[i].x - nodes[j].x;
                    const dy = nodes[i].y - nodes[j].y;
                    const dist = Math.sqrt(dx * dx + dy * dy);

                    if (dist < connectionDistance) {
                        ctx.beginPath();
                        ctx.moveTo(nodes[i].x, nodes[i].y);
                        ctx.lineTo(nodes[j].x, nodes[j].y);
                        // Linha mais transparente quanto mais longe
                        ctx.strokeStyle = `rgba(255, 255, 255, ${0.05 * (1 - dist / connectionDistance)})`;
                        ctx.stroke();

                        // Chance aleatória de gerar uma partícula (sinapse)
                        if (Math.random() < 0.002) {
                            particles.push(new Particle(nodes[i], nodes[j]));
                        }
                    }
                }
            }

            // Atualiza e desenha partículas
            for (let i = particles.length - 1; i >= 0; i--) {
                particles[i].update();
                particles[i].draw();
                if (particles[i].finished) {
                    particles.splice(i, 1);
                }
            }

            requestAnimationFrame(animate);
        }

        // Inicia
        resize();
        animate();
    })();
</script>

<style>
    /* Animações CSS complementares */
    @keyframes scan {
        0% { transform: translateY(-100%); }
        100% { transform: translateY(100%); }
    }
    .animate-scan {
        animation: scan 3s cubic-bezier(0.4, 0, 0.2, 1) infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    .animate-float-delayed {
        animation: float 7s ease-in-out infinite 1s;
    }
    .animate-pulse-slow {
        animation: pulse 8s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    .perspective-1000 {
        perspective: 1000px;
    }
</style>
@endpush