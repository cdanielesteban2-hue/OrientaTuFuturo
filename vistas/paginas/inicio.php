<?php
if (!isset($url_base)) { $url_base = constant('URL_BASE'); }
$es_admin_inicio = isset($_SESSION['usuario']) && (($_SESSION['usuario']['rol'] ?? '') === 'admin');
if ($es_admin_inicio):
?>
<div class="admin-wrap">
    <header class="admin-greet">
        <p class="admin-greet-hi">Hola admin</p>
        <h1 class="admin-greet-q">¿Qué tenemos para hoy?</h1>
        <p class="page-sub">Elige una opción para gestionar la plataforma.</p>
    </header>

    <div class="admin-option-grid">
        <a class="admin-option-card" href="<?php echo $url_base; ?>usuarios/admin">
            <i class="fa-solid fa-gauge-high"></i>
            <strong>Panel Admin</strong>
            <span>Métricas y gráficas del sistema</span>
        </a>
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
</div>
<style>
.admin-wrap{max-width:100%;width:100%;margin:0 auto;box-sizing:border-box;overflow-x:hidden}
.admin-greet{margin-bottom:28px;padding-top:8px}
.admin-greet-hi{margin:0 0 6px;font-size:clamp(1.1rem,2.5vw,1.35rem);font-weight:700;color:#eab308;letter-spacing:.02em}
.admin-greet-q{margin:0 0 10px;font-family:'Roboto Slab',Georgia,serif;font-size:clamp(2rem,5vw,3rem);font-weight:800;line-height:1.15}
.admin-option-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:14px}
.admin-option-card{display:flex;flex-direction:column;gap:6px;padding:20px 18px;border-radius:10px;text-decoration:none;color:inherit;background:rgba(15,23,42,.62);border:1.5px solid rgba(255,255,255,.1);transition:border-color .15s,box-shadow .15s}
.admin-option-card:hover{border-color:rgba(234,179,8,.5);box-shadow:0 6px 18px rgba(0,0,0,.2)}
[data-theme="light"] .admin-option-card{background:#fff;border:1.5px solid #0f172a}
.admin-option-card i{font-size:1.35rem;color:#eab308;margin-bottom:4px}
.admin-option-card strong{font-family:'Roboto Slab',Georgia,serif;font-size:1.05rem}
.admin-option-card span{font-size:.84rem;color:#94a3b8;line-height:1.35}
</style>
<?php
else:
include __DIR__ . '/inicio_contenido_a.php';
include __DIR__ . '/inicio_contenido_b1.php';
include __DIR__ . '/inicio_contenido_b2.php';
endif;
