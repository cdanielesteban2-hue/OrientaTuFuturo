<?php
/** @var array $cuestionario */
/** @var array $preguntas */
/** @var string $error */
$url_base = defined('URL_BASE') ? constant('URL_BASE') : '';
?>

<div class="max-w-3xl mx-auto px-4 py-8">
    
    <!-- Barra de Progreso y Metadatos Superiores -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3">
            <div class="flex items-center gap-2">
                <span id="dimension-badge" class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-blue-100 dark:bg-blue-950/80 text-blue-700 dark:text-blue-300">
                    Dimensión: Intereses Vocacionales
                </span>
                <button type="button" onclick="abrirModalEtica()" class="text-xs text-slate-500 hover:text-blue-600 dark:hover:text-blue-400 underline font-medium flex items-center gap-1">
                    <i class="fa-solid fa-circle-info"></i> Fuentes &amp; Metodología
                </button>
            </div>

            <div class="text-right text-xs font-semibold text-slate-500 dark:text-slate-400">
                <span id="step-indicator" class="font-bold text-blue-600 dark:text-blue-400">Pregunta 1 de <?php echo count($preguntas); ?></span>
                <span id="step-percentage" class="ml-1 text-slate-400">(0% completado)</span>
            </div>
        </div>

        <!-- Barra Visual de Progreso Dinámica -->
        <div class="w-full h-2.5 bg-slate-200 dark:bg-slate-800 rounded-full overflow-hidden">
            <div id="progress-fill" class="h-full bg-gradient-to-r from-blue-600 to-indigo-600 transition-all duration-300 ease-out" style="width: 0%;"></div>
        </div>
    </div>

    <?php if (!empty($error)): ?>
        <div class="p-4 mb-6 rounded-2xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-900 text-rose-700 dark:text-rose-300 text-sm flex items-center gap-3">
            <i class="fa-solid fa-triangle-exclamation text-lg"></i>
            <span><?php echo htmlspecialchars($error); ?></span>
        </div>
    <?php endif; ?>

    <form id="vocationalForm" method="POST" action="<?php echo $url_base; ?>cuestionarios/resolver?id=<?php echo $cuestionario['id_cuestionario'] ?? 2; ?>">
        <?php foreach ($preguntas as $index => $preg): ?>
            <div class="question-step <?php echo $index === 0 ? 'active' : ''; ?>" 
                 id="step_<?php echo $index; ?>" 
                 data-dimension="<?php echo htmlspecialchars($preg['dimension'] ?? 'Intereses Vocacionales'); ?>"
                 style="<?php echo $index === 0 ? '' : 'display: none;'; ?>">
                
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-10 shadow-xl mb-6 relative">
                    
                    <div class="mb-6">
                        <div class="text-xs font-extrabold text-blue-600 dark:text-blue-400 uppercase tracking-widest mb-2">
                            PREGUNTA <?php echo $index + 1; ?> DE <?php echo count($preguntas); ?>
                        </div>
                        <h2 class="text-xl sm:text-2xl font-heading font-extrabold text-slate-900 dark:text-white leading-snug">
                            <?php echo htmlspecialchars($preg['pregunta']); ?>
                        </h2>
                        <?php if (!empty($preg['tip'])): ?>
                            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 italic mt-2">
                                💡 <?php echo htmlspecialchars($preg['tip']); ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <!-- Lista de 6 Opciones RIASEC (a, b, c, d, e, f) -->
                    <div class="space-y-3">
                        <?php 
                        $opciones = [
                            'a' => ['letra' => 'A', 'texto' => $preg['a'] ?? ''],
                            'b' => ['letra' => 'B', 'texto' => $preg['b'] ?? ''],
                            'c' => ['letra' => 'C', 'texto' => $preg['c'] ?? ''],
                            'd' => ['letra' => 'D', 'texto' => $preg['d'] ?? ''],
                            'e' => ['letra' => 'E', 'texto' => $preg['e'] ?? ''],
                            'f' => ['letra' => 'F', 'texto' => $preg['f'] ?? '']
                        ];
                        foreach ($opciones as $key => $opt): 
                            if (empty($opt['texto'])) continue;
                        ?>
                            <label class="option-card w-full text-left p-4 sm:p-5 rounded-2xl border border-slate-200 dark:border-slate-800 hover:border-slate-300 dark:hover:border-slate-700 bg-white dark:bg-slate-900/50 hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-all duration-200 flex items-start gap-4 cursor-pointer select-none">
                                <input type="radio" 
                                       name="respuestas[<?php echo $preg['id_pregunta']; ?>]" 
                                       value="<?php echo $key; ?>" 
                                       class="sr-only"
                                       onchange="handleOptionSelect(this, <?php echo $index; ?>)">
                                
                                <div class="option-radio-dot w-6 h-6 rounded-full border-2 border-slate-300 dark:border-slate-700 flex items-center justify-center text-xs font-bold text-transparent shrink-0 mt-0.5 transition">
                                    ✓
                                </div>

                                <div class="flex-1">
                                    <p class="text-sm sm:text-base font-medium text-slate-800 dark:text-slate-200 leading-relaxed">
                                        <?php echo htmlspecialchars($opt['texto']); ?>
                                    </p>
                                </div>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <!-- Ajuste de avance automático -->
                    <div class="flex items-center justify-between mt-6 pt-4 border-t border-slate-100 dark:border-slate-800 text-xs text-slate-400">
                        <label class="inline-flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" id="autoAdvanceToggle" checked class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            <span>Avanzar automáticamente al seleccionar una opción</span>
                        </label>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Controles Inferiores de Navegación -->
        <div class="flex items-center justify-between gap-4">
            <button type="button" id="btnPrev" onclick="prevStep()" class="px-6 py-3 rounded-xl text-sm font-bold border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition flex items-center gap-2" style="visibility: hidden;">
                <i class="fa-solid fa-arrow-left"></i> Anterior
            </button>

            <button type="button" id="btnNext" onclick="nextStep()" class="px-8 py-3 rounded-xl text-sm font-bold bg-slate-200 dark:bg-slate-800 text-slate-400 cursor-not-allowed transition flex items-center gap-2" disabled>
                <span>Siguiente</span>
                <i class="fa-solid fa-arrow-right"></i>
            </button>

            <button type="submit" id="btnSubmit" class="px-9 py-3.5 rounded-xl text-sm font-extrabold bg-gradient-to-r from-amber-500 to-amber-400 text-slate-950 shadow-xl shadow-amber-400/20 hover:scale-[1.02] transition flex items-center gap-2" style="display: none;">
                <i class="fa-solid fa-circle-check"></i>
                <span>Finalizar y Ver Diagnóstico</span>
            </button>
        </div>
    </form>
