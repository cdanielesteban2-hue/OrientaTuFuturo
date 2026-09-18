<?php $url_base = constant('URL_BASE'); ?>
<div style="max-width: 800px; margin: 0 auto; padding: 40px 0;">
    <span class="badge badge-primary" style="margin-bottom: 15px; display: inline-flex;"><i class="fa-solid fa-people-group"></i> Quiénes Somos</span>
    <h1 style="font-size: 2.8rem; margin-bottom: 20px;">Nuestra Misión: Guiar tu Pasión</h1>
    <p style="font-size: 1.15rem; color: var(--text-secondary); margin-bottom: 30px;">
        <strong>Orienta tu FUTURO</strong> nació con un propósito claro: democratizar la orientación vocacional y simplificar la búsqueda de carreras para miles de estudiantes colombianos. Creemos que cada joven posee talentos excepcionales que, cuando se alinean con la profesión correcta, pueden transformar comunidades enteras.
    </p>

    <div class="card-premium" style="margin-bottom: 40px;">
        <h3 style="font-size: 1.4rem; margin-bottom: 15px; color: var(--primary); display: flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-graduation-cap"></i> ¿Por qué elegir nuestra plataforma?
        </h3>
        <p style="color: var(--text-secondary); margin-bottom: 15px;">
            El tránsito entre el bachillerato y la educación superior suele ser abrumador y estar cargado de incertidumbre. Muchas veces, los estudiantes eligen carreras por presión o desinformación, lo que incrementa las tasas de deserción universitaria.
        </p>
        <p style="color: var(--text-secondary);">
            Nuestra herramienta combina un <strong>Test Vocacional intuitivo</strong> con un catálogo estructurado e integrado de universidades, costos reales de programas académicos y becas, ayudándote a trazar una ruta factible y motivadora para tu porvenir.
        </p>
    </div>

    <h2 style="font-size: 1.8rem; margin-bottom: 25px; text-align: center;">Nuestros Pilares Fundamentales</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 40px;">
        <div class="card" style="text-align: center;">
            <div style="font-size: 2.5rem; color: var(--primary); margin-bottom: 15px;"><i class="fa-solid fa-magnifying-glass-chart"></i></div>
            <h4 style="margin-bottom: 8px;">Orientación Científica</h4>
            <p style="font-size: 0.85rem; color: var(--text-secondary);">Análisis dinámico de tus respuestas para determinar tu verdadera afinidad vocacional.</p>
        </div>
        <div class="card" style="text-align: center;">
            <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 15px;"><i class="fa-solid fa-handshake-angle"></i></div>
            <h4 style="margin-bottom: 8px;">Inclusión Académica</h4>
            <p style="font-size: 0.85rem; color: var(--text-secondary);">Visibilizamos becas y opciones públicas para garantizar oportunidades a todos.</p>
        </div>
        <div class="card" style="text-align: center;">
            <div style="font-size: 2.5rem; color: var(--success); margin-bottom: 15px;"><i class="fa-solid fa-chart-line"></i></div>
            <h4 style="margin-bottom: 8px;">Información Real</h4>
            <p style="font-size: 0.85rem; color: var(--text-secondary);">Datos actualizados de semestres, jornadas y enlaces directos de contacto.</p>
        </div>
    </div>

    <div style="text-align: center; background: #e0e7ff; padding: 30px; border-radius: var(--radius-md);">
        <h3 style="margin-bottom: 10px; color: var(--primary);">¿Listo para dar el gran paso?</h3>
        <p style="font-size: 0.95rem; color: var(--text-secondary); margin-bottom: 20px;">No dejes tu futuro al azar. Resuelve el test hoy mismo.</p>
        <a href="<?php echo $url_base; ?>cuestionarios/inicio" class="btn btn-primary"><i class="fa-solid fa-play"></i> Comenzar el Test</a>
    </div>
</div>
