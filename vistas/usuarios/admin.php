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
            <span class="badge badge-accent"><i class="fa-solid fa-shield-halved"></i> Administración</span>
            <h1 class="admin-page-title">Panel de control</h1>
            <p class="page-sub" style="margin:0;">Hola, <?php echo $nombre; ?>. Métricas y gestión del sistema.</p>
        </div>
        <div class="admin-hero-actions">
            <a href="<?php echo $url_base; ?>usuarios/adminGestion" class="btn btn-accent"><i class="fa-solid fa-pen-to-square"></i> Gestionar contenido</a>
        </div>
    </div>

    <form method="get" action="<?php echo $url_base; ?>usuarios/admin" class="admin-filters">
        <div class="admin-filter-field">
            <label class="form-label">Ciudad</label>
            <select name="ciudad" class="form-input">
                <option value="">Todas</option>
                <?php foreach ($ciudades_filtro as $c): ?>
                    <option value="<?php echo htmlspecialchars($c); ?>" <?php echo $filtro_ciudad === $c ? 'selected' : ''; ?>><?php echo htmlspecialchars($c); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="admin-filter-field">
            <label class="form-label">Periodo</label>
            <select name="periodo" class="form-input">
                <option value="all" <?php echo ($periodo ?? 'all') === 'all' ? 'selected' : ''; ?>>Todo</option>
                <option value="30" <?php echo ($periodo ?? '') === '30' ? 'selected' : ''; ?>>30 días</option>
                <option value="90" <?php echo ($periodo ?? '') === '90' ? 'selected' : ''; ?>>90 días</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-filter"></i> Aplicar</button>
        <a href="<?php echo $url_base; ?>usuarios/admin" class="btn btn-outline">Limpiar</a>
    </form>

    <div class="admin-kpis">
        <div class="admin-kpi"><div class="admin-kpi-icon" style="background:rgba(37,99,235,.15);color:#60a5fa;"><i class="fa-solid fa-users"></i></div><div><strong><?php echo (int)($stats['usuarios'] ?? 0); ?></strong><span>Usuarios</span></div></div>
        <div class="admin-kpi"><div class="admin-kpi-icon" style="background:rgba(234,179,8,.15);color:#eab308;"><i class="fa-solid fa-building-columns"></i></div><div><strong><?php echo (int)($stats['universidades'] ?? 0); ?></strong><span>Universidades</span></div></div>
        <div class="admin-kpi"><div class="admin-kpi-icon" style="background:rgba(16,185,129,.15);color:#34d399;"><i class="fa-solid fa-graduation-cap"></i></div><div><strong><?php echo (int)($stats['programas'] ?? 0); ?></strong><span>Programas</span></div></div>
        <div class="admin-kpi"><div class="admin-kpi-icon" style="background:rgba(139,92,246,.15);color:#a78bfa;"><i class="fa-solid fa-award"></i></div><div><strong><?php echo (int)($stats['becas'] ?? 0); ?></strong><span>Becas</span></div></div>
        <div class="admin-kpi"><div class="admin-kpi-icon" style="background:rgba(59,130,246,.15);color:#93c5fd;"><i class="fa-solid fa-clipboard-list"></i></div><div><strong><?php echo (int)($stats['tests_completados'] ?? 0); ?></strong><span>Tests hechos</span></div></div>
    </div>

    <div class="admin-charts">
        <div class="admin-card">
            <div class="admin-card-head">
                <h3><i class="fa-solid fa-chart-column"></i> Universidades más visitadas</h3>
                <select id="chart-type-ciudades" class="form-input admin-select-sm">
                    <option value="bar">Barras (ascendente)</option>
                    <option value="line">Línea</option>
                </select>
            </div>
            <div class="chart-box"><canvas id="chartCiudades"></canvas></div>
        </div>
        <div class="admin-card">
            <div class="admin-card-head"><h3><i class="fa-solid fa-chart-pie"></i> Contenido del sistema</h3></div>
            <div class="chart-box"><canvas id="chartContenido"></canvas></div>
        </div>
        <div class="admin-card admin-chart-wide">
            <div class="admin-card-head"><h3><i class="fa-solid fa-chart-line"></i> Actividad (tests vocacionales)</h3></div>
            <div class="chart-box chart-box-tall"><canvas id="chartActividad"></canvas></div>
        </div>
    </div>

    <div class="admin-grid">
        <div class="admin-card">
            <h3><i class="fa-solid fa-screwdriver-wrench"></i> Gestión</h3>
            <p class="page-sub">Administra el contenido de la plataforma.</p>
            <div class="admin-actions">
                <a class="admin-action" href="<?php echo $url_base; ?>usuarios/adminGestion?tab=universidades"><i class="fa-solid fa-building-columns"></i><span>Universidades</span></a>
                <a class="admin-action" href="<?php echo $url_base; ?>usuarios/adminGestion?tab=programas"><i class="fa-solid fa-book-open"></i><span>Carreras</span></a>
                <a class="admin-action" href="<?php echo $url_base; ?>usuarios/adminGestion?tab=becas"><i class="fa-solid fa-award"></i><span>Becas</span></a>
                <a class="admin-action" href="<?php echo $url_base; ?>admin/usuarios"><i class="fa-solid fa-users"></i><span>Usuarios</span></a>
            </div>
        </div>
        <div class="admin-card">
            <h3><i class="fa-solid fa-chart-line"></i> Resumen</h3>
            <ul class="admin-list">
                <li><span>Preguntas test vocacional</span><strong><?php echo (int)($stats['preguntas_test'] ?? 0); ?></strong></li>
                <li><span>Respuestas de usuarios</span><strong><?php echo (int)($stats['respuestas_test'] ?? 0); ?></strong></li>
                <li><span>Tests completados</span><strong><?php echo (int)($stats['tests_completados'] ?? 0); ?></strong></li>
            </ul>
        </div>
    </div>

    <div class="admin-card" style="margin-top:14px;">
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
  Chart.defaults.font.family = "'Roboto Slab', Georgia, serif";
  const dataCiudades = <?php echo json_encode($chart_ciudades, JSON_UNESCAPED_UNICODE); ?>;
  const dataContenido = <?php echo json_encode($chart_contenido, JSON_UNESCAPED_UNICODE); ?>;
  const dataActividad = <?php echo json_encode($chart_actividad, JSON_UNESCAPED_UNICODE); ?>;
  const labelsC = dataCiudades.map(x => x.label);
  const valuesC = dataCiudades.map(x => x.value);
  const colors = ['#2563eb','#eab308','#10b981','#8b5cf6','#ef4444','#06b6d4','#f97316','#ec4899','#84cc16','#6366f1','#14b8a6','#a855f7'];
  let chartCiudades = new Chart(document.getElementById('chartCiudades'), {
    type: 'bar',
    data: { labels: labelsC, datasets: [{ label: 'Visitas', data: valuesC, backgroundColor: colors.slice(0, labelsC.length), borderRadius: 4, borderSkipped: false }] },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { ticks: { maxRotation: 45 }, grid: { display: false } }, y: { beginAtZero: true, ticks: { precision: 0 } } } }
  });
  document.getElementById('chart-type-ciudades').addEventListener('change', function(){
    const t = this.value;
    chartCiudades.destroy();
    chartCiudades = new Chart(document.getElementById('chartCiudades'), {
      type: t,
      data: { labels: labelsC, datasets: [{ label: 'Visitas', data: valuesC, backgroundColor: colors.slice(0, labelsC.length), borderColor: '#3b82f6', fill: t==='line', tension: 0.3, borderRadius: t === 'bar' ? 4 : 0 }] },
      options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { ticks: { maxRotation: 45 }, grid: { display: false } }, y: { beginAtZero: true, ticks: { precision: 0 } } } }
    });
  });
  new Chart(document.getElementById('chartContenido'), {
    type: 'doughnut',
    data: { labels: dataContenido.map(x => x.label), datasets: [{ data: dataContenido.map(x => x.value), backgroundColor: ['#eab308','#2563eb','#8b5cf6','#10b981'], borderWidth: 0, hoverOffset: 6 }] },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } }, cutout: '58%' }
  });
  new Chart(document.getElementById('chartActividad'), {
    type: 'line',
    data: { labels: dataActividad.labels || [], datasets: [
      { label: 'Tests vocacionales', data: dataActividad.tests || [], borderColor: '#3b82f6', backgroundColor: 'rgba(59,130,246,0.12)', fill: true, tension: 0.35, pointRadius: 3 }
    ]},
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'top' } }, scales: { x: { grid: { display: false } }, y: { beginAtZero: true, ticks: { precision: 0 } } } }
  });
})();
</script>
<style>
.admin-wrap{max-width:100%;width:100%;margin:0 auto;box-sizing:border-box;overflow-x:hidden}
.admin-page-title{margin:10px 0 6px;font-family:'Roboto Slab',Georgia,serif;font-size:clamp(1.4rem,3vw,1.85rem);font-weight:800}
.admin-hero{display:flex;flex-wrap:wrap;align-items:flex-start;justify-content:space-between;gap:14px;margin-bottom:16px}
.admin-hero-actions{display:flex;flex-wrap:wrap;gap:8px}
.admin-filters{display:flex;flex-wrap:wrap;gap:12px;align-items:flex-end;padding:14px 16px;margin-bottom:14px;background:rgba(15,23,42,.55);border:1px solid rgba(255,255,255,.08);border-radius:8px}
[data-theme="light"] .admin-filters{background:rgba(255,255,255,.92);border:1.5px solid #0f172a}
.admin-filter-field{flex:1;min-width:140px;max-width:220px}
.admin-filter-field .form-input{width:100%}
.admin-kpis{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:12px;margin-bottom:14px}
.admin-kpi{display:flex;align-items:center;gap:12px;min-width:0;background:rgba(15,22,40,.55);border:1px solid rgba(255,255,255,.08);border-radius:8px;padding:14px 16px}
[data-theme="light"] .admin-kpi{background:rgba(255,255,255,.92);border:1.5px solid #0f172a}
.admin-kpi-icon{width:40px;height:40px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0}
.admin-kpi strong{display:block;font-size:1.3rem;font-family:'Roboto Slab',Georgia,serif;line-height:1.1}
.admin-kpi span{font-size:.78rem;color:#94a3b8;font-weight:600}
.admin-charts{display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1fr);gap:12px;margin-bottom:14px}
.admin-chart-wide{grid-column:1/-1}
.admin-card{min-width:0;background:rgba(15,23,42,.55);border:1px solid rgba(255,255,255,.08);border-radius:8px;padding:16px 18px;box-sizing:border-box;overflow:hidden}
[data-theme="light"] .admin-card{background:rgba(255,255,255,.92);border:1.5px solid #0f172a}
.admin-card-head{display:flex;justify-content:space-between;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:4px}
.admin-card h3{margin:0;font-size:.98rem;font-family:'Roboto Slab',Georgia,serif}
.admin-select-sm{width:auto!important;min-width:110px;padding:6px 10px!important;font-size:.8rem!important}
.chart-box{height:240px;max-height:240px;margin-top:10px;position:relative;width:100%;max-width:100%;overflow:hidden}
.chart-box-tall{height:280px;max-height:280px}
.chart-box canvas{max-width:100%!important}
.admin-grid{display:grid;grid-template-columns:minmax(0,1.2fr) minmax(0,.9fr);gap:12px}
.admin-actions{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:8px;margin-top:12px}
.admin-action{display:flex;align-items:center;gap:8px;padding:10px 12px;border-radius:6px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);text-decoration:none;color:inherit;font-weight:600;font-size:.88rem}
[data-theme="light"] .admin-action{background:#f8fafc;border-color:#e2e8f0}
.admin-action:hover{border-color:rgba(234,179,8,.45)}
.admin-action i{color:#eab308;width:18px;text-align:center}
.admin-list{list-style:none;margin:12px 0 0;padding:0}
.admin-list li{display:flex;justify-content:space-between;gap:10px;padding:10px 0;border-bottom:1px solid rgba(255,255,255,.06);font-size:.9rem}
[data-theme="light"] .admin-list li{border-bottom-color:#f1f5f9}
.admin-list li:last-child{border-bottom:none}
.admin-table-wrap{overflow-x:auto;margin-top:10px}
.admin-table{width:100%;border-collapse:collapse;font-size:.86rem;min-width:480px}
.admin-table th,.admin-table td{text-align:left;padding:10px 8px;border-bottom:1px solid rgba(255,255,255,.06)}
[data-theme="light"] .admin-table th,[data-theme="light"] .admin-table td{border-bottom-color:#f1f5f9}
.admin-table th{color:#94a3b8;font-size:.75rem;text-transform:uppercase;letter-spacing:.04em}
.admin-role{display:inline-block;padding:2px 8px;border-radius:4px;background:rgba(255,255,255,.08);font-size:.75rem;font-weight:700}
.admin-role.is-admin{background:rgba(234,179,8,.2);color:#eab308}
@media (max-width:900px){.admin-kpis{grid-template-columns:repeat(2,minmax(0,1fr))}.admin-charts,.admin-grid{grid-template-columns:1fr}.admin-chart-wide{grid-column:auto}}
@media (max-width:560px){.admin-kpis{grid-template-columns:1fr}.admin-actions{grid-template-columns:1fr}}
</style>
