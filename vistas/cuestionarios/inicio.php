<?php
/** @var array $cuestionario */
/** @var array|null $usuario_activo */
$url_base = defined('URL_BASE') ? constant('URL_BASE') : '';
?>

<!-- Contenedor Principal de Inicio del Test -->
<div class="max-w-4xl mx-auto px-4 py-10 sm:py-16 text-center">
    
    <!-- Badges Institucionales y Metodológicos -->
    <div class="inline-flex flex-wrap items-center justify-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-blue-50 dark:bg-blue-950/60 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800 mb-6">
        <span><i class="fa-solid fa-graduation-cap text-amber-500"></i> Orientación Vocacional Universitaria</span>
        <span>•</span>
        <span>Modelo John Holland (RIASEC)</span>
    </div>

    <!-- Título Principal Motivador para Grados 10 y 11 -->
    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-heading font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight mb-6">
        Descubre tu vocación y proyecta tus <span class="text-amber-500">sueños profesionales</span>
    </h1>

    <!-- Descripción Humanizada y Clara -->
    <p class="text-base sm:text-xl text-slate-600 dark:text-slate-300 leading-relaxed max-w-2xl mx-auto mb-8 font-normal">
        Un test gratuito, rápido y validado psicométricamente para estudiantes de grados 10° y 11°. Conoce en qué áreas del conocimiento florecerás, compara opciones de pregrado en Colombia y reduce cualquier riesgo de deserción antes de matricularte.
    </p>

    <!-- Botones de Acción Inmediata -->
    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
        <a href="<?php echo $url_base; ?>cuestionarios/resolver?id=<?php echo $cuestionario['id_cuestionario'] ?? 2; ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-9 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-extrabold text-base rounded-2xl shadow-xl shadow-blue-600/30 hover:scale-[1.02] transition">
            <span>Iniciar Test Vocacional Ahora</span>
            <i class="fa-solid fa-arrow-right"></i>
        </a>

        <button type="button" onclick="abrirModalEtica()" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-4 bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 font-bold text-sm rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm transition">
            <i class="fa-solid fa-scale-balanced text-amber-500"></i>
            <span>Fuentes, Ética y Metodología</span>
        </button>
    </div>

    <!-- Tarjeta de Estructura del Test: 4 Dimensiones Evaluadas -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl text-left mb-10">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-5 border-b border-slate-100 dark:border-slate-800 mb-6">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400">
                    Estructura de la Evaluación
                </span>
                <h3 class="text-xl sm:text-2xl font-heading font-extrabold text-slate-900 dark:text-white mt-1">
                    ¿Qué aspectos evalúa este test vocacional?
                </h3>
            </div>
            <div class="flex items-center gap-2 text-xs font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/50 px-3 py-1.5 rounded-xl border border-emerald-200 dark:border-emerald-800">
                <i class="fa-solid fa-bolt"></i> 100% Gratuito y Ágil
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Dimensión 1 -->
            <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/40 border border-slate-200/80 dark:border-slate-800">
                <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-950/80 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-lg mb-3">
                    <i class="fa-solid fa-lightbulb"></i>
                </div>
                <h4 class="text-sm font-extrabold text-slate-900 dark:text-white mb-1">1. Intereses Reales</h4>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                    Lo que te apasiona hacer de forma espontánea y despierta tu curiosidad natural.
                </p>
            </div>

            <!-- Dimensión 2 -->
            <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/40 border border-slate-200/80 dark:border-slate-800">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-950/80 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-lg mb-3">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
                <h4 class="text-sm font-extrabold text-slate-900 dark:text-white mb-1">2. Habilidades Clave</h4>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                    Tus aptitudes cognitivas, manuales, analíticas y de liderazgo más sólidas.
                </p>
            </div>

            <!-- Dimensión 3 -->
            <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/40 border border-slate-200/80 dark:border-slate-800">
                <div class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-950/80 text-amber-600 dark:text-amber-400 flex items-center justify-center font-bold text-lg mb-3">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                <h4 class="text-sm font-extrabold text-slate-900 dark:text-white mb-1">3. Hábitos de Estudio</h4>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                    Cómo resuelves problemas complejos y asimilas conocimientos en la práctica.
                </p>
            </div>

            <!-- Dimensión 4 -->
            <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/40 border border-slate-200/80 dark:border-slate-800">
                <div class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-950/80 text-purple-600 dark:text-purple-400 flex items-center justify-center font-bold text-lg mb-3">
                    <i class="fa-solid fa-compass"></i>
                </div>
                <h4 class="text-sm font-extrabold text-slate-900 dark:text-white mb-1">4. Sueños y Estilo</h4>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                    El entorno laboral y el impacto con el que deseas trascender profesionalmente.
                </p>
            </div>
        </div>

        <!-- 6 Áreas de Holland Integradas -->
        <div class="mt-6 pt-5 border-t border-slate-100 dark:border-slate-800">
            <span class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider block mb-3">
                Las 6 Áreas Ocupacionales Diagnosticadas:
            </span>
            <div class="flex flex-wrap gap-2 text-xs">
                <span class="px-3 py-1 rounded-lg bg-blue-50 dark:bg-blue-950/60 text-blue-700 dark:text-blue-300 font-semibold border border-blue-200 dark:border-blue-900">⚙️ Técnica-Práctica</span>
                <span class="px-3 py-1 rounded-lg bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 font-semibold border border-emerald-200 dark:border-emerald-900">🔬 Científica-Investigativa</span>
                <span class="px-3 py-1 rounded-lg bg-pink-50 dark:bg-pink-950/60 text-pink-700 dark:text-pink-300 font-semibold border border-pink-200 dark:border-pink-900">🎨 Artística-Creativa</span>
                <span class="px-3 py-1 rounded-lg bg-orange-50 dark:bg-orange-950/60 text-orange-700 dark:text-orange-300 font-semibold border border-orange-200 dark:border-orange-900">🤝 Social-Humanitaria</span>
                <span class="px-3 py-1 rounded-lg bg-purple-50 dark:bg-purple-950/60 text-purple-700 dark:text-purple-300 font-semibold border border-purple-200 dark:border-purple-900">🚀 Empresarial-Comercial</span>
                <span class="px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 font-semibold border border-slate-200 dark:border-slate-700">📋 Administrativa-Organizacional</span>
            </div>
        </div>
    </div>

    <!-- Reconocimiento de Fuentes en la Página de Inicio -->
    <div class="rounded-2xl p-5 bg-amber-50/80 dark:bg-slate-900/80 border border-amber-300/80 dark:border-amber-900/60 text-left">
        <p class="text-xs sm:text-sm text-slate-700 dark:text-slate-300 leading-relaxed">
            <strong class="text-amber-800 dark:text-amber-400">Reconocimiento Institucional:</strong>
            Este test de orientación vocacional se inspira y toma como referencia el Test Vocacional de Filadd (basado en el modelo de John Holland), el Test de Orientación Vocacional de la Universidad de Santander (UDES) y el Test de Orientación Vocacional de la Universidad de Medellín (UVirtualAbierta).
        </p>
    </div>
