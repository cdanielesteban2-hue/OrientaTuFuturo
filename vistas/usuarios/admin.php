<?php
$url_base = defined('URL_BASE') ? constant('URL_BASE') : '';
$nombre = htmlspecialchars($_SESSION['usuario']['nombre'] ?? 'Admin');
$chart_ciudades = $chart_ciudades ?? [];
$chart_contenido = $chart_contenido ?? [];
$chart_actividad = $chart_actividad ?? [];
$filtro_ciudad = $filtro_ciudad ?? '';
$ciudades_filtro = $ciudades_filtro ?? [];
?>
<div class="admin-wrap">
    <div class="admin-hero">
        <div>
            <span class="badge badge-accent"><i class="fa-solid fa-shield-halved"></i> Modo administrador</span>
            <h1 style="margin:10px 0 6px; font-family:Outfit,sans-serif;">Panel operativo</h1>
            <p class="page-sub" style="margin:0;">Hola, <?php echo $nombre; ?>. Métricas interactivas y control del sistema.</p>
        </div>
        <div style="display:flex; flex-wrap:wrap; gap:8px;">
            <a href="<?php echo $url_base; ?>usuarios/adminGestion" class="btn btn-accent"><i class="fa-solid fa-pen-to-square"></i> Gestionar contenido</a>
            <a href="<?php echo $url_base; ?>usuarios/dashboard" class="btn btn-outline">Ver panel estudiante</a>
        </div>
    </div>

    <form method="get" action="<?php echo $url_base; ?>usuarios/admin" class="admin-filters card-premium" style="padding:14px 16px; margin-bottom:14px; display:flex; flex-wrap:wrap; gap:12px; align-items:flex-end;">
        <div style="flex:1; min-width:160px;">
            <label class="form-label">Filtrar por ciudad</label>
            <select name="ciudad" class="form-input" style="width:100%;">
                <option value="">Todas las ciudades</option>
                <?php foreach ($ciudades_filtro as $c): ?>
                    <option value="<?php echo htmlspecialchars($c); ?>" <?php echo $filtro_ciudad === $c ? 'selected' : ''; ?>><?php echo htmlspecialchars($c); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div style="flex:1; min-width:140px;">
            <label class="form-label">Periodo gráficos</label>
            <select name="periodo" class="form-input" style="width:100%;">
                <option value="all" <?php echo ($periodo ?? 'all') === 'all' ? 'selected' : ''; ?>>Todo el historial</option>
                <option value="30" <?php echo ($periodo ?? '') === '30' ? 'selected' : ''; ?>>Últimos 30 días</option>
                <option value="90" <?php echo ($periodo ?? '') === '90' ? 'selected' : ''; ?>>Últimos 90 días</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-filter"></i> Aplicar</button>
        <a href="<?php echo $url_base; ?>usuarios/admin" class="btn btn-outline">Limpiar</a>
    </form>

    <div class="admin-kpis">
        <div class="admin-kpi"><div class="admin-kpi-icon" style="background:rgba(37,99,235,.15);color:#60a5fa;"><i class="fa-solid fa-users"></i></div><div><strong><?php echo (int)$stats['usuarios']; ?></strong><span>Usuarios registrados</span></div></div>
        <div class="admin-kpi"><div class="admin-kpi-icon" style="background:rgba(234,179,8,.15);color:#eab308;"><i class="fa-solid fa-building-columns"></i></div><div><strong><?php echo (int)$stats['universidades']; ?></strong><span>Universidades</span></div></div>
        <div class="admin-kpi"><div class="admin-kpi-icon" style="background:rgba(16,185,129,.15);color:#34d399;"><i class="fa-solid fa-graduation-cap"></i></div><div><strong><?php echo (int)$stats['programas']; ?></strong><span>Programas / carreras</span></div></div>
        <div class="admin-kpi"><div class="admin-kpi-icon" style="background:rgba(139,92,246,.15);color:#a78bfa;"><i class="fa-solid fa-award"></i></div><div><strong><?php echo (int)$stats['becas']; ?></strong><span>Becas publicadas</span></div></div>
        <div class="admin-kpi"><div class="admin-kpi-icon" style="background:rgba(59,130,246,.15);color:#93c5fd;"><i class="fa-solid fa-clipboard-list"></i></div><div><strong><?php echo (int)$stats['tests_completados']; ?></strong><span>Tests vocacionales</span></div></div>
        <div class="admin-kpi"><div class="admin-kpi-icon" style="background:rgba(239,68,68,.15);color:#f87171;"><i class="fa-solid fa-pencil"></i></div><div><strong><?php echo (int)$stats['simulacros']; ?></strong><span>Intentos Pre-ICFES</span></div></div>
    </div>

    <div class="admin-charts">
        <div class="card-premium admin-card">
            <div style="display:flex; justify-content:space-between; align-items:center; gap:8px; flex-wrap:wrap;">
                <h3 style="margin:0;"><i class="fa-solid fa-chart-column"></i> Universidades por ciudad</h3>
                <select id="chart-type-ciudades" class="form-input" style="width:auto; min-width:120px; padding:6px 10px; font-size:0.82rem;">
                    <option value="bar">Barras</option>
                    <option value="doughnut">Dona</option>
                </select>
            </div>
            <div class="chart-box"><canvas id="chartCiudades"></canvas></div>
        </div>
        <div class="card-premium admin-card">
            <h3 style="margin:0 0 8px;"><i class="fa-solid fa-chart-pie"></i> Contenido del sistema</h3>
            <div class="chart-box"><canvas id="chartContenido"></canvas></div>
        </div>
        <div class="card-premium admin-card admin-chart-wide">
            <div style="display:flex; justify-content:space-between; align-items:center; gap:8px; flex-wrap:wrap;">
                <h3 style="margin:0;"><i class="fa-solid fa-chart-line"></i> Actividad (tests vs Pre-ICFES)</h3>
                <span class="page-sub" style="font-size:0.8rem;">Clic en la leyenda para mostrar/ocultar series</span>
            </div>
            <div class="chart-box chart-box-tall"><canvas id="chartActividad"></canvas></div>
        </div>
    </div>

    <div class="admin-grid" style="margin-top:14px;">
        <div class="card-premium admin-card">
            <h3><i class="fa-solid fa-gauge-high"></i> Control operativo</h3>
            <p class="page-sub">Gestión de datos y accesos rápidos.</p>
            <div class="admin-actions">
                <a class="admin-action" href="<?php echo $url_base; ?>usuarios/adminGestion?tab=universidades"><i class="fa-solid fa-building-columns"></i><span>Editar universidades</span></a>
                <a class="admin-action" href="<?php echo $url_base; ?>usuarios/adminGestion?tab=programas"><i class="fa-solid fa-book-open"></i><span>Editar carreras</span></a>
                <a class="admin-action" href="<?php echo $url_base; ?>usuarios/adminGestion?tab=becas"><i class="fa-solid fa-award"></i><span>Editar becas</span></a>
                <a class="admin-action" href="<?php echo $url_base; ?>universidades/inicio"><i class="fa-solid fa-eye"></i><span>Ver directorio</span></a>
                <a class="admin-action" href="<?php echo $url_base; ?>simulacros/inicio"><i class="fa-solid fa-pencil"></i><span>Pre-ICFES</span></a>
                <a class="admin-action" href="<?php echo $url_base; ?>cuestionarios/inicio"><i class="fa-solid fa-clipboard-list"></i><span>Test vocacional</span></a>
            </div>
        </div>
        <div class="card-premium admin-card">
            <h3><i class="fa-solid fa-chart-line"></i> Resumen</h3>
            <ul class="admin-list">
                <li><span>Preguntas Pre-ICFES</span><strong><?php echo (int)$stats['preguntas_simulacro']; ?></strong></li>
                <li><span>Preguntas test vocacional</span><strong><?php echo (int)$stats['preguntas_test']; ?></strong></li>
                <li><span>Respuestas de usuarios</span><strong><?php echo (int)$stats['respuestas_test']; ?></strong></li>
                <li><span>Promedio Pre-ICFES</span><strong><?php echo htmlspecialchars((string)$stats['promedio_icfes']); ?>%</strong></li>
            </ul>
        </div>
    </div>

    <div class="card-premium admin-card" style="margin-top:14px;">
        <h3><i class="fa-solid fa-user-shield"></i> Últimos usuarios</h3>
        <?php if (empty($ultimos_usuarios)): ?>
            <p class="page-sub">No hay usuarios.</p>
        <?php else: ?>
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead><tr><th>Nombre</th><th>Correo</th><th>Ciudad</th><th>Rol</th><th>Registro</th></tr></thead>
                    <tbody>
                    <?php foreach ($ultimos_usuarios as $u): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($u['nombre'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($u['correo'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($u['ciudad'] ?? '—'); ?></td>
                            <td><span class="admin-role <?php echo ($u['rol'] ?? '') === 'admin' ? 'is-admin' : ''; ?>"><?php echo htmlspecialchars($u['rol'] ?? 'usuario'); ?></span></td>
                            <td><?php echo !empty($u['f_registro']) ? date('d/m/Y', strtotime($u['f_registro'])) : '—'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
(function(){
  const isDark = document.documentElement.getAttribute('data-theme') !== 'light';
  const textColor = isDark ? '#94a3b8' : '#64748b';
  const gridColor = isDark ? 'rgba(255,255,255,0.06)' : 'rgba(15,23,42,0.06)';
  Chart.defaults.color = textColor;
  Chart.defaults.borderColor = gridColor;
  Chart.defaults.font.family = "'Plus Jakarta Sans', system-ui, sans-serif";

  const dataCiudades = <?php echo json_encode($chart_ciudades, JSON_UNESCAPED_UNICODE); ?>;
  const dataContenido = <?php echo json_encode($chart_contenido, JSON_UNESCAPED_UNICODE); ?>;
  const dataActividad = <?php echo json_encode($chart_actividad, JSON_UNESCAPED_UNICODE); ?>;
  const labelsC = dataCiudades.map(x => x.label);
  const valuesC = dataCiudades.map(x => x.value);
  const colors = ['#2563eb','#eab308','#10b981','#8b5cf6','#ef4444','#06b6d4','#f97316','#ec4899','#84cc16','#6366f1'];

  let chartCiudades = new Chart(document.getElementById('chartCiudades'), {
    type: 'bar',
    data: { labels: labelsC, datasets: [{ label: 'Universidades', data: valuesC, backgroundColor: colors.slice(0, labelsC.length), borderRadius: 8, borderSkipped: false }] },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { ticks: { maxRotation: 45 }, grid: { display: false } }, y: { beginAtZero: true, ticks: { precision: 0 } } }, interaction: { mode: 'index', intersect: false } }
  });

  document.getElementById('chart-type-ciudades').addEventListener('change', function(){
    const t = this.value;
    chartCiudades.destroy();
    chartCiudades = new Chart(document.getElementById('chartCiudades'), {
      type: t,
      data: { labels: labelsC, datasets: [{ label: 'Universidades', data: valuesC, backgroundColor: colors.slice(0, labelsC.length), borderRadius: t === 'bar' ? 8 : 0 }] },
      options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: t !== 'bar', position: 'bottom' } }, scales: t === 'bar' ? { x: { ticks: { maxRotation: 45 }, grid: { display: false } }, y: { beginAtZero: true, ticks: { precision: 0 } } } : undefined }
    });
  });

  new Chart(document.getElementById('chartContenido'), {
    type: 'doughnut',
    data: { labels: dataContenido.map(x => x.label), datasets: [{ data: dataContenido.map(x => x.value), backgroundColor: ['#eab308','#2563eb','#8b5cf6','#10b981','#ef4444'], borderWidth: 0, hoverOffset: 8 }] },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } }, cutout: '58%' }
  });

  new Chart(document.getElementById('chartActividad'), {
    type: 'line',
    data: {
      labels: dataActividad.labels || [],
      datasets: [
        { label: 'Tests vocacionales', data: dataActividad.tests || [], borderColor: '#3b82f6', backgroundColor: 'rgba(59,130,246,0.15)', fill: true, tension: 0.35, pointRadius: 4, pointHoverRadius: 6 },
        { label: 'Pre-ICFES', data: dataActividad.icfes || [], borderColor: '#eab308', backgroundColor: 'rgba(234,179,8,0.12)', fill: true, tension: 0.35, pointRadius: 4, pointHoverRadius: 6 }
      ]
    },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'top' } }, interaction: { mode: 'index', intersect: false }, scales: { x: { grid: { display: false } }, y: { beginAtZero: true, ticks: { precision: 0 } } } }
  });
})();
</script>

