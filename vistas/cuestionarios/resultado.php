<?php
/** @var array $area_dominante */
/** @var int $porcentaje_dominante */
/** @var array $areas_map */
/** @var array $conteo */
/** @var int $total */
/** @var array $programas_sugeridos */
$url_base = defined('URL_BASE') ? constant('URL_BASE') : '';
?>
<div style="margin-bottom: 30px; text-align: center;">
    <span class="badge badge-success" style="padding: 6px 14px;"><i class="fa-solid fa-trophy"></i> Diagnóstico Listo</span>
    <h1 style="font-size: 2.5rem; margin-top: 5px;">Tu Perfil Vocacional</h1>
    <p style="color: var(--text-secondary);">Analizamos tus respuestas y aquí tienes tu diagnóstico y sugerencias de carrera.</p>
</div>

<div class="results-wrapper">
    <!-- Left Column: Dominant Area and Chart breakdown -->
    <div>
        <!-- Dominant Area Card -->
        <div class="card-premium" style="border-left: 6px solid <?php echo $area_dominante['color']; ?>; margin-bottom: 30px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="font-size: 1.5rem; color: <?php echo $area_dominante['color']; ?>;">
                    <i class="fa-solid fa-star"></i> Área Dominante: <?php echo htmlspecialchars($area_dominante['nombre']); ?>
                </h3>
                <div style="width: 60px; height: 60px; border-radius: 50%; background-color: <?php echo $area_dominante['color']; ?>; color: white; display: flex; align-items: center; justify-content: center; font-family: var(--font-heading); font-weight: 800; font-size: 1.25rem;">
                    <?php echo $porcentaje_dominante; ?>%
                </div>
            </div>
            <p style="font-size: 1.02rem; line-height: 1.7; color: var(--text-secondary); margin-bottom: 15px;">
                <?php echo htmlspecialchars($area_dominante['descripcion']); ?>
            </p>
        </div>

        <!-- Contenedor en cuadrícula responsiva para barras + radar interactivo -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px;">
            <!-- Breakdown Chart (Barras) -->
            <div class="chart-container" style="margin: 0; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                <h4 style="font-size: 1.15rem; margin-bottom: 15px;"><i class="fa-solid fa-chart-pie"></i> Desglose de Intereses</h4>
                
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <?php foreach ($areas_map as $key => $info): ?>
                        <?php 
                            $votos = $conteo[$key];
                            $pct = round(($votos / $total) * 100);
                        ?>
                        <div class="bar-wrapper">
                            <div class="bar-label">
                                <span><?php echo htmlspecialchars($info['nombre']); ?></span>
                                <strong style="color: <?php echo $info['color']; ?>;"><?php echo $pct; ?>%</strong>
                            </div>
                            <div class="progress-bar-bg">
                                <div class="progress-bar-fill" style="width: <?php echo $pct; ?>%; background-color: <?php echo $info['color']; ?>;"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Radar Chart (Chart.js) -->
            <div class="chart-container" style="margin: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 300px; height: 100%;">
                <h4 style="font-size: 1.15rem; margin-bottom: 15px; width: 100%; text-align: left;"><i class="fa-solid fa-chart-line"></i> Mapa de Afinidades</h4>
                <div style="width: 100%; max-width: 320px; height: 280px; position: relative; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                    <canvas id="radarChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Curated program recommendations matching the dominant area -->
    <div>
        <div class="card" style="height: 100%;">
            <h3 style="font-size: 1.3rem; margin-bottom: 15px; color: var(--primary); border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
                <i class="fa-solid fa-graduation-cap"></i> Carreras Recomendadas Para Ti
            </h3>
            <p style="color: var(--text-secondary); font-size: 0.88rem; margin-bottom: 20px;">
                Según tu afinidad principal con el área de <strong><?php echo htmlspecialchars($area_dominante['nombre']); ?></strong>, te sugerimos investigar los siguientes pregrados:
            </p>

            <?php if (count($programas_sugeridos) === 0): ?>
                <p style="color: var(--text-secondary); font-size: 0.9rem; text-align: center; padding: 20px;">
                    No tenemos carreras de este área específicas en la base de datos actualmente, pero puedes buscar más opciones en el buscador de programas.
                </p>
            <?php else: ?>
                <div style="display: flex; flex-direction: column; gap: 15px; max-height: 400px; overflow-y: auto; padding-right: 5px;">
                    <?php foreach ($programas_sugeridos as $prog): ?>
                        <div style="background-color: var(--bg-main); border-radius: var(--radius-md); padding: 15px; border: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; transition: var(--transition);">
                            <div>
                                <h4 style="font-size: 0.95rem; margin-bottom: 4px; color: var(--text-primary);"><?php echo htmlspecialchars($prog['n_programa']); ?></h4>
                                <small style="color: var(--text-secondary); display: block;">
                                    <i class="fa-solid fa-building-columns"></i> <?php echo htmlspecialchars($prog['universidad_nombre']); ?>
                                </small>
                                <span style="font-size: 0.72rem; color: var(--primary); font-weight: 700; display: block; margin-top: 4px;">
                                    Semestre: <?php echo ($prog['costo'] == 0) ? 'Gratuito' : '$' . number_format($prog['costo'], 0, ',', '.'); ?>
                                </span>
                            </div>
                            
                            <a href="<?php echo $url_base; ?>programas/detalle?id=<?php echo $prog['id_programa']; ?>" class="btn btn-secondary" style="padding: 6px 12px; font-size: 0.8rem; border-radius: var(--radius-sm);">
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if (isset($mostrar_microtest) && $mostrar_microtest): ?>
<div style="background: linear-gradient(135deg, var(--primary), var(--secondary)); border-radius: 12px; padding: 25px; margin-top: 30px; text-align: center; color: white; box-shadow: var(--shadow-md);">
    <h3 style="font-size: 1.5rem; margin-bottom: 10px; color: white;"><i class="fa-solid fa-microscope"></i> ¡Profundicemos en tu perfil!</h3>
    <p style="font-size: 1.05rem; margin-bottom: 20px; opacity: 0.9;">Notamos una fuerte vocación hacia <strong><?php echo htmlspecialchars($area_dominante['nombre']); ?></strong>. Toma nuestro Micro-test especializado para descubrir en qué rama específica de esta área encajas mejor.</p>
    <a href="<?php echo $url_base; ?>cuestionarios/inicio?id=<?php echo $area_dominante['id_microtest']; ?>" class="btn" style="background-color: white; color: var(--primary); font-weight: 800; padding: 12px 30px; border-radius: 30px; box-shadow: var(--shadow-sm);">Tomar Micro-test de Especialidad <i class="fa-solid fa-arrow-right"></i></a>