</div>

<!-- Modal Interactivo de Fuentes y Reconocimientos Éticos (Obligatorio) -->
<div id="modalEtica" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm" style="display: none;">
    <div class="relative w-full max-w-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-2xl p-6 sm:p-8 overflow-y-auto max-h-[90vh] text-left">
        
        <!-- Botón de Cerrar -->
        <button type="button" onclick="cerrarModalEtica()" class="absolute top-5 right-5 w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-900 dark:hover:text-white flex items-center justify-center text-lg transition">
            ✕
        </button>

        <div class="flex items-center gap-3 mb-5">
            <div class="w-12 h-12 rounded-2xl bg-amber-400/20 text-amber-500 flex items-center justify-center text-xl font-bold">
                <i class="fa-solid fa-scale-balanced"></i>
            </div>
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400">
                    Marco Científico &amp; Ético
                </span>
                <h3 class="text-2xl font-heading font-extrabold text-slate-900 dark:text-white">
                    Fuentes de Referencia y Reconocimientos
                </h3>
            </div>
        </div>

        <!-- Cita Literal Requerida -->
        <div class="p-4 sm:p-5 rounded-2xl bg-blue-50 dark:bg-blue-950/40 border border-blue-200 dark:border-blue-800/60 mb-6">
            <p class="text-sm font-semibold text-blue-900 dark:text-blue-200 leading-relaxed italic">
                “Este test de orientación vocacional se inspira y toma como referencia el Test Vocacional de Filadd (basado en el modelo de John Holland), el Test de Orientación Vocacional de la Universidad de Santander (UDES) y el Test de Orientación Vocacional de la Universidad de Medellín (UVirtualAbierta).”
            </p>
        </div>

        <!-- Fuentes Desglosadas -->
        <div class="space-y-4 mb-6">
            <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800">
                <h4 class="text-sm font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-1">
                    <span class="text-blue-500">●</span> Test Vocacional Filadd (Modelo John Holland - RIASEC)
                </h4>
                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                    Referencia principal de test rápido y gratuito para bachilleres de grados 10° y 11°. Evalúa intereses, habilidades, hábitos de estudio y preferencias en las 6 áreas ocupacionales: Técnica-Práctica, Científica-Investigativa, Artística-Creativa, Social-Humanitaria, Empresarial-Comercial y Administrativa-Organizacional.
                </p>
            </div>

            <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800">
                <h4 class="text-sm font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-1">
                    <span class="text-emerald-500">●</span> Universidad de Santander (UDES)
                </h4>
                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                    Enfoque en evaluar personalidad y preferencias del joven para orientarlo con claridad sobre qué áreas del conocimiento se alinean mejor con su futuro, diseñado por profesionales para mitigar la deserción universitaria.
                </p>
            </div>

            <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800">
                <h4 class="text-sm font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-1">
                    <span class="text-amber-500">●</span> Universidad de Medellín (UVirtualAbierta)
                </h4>
                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                    Recorrido de exploración donde el estudiante consolida su autoconocimiento, descubre sus sueños profesionales y define sus verdaderas preferencias académicas antes de matricularse.
                </p>
            </div>
        </div>

        <!-- Disclaimer Ético Obligatorio -->
        <div class="p-4 rounded-2xl bg-amber-50 dark:bg-amber-950/30 border border-amber-300 dark:border-amber-800/60 mb-6">
            <div class="flex items-start gap-3">
                <span class="text-lg"><i class="fa-solid fa-triangle-exclamation text-amber-600"></i></span>
                <div>
                    <h5 class="text-xs font-bold text-amber-900 dark:text-amber-300 uppercase tracking-wide mb-1">
                        Aviso Profesional Deontológico
                    </h5>
                    <p class="text-xs font-medium text-amber-800 dark:text-amber-200 leading-relaxed">
                        “Este test es una herramienta de orientación y no reemplaza una asesoría profesional personalizada de un orientador vocacional, psicólogo o pedagogo.”
                    </p>
                </div>
            </div>
        </div>

        <!-- Botón de Cierre -->
        <button type="button" onclick="cerrarModalEtica()" class="w-full py-3.5 px-6 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold transition shadow-lg shadow-blue-600/25">
            Entendido y De Acuerdo
        </button>
    </div>
</div>

<script>
function abrirModalEtica() {
    const modal = document.getElementById('modalEtica');
    if (modal) {
        modal.style.display = 'flex';
    }
}

function cerrarModalEtica() {
    const modal = document.getElementById('modalEtica');
    if (modal) {
        modal.style.display = 'none';
    }
}

// Cerrar al presionar la tecla Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        cerrarModalEtica();
    }
});
</script>
