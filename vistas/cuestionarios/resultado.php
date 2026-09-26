<?php
/** @var array $area_dominante */
/** @var array $area_secundaria */
/** @var int $porcentaje_dominante */
/** @var int $porcentaje_secundario */
/** @var string $codigo_holland */
/** @var array $areas_map */
/** @var array $conteo */
/** @var int $total */
/** @var array $programas_sugeridos */
/** @var string $justificacion_diagnostica */
/** @var array|null $usuario_activo */
$url_base = defined('URL_BASE') ? constant('URL_BASE') : '';
?>

<div class="max-w-6xl mx-auto px-4 py-10 space-y-12">
    
    <!-- Encabezado de Diagnóstico Listo -->
    <div class="text-center max-w-3xl mx-auto">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-800 mb-4">
            <i class="fa-solid fa-trophy text-amber-500"></i> Diagnóstico Vocacional Completado
        </span>
        <h1 class="text-3xl sm:text-5xl font-heading font-extrabold text-slate-900 dark:text-white tracking-tight mb-4">
            Tu Perfil Vocacional Personalizado
        </h1>
        <p class="text-slate-600 dark:text-slate-400 text-base sm:text-lg leading-relaxed">
            Cruzamos tus respuestas con el modelo tipológico de John Holland y las áreas de conocimiento de la educación superior colombiana para orientarte con la mayor certeza.
        </p>
    </div>

    <!-- Tarjeta Principal del Área Dominante -->
    <div class="rounded-3xl p-6 sm:p-10 border shadow-xl relative overflow-hidden" 
         style="border-color: <?php echo $area_dominante['color']; ?>40; background: linear-gradient(135deg, <?php echo $area_dominante['color']; ?>12 0%, rgba(255,255,255,0.95) 100%);">
        
        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 mb-6">
            <div>
                <div class="flex flex-wrap items-center gap-2 mb-2">
                    <span class="text-xs font-extrabold uppercase tracking-widest px-3 py-1 rounded-full text-white" style="background-color: <?php echo $area_dominante['color']; ?>;">
                        Área Dominante (<?php echo $porcentaje_dominante; ?>%)
                    </span>
                    <span class="text-xs font-bold text-slate-600 dark:text-slate-400 uppercase tracking-wider bg-white/80 dark:bg-slate-800 px-3 py-1 rounded-full border border-slate-200 dark:border-slate-700">
                        Código Holland: <strong class="text-slate-900 dark:text-white font-extrabold"><?php echo $codigo_holland; ?></strong>
                    </span>
                </div>

                <h2 class="text-2xl sm:text-4xl font-heading font-extrabold text-slate-900" style="color: <?php echo $area_dominante['color']; ?>;">
                    <i class="fa-solid fa-compass"></i> <?php echo htmlspecialchars($area_dominante['nombre']); ?>
                </h2>
                <p class="text-sm font-semibold text-slate-600 mt-1">
                    Tipología Filadd: <?php echo htmlspecialchars($area_dominante['area_filadd']); ?>
                </p>
            </div>

            <div class="w-20 h-20 rounded-2xl flex flex-col items-center justify-center text-white shadow-lg shrink-0" style="background-color: <?php echo $area_dominante['color']; ?>;">
                <span class="text-2xl font-black"><?php echo $area_dominante['clave']; ?></span>
                <span class="text-[11px] font-bold"><?php echo $porcentaje_dominante; ?>%</span>
            </div>
        </div>

        <p class="text-sm sm:text-base text-slate-700 leading-relaxed mb-6 font-normal">
            <?php echo htmlspecialchars($area_dominante['descripcion']); ?>
        </p>

        <!-- Fortalezas y Empleabilidad -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-6 border-t border-slate-200/80">
            <div class="p-4 rounded-2xl bg-white/70 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider block mb-1">
                    <i class="fa-solid fa-brain text-blue-600"></i> Habilidades Clave que Posees:
                </span>
                <p class="text-xs sm:text-sm text-slate-700 dark:text-slate-200 font-medium">
                    <?php echo htmlspecialchars($area_dominante['habilidades']); ?>
                </p>
            </div>

            <div class="p-4 rounded-2xl bg-white/70 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider block mb-1">
                    <i class="fa-solid fa-chart-line text-emerald-600"></i> Proyección en Colombia:
                </span>
                <p class="text-xs sm:text-sm text-slate-700 dark:text-slate-200 font-medium">
                    <?php echo htmlspecialchars($area_dominante['empleabilidad']); ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Gráficos de Resultados: Radar Chart (Chart.js) + Desglose de Barras -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-10 shadow-lg">
        
        <!-- Columna Izquierda: Radar Chart -->
        <div class="lg:col-span-6 flex flex-col items-center">
            <div class="w-full text-center lg:text-left mb-4">
                <h3 class="text-xl font-heading font-extrabold text-slate-900 dark:text-white flex items-center justify-center lg:justify-start gap-2">
                    <i class="fa-solid fa-chart-radar text-blue-600"></i> Mapa Psicométrico RIASEC
                </h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Afinidad comparada entre las 6 tipologías de John Holland
                </p>
            </div>
            <div class="w-full max-w-[340px] h-[300px] relative flex items-center justify-center">
                <canvas id="radarChart"></canvas>
            </div>
        </div>

        <!-- Columna Derecha: Barras Porcentuales -->
        <div class="lg:col-span-6 space-y-4">
            <h3 class="text-xl font-heading font-extrabold text-slate-900 dark:text-white mb-2 flex items-center gap-2">
                <i class="fa-solid fa-bars-progress text-indigo-600"></i> Desglose por Áreas Ocupacionales
            </h3>

            <?php foreach ($areas_map as $key => $info): 
                $votos = $conteo[$key] ?? 0;
                $pct = $total > 0 ? round(($votos / $total) * 100) : 0;
            ?>
                <div class="space-y-1">
                    <div class="flex items-center justify-between text-xs sm:text-sm">
                        <span class="font-bold text-slate-800 dark:text-slate-200 flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full" style="background-color: <?php echo $info['color']; ?>;"></span>
                            <?php echo htmlspecialchars($info['nombre']); ?>
                        </span>
                        <strong style="color: <?php echo $info['color']; ?>;"><?php echo $pct; ?>%</strong>
                    </div>
                    <div class="w-full h-3 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-700 ease-out" style="width: <?php echo $pct; ?>%; background-color: <?php echo $info['color']; ?>;"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Síntesis Diagnóstica Inteligente (Inspirada en UDES y UVirtualAbierta) -->
    <div class="bg-slate-900 text-white rounded-3xl p-6 sm:p-10 border border-slate-800 shadow-2xl relative overflow-hidden">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-xl bg-blue-600/30 text-blue-400 flex items-center justify-center font-bold text-lg">
                <i class="fa-solid fa-lightbulb"></i>
            </div>
            <div>
                <span class="text-xs font-bold text-blue-400 uppercase tracking-widest">
                    Análisis Personalizado
                </span>
                <h3 class="text-xl sm:text-2xl font-bold text-white">
                    ¿Por qué estas carreras encajan contigo?
                </h3>
            </div>
        </div>

        <p class="text-slate-300 text-sm sm:text-base leading-relaxed whitespace-pre-line font-normal">
            <?php echo htmlspecialchars($justificacion_diagnostica); ?>
        </p>
    </div>

    <!-- Carreras Recomendadas y Caminos Académicos -->
    <div>
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400">
                    Oportunidades de Formación
                </span>
                <h2 class="text-2xl sm:text-3xl font-heading font-extrabold text-slate-900 dark:text-white">
                    Carreras Recomendadas Para Tu Futuro
                </h2>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400 max-w-sm">
                Programas con alta pertinencia laboral en Colombia que potencian tu afinidad vocacional dominante.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($programas_sugeridos as $idx => $prog): ?>
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 shadow-sm hover:shadow-xl hover:border-blue-500/50 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between text-xs mb-2">
                            <span class="font-bold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/60 px-2.5 py-0.5 rounded-full">
                                Recomendación #<?php echo $idx + 1; ?>
                            </span>
                            <?php if (!empty($prog['empleabilidad'])): ?>
                                <span class="font-bold text-emerald-600 dark:text-emerald-400">
                                    📈 <?php echo $prog['empleabilidad']; ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <h3 class="text-lg font-extrabold text-slate-900 dark:text-white mb-2 leading-tight">
                            <?php echo htmlspecialchars($prog['n_programa']); ?>
                        </h3>

                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-3 flex items-center gap-1.5">
                            <i class="fa-solid fa-building-columns text-slate-400"></i>
                            <span><?php echo htmlspecialchars($prog['universidad_nombre'] ?? 'Universidades Aliadas en Colombia'); ?></span>
                        </p>

                        <div class="text-xs font-semibold text-slate-700 dark:text-slate-300 space-y-1 mb-4">
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Duración:</span>
                                <span><?php echo htmlspecialchars($prog['duracion'] ?? 10); ?> Semestres</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Costo Semestre:</span>
                                <span class="text-blue-600 dark:text-blue-400 font-bold">
                                    <?php echo (isset($prog['costo']) && $prog['costo'] == 0) ? 'Matrícula Cero / Pública' : ((isset($prog['costo']) && $prog['costo'] > 0) ? '$' . number_format($prog['costo'], 0, ',', '.') : 'A consultar'); ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <a href="<?php echo $url_base; ?>programas/inicio?buscar=<?php echo urlencode($prog['n_programa']); ?>" class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl text-xs font-bold bg-slate-900 dark:bg-slate-800 hover:bg-blue-600 text-white dark:hover:bg-blue-600 transition">
                        <span>Ver Oferta y Becas</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- SECCIÓN OBLIGATORIA DE RECONOCIMIENTOS INSTITUCIONALES Y ÉTICA -->
    <div class="rounded-3xl p-6 sm:p-8 bg-amber-50 dark:bg-slate-900 border-2 border-amber-300 dark:border-amber-900/60 shadow-lg text-left">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-amber-400/30 text-amber-600 dark:text-amber-400 flex items-center justify-center text-2xl shrink-0">
                <i class="fa-solid fa-scale-balanced"></i>
            </div>
            <div class="space-y-3">
                <span class="text-xs font-extrabold uppercase tracking-wider text-amber-800 dark:text-amber-400">
                    Reconocimiento a Fuentes de Referencia y Transparencia Ética (Obligatorio)
                </span>

                <!-- CITA LITERAL OBLIGATORIA -->
                <p class="text-sm sm:text-base font-bold text-slate-900 dark:text-white leading-relaxed">
                    “Este test de orientación vocacional se inspira y toma como referencia el Test Vocacional de Filadd (basado en el modelo de John Holland), el Test de Orientación Vocacional de la Universidad de Santander (UDES) y el Test de Orientación Vocacional de la Universidad de Medellín (UVirtualAbierta).”
                </p>

                <!-- EXPLICACIÓN DE METODOLOGÍA -->
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed font-normal">
                    La metodología se basa en modelos validados internacionalmente (Holland RIASEC: Realista, Investigador, Artístico, Social, Emprendedor, Convencional) y en herramientas institucionales colombianas diseñadas por profesionales orientadas a fortalecer el autoconocimiento y mitigar la deserción universitaria en jóvenes de grados 10° y 11°.
                </p>

                <!-- DISCLAIMER OBLIGATORIO -->
                <div class="pt-2 border-t border-amber-200 dark:border-slate-800">
                    <p class="text-xs font-semibold text-amber-900 dark:text-amber-300 italic">
                        ⚠️ “Este test es una herramienta de orientación y no reemplaza una asesoría profesional personalizada de un orientador vocacional, psicólogo o pedagogo.”
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Botones de Acción (Compartir, Guardar, Imprimir, Repetir) -->
    <div class="flex flex-wrap items-center justify-center gap-4 pt-6 border-t border-slate-200 dark:border-slate-800">
        <!-- Compartir en WhatsApp -->
        <button type="button" onclick="compartirWhatsApp()" class="px-6 py-3.5 rounded-xl text-sm font-bold bg-emerald-600 hover:bg-emerald-700 text-white shadow-lg shadow-emerald-600/20 transition flex items-center gap-2">
            <i class="fa-brands fa-whatsapp text-lg"></i>
            <span>Compartir en WhatsApp</span>
        </button>

        <!-- Copiar Enlace con Toast -->
        <button type="button" id="btnCopiarLink" onclick="copiarEnlace()" class="px-6 py-3.5 rounded-xl text-sm font-bold bg-slate-900 dark:bg-slate-800 hover:bg-blue-600 text-white transition flex items-center gap-2">
            <i class="fa-solid fa-link"></i>
            <span id="btnCopiarTexto">Copiar Enlace</span>
        </button>

        <!-- Imprimir o Guardar en PDF -->
        <a href="<?php echo $url_base; ?>cuestionarios/imprimir?id=<?php echo $cuestionario['id_cuestionario'] ?? 2; ?>" target="_blank" class="px-6 py-3.5 rounded-xl text-sm font-bold border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition flex items-center gap-2">
            <i class="fa-solid fa-print"></i>
            <span>Descargar / Imprimir PDF</span>
        </a>

        <!-- Volver a Realizar -->
        <a href="<?php echo $url_base; ?>cuestionarios/inicio" class="px-6 py-3.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800 dark:hover:text-white transition flex items-center gap-1">
            <i class="fa-solid fa-rotate-left"></i>
            <span>Repetir Test</span>
        </a>

        <?php if (!isset($usuario_activo)): ?>
            <a href="<?php echo $url_base; ?>usuarios/registro" class="px-6 py-3.5 rounded-xl text-sm font-bold bg-amber-400 hover:bg-amber-300 text-black transition flex items-center gap-1.5 shadow-md">
                <i class="fa-solid fa-user-plus"></i>
                <span>Crear Cuenta Gratis Para Guardar</span>
            </a>
        <?php endif; ?>
    </div>
