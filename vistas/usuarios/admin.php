<?php
$url_base = defined('URL_BASE') ? constant('URL_BASE') : '';
$nombre = htmlspecialchars($_SESSION['usuario']['nombre'] ?? 'Admin');
?>
<div class="admin-wrap">
    <div class="admin-hero">
        <div>
            <span class="badge badge-accent"><i class="fa-solid fa-shield-halved"></i> Modo administrador</span>
            <h1 style="margin:10px 0 6px; font-family:Outfit,sans-serif;">Panel operativo</h1>
            <p class="page-sub" style="margin:0;">Hola, <?php echo $nombre; ?>. Centraliza métricas, contenido y control del sistema OrientaTuFuturo.</p>
        </div>
        <a href="<?php echo $url_base; ?>usuarios/dashboard" class="btn btn-outline">Ver panel estudiante</a>
    </div>

    <div class="admin-kpis">
        <div class="admin-kpi">
            <div class="admin-kpi-icon" style="background:rgba(37,99,235,.15);color:#60a5fa;"><i class="fa-solid fa-users"></i></div>
            <div>
                <strong><?php echo (int)$stats['usuarios']; ?></strong>
                <span>Usuarios registrados</span>
            </div>
        </div>
        <div class="admin-kpi">
            <div class="admin-kpi-icon" style="background:rgba(234,179,8,.15);color:#eab308;"><i class="fa-solid fa-building-columns"></i></div>
            <div>
                <strong><?php echo (int)$stats['universidades']; ?></strong>
                <span>Universidades</span>
            </div>
        </div>
        <div class="admin-kpi">
            <div class="admin-kpi-icon" style="background:rgba(16,185,129,.15);color:#34d399;"><i class="fa-solid fa-graduation-cap"></i></div>
            <div>
                <strong><?php echo (int)$stats['programas']; ?></strong>
                <span>Programas / carreras</span>
            </div>
        </div>
        <div class="admin-kpi">
            <div class="admin-kpi-icon" style="background:rgba(139,92,246,.15);color:#a78bfa;"><i class="fa-solid fa-award"></i></div>
            <div>
                <strong><?php echo (int)$stats['becas']; ?></strong>
                <span>Becas publicadas</span>
            </div>
        </div>
        <div class="admin-kpi">
            <div class="admin-kpi-icon" style="background:rgba(59,130,246,.15);color:#93c5fd;"><i class="fa-solid fa-clipboard-list"></i></div>
            <div>
                <strong><?php echo (int)$stats['tests_completados']; ?></strong>
                <span>Tests vocacionales</span>
            </div>
        </div>
        <div class="admin-kpi">
            <div class="admin-kpi-icon" style="background:rgba(239,68,68,.15);color:#f87171;"><i class="fa-solid fa-pencil"></i></div>
            <div>
                <strong><?php echo (int)$stats['simulacros']; ?></strong>
                <span>Intentos Pre-ICFES</span>
            </div>
        </div>
    </div>

    <div class="admin-grid">
        <div class="card-premium admin-card">
            <h3><i class="fa-solid fa-gauge-high"></i> Control operativo</h3>
            <p class="page-sub">Accesos rápidos a módulos de contenido y experiencia del estudiante.</p>
            <div class="admin-actions">
                <a class="admin-action" href="<?php echo $url_base; ?>universidades/inicio"><i class="fa-solid fa-building-columns"></i><span>Universidades</span></a>
                <a class="admin-action" href="<?php echo $url_base; ?>programas/inicio"><i class="fa-solid fa-book-open"></i><span>Carreras</span></a>
                <a class="admin-action" href="<?php echo $url_base; ?>becas/inicio"><i class="fa-solid fa-award"></i><span>Becas</span></a>
                <a class="admin-action" href="<?php echo $url_base; ?>cuestionarios/inicio"><i class="fa-solid fa-clipboard-list"></i><span>Test vocacional</span></a>
                <a class="admin-action" href="<?php echo $url_base; ?>simulacros/inicio"><i class="fa-solid fa-pencil"></i><span>Pre-ICFES</span></a>
                <a class="admin-action" href="<?php echo $url_base; ?>simulacros/profundizado"><i class="fa-solid fa-layer-group"></i><span>Pre-ICFES profundizado</span></a>
            </div>
        </div>

        <div class="card-premium admin-card">
            <h3><i class="fa-solid fa-chart-line"></i> Resumen de actividad</h3>
            <ul class="admin-list">
                <li><span>Preguntas del banco Pre-ICFES</span><strong><?php echo (int)$stats['preguntas_simulacro']; ?></strong></li>
                <li><span>Preguntas del test vocacional</span><strong><?php echo (int)$stats['preguntas_test']; ?></strong></li>
                <li><span>Respuestas de usuarios (test)</span><strong><?php echo (int)$stats['respuestas_test']; ?></strong></li>
                <li><span>Promedio mejor práctica ICFES*</span><strong><?php echo htmlspecialchars((string)$stats['promedio_icfes']); ?>%</strong></li>
            </ul>
            <p style="font-size:0.78rem;color:var(--text-secondary);margin:12px 0 0;">* Promedio de puntajes registrados en intentos (0 si no hay datos).</p>
        </div>
    </div>

    <div class="card-premium admin-card" style="margin-top:14px;">
        <h3><i class="fa-solid fa-user-shield"></i> Últimos usuarios registrados</h3>
        <?php if (empty($ultimos_usuarios)): ?>
            <p class="page-sub">No hay usuarios para mostrar.</p>
        <?php else: ?>
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Ciudad</th>
                            <th>Rol</th>
                            <th>Registro</th>
                        </tr>
                    </thead>
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

