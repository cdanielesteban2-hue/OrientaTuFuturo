<?php
$url_base = defined('URL_BASE') ? constant('URL_BASE') : '';
$nombre = htmlspecialchars($_SESSION['usuario']['nombre'] ?? 'Admin');
?>
<div class="admin-wrap">
    <header class="admin-greet">
        <p class="admin-greet-hi">Hola admin</p>
        <h1 class="admin-greet-q">¿Qué tenemos para hoy?</h1>
        <p class="page-sub">Elige una opción para gestionar la plataforma.</p>
    </header>

    <div class="admin-option-grid">
        <a class="admin-option-card" href="<?php echo $url_base; ?>usuarios/adminGestion">
            <i class="fa-solid fa-pen-to-square"></i>
            <strong>Gestionar contenido</strong>
            <span>Universidades, carreras y becas</span>
        </a>
        <a class="admin-option-card" href="<?php echo $url_base; ?>admin/usuarios">
            <i class="fa-solid fa-users"></i>
            <strong>Usuarios</strong>
            <span>Lista de estudiantes y administradores</span>
        </a>
        <a class="admin-option-card" href="<?php echo $url_base; ?>admin/universidades">
            <i class="fa-solid fa-building-columns"></i>
            <strong>Universidades</strong>
            <span>Administrar instituciones</span>
        </a>
        <a class="admin-option-card" href="<?php echo $url_base; ?>admin/becas">
            <i class="fa-solid fa-award"></i>
            <strong>Becas</strong>
            <span>Oportunidades de financiación</span>
        </a>
        <a class="admin-option-card" href="<?php echo $url_base; ?>usuarios/adminGestion?tab=programas">
            <i class="fa-solid fa-book-open"></i>
            <strong>Carreras</strong>
            <span>Programas académicos</span>
        </a>
    </div>

    <div class="admin-kpis" style="margin-top:20px;">
        <div class="admin-kpi"><div class="admin-kpi-icon" style="background:rgba(37,99,235,.15);color:#60a5fa;"><i class="fa-solid fa-users"></i></div><div><strong><?php echo (int)($stats['usuarios'] ?? 0); ?></strong><span>Usuarios</span></div></div>
        <div class="admin-kpi"><div class="admin-kpi-icon" style="background:rgba(234,179,8,.15);color:#eab308;"><i class="fa-solid fa-building-columns"></i></div><div><strong><?php echo (int)($stats['universidades'] ?? 0); ?></strong><span>Universidades</span></div></div>
        <div class="admin-kpi"><div class="admin-kpi-icon" style="background:rgba(16,185,129,.15);color:#34d399;"><i class="fa-solid fa-graduation-cap"></i></div><div><strong><?php echo (int)($stats['programas'] ?? 0); ?></strong><span>Carreras</span></div></div>
        <div class="admin-kpi"><div class="admin-kpi-icon" style="background:rgba(139,92,246,.15);color:#a78bfa;"><i class="fa-solid fa-award"></i></div><div><strong><?php echo (int)($stats['becas'] ?? 0); ?></strong><span>Becas</span></div></div>
        <div class="admin-kpi"><div class="admin-kpi-icon" style="background:rgba(59,130,246,.15);color:#93c5fd;"><i class="fa-solid fa-clipboard-list"></i></div><div><strong><?php echo (int)($stats['tests_completados'] ?? 0); ?></strong><span>Tests hechos</span></div></div>
    </div>
</div>
<style>
.admin-wrap{max-width:100%;width:100%;margin:0 auto;box-sizing:border-box;overflow-x:hidden}
.admin-greet{margin-bottom:28px;padding-top:8px}
.admin-greet-hi{
  margin:0 0 6px;
  font-size:clamp(1.1rem,2.5vw,1.35rem);
  font-weight:700;
  color:#eab308;
  letter-spacing:.02em;
}
.admin-greet-q{
  margin:0 0 10px;
  font-family:'Roboto Slab',Georgia,serif;
  font-size:clamp(2rem,5vw,3rem);
  font-weight:800;
  line-height:1.15;
}
.admin-option-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
  gap:14px;
}
.admin-option-card{
  display:flex;
  flex-direction:column;
  gap:6px;
  padding:20px 18px;
  border-radius:10px;
  text-decoration:none;
  color:inherit;
  background:rgba(15,23,42,.62);
  border:1.5px solid rgba(255,255,255,.1);
  transition:border-color .15s, box-shadow .15s;
}
.admin-option-card:hover{
  border-color:rgba(234,179,8,.5);
  box-shadow:0 6px 18px rgba(0,0,0,.2);
}
[data-theme="light"] .admin-option-card{
  background:#fff;
  border:1.5px solid #0f172a;
}
.admin-option-card i{
  font-size:1.35rem;
  color:#eab308;
  margin-bottom:4px;
}
.admin-option-card strong{
  font-family:'Roboto Slab',Georgia,serif;
  font-size:1.05rem;
}
.admin-option-card span{
  font-size:.84rem;
  color:#94a3b8;
  line-height:1.35;
}
.admin-kpis{display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:12px;margin-bottom:14px}
.admin-kpi{display:flex;align-items:center;gap:12px;min-width:0;background:rgba(15,22,40,.55);border:1px solid rgba(255,255,255,.08);border-radius:8px;padding:14px 16px}
[data-theme="light"] .admin-kpi{background:rgba(255,255,255,.92);border:1.5px solid #0f172a}
.admin-kpi-icon{width:40px;height:40px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0}
.admin-kpi strong{display:block;font-size:1.25rem;font-family:'Roboto Slab',Georgia,serif;line-height:1.1}
.admin-kpi span{font-size:.78rem;color:#94a3b8;font-weight:600}
</style>