</div>

<!-- Librería Chart.js para el Radar -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('radarChart').getContext('2d');
    
    <?php
    $pct_a = $total > 0 ? round(($conteo['a'] / $total) * 100) : 0;
    $pct_b = $total > 0 ? round(($conteo['b'] / $total) * 100) : 0;
    $pct_c = $total > 0 ? round(($conteo['c'] / $total) * 100) : 0;
    $pct_d = $total > 0 ? round(($conteo['d'] / $total) * 100) : 0;
    $pct_e = $total > 0 ? round(($conteo['e'] / $total) * 100) : 0;
    $pct_f = $total > 0 ? round(($conteo['f'] / $total) * 100) : 0;
    ?>

    const data = {
        labels: [
            'Técnica-Práctica (R)',
            'Científica (I)',
            'Artística (A)',
            'Social (S)',
            'Empresarial (E)',
            'Convencional (C)'
        ],
        datasets: [{
            label: 'Afinidad Vocacional (%)',
            data: [
                <?php echo $pct_a; ?>,
                <?php echo $pct_b; ?>,
                <?php echo $pct_c; ?>,
                <?php echo $pct_d; ?>,
                <?php echo $pct_e; ?>,
                <?php echo $pct_f; ?>
            ],
            fill: true,
            backgroundColor: 'rgba(37, 99, 235, 0.2)',
            borderColor: '#2563eb',
            pointBackgroundColor: '#2563eb',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: '#2563eb',
            pointRadius: 4
        }]
    };

    const config = {
        type: 'radar',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.raw + '%';
                        }
                    }
                }
            },
            scales: {
                r: {
                    angleLines: { color: '#cbd5e1' },
                    grid: { color: '#e2e8f0' },
                    pointLabels: {
                        font: { family: 'Plus Jakarta Sans', size: 10, weight: '700' },
                        color: '#475569'
                    },
                    ticks: {
                        backdropColor: 'transparent',
                        color: '#94a3b8',
                        font: { size: 9 },
                        stepSize: 20
                    },
                    suggestedMin: 0,
                    suggestedMax: 100
                }
            }
        }
    };

    new Chart(ctx, config);
});

function compartirWhatsApp() {
    const texto = encodeURIComponent("¡Hola! Hice mi Test Vocacional en Orienta tu FUTURO (inspirado en Holland RIASEC, Filadd, UDES y UdeM). Mi área dominante es: <?php echo addslashes($area_dominante['nombre']); ?> con <?php echo $porcentaje_dominante; ?>%. ¡Haz el tuyo!");
    window.open("https://api.whatsapp.com/send?text=" + texto, '_blank');
}

function copiarEnlace() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        const txt = document.getElementById('btnCopiarTexto');
        txt.textContent = "¡Enlace Copiado!";
        setTimeout(() => {
            txt.textContent = "Copiar Enlace";
        }, 2500);
    });
}
</script>
