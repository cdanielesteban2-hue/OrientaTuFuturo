<?php $url_base = constant('URL_BASE'); ?>
<?php
// Amarillo dorado fijo para número de pregunta y opción seleccionada
$color_ui = '#eab308';
$color_ui_dark = '#ca8a04';
$accion_resolver = isset($_GET['modo']) && $_GET['modo'] === 'aleatorio'
    ? $url_base . 'simulacros/resolver?modo=aleatorio&modalidad=' . urlencode($_GET['modalidad'] ?? 'corto')
    : (isset($_GET['materia'])
        ? $url_base . 'simulacros/resolver?materia=' . urlencode($_GET['materia'])
        : $url_base . 'simulacros/resolver?id=' . $simulacro['id_simulacro']);
$etiqueta_prueba = isset($_GET['materia']) ? $_GET['materia'] : ($simulacro['materia'] === 'Mixto' ? 'Prueba mixta' : $simulacro['materia']);
$es_normal = isset($es_normal) && $es_normal;
$tiempo_inicial = isset($_SESSION[$session_key]['inicio']) ? max(0, $tiempo_limite_segundos - (time() - $_SESSION[$session_key]['inicio'])) : $tiempo_limite_segundos;
?>
<div class="container" style="max-width: 1100px; padding: 30px 24px; width: 100%; margin: 0 auto;">
    
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 28px; flex-wrap: wrap; gap: 12px;">
        <div>
            <span style="background-color: <?php echo $simulacro['color']; ?>20; color: <?php echo $simulacro['color']; ?>; padding: 6px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase;">
                <i class="<?php echo $simulacro['icono']; ?>"></i> <?php echo htmlspecialchars($etiqueta_prueba); ?>
            </span>
            <h1 style="font-size: 1.85rem; margin: 10px 0 0 0; color: var(--text-primary);">
                <?php echo htmlspecialchars($simulacro['titulo']); ?>
            </h1>
            <p style="color: var(--text-secondary); font-size: 0.9rem; margin: 6px 0 0 0;">
                <i class="fa-solid fa-list-ol"></i> <?php echo count($preguntas_vista); ?> preguntas en esta sección<?php echo $es_normal ? ' · ' . ($fase === 1 ? 'parte 1 de 2' : 'parte 2 de 2') : ''; ?> · resultado porcentual y explicación de errores
            </p>
        </div>
        <a href="<?php echo $url_base; ?>simulacros/inicio" class="btn btn-outline" style="padding: 10px 18px;">
            <i class="fa-solid fa-xmark"></i> Salir
        </a>
    </div>
    <?php if ($tiempo_limite_segundos > 0): ?>
        <div id="cronometro" data-segundos="<?php echo $tiempo_inicial; ?>" style="position: sticky; top: 82px; z-index: 20; display: flex; align-items: center; justify-content: center; gap: 10px; margin: 0 0 24px; padding: 13px 18px; border: 1px solid #eab30866; border-radius: 14px; background: #fffbeb; color: #92400e; font-weight: 800; box-shadow: 0 5px 16px rgba(15,23,42,.12);">
            <i class="fa-solid fa-clock"></i> Tiempo restante: <span id="cronometro-valor">--:--:--</span>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert-error" style="margin-bottom: 25px;">
            <i class="fa-solid fa-triangle-exclamation"></i> <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo htmlspecialchars($accion_resolver); ?>" id="form-simulacro">
        
        <?php foreach ($preguntas_vista as $index => $p): ?>
            <div class="card-premium simulacro-pregunta" style="margin-bottom: 28px; padding: 28px 32px; border: 1px solid <?php echo $color_ui; ?>55;">
                <div style="display: flex; align-items: flex-start; gap: 16px; margin-bottom: 22px;">
                    <div style="background: linear-gradient(135deg, <?php echo $color_ui; ?>, <?php echo $color_ui_dark; ?>); color: #1a1a1a; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.15rem; flex-shrink: 0; box-shadow: 0 2px 8px <?php echo $color_ui; ?>55;">
                        <?php echo $es_normal && $fase === 2 ? $index + 124 : $index + 1; ?>
                    </div>
                    <h3 style="font-size: 1.12rem; line-height: 1.65; margin: 0; color: var(--text-primary); font-weight: 600; flex: 1;">
                        <?php echo nl2br(htmlspecialchars($p['pregunta'])); ?>
                    </h3>
                </div>

                <div class="opciones-grid" style="display: flex; flex-direction: column; gap: 14px; padding-left: 8px;">
                    <?php 
                    $opciones = [
                        'a' => $p['opcion_a'],
                        'b' => $p['opcion_b'],
                        'c' => $p['opcion_c'],
                        'd' => $p['opcion_d']
                    ];
                    foreach ($opciones as $letra => $texto): 
                    ?>
                        <label class="radio-container opcion-btn" style="padding: 16px 20px; border: 2px solid var(--border-color, var(--border)); border-radius: 12px; cursor: pointer; transition: all 0.2s ease; display: flex; align-items: flex-start; gap: 16px; min-height: 56px; background: var(--bg-card, #fff);">
                            <input type="radio" name="respuestas[<?php echo $p['id_pregunta']; ?>]" value="<?php echo $letra; ?>" required style="margin-top: 4px; width: 20px; height: 20px; flex-shrink: 0; accent-color: <?php echo $color_ui; ?>;">
                            <span class="letra-opcion" style="font-weight: 800; color: var(--text-muted); text-transform: uppercase; font-size: 1.05rem; min-width: 28px;"><?php echo $letra; ?>.</span>
                            <span class="texto-opcion" style="color: var(--text-secondary); line-height: 1.55; font-size: 1rem; flex: 1;"><?php echo htmlspecialchars($texto); ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <div style="background-color: var(--bg-card); padding: 28px; border-radius: var(--radius-lg); border: 1px solid var(--border-color, var(--border)); text-align: center; margin-top: 36px;">
            <i class="fa-solid fa-flag-checkered" style="font-size: 2rem; color: var(--text-muted); margin-bottom: 12px;"></i>
            <h3 style="margin-bottom: 12px;"><?php echo $es_normal && $fase === 1 ? '¿Terminaste la primera sección?' : '¿Terminaste de responder?'; ?></h3>
            <p style="color: var(--text-secondary); margin-bottom: 20px; font-size: 0.95rem;"><?php echo $es_normal && $fase === 1 ? 'Al continuar comenzarás las 124 preguntas restantes. Tendrás otras 4 horas para esta segunda sección.' : 'Asegúrate de haber marcado todas las respuestas antes de finalizar.'; ?></p>
            <button type="submit" name="<?php echo $es_normal && $fase === 1 ? 'continuar_segunda_seccion' : 'finalizar_simulacro'; ?>" value="1" class="btn btn-primary" style="padding: 16px 48px; font-size: 1.15rem; font-weight: 700; background: linear-gradient(135deg, <?php echo $color_ui; ?>, <?php echo $color_ui_dark; ?>); color: #1a1a1a; border: none;">
                <i class="fa-solid <?php echo $es_normal && $fase === 1 ? 'fa-arrow-right' : 'fa-paper-plane'; ?>"></i> <?php echo $es_normal && $fase === 1 ? 'Continuar a la segunda sección' : 'Finalizar y Calificar'; ?>
            </button>
        </div>

    </form>
