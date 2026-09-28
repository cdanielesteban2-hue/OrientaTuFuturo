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

    <div class="preicfes-mode-grid" style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; margin-bottom: 40px;">
        <a href="<?php echo $url_base; ?>simulacros/resolver?modo=aleatorio" class="card-premium preicfes-mode-card" style="border-top: 4px solid #2563eb; text-decoration: none; color: inherit;">
            <span class="preicfes-mode-icon" style="background: #dbeafe; color: #2563eb;"><i class="fa-solid fa-shuffle"></i></span>
            <h2 style="font-size: 1.35rem; margin: 15px 0 8px;">Pre-ICFES aleatorio</h2>
            <p style="color: var(--text-secondary); margin: 0 0 18px;">25 preguntas mezcladas de todas las materias disponibles.</p>
            <span class="btn btn-primary" style="width: 100%;">Comenzar prueba mixta <i class="fa-solid fa-arrow-right"></i></span>
        </a>
        <a href="<?php echo $url_base; ?>simulacros/profundizado" class="card-premium preicfes-mode-card" style="border-top: 4px solid #eab308; text-decoration: none; color: inherit;">
            <span class="preicfes-mode-icon" style="background: #fef3c7; color: #a16207;"><i class="fa-solid fa-layer-group"></i></span>
            <h2 style="font-size: 1.35rem; margin: 15px 0 8px;">Pre-ICFES profundizado</h2>
            <p style="color: var(--text-secondary); margin: 0 0 18px;">Elige una materia y practica 25 preguntas específicas.</p>
            <span class="btn" style="width: 100%; background: #eab308; color: #422006;">Elegir materia <i class="fa-solid fa-arrow-right"></i></span>
        </a>
    </div>

    <h2 style="font-size: 1.5rem; margin-bottom: 20px; border-bottom: 2px solid var(--border); padding-bottom: 10px;">
        <i class="fa-solid fa-list-check"></i> Simulacros Disponibles
    </h2>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin-bottom: 40px;">
        <?php if (!empty($simulacros)): ?>
            <?php foreach ($simulacros as $s): ?>
                <div class="card-premium" style="display: flex; flex-direction: column; height: 100%; border-top: 4px solid <?php echo $s['color']; ?>;">
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                        <div style="background-color: <?php echo $s['color']; ?>20; color: <?php echo $s['color']; ?>; width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                            <i class="<?php echo $s['icono']; ?>"></i>
                        </div>
                        <div>
                            <span style="font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: <?php echo $s['color']; ?>;"><?php echo htmlspecialchars($s['materia']); ?></span>
                            <h3 style="font-size: 1.2rem; margin: 0;"><?php echo htmlspecialchars($s['titulo']); ?></h3>
                        </div>
                    </div>
                    <p style="color: var(--text-secondary); font-size: 0.95rem; line-height: 1.5; flex-grow: 1; margin-bottom: 20px;">
                        <?php echo htmlspecialchars($s['descripcion']); ?>
                    </p>
                    <a href="<?php echo $url_base; ?>simulacros/resolver?id=<?php echo $s['id_simulacro']; ?>" class="btn" style="width: 100%; background-color: <?php echo $s['color']; ?>; color: white;">
                        <i class="fa-solid fa-play"></i> Iniciar Simulacro
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background-color: var(--bg-card); border-radius: var(--radius-lg); border: 1px dashed var(--border);">
                <i class="fa-solid fa-folder-open" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 15px;"></i>
                <p style="color: var(--text-secondary);">Aún no hay simulacros disponibles. ¡Vuelve pronto!</p>
            </div>
        <?php endif; ?>
    </div>

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
@media (max-width: 620px) {
    .preicfes-mode-grid { grid-template-columns: 1fr !important; }
}
</style>
