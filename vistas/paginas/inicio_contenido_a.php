<?php
$url_base = constant('URL_BASE');

// Progreso dinámico (test vocacional + Pre-ICFES)
$pct_vocacional = 0;
$pct_icfes = 0;
$label_vocacional = 'Sin iniciar';
$label_icfes = 'Sin iniciar';

if (isset($_SESSION['usuario']['id'])) {
    $id_usuario = (int)$_SESSION['usuario']['id'];
    try {
        include_once __DIR__ . '/../../modelos/cuestionario.php';
        include_once __DIR__ . '/../../modelos/simulacro.php';

        // Test vocacional: completado = 100%, si no % de preguntas respondidas
        $realizados = Cuestionario::obtenerCuestionariosRealizados($id_usuario);
        if (!empty($realizados)) {
            $pct_vocacional = 100;
            $label_vocacional = 'Completado';
        } else {
            $db = baseDatos::crearInstancia();
            $totalPreg = (int)$db->query("SELECT COUNT(*) FROM preguntas")->fetchColumn();
            $respUser = $db->prepare("SELECT COUNT(DISTINCT id_pregunta) FROM respuesta WHERE id_usuario = ?");
            $respUser->execute([$id_usuario]);
            $respondidas = (int)$respUser->fetchColumn();
            if ($totalPreg > 0) {
                $pct_vocacional = (int)min(100, round(($respondidas / $totalPreg) * 100));
            }
            $label_vocacional = $pct_vocacional > 0 ? 'En progreso' : 'Sin iniciar';
        }

        // Pre-ICFES: si hay intentos = 100% de práctica iniciada; además muestra mejor puntaje en etiqueta
        $intentos = Simulacro::obtenerIntentosUsuario($id_usuario);
        if (!empty($intentos)) {
            $pct_icfes = 100;
            $mejor = 0;
            foreach ($intentos as $it) {
                $p = (float)($it['puntaje'] ?? 0);
                if ($p > $mejor) $mejor = $p;
            }
            $label_icfes = 'Mejor: ' . round($mejor) . '%';
        } else {
            $pct_icfes = 0;
            $label_icfes = 'Sin iniciar';
        }
    } catch (Exception $e) {
        // Si falla la consulta, dejar en 0
    }
} else {
    $label_vocacional = 'Inicia sesión';
    $label_icfes = 'Inicia sesión';
}
?>

<div class="mock-banner">
    <h1>Tu Viaje Hacia el Futuro<br>Comienza Aquí</h1>
    <a href="<?php echo $url_base; ?>cuestionarios/inicio" class="btn btn-accent">Comenzar</a>
</div>

<div class="mock-grid">
    <div class="mock-card">
        <h3>Mi Progreso</h3>
        <div style="display:flex; flex-wrap:wrap; gap:8px; margin-bottom:4px;">
            <a href="<?php echo $url_base; ?>cuestionarios/inicio" class="btn btn-accent" style="padding:8px 14px; font-size:0.85rem;">
                <i class="fa-solid fa-clipboard-list"></i> Test Vocacional
            </a>
            <a href="<?php echo $url_base; ?>simulacros/inicio" class="btn btn-outline" style="padding:8px 14px; font-size:0.85rem;">
                <i class="fa-solid fa-pencil"></i> Pre-ICFES
            </a>
        </div>

        <div class="mock-progress-block">
            <div class="mock-progress-label">
                <span>Test vocacional · <?php echo htmlspecialchars($label_vocacional); ?></span>
                <strong><?php echo (int)$pct_vocacional; ?>%</strong>
            </div>
            <div class="mock-progress-track" role="progressbar" aria-valuenow="<?php echo (int)$pct_vocacional; ?>" aria-valuemin="0" aria-valuemax="100">
                <div class="mock-progress-fill" style="width: <?php echo (int)$pct_vocacional; ?>%;"></div>
            </div>
        </div>

        <div class="mock-progress-block">
            <div class="mock-progress-label">
                <span>Pre-ICFES · <?php echo htmlspecialchars($label_icfes); ?></span>
                <strong><?php echo (int)$pct_icfes; ?>%</strong>
            </div>
            <div class="mock-progress-track" role="progressbar" aria-valuenow="<?php echo (int)$pct_icfes; ?>" aria-valuemin="0" aria-valuemax="100">
                <div class="mock-progress-fill accent" style="width: <?php echo (int)$pct_icfes; ?>%;"></div>
            </div>
        </div>
    </div>

    <div class="mock-card">
        <h3>Carreras Recomendadas</h3>
        <div class="mock-career-list">
            <a href="<?php echo $url_base; ?>programas/inicio" class="mock-career-item">
                <div class="mock-career-icon"><i class="fa-solid fa-laptop-code"></i></div>
                <div>
                    <strong>Ingeniería de Software</strong>
                    <span>Programas tecnológicos y desarrollo de sistemas.</span>
                </div>
            </a>
            <a href="<?php echo $url_base; ?>programas/inicio" class="mock-career-item">
                <div class="mock-career-icon"><i class="fa-solid fa-palette"></i></div>
                <div>
                    <strong>Diseño Gráfico</strong>
                    <span>Creatividad, comunicación visual y medios digitales.</span>
                </div>
            </a>
            <a href="<?php echo $url_base; ?>programas/inicio" class="mock-career-item">
                <div class="mock-career-icon"><i class="fa-solid fa-stethoscope"></i></div>
                <div>
                    <strong>Ciencias de la Salud</strong>
                    <span>Medicina, enfermería y áreas afines.</span>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="mock-grid-bottom">
    <div class="mock-card">
        <h3>Próximos pasos</h3>
        <div class="mock-session">
            <div class="mock-session-bar"></div>
            <div>
                <strong>Completar Test Vocacional</strong>
                <span>Descubre tu perfil RIASEC</span>
            </div>
        </div>
        <div class="mock-session">
            <div class="mock-session-bar"></div>
            <div>
                <strong>Explorar Universidades</strong>
                <span>Compara instituciones y jornadas</span>
            </div>
        </div>
        <div class="mock-session">
            <div class="mock-session-bar"></div>
            <div>
                <strong>Practicar Pre-ICFES</strong>
                <span>Simulacros al azar de matemáticas</span>
            </div>
        </div>
    </div>

    <div class="mock-card">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px;">
            <h3 style="margin:0;">Recursos y atajos</h3>
            <a href="<?php echo $url_base; ?>becas/inicio" class="btn btn-accent" style="padding:7px 12px; font-size:0.82rem;">Ver becas</a>
        </div>
        <div class="mock-event">
            <div class="mock-event-left">
                <i class="fa-solid fa-building-columns"></i>
                <span>Directorio de universidades</span>
            </div>
            <a href="<?php echo $url_base; ?>universidades/inicio" class="btn btn-outline" style="padding:5px 10px; font-size:0.8rem;">Abrir</a>
        </div>
        <div class="mock-event">
            <div class="mock-event-left">
                <i class="fa-solid fa-book-open"></i>
                <span>Catálogo de programas</span>
            </div>
            <a href="<?php echo $url_base; ?>programas/inicio" class="btn btn-outline" style="padding:5px 10px; font-size:0.8rem;">Abrir</a>
        </div>
        <div class="mock-event">
            <div class="mock-event-left">
                <i class="fa-solid fa-pencil"></i>
                <span>Pre-ICFES interactivo</span>
            </div>
            <a href="<?php echo $url_base; ?>simulacros/inicio" class="btn btn-accent" style="padding:5px 10px; font-size:0.8rem;">Practicar</a>
        </div>
    </div>
</div>
