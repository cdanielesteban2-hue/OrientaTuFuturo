<?php $url_base = constant('URL_BASE'); ?>
<?php
$colores = [
    'Inglés' => ['#2563eb', 'fa-solid fa-language', 'Comprensión de textos, vocabulario y uso funcional del idioma.'],
    'Ciencias Naturales' => ['#10b981', 'fa-solid fa-flask', 'Biología, química, física y análisis de fenómenos naturales.'],
    'Lectura Crítica' => ['#8b5cf6', 'fa-solid fa-book-open-reader', 'Interpretación, evaluación de argumentos e inferencias.'],
    'Matemáticas' => ['#f59e0b', 'fa-solid fa-calculator', 'Álgebra, geometría, estadística y razonamiento cuantitativo.'],
    'Sociales' => ['#ef4444', 'fa-solid fa-landmark', 'Historia, ciudadanía, territorio y análisis de fenómenos sociales.'],
];
?>
<div class="container" style="padding: 40px 20px;">
    <div style="text-align: center; margin-bottom: 40px;">
        <span class="badge badge-primary"><i class="fa-solid fa-layer-group"></i> Práctica por competencias</span>
        <h1 style="font-size: 2.5rem; margin: 10px 0; color: var(--text-primary);">Pre-ICFES profundizado</h1>
        <p style="color: var(--text-secondary); font-size: 1.05rem; max-width: 700px; margin: 0 auto;">
            Selecciona una materia. Cada prueba tiene aproximadamente 25 preguntas, calcula tu porcentaje y explica tus respuestas incorrectas al finalizar.
        </p>
    </div>
    <div class="preicfes-subject-grid" style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 20px;">
        <?php foreach ($materias as $materia): ?>
            <?php [$color, $icono, $descripcion] = $colores[$materia]; ?>
            <a href="<?php echo $url_base; ?>simulacros/resolver?materia=<?php echo urlencode($materia); ?>" class="card-premium preicfes-subject-card" style="border-top: 4px solid <?php echo $color; ?>; text-decoration: none; color: inherit; display: flex; flex-direction: column; min-height: 230px;">
                <span class="preicfes-mode-icon" style="background: <?php echo $color; ?>20; color: <?php echo $color; ?>;"><i class="<?php echo $icono; ?>"></i></span>
                <h2 style="font-size: 1.25rem; margin: 16px 0 8px;"><?php echo htmlspecialchars($materia); ?></h2>
                <p style="color: var(--text-secondary); line-height: 1.55; flex: 1; margin-bottom: 18px;"><?php echo htmlspecialchars($descripcion); ?></p>
                <span class="btn" style="width: 100%; background: <?php echo $color; ?>; color: white;">Resolver 25 preguntas <i class="fa-solid fa-arrow-right"></i></span>
            </a>
        <?php endforeach; ?>
    </div>
    <div style="text-align: center; margin-top: 35px;">
        <a href="<?php echo $url_base; ?>simulacros/inicio" class="btn btn-outline"><i class="fa-solid fa-arrow-left"></i> Volver a Pre-ICFES</a>
    </div>
</div>
<style>
.preicfes-mode-icon { width: 52px; height: 52px; border-radius: 14px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.35rem; }
.preicfes-mode-card, .preicfes-subject-card { transition: transform .2s ease, box-shadow .2s ease; }
.preicfes-mode-card:hover, .preicfes-subject-card:hover { transform: translateY(-4px); }
@media (max-width: 800px) {
    .preicfes-subject-grid { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; }
}
@media (max-width: 560px) {
    .preicfes-subject-grid { grid-template-columns: 1fr !important; }
}
</style>