</div>
<?php endif; ?>

<div style="text-align: center; margin-top: 40px; display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
    <a href="<?php echo $url_base; ?>usuarios/dashboard" class="btn btn-primary">
        <i class="fa-solid fa-gauge"></i> Ir a mi Panel
    </a>
    <a href="<?php echo $url_base; ?>cuestionarios/imprimir?id=<?php echo $cuestionario['id_cuestionario']; ?>" target="_blank" class="btn btn-secondary">
        <i class="fa-solid fa-print"></i> Imprimir Reporte Vocacional
    </a>
    <a href="<?php echo $url_base; ?>cuestionarios/inicio" class="btn btn-outline">
        <i class="fa-solid fa-arrow-rotate-left"></i> Volver a realizar el Test
    </a>
</div>

<!-- Librería de gráficos interactivos Chart.js -->
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
            'Realista',
            'Investigador',
            'Artístico',
            'Social',
            'Emprendedor',
            'Convencional'
        ],
        datasets: [{
            label: 'Afinidad (%)',
            data: [
                <?php echo $pct_a; ?>,
                <?php echo $pct_b; ?>,
                <?php echo $pct_c; ?>,
                <?php echo $pct_d; ?>,
                <?php echo $pct_e; ?>,
                <?php echo $pct_f; ?>
            ],
            fill: true,
            backgroundColor: 'rgba(79, 70, 229, 0.15)', // Color primario translúcido
            borderColor: 'rgba(79, 70, 229, 1)',
            pointBackgroundColor: 'rgba(79, 70, 229, 1)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgba(79, 70, 229, 1)'
        }]
    };

    const config = {
        type: 'radar',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: 15
            },
            plugins: {
                legend: {
                    display: false
                },
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
                    angleLines: {
                        color: '#e2e8f0'
                    },
                    grid: {
                        color: '#e2e8f0'
                    },
                    pointLabels: {
                        font: {
                            family: 'Plus Jakarta Sans',
                            size: 11,
                            weight: '700'
                        },
                        color: '#475569'
                    },
                    ticks: {
                        backdropColor: 'transparent',
                        color: '#94a3b8',
                        font: {
                            size: 9
                        },
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
</script>