</div>

<!-- Modal Interactivo de Fuentes y Reconocimientos Éticos (Requisito Obligatorio) -->
<div id="modalEtica" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm" style="display: none;">
    <div class="relative w-full max-w-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-2xl p-6 sm:p-8 overflow-y-auto max-h-[90vh] text-left">
        <button type="button" onclick="cerrarModalEtica()" class="absolute top-5 right-5 w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-900 dark:hover:text-white flex items-center justify-center text-lg transition">
            ✕
        </button>

        <div class="flex items-center gap-3 mb-5">
            <div class="w-12 h-12 rounded-2xl bg-amber-400/20 text-amber-500 flex items-center justify-center text-xl font-bold">
                <i class="fa-solid fa-scale-balanced"></i>
            </div>
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400">
                    Marco Metodológico &amp; Ético
                </span>
                <h3 class="text-2xl font-heading font-extrabold text-slate-900 dark:text-white">
                    Fuentes de Referencia y Reconocimientos
                </h3>
            </div>
        </div>

        <div class="p-4 sm:p-5 rounded-2xl bg-blue-50 dark:bg-blue-950/40 border border-blue-200 dark:border-blue-800/60 mb-6">
            <p class="text-sm font-semibold text-blue-900 dark:text-blue-200 leading-relaxed italic">
                “Este test de orientación vocacional se inspira y toma como referencia el Test Vocacional de Filadd (basado en el modelo de John Holland), el Test de Orientación Vocacional de la Universidad de Santander (UDES) y el Test de Orientación Vocacional de la Universidad de Medellín (UVirtualAbierta).”
            </p>
        </div>

        <div class="space-y-4 mb-6">
            <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800">
                <h4 class="text-sm font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-1">
                    <span class="text-blue-500">●</span> Filadd (Modelo RIASEC de John Holland)
                </h4>
                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                    Evaluación dinámica de intereses, habilidades, hábitos de estudio y preferencias en 6 áreas ocupacionales clave para estudiantes de 10° y 11°.
                </p>
            </div>

            <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800">
                <h4 class="text-sm font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-1">
                    <span class="text-emerald-500">●</span> Universidad de Santander (UDES)
                </h4>
                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                    Orientación enfocada en autoconocimiento de personalidad y prevención de la deserción universitaria en Colombia.
                </p>
            </div>

            <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800">
                <h4 class="text-sm font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-1">
                    <span class="text-amber-500">●</span> Universidad de Medellín (UVirtualAbierta)
                </h4>
                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                    Recorrido para clarificar sueños profesionales y verdaderas preferencias académicas antes de matricularse.
                </p>
            </div>
        </div>

        <div class="p-4 rounded-2xl bg-amber-50 dark:bg-amber-950/30 border border-amber-300 dark:border-amber-800/60 mb-6">
            <p class="text-xs font-medium text-amber-800 dark:text-amber-200 leading-relaxed">
                ⚠️ “Este test es una herramienta de orientación y no reemplaza una asesoría profesional personalizada de un orientador vocacional, psicólogo o pedagogo.”
            </p>
        </div>

        <button type="button" onclick="cerrarModalEtica()" class="w-full py-3.5 px-6 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold transition shadow-lg shadow-blue-600/25">
            Continuar Test
        </button>
    </div>
</div>

<script>
let currentStepIndex = 0;
const steps = document.querySelectorAll('.question-step');
const totalSteps = steps.length;