<style>
.admin-wrap { max-width: 1100px; margin: 0 auto; }
.admin-hero { display:flex; flex-wrap:wrap; align-items:flex-start; justify-content:space-between; gap:14px; margin-bottom: 18px; }
.admin-kpis { display:grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap:12px; margin-bottom:14px; }
.admin-kpi { display:flex; align-items:center; gap:12px; background: rgba(15,22,40,.45); border:1px solid rgba(255,255,255,.08); border-radius:14px; padding:14px 16px; backdrop-filter: blur(8px); }
[data-theme="light"] .admin-kpi { background: rgba(255,255,255,.7); border-color:#e8ecf4; }
.admin-kpi-icon { width:42px; height:42px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.1rem; flex-shrink:0; }
.admin-kpi strong { display:block; font-size:1.35rem; font-family:Outfit,sans-serif; line-height:1.1; }
.admin-kpi span { font-size:.8rem; color: var(--text-secondary, #94a3b8); font-weight:600; }
.admin-charts { display:grid; grid-template-columns: 1fr 1fr; gap:12px; }
.admin-chart-wide { grid-column: 1 / -1; }
.chart-box { height: 260px; margin-top: 12px; position: relative; }
.chart-box-tall { height: 300px; }
.admin-grid { display:grid; grid-template-columns: 1.2fr .9fr; gap:12px; }
.admin-card h3 { margin:0 0 8px; font-size:1.05rem; }
.admin-actions { display:grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap:8px; margin-top:12px; }
.admin-action { display:flex; align-items:center; gap:8px; padding:10px 12px; border-radius:12px; background: rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.08); text-decoration:none; color:inherit; font-weight:600; font-size:.9rem; transition: border-color .18s, transform .18s; }
[data-theme="light"] .admin-action { background:#f8fafc; border-color:#eef2f7; }
.admin-action:hover { border-color: rgba(234,179,8,.45); transform: translateY(-1px); }
.admin-action i { color:#eab308; width:18px; text-align:center; }
.admin-list { list-style:none; margin:12px 0 0; padding:0; }
.admin-list li { display:flex; justify-content:space-between; gap:10px; padding:10px 0; border-bottom:1px solid rgba(255,255,255,.06); font-size:.9rem; }
[data-theme="light"] .admin-list li { border-bottom-color:#f1f5f9; }
.admin-list li:last-child { border-bottom:none; }
.admin-table-wrap { overflow-x:auto; margin-top:10px; }
.admin-table { width:100%; border-collapse:collapse; font-size:.88rem; }
.admin-table th, .admin-table td { text-align:left; padding:10px 8px; border-bottom:1px solid rgba(255,255,255,.06); }
[data-theme="light"] .admin-table th, [data-theme="light"] .admin-table td { border-bottom-color:#f1f5f9; }
.admin-table th { color: var(--text-secondary,#94a3b8); font-size:.78rem; text-transform:uppercase; letter-spacing:.04em; }
.admin-role { display:inline-block; padding:2px 8px; border-radius:999px; background:rgba(255,255,255,.08); font-size:.75rem; font-weight:700; }
.admin-role.is-admin { background: rgba(234,179,8,.2); color:#eab308; }
@media (max-width: 900px) { .admin-kpis { grid-template-columns: repeat(2, minmax(0,1fr)); } .admin-charts, .admin-grid { grid-template-columns: 1fr; } .admin-chart-wide { grid-column: auto; } }
@media (max-width: 560px) { .admin-kpis { grid-template-columns: 1fr; } .admin-actions { grid-template-columns: 1fr; } }
</style>
