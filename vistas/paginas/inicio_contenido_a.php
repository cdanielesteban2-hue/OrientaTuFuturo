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

        $intentos = Simulacro::obtenerIntentosUsuario($id_usuario);
        if (!empty($intentos)) {
            $mejor = 0;
            foreach ($intentos as $it) {
                $p = (float)($it['puntaje'] ?? 0);
                if ($p > $mejor) $mejor = $p;
            }
            $pct_icfes = (int)min(100, max(0, round($mejor)));
            if ($pct_icfes > 0) {
                $label_icfes = 'Mejor: ' . $pct_icfes . '%';
            } else {
                $pct_icfes = 0;
                $label_icfes = 'Sin iniciar';
            }
        } else {
            $pct_icfes = 0;
            $label_icfes = 'Sin iniciar';
        }
    } catch (Exception $e) {
        // silencioso
    }
} else {
    $label_vocacional = 'Inicia sesión';
    $label_icfes = 'Inicia sesión';
}
?>

<div class="home-shell">
    <section class="home-hero">
        <div class="home-hero-copy">
            <span class="home-kicker">Orientación vocacional</span>
            <h1>¿Y si supieras qué estudiar antes de elegir?</h1>
            <p>Test vocacional RIASEC + universidades + becas + Pre-ICFES en un solo lugar.</p>
            <div class="hero-actions">
                <a href="<?php echo $url_base; ?>cuestionarios/inicio" class="btn btn-accent">Comenzar test</a>
                <a href="<?php echo $url_base; ?>programas/inicio" class="btn btn-outline">Explorar carreras</a>
            </div>
            <div class="hero-meta">
                <span>Universidades</span>
                <span>Programas</span>
                <span>Becas</span>
            </div>
        </div>

        <div class="home-hero-preview">
            <div class="preview-card">
                <div class="preview-header">
                    <div class="preview-circles"><span></span><span></span><span></span></div>
                    <span>Tu progreso</span>
                </div>
                <div class="preview-panel">
                    <div class="preview-panel-row">
                        <span>Test vocacional</span>
                        <strong><?php echo (int)$pct_vocacional; ?>%</strong>
                    </div>
                    <div class="preview-legend">
                        <span class="preview-pill accent">RIASEC</span>
                        <span class="preview-pill">Pre-ICFES</span>
                    </div>
                    <div class="preview-chart"></div>
                </div>
            </div>
        </div>
    </section>

    <div class="home-grid">
        <div class="home-card">
            <h3>Mi progreso</h3>
            <div class="home-quick-tags">
                <span class="progress-chip primary"><i class="fa-solid fa-clipboard-list"></i> Test Vocacional</span>
                <span class="progress-chip"><i class="fa-solid fa-pencil"></i> Pre-ICFES</span>
            </div>

            <div class="home-progress-block">
                <div class="home-progress-label">
                    <span>Test vocacional · <?php echo htmlspecialchars($label_vocacional); ?></span>
                    <strong><?php echo (int)$pct_vocacional; ?>%</strong>
                </div>
                <div class="home-progress-track" role="progressbar" aria-valuenow="<?php echo (int)$pct_vocacional; ?>" aria-valuemin="0" aria-valuemax="100">
                    <div class="home-progress-fill" style="width: <?php echo (int)$pct_vocacional; ?>%;"></div>
                </div>
            </div>

            <div class="home-progress-block">
                <div class="home-progress-label">
                    <span>Pre-ICFES · <?php echo htmlspecialchars($label_icfes); ?></span>
                    <strong><?php echo (int)$pct_icfes; ?>%</strong>
                </div>
                <div class="home-progress-track" role="progressbar" aria-valuenow="<?php echo (int)$pct_icfes; ?>" aria-valuemin="0" aria-valuemax="100">
                    <div class="home-progress-fill" style="width: <?php echo (int)$pct_icfes; ?>%;"></div>
                </div>
            </div>
        </div>

        <div class="home-card">
            <h3>Carreras recomendadas</h3>
            <div class="home-career-list">
                <a href="<?php echo $url_base; ?>programas/inicio" class="home-career-item">
                    <div class="home-career-icon"><i class="fa-solid fa-laptop-code"></i></div>
                    <div>
                        <strong>Ingeniería de Software</strong>
                        <span>Programas tecnológicos y desarrollo de sistemas.</span>
                    </div>
                </a>
                <a href="<?php echo $url_base; ?>programas/inicio" class="home-career-item">
                    <div class="home-career-icon"><i class="fa-solid fa-palette"></i></div>
                    <div>
                        <strong>Diseño Gráfico</strong>
                        <span>Creatividad, comunicación visual y medios digitales.</span>
                    </div>
                </a>
                <a href="<?php echo $url_base; ?>programas/inicio" class="home-career-item">
                    <div class="home-career-icon"><i class="fa-solid fa-stethoscope"></i></div>
                    <div>
                        <strong>Ciencias de la Salud</strong>
                        <span>Medicina, enfermería y áreas afines.</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="home-grid" style="margin-top:20px;">
        <div class="home-card">
            <h3>Próximos pasos</h3>
            <div class="home-steps">
                <div class="home-step">
                    <div class="home-step-index">01</div>
                    <div>
                        <strong>Completar test vocacional</strong>
                        <span>Descubre tu perfil RIASEC</span>
                    </div>
                </div>
                <div class="home-step">
                    <div class="home-step-index">02</div>
                    <div>
                        <strong>Explorar universidades</strong>
                        <span>Compara instituciones y jornadas</span>
                    </div>
                </div>
                <div class="home-step">
                    <div class="home-step-index">03</div>
                    <div>
                        <strong>Practicar Pre-ICFES</strong>
                        <span>Simulacros y seguimiento de progreso</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="home-card">
            <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; margin-bottom:8px;">
                <h3 style="margin:0;">Recursos y atajos</h3>
                <a href="<?php echo $url_base; ?>becas/inicio" class="btn btn-accent" style="padding:0 12px; min-height:30px; font-size:0.76rem;">Ver becas</a>
            </div>
            <div class="home-shortcuts">
                <div class="home-shortcut">
                    <div class="home-shortcut-left"><i class="fa-solid fa-building-columns"></i><span>Directorio de universidades</span></div>
                    <a href="<?php echo $url_base; ?>universidades/inicio" class="btn btn-outline" style="padding:0 10px; min-height:28px; font-size:0.7rem;">Abrir</a>
                </div>
                <div class="home-shortcut">
                    <div class="home-shortcut-left"><i class="fa-solid fa-book-open"></i><span>Catálogo de programas</span></div>
                    <a href="<?php echo $url_base; ?>programas/inicio" class="btn btn-outline" style="padding:0 10px; min-height:28px; font-size:0.7rem;">Abrir</a>
                </div>
                <div class="home-shortcut">
                    <div class="home-shortcut-left"><i class="fa-solid fa-pencil"></i><span>Pre-ICFES interactivo</span></div>
                    <a href="<?php echo $url_base; ?>simulacros/inicio" class="btn btn-accent" style="padding:0 10px; min-height:28px; font-size:0.7rem;">Practicar</a>
                </div>
            </div>
        </div>
    </div>
</div>