function updateProgress() {
    const percent = Math.round(((currentStepIndex + 1) / totalSteps) * 100);
    document.getElementById('progress-fill').style.width = percent + '%';
    document.getElementById('step-indicator').textContent = `Pregunta ${currentStepIndex + 1} de ${totalSteps}`;
    document.getElementById('step-percentage').textContent = `(${percent}% completado)`;
    
    // Actualizar badge de dimensión
    const currentStepEl = steps[currentStepIndex];
    if (currentStepEl) {
        const dim = currentStepEl.getAttribute('data-dimension') || 'Intereses Vocacionales';
        document.getElementById('dimension-badge').textContent = `Dimensión: ${dim}`;
    }

    // Control botón Anterior
    if (currentStepIndex === 0) {
        document.getElementById('btnPrev').style.visibility = 'hidden';
    } else {
        document.getElementById('btnPrev').style.visibility = 'visible';
    }

    // Control botón Siguiente vs Finalizar
    if (currentStepIndex === totalSteps - 1) {
        document.getElementById('btnNext').style.display = 'none';
        document.getElementById('btnSubmit').style.display = 'inline-flex';
    } else {
        document.getElementById('btnNext').style.display = 'inline-flex';
        document.getElementById('btnSubmit').style.display = 'none';
    }

    checkCurrentAnswered();
}

function showStep(index) {
    steps.forEach((el, idx) => {
        if (idx === index) {
            el.style.display = 'block';
            el.classList.add('active');
        } else {
            el.style.display = 'none';
            el.classList.remove('active');
        }
    });
    currentStepIndex = index;
    updateProgress();
}

function checkCurrentAnswered() {
    const currentStepEl = steps[currentStepIndex];
    const checked = currentStepEl.querySelector('input[type="radio"]:checked');
    const btnNext = document.getElementById('btnNext');
    const btnSubmit = document.getElementById('btnSubmit');

    if (checked) {
        btnNext.disabled = false;
        btnNext.className = "px-8 py-3 rounded-xl text-sm font-bold bg-blue-600 hover:bg-blue-700 text-white shadow-lg shadow-blue-600/25 transition flex items-center gap-2 cursor-pointer";
        
        btnSubmit.disabled = false;
        btnSubmit.className = "px-9 py-3.5 rounded-xl text-sm font-extrabold bg-gradient-to-r from-amber-500 to-amber-400 text-slate-950 shadow-xl shadow-amber-400/20 hover:scale-[1.02] transition flex items-center gap-2 cursor-pointer";
    } else {
        btnNext.disabled = true;
        btnNext.className = "px-8 py-3 rounded-xl text-sm font-bold bg-slate-200 dark:bg-slate-800 text-slate-400 cursor-not-allowed transition flex items-center gap-2";
        
        btnSubmit.disabled = true;
        btnSubmit.className = "px-9 py-3.5 rounded-xl text-sm font-extrabold bg-slate-200 dark:bg-slate-800 text-slate-400 cursor-not-allowed transition flex items-center gap-2";
    }
}

function handleOptionSelect(radioInput, stepIndex) {
    const currentStepEl = steps[stepIndex];
    const cards = currentStepEl.querySelectorAll('.option-card');
    
    cards.forEach(card => {
        const dot = card.querySelector('.option-radio-dot');
        card.classList.remove('border-blue-600', 'bg-blue-50/80', 'dark:bg-blue-950/40', 'ring-2', 'ring-blue-500/20');
        if (dot) {
            dot.classList.remove('bg-blue-600', 'text-white', 'border-blue-600');
            dot.classList.add('border-slate-300', 'dark:border-slate-700', 'text-transparent');
        }
    });

    const selectedCard = radioInput.closest('.option-card');
    if (selectedCard) {
        selectedCard.classList.add('border-blue-600', 'bg-blue-50/80', 'dark:bg-blue-950/40', 'ring-2', 'ring-blue-500/20');
        const selectedDot = selectedCard.querySelector('.option-radio-dot');
        if (selectedDot) {
            selectedDot.classList.add('bg-blue-600', 'text-white', 'border-blue-600');
            selectedDot.classList.remove('text-transparent');
        }
    }

    checkCurrentAnswered();

    // Avance automático si el checkbox está activo
    const autoAdvance = document.getElementById('autoAdvanceToggle').checked;
    if (autoAdvance && stepIndex < totalSteps - 1) {
        setTimeout(() => {
            nextStep();
        }, 340);
    }
}

function nextStep() {
    if (currentStepIndex < totalSteps - 1) {
        showStep(currentStepIndex + 1);
    }
}

function prevStep() {
    if (currentStepIndex > 0) {
        showStep(currentStepIndex - 1);
    }
}

function abrirModalEtica() {
    const modal = document.getElementById('modalEtica');
    if (modal) modal.style.display = 'flex';
}

function cerrarModalEtica() {
    const modal = document.getElementById('modalEtica');
    if (modal) modal.style.display = 'none';
}

document.addEventListener('DOMContentLoaded', () => {
    showStep(0);
});
</script>
