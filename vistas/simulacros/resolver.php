<?php $url_base = constant('URL_BASE'); ?>
<div class="container" style="max-width: 800px; padding: 40px 20px;">
    
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px;">
        <div>
            <span style="background-color: <?php echo $simulacro['color']; ?>20; color: <?php echo $simulacro['color']; ?>; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase;">
                <i class="<?php echo $simulacro['icono']; ?>"></i> <?php echo htmlspecialchars($simulacro['materia']); ?>
            </span>
            <h1 style="font-size: 2rem; margin: 10px 0 0 0; color: var(--text-primary);">
                <?php echo htmlspecialchars($simulacro['titulo']); ?>
            </h1>
        </div>
        <a href="<?php echo $url_base; ?>simulacros/inicio" class="btn btn-outline" style="padding: 8px 15px;">
            <i class="fa-solid fa-xmark"></i> Salir
        </a>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert-error" style="margin-bottom: 25px;">
            <i class="fa-solid fa-triangle-exclamation"></i> <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo $url_base; ?>simulacros/resolver?id=<?php echo $simulacro['id_simulacro']; ?>" id="form-simulacro">
        
        <?php foreach ($preguntas as $index => $p): ?>
            <div class="card-premium" style="margin-bottom: 25px; padding: 30px;">
                <div style="display: flex; align-items: flex-start; gap: 15px; margin-bottom: 20px;">
                    <div style="background-color: var(--bg-body); color: var(--text-secondary); width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.1rem; flex-shrink: 0;">
                        <?php echo $index + 1; ?>
                    </div>
                    <h3 style="font-size: 1.1rem; line-height: 1.6; margin: 0; color: var(--text-primary); font-weight: 600;">
                        <?php echo nl2br(htmlspecialchars($p['pregunta'])); ?>
                    </h3>
                </div>

                <div style="display: flex; flex-direction: column; gap: 12px; padding-left: 50px;">
                    <?php 
                    $opciones = [
                        'a' => $p['opcion_a'],
                        'b' => $p['opcion_b'],
                        'c' => $p['opcion_c'],
                        'd' => $p['opcion_d']
                    ];
                    foreach ($opciones as $letra => $texto): 
                    ?>
                        <label class="radio-container" style="padding: 12px 15px; border: 1px solid var(--border); border-radius: 8px; cursor: pointer; transition: all 0.2s; display: flex; align-items: flex-start; gap: 15px;">
                            <input type="radio" name="respuestas[<?php echo $p['id_pregunta']; ?>]" value="<?php echo $letra; ?>" required style="margin-top: 5px;">
                            <span style="font-weight: 700; color: var(--text-muted); text-transform: uppercase;"><?php echo $letra; ?>.</span>
                            <span style="color: var(--text-secondary); line-height: 1.5;"><?php echo htmlspecialchars($texto); ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <div style="background-color: var(--bg-card); padding: 25px; border-radius: var(--radius-lg); border: 1px solid var(--border); text-align: center; margin-top: 40px;">
            <i class="fa-solid fa-flag-checkered" style="font-size: 2rem; color: var(--text-muted); margin-bottom: 15px;"></i>
            <h3 style="margin-bottom: 15px;">¿Terminaste de responder?</h3>
            <p style="color: var(--text-secondary); margin-bottom: 20px; font-size: 0.95rem;">Asegúrate de haber marcado todas las respuestas antes de finalizar.</p>
            <button type="submit" class="btn btn-primary" style="padding: 15px 40px; font-size: 1.1rem;">
                <i class="fa-solid fa-paper-plane"></i> Finalizar y Calificar
            </button>
        </div>

    </form>
</div>

<style>
.radio-container:hover {
    background-color: var(--bg-body);
    border-color: var(--primary);
}
.radio-container input:checked + span + span {
    color: var(--primary);
    font-weight: 600;
}
.radio-container input:checked {
    accent-color: var(--primary);
}
</style>
