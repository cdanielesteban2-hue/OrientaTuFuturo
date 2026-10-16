<?php $url_base = constant('URL_BASE'); ?>

<div class="mock-banner">
    <h1>Tu Viaje Hacia el Futuro<br>Comienza Aquí</h1>
    <a href="<?php echo $url_base; ?>cuestionarios/inicio" class="btn btn-accent">Ver completar</a>
</div>

<div class="mock-grid">
    <div class="mock-card">
        <h3>Mi Progreso Vocacional</h3>
        <a href="<?php echo $url_base; ?>cuestionarios/inicio" class="btn btn-accent" style="padding:10px 18px;">
            <i class="fa-solid fa-clipboard-list"></i> Test Vocacional
        </a>
        <div class="mock-progress-track" aria-hidden="true">
            <div class="mock-progress-fill"></div>
        </div>
        <p style="margin:10px 0 0; font-size:0.8rem; color:#94a3b8;">Progreso de vocación</p>
    </div>

    <div class="mock-card">
        <h3>Carreras Recomendadas</h3>
        <div class="mock-career-list">
            <a href="<?php echo $url_base; ?>programas/inicio" class="mock-career-item" style="text-decoration:none;">
                <div class="mock-career-icon"><i class="fa-solid fa-laptop-code"></i></div>
                <div>
                    <strong>Ingeniería de Software</strong>
                    <span>Programas tecnológicos y desarrollo de sistemas.</span>
                </div>
            </a>
            <a href="<?php echo $url_base; ?>programas/inicio" class="mock-career-item" style="text-decoration:none;">
                <div class="mock-career-icon"><i class="fa-solid fa-palette"></i></div>
                <div>
                    <strong>Diseño Gráfico</strong>
                    <span>Creatividad, comunicación visual y medios digitales.</span>
                </div>
            </a>
            <a href="<?php echo $url_base; ?>programas/inicio" class="mock-career-item" style="text-decoration:none;">
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
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
            <h3 style="margin:0;">Recursos y atajos</h3>
            <a href="<?php echo $url_base; ?>becas/inicio" class="btn btn-accent" style="padding:8px 14px; font-size:0.82rem;">Ver becas</a>
        </div>
        <div class="mock-event">
            <div class="mock-event-left">
                <i class="fa-solid fa-building-columns"></i>
                <span>Directorio de universidades</span>
            </div>
            <a href="<?php echo $url_base; ?>universidades/inicio" class="btn btn-outline" style="padding:6px 12px; font-size:0.78rem;">Abrir</a>
        </div>
        <div class="mock-event">
            <div class="mock-event-left">
                <i class="fa-solid fa-book-open"></i>
                <span>Catálogo de programas</span>
            </div>
            <a href="<?php echo $url_base; ?>programas/inicio" class="btn btn-outline" style="padding:6px 12px; font-size:0.78rem;">Abrir</a>
        </div>
        <div class="mock-event">
            <div class="mock-event-left">
                <i class="fa-solid fa-pencil"></i>
                <span>Pre-ICFES interactivo</span>
            </div>
            <a href="<?php echo $url_base; ?>simulacros/inicio" class="btn btn-accent" style="padding:6px 12px; font-size:0.78rem;">Practicar</a>
        </div>
    </div>
</div>
