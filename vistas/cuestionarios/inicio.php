<?php
/** @var array|null $cuestionario */
$url_base = defined('URL_BASE') ? constant('URL_BASE') : '';
?>
<div style="max-width: 700px; margin: 40px auto; text-align: center; padding: 20px;">
    <span class="badge badge-primary" style="margin-bottom: 15px; padding: 6px 14px;"><i class="fa-solid fa-clipboard-question"></i> Diagnóstico Vocacional</span>
    
    <h1 style="font-size: 2.8rem; line-height: 1.2; margin-bottom: 20px; color: var(--text-primary);">
        Descubre tu Vocación Profesional
    </h1>
    
    <p style="font-size: 1.1rem; color: var(--text-secondary); line-height: 1.7; margin-bottom: 35px;">
        Este test está diseñado por psicólogos y orientadores académicos para ayudarte a descubrir tus verdaderos intereses y aptitudes profesionales. Responde de forma honesta según lo que disfrutas hacer, no hay respuestas buenas ni malas.
    </p>

    <div class="card-premium" style="margin-bottom: 40px; text-align: left;">
        <h3 style="font-size: 1.25rem; margin-bottom: 15px; color: var(--primary); display: flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-circle-info"></i> Información del Test
        </h3>
        
        <div style="display: flex; flex-direction: column; gap: 15px; font-size: 0.92rem;">
            <div style="display: flex; gap: 10px; align-items: center;">
                <span style="font-size: 1.2rem; color: var(--success);"><i class="fa-solid fa-clock"></i></span>
                <span><strong>Duración estimada:</strong> 3 a 5 minutos.</span>
            </div>
            <div style="display: flex; gap: 10px; align-items: center;">
                <span style="font-size: 1.2rem; color: var(--success);"><i class="fa-solid fa-list-check"></i></span>
                <span><strong>Número de preguntas:</strong> 5 preguntas situacionales rápidas.</span>
            </div>
            <div style="display: flex; gap: 10px; align-items: center;">
                <span style="font-size: 1.2rem; color: var(--success);"><i class="fa-solid fa-bullseye"></i></span>
                <span><strong>Resultados:</strong> Análisis porcentual de 4 áreas clave y listado automático de carreras.</span>
            </div>
        </div>
    </div>

    <?php if ($cuestionario): ?>
        <a href="<?php echo $url_base; ?>cuestionarios/resolver?id=<?php echo $cuestionario['id_cuestionario']; ?>" class="btn btn-primary btn-lg" style="padding: 14px 40px; font-size: 1.1rem; font-family: var(--font-heading); box-shadow: var(--shadow-premium);">
            <i class="fa-solid fa-play"></i> Iniciar Test Vocacional Ahora
        </a>
    <?php else: ?>
        <div class="alert-error" style="text-align: left;">
            <i class="fa-solid fa-circle-exclamation"></i> Lo sentimos, no hay cuestionarios disponibles en este momento en el sistema.
        </div>
    <?php endif; ?>
</div>