<style>
.admin-wrap { max-width: 1100px; margin: 0 auto; }
.admin-hero {
  display:flex; flex-wrap:wrap; align-items:flex-start; justify-content:space-between; gap:14px;
  margin-bottom: 18px;
}
.admin-kpis {
  display:grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap:12px; margin-bottom:14px;
}
.admin-kpi {
  display:flex; align-items:center; gap:12px;
  background: rgba(15,22,40,.45); border:1px solid rgba(255,255,255,.08);
  border-radius:14px; padding:14px 16px; backdrop-filter: blur(8px);
}
[data-theme="light"] .admin-kpi {
  background: rgba(255,255,255,.7); border-color:#e8ecf4;
}
.admin-kpi-icon {
  width:42px; height:42px; border-radius:12px;
  display:flex; align-items:center; justify-content:center; font-size:1.1rem; flex-shrink:0;
}
.admin-kpi strong { display:block; font-size:1.35rem; font-family:Outfit,sans-serif; line-height:1.1; }
.admin-kpi span { font-size:.8rem; color: var(--text-secondary, #94a3b8); font-weight:600; }
.admin-grid { display:grid; grid-template-columns: 1.2fr .9fr; gap:12px; }
.admin-card h3 { margin:0 0 8px; font-size:1.05rem; }
.admin-actions { display:grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap:8px; margin-top:12px; }
.admin-action {
  display:flex; align-items:center; gap:8px;
  padding:10px 12px; border-radius:12px;
  background: rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.08);
  text-decoration:none; color:inherit; font-weight:600; font-size:.9rem;
  transition: border-color .18s, transform .18s;
}
[data-theme="light"] .admin-action { background:#f8fafc; border-color:#eef2f7; }
.admin-action:hover { border-color: rgba(234,179,8,.45); transform: translateY(-1px); }
.admin-action i { color:#eab308; width:18px; text-align:center; }
.admin-list { list-style:none; margin:12px 0 0; padding:0; }
.admin-list li {
  display:flex; justify-content:space-between; gap:10px;
  padding:10px 0; border-bottom:1px solid rgba(255,255,255,.06); font-size:.9rem;
}
[data-theme="light"] .admin-list li { border-bottom-color:#f1f5f9; }
.admin-list li:last-child { border-bottom:none; }
.admin-table-wrap { overflow-x:auto; margin-top:10px; }
.admin-table { width:100%; border-collapse:collapse; font-size:.88rem; }
.admin-table th, .admin-table td { text-align:left; padding:10px 8px; border-bottom:1px solid rgba(255,255,255,.06); }
[data-theme="light"] .admin-table th, [data-theme="light"] .admin-table td { border-bottom-color:#f1f5f9; }
.admin-table th { color: var(--text-secondary,#94a3b8); font-size:.78rem; text-transform:uppercase; letter-spacing:.04em; }
.admin-role { display:inline-block; padding:2px 8px; border-radius:999px; background:rgba(255,255,255,.08); font-size:.75rem; font-weight:700; }
.admin-role.is-admin { background: rgba(234,179,8,.2); color:#eab308; }
@media (max-width: 900px) {
  .admin-kpis { grid-template-columns: repeat(2, minmax(0,1fr)); }
  .admin-grid { grid-template-columns: 1fr; }
}
@media (max-width: 560px) {
  .admin-kpis { grid-template-columns: 1fr; }
  .admin-actions { grid-template-columns: 1fr; }
}
</style>
