<?php $url_base = constant('URL_BASE'); ?>
<div class="container" style="padding: 40px 20px;">
    <div style="text-align: center; margin-bottom: 40px;">
        <h1 style="font-size: 2.5rem; margin-bottom: 10px; color: var(--text-primary);">
            <i class="fa-solid fa-graduation-cap" style="color: var(--primary);"></i> Pre-ICFES Saber 11
        </h1>
        <p style="color: var(--text-secondary); font-size: 1.1rem; max-width: 600px; margin: 0 auto;">
            Prepárate para la prueba de Estado con nuestros simulacros interactivos. Practica, descubre tus errores y mejora tu puntaje para asegurar esa beca o cupo universitario.
        </p>
    </div>

    <div class="preicfes-mode-grid" style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; margin-bottom: 24px;">
        <?php foreach ($modalidades as $clave => $modalidad): ?>
            <?php $es_normal = $clave === 'normal'; ?>
            <a href="<?php echo $url_base; ?>simulacros/resolver?modo=aleatorio&modalidad=<?php echo urlencode($clave); ?>" class="card-premium preicfes-mode-card" style="border-top: 4px solid <?php echo $es_normal ? '#8b5cf6' : '#2563eb'; ?>; text-decoration: none; color: inherit;">
                <span class="preicfes-mode-icon" style="background: <?php echo $es_normal ? '#ede9fe' : '#dbeafe'; ?>; color: <?php echo $es_normal ? '#7c3aed' : '#2563eb'; ?>;"><i class="fa-solid <?php echo $es_normal ? 'fa-flag-checkered' : 'fa-shuffle'; ?>"></i></span>
                <h2 style="font-size: 1.25rem; margin: 15px 0 8px;"><?php echo htmlspecialchars(str_replace('Pre-ICFES aleatorio — ', '', $modalidad['titulo'])); ?></h2>
                <p style="color: var(--text-secondary); margin: 0 0 8px;"><strong><?php echo $modalidad['preguntas']; ?> preguntas</strong> · <?php echo htmlspecialchars($modalidad['duracion']); ?></p>
                <p style="color: var(--text-secondary); margin: 0 0 18px; font-size: .9rem;"><?php echo htmlspecialchars($modalidad['descripcion']); ?></p>
                <span class="btn <?php echo $es_normal ? '' : 'btn-primary'; ?>" style="width: 100%; <?php echo $es_normal ? 'background: #8b5cf6; color: white;' : ''; ?>">Comenzar <i class="fa-solid fa-arrow-right"></i></span>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Pre-ICFES profundizado (por materia) -->
    <div class="card-premium preicfes-profundizado-banner" style="border-top: 4px solid #eab308; margin-bottom: 40px; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 18px;">
        <div style="flex: 1; min-width: 240px;">
            <span class="badge badge-accent" style="margin-bottom: 8px;"><i class="fa-solid fa-layer-group"></i> Por competencias</span>
            <h2 style="font-size: 1.35rem; margin: 0 0 8px;">Pre-ICFES profundizado</h2>
            <p style="color: var(--text-secondary); margin: 0; font-size: 0.95rem; line-height: 1.5;">
                Practica por materia (Matemáticas, Lectura Crítica, Ciencias, Sociales e Inglés) eligiendo 10, 25 o 50 preguntas. Al terminar verás tu porcentaje y las explicaciones de los errores.
            </p>
        </div>
        <a href="<?php echo $url_base; ?>simulacros/profundizado" class="btn btn-accent" style="padding: 12px 22px; font-size: 0.95rem; white-space: nowrap;">
            <i class="fa-solid fa-book-open-reader"></i> Ir a profundizado
        </a>
    </div>

    <p style="text-align: center; color: var(--text-secondary); margin: -10px auto 40px; max-width: 720px;">
        El simulacro normal es una sola prueba de 247 preguntas: primero presenta 123 y, al pulsar continuar, presenta las 124 restantes. Cada sección tiene un límite de 4 horas, igual que la referencia de tiempo y cantidad de preguntas del ICFES real.
    </p>

    <?php if (!empty($intentos)): ?>
        <h2 style="font-size: 1.5rem; margin-bottom: 20px; border-bottom: 2px solid var(--border); padding-bottom: 10px;">
            <i class="fa-solid fa-clock-rotate-left"></i> Tu Historial de Práctica
        </h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 15px;">
            <?php foreach ($intentos as $intento): ?>
                <?php 
                    $puntaje = $intento['puntaje'];
                    $color_puntaje = $puntaje >= 80 ? '#10b981' : ($puntaje >= 60 ? '#f59e0b' : '#ef4444');
                ?>
                <a href="<?php echo $url_base; ?>simulacros/resultado?id=<?php echo $intento['id_intento']; ?>" style="text-decoration: none; color: inherit;">
                    <div class="card-premium" style="padding: 15px; display: flex; align-items: center; justify-content: space-between; transition: transform 0.2s;">
                        <div>
                            <div style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 5px;">
                                <i class="fa-regular fa-calendar"></i> <?php echo date('d M Y, h:i a', strtotime($intento['fecha'])); ?>
                            </div>
                            <h4 style="margin: 0; font-size: 1rem;"><?php echo htmlspecialchars($intento['titulo']); ?></h4>
                        </div>
                        <div style="background-color: <?php echo $color_puntaje; ?>20; color: <?php echo $color_puntaje; ?>; padding: 8px 12px; border-radius: 8px; font-weight: 700; font-size: 1.1rem;">
                            <?php echo $puntaje; ?>%
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<style>
.preicfes-mode-icon { width: 52px; height: 52px; border-radius: 14px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.35rem; }
.preicfes-mode-card { min-height: 245px; display: flex; flex-direction: column; transition: transform .2s ease, box-shadow .2s ease; }
.preicfes-mode-card .btn { margin-top: auto; }
.preicfes-mode-card:hover { transform: translateY(-4px); }
.preicfes-profundizado-banner:hover { border-color: rgba(234, 179, 8, 0.5); }
@media (max-width: 620px) {
    .preicfes-mode-grid { grid-template-columns: 1fr !important; }
}
</style>
