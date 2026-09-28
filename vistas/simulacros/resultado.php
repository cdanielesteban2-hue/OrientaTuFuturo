<?php $url_base = constant('URL_BASE'); ?>
<div class="container" style="max-width: 800px; padding: 40px 20px;">
    
    <!-- Encabezado del Resultado -->
    <div class="card-premium" style="text-align: center; padding: 40px 20px; margin-bottom: 40px; border-top: 5px solid <?php echo $intento['puntaje'] >= 60 ? '#10b981' : '#ef4444'; ?>;">
        <span style="font-size: 0.9rem; font-weight: 700; text-transform: uppercase; color: var(--text-muted); letter-spacing: 1px;">Resultado del Simulacro</span>
        <h1 style="font-size: 2rem; margin: 10px 0 20px 0; color: var(--text-primary);">
            <?php echo htmlspecialchars($intento['titulo']); ?>
        </h1>
        
        <div style="display: inline-flex; align-items: center; justify-content: center; width: 120px; height: 120px; border-radius: 50%; background-color: <?php echo $intento['puntaje'] >= 60 ? '#10b98120' : '#ef444420'; ?>; margin-bottom: 20px;">
            <span style="font-size: 3rem; font-weight: 800; color: <?php echo $intento['puntaje'] >= 60 ? '#10b981' : '#ef4444'; ?>;">
                <?php echo $intento['puntaje']; ?><span style="font-size: 1.5rem;">%</span>
            </span>
        </div>

        <p style="color: var(--text-secondary); font-size: 1.1rem; max-width: 500px; margin: 0 auto 30px auto;">
            <?php if ($intento['puntaje'] >= 80): ?>
                ¡Excelente trabajo! Tienes un dominio muy fuerte de estos temas.
            <?php elseif ($intento['puntaje'] >= 60): ?>
                ¡Buen esfuerzo! Has aprobado, pero revisar las justificaciones te ayudará a pulir detalles.
            <?php else: ?>
                Es una gran oportunidad para aprender. Revisa detenidamente las explicaciones abajo para mejorar en tu próximo intento.
            <?php endif; ?>
        </p>

        <div style="display: flex; gap: 15px; justify-content: center;">
            <a href="<?php echo $url_base; ?>simulacros/inicio" class="btn btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Volver a Simulacros
            </a>
            <?php $url_reintento = ($intento['materia'] === 'Mixto')
                ? $url_base . 'simulacros/resolver?modo=aleatorio'
                : $url_base . 'simulacros/resolver?materia=' . urlencode($intento['materia']); ?>
            <a href="<?php echo $url_reintento; ?>" class="btn btn-primary">
                <i class="fa-solid fa-rotate-right"></i> Reintentar
            </a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 35px;">
        <div class="card-premium" style="text-align: center; padding: 18px; border-top: 3px solid #10b981;">
            <strong style="display: block; color: #10b981; font-size: 1.65rem;"><?php echo $correctas; ?></strong>
            <span style="color: var(--text-secondary); font-size: .9rem;">Respuestas correctas</span>
        </div>
        <div class="card-premium" style="text-align: center; padding: 18px; border-top: 3px solid #ef4444;">
            <strong style="display: block; color: #ef4444; font-size: 1.65rem;"><?php echo $incorrectas; ?></strong>
            <span style="color: var(--text-secondary); font-size: .9rem;">Respuestas por revisar</span>
        </div>
        <div class="card-premium" style="text-align: center; padding: 18px; border-top: 3px solid #2563eb;">
            <strong style="display: block; color: #2563eb; font-size: 1.65rem;"><?php echo count($respuestas); ?></strong>
            <span style="color: var(--text-secondary); font-size: .9rem;">Preguntas respondidas</span>
        </div>
    </div>

    <h2 style="font-size: 1.5rem; margin-bottom: 25px; border-bottom: 2px solid var(--border); padding-bottom: 10px;">
        <i class="fa-solid fa-list-check"></i> Revisión y explicación de respuestas
    </h2>
    <?php if ($incorrectas > 0): ?>
        <p style="color: var(--text-secondary); margin: -10px 0 25px;">
            <i class="fa-solid fa-lightbulb" style="color: var(--accent);"></i>
            Las preguntas marcadas en rojo son tus errores. Lee su explicación para entender el procedimiento y volver a intentarlas.
        </p>
    <?php endif; ?>

    <!-- Revisión de Preguntas -->
    <?php foreach ($respuestas as $index => $r): ?>
        <?php 
            $es_correcta = $r['es_correcta'];
            $color_borde = $es_correcta ? '#10b981' : '#ef4444';
            $icono = $es_correcta ? 'fa-solid fa-check' : 'fa-solid fa-xmark';
        ?>
        <div class="card-premium" style="margin-bottom: 25px; border-left: 5px solid <?php echo $color_borde; ?>; padding: 25px;">
            <div style="display: flex; align-items: flex-start; gap: 15px; margin-bottom: 15px;">
                <div style="background-color: <?php echo $color_borde; ?>20; color: <?php echo $color_borde; ?>; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1rem; flex-shrink: 0;">
                    <?php echo $index + 1; ?>
                </div>
                <h3 style="font-size: 1.1rem; line-height: 1.6; margin: 0; color: var(--text-primary); font-weight: 600;">
                    <?php echo nl2br(htmlspecialchars($r['pregunta'])); ?>
                </h3>
            </div>

            <div style="padding-left: 45px; margin-bottom: 20px;">
                <?php 
                $opciones = [
                    'a' => $r['opcion_a'],
                    'b' => $r['opcion_b'],
                    'c' => $r['opcion_c'],
                    'd' => $r['opcion_d']
                ];
                ?>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px;">
                    <?php foreach ($opciones as $letra => $texto): ?>
                        <?php 
                            $es_la_elegida = (strtolower($r['respuesta_usuario']) === $letra);
                            $es_la_correcta = (strtolower($r['correcta']) === $letra);
                            
                            $estilo_li = "padding: 10px 15px; border-radius: 8px; border: 1px solid var(--border); font-size: 0.95rem; display: flex; gap: 10px; align-items: flex-start;";
                            
                            if ($es_la_correcta) {
                                $estilo_li = "padding: 10px 15px; border-radius: 8px; border: 1px solid #10b981; background-color: #10b98110; font-size: 0.95rem; display: flex; gap: 10px; align-items: flex-start; font-weight: 600;";
                            } elseif ($es_la_elegida && !$es_la_correcta) {
                                $estilo_li = "padding: 10px 15px; border-radius: 8px; border: 1px solid #ef4444; background-color: #ef444410; font-size: 0.95rem; display: flex; gap: 10px; align-items: flex-start; color: #ef4444;";
                            }
                        ?>
                        <li style="<?php echo $estilo_li; ?>">
                            <span style="font-weight: 700; text-transform: uppercase; width: 20px; flex-shrink: 0;"><?php echo $letra; ?>.</span>
                            <span style="line-height: 1.5;"><?php echo htmlspecialchars($texto); ?></span>
                            
                            <?php if ($es_la_correcta): ?>
                                <i class="fa-solid fa-circle-check" style="color: #10b981; margin-left: auto; margin-top: 3px;"></i>
                            <?php elseif ($es_la_elegida && !$es_la_correcta): ?>
                                <i class="fa-solid fa-circle-xmark" style="color: #ef4444; margin-left: auto; margin-top: 3px;"></i>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div style="background-color: var(--bg-body); padding: 15px 20px; border-radius: 8px; border-left: 3px solid var(--accent);">
                <span style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--accent); margin-bottom: 5px; text-transform: uppercase;">
                    <i class="fa-solid fa-lightbulb"></i> Explicación
                </span>
                <p style="margin: 0; color: var(--text-secondary); font-size: 0.95rem; line-height: 1.6;">
                    <?php echo nl2br(htmlspecialchars($r['justificacion'])); ?>
                </p>
            </div>
        </div>
    <?php endforeach; ?>

    <div style="text-align: center; margin-top: 40px;">
        <a href="<?php echo $url_base; ?>simulacros/inicio" class="btn btn-secondary" style="padding: 12px 30px;">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> Explorar más simulacros
        </a>
    </div>
</div>
<style>
@media (max-width: 600px) {
    .container > div[style*="grid-template-columns: repeat(3"] { grid-template-columns: 1fr !important; }
}
</style>