</div>

<style>
.opcion-btn:hover {
    background-color: #fefce8 !important;
    border-color: #eab308 !important;
    transform: translateX(4px);
    box-shadow: 0 4px 12px rgba(234, 179, 8, 0.15);
}
.opcion-btn:has(input:checked),
.opcion-btn.selected {
    background-color: #fef9c3 !important;
    border-color: #eab308 !important;
    box-shadow: 0 0 0 2px rgba(234, 179, 8, 0.35);
}
.opcion-btn:has(input:checked) .letra-opcion,
.opcion-btn:has(input:checked) .texto-opcion,
.opcion-btn.selected .letra-opcion,
.opcion-btn.selected .texto-opcion {
    color: #a16207 !important;
    font-weight: 600;
}
.opcion-btn input:checked {
    accent-color: #eab308;
}
@media (max-width: 640px) {
    .simulacro-pregunta { padding: 20px 16px !important; }
    .opcion-btn { padding: 14px 14px !important; min-height: 52px; }
}
</style>
<script>
document.querySelectorAll('.opcion-btn').forEach(function(label) {
    var input = label.querySelector('input[type=radio]');
    if (!input) return;
    input.addEventListener('change', function() {
        var name = input.name;
        document.querySelectorAll('input[name="' + name + '"]').forEach(function(r) {
            r.closest('.opcion-btn').classList.remove('selected');
        });
        label.classList.add('selected');
    });
    if (input.checked) label.classList.add('selected');
});

var cronometro = document.getElementById('cronometro');
if (cronometro) {
    var formulario = document.getElementById('form-simulacro');
    var restante = parseInt(cronometro.getAttribute('data-segundos'), 10);
    var valor = document.getElementById('cronometro-valor');
    var intervalo = setInterval(function() {
        var horas = Math.floor(restante / 3600);
        var minutos = Math.floor((restante % 3600) / 60);
        var segundos = restante % 60;
        valor.textContent = [horas, minutos, segundos].map(function(n) { return String(n).padStart(2, '0'); }).join(':');
        if (restante <= 300) cronometro.style.color = '#b91c1c';
        if (restante <= 0) {
            clearInterval(intervalo);
            formulario.querySelectorAll('[required]').forEach(function(input) { input.removeAttribute('required'); });
            formulario.submit();
        }
        restante--;
    }, 1000);
}
</script>
