<?php
$url_base = constant('URL_BASE');
$uri = $_SERVER['REQUEST_URI'] ?? '';
function nav_active($needle) {
    global $uri;
    return (strpos($uri, $needle) !== false) ? 'active' : '';
}
$avatares = ['av1'=>'👤','av2'=>'🎓','av3'=>'🚀','av4'=>'🌟','av5'=>'💡','av6'=>'🔬','av7'=>'🎨','av8'=>'⚙️'];
$avatar_actual = $_SESSION['usuario']['avatar'] ?? 'av1';
$emoji = $avatares[$avatar_actual] ?? '👤';
$nombre = isset($_SESSION['usuario']) ? htmlspecialchars($_SESSION['usuario']['nombre']) : 'Invitado';
$logado = isset($_SESSION['usuario']);
?>
<!-- Decoración: dragón + letras verticales -->
<svg class="app-dragon" viewBox="0 0 400 480" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
  <defs>
    <linearGradient id="dg" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#64748b"/>
      <stop offset="100%" stop-color="#94a3b8"/>
    </linearGradient>
  </defs>
  <path fill="url(#dg)" d="M60 380c20-40 50-70 90-90 10-40 40-70 80-85-15-25-10-55 15-70 20-12 45-8 60 10 18-30 55-40 85-20 25 16 35 45 25 75 35 20 50 55 40 95-8 30-30 50-60 60 5 30-5 60-30 75-30 18-65 10-85-15-25 20-60 25-90 5-35-22-50-60-40-95-25-10-45-30-50-55-5-20 0-40 10-55z"/>
  <path fill="url(#dg)" opacity="0.7" d="M200 120c30-40 80-50 120-25 25 15 40 45 35 75-20 10-45 5-60-10-10 25-35 40-65 35-30-5-50-30-45-55 5-10 10-15 15-20z"/>
  <ellipse cx="280" cy="90" rx="18" ry="12" fill="url(#dg)"/>
  <circle cx="288" cy="88" r="3" fill="#0f172a"/>
</svg>
<div class="app-vertical-text" aria-hidden="true">情報決断前進</div>

<aside class="app-sidebar" id="app-sidebar">
    <div class="sidebar-brand">
        <a href="<?php echo $url_base; ?>paginas/inicio" class="sidebar-logo">
            <img src="<?php echo $url_base; ?>recursos/img/logo_navbar.png" alt="Logo" class="sidebar-logo-img">
            <span class="sidebar-logo-text">orienta<span>tu</span>futuro</span>
        </a>
    </div>

    <nav class="sidebar-nav">
        <a href="<?php echo $url_base; ?>paginas/inicio" class="side-link <?php echo (nav_active('paginas/inicio') || preg_match('#/(index\.php)?$#', $uri)) ? 'active' : ''; ?>">
            <i class="fa-solid fa-house"></i> Inicio
        </a>
        <a href="<?php echo $url_base; ?>programas/inicio" class="side-link <?php echo nav_active('programas'); ?>">
            <i class="fa-solid fa-magnifying-glass"></i> Explorar Carreras
        </a>
        <a href="<?php echo $url_base; ?>universidades/inicio" class="side-link <?php echo nav_active('universidades'); ?>">
            <i class="fa-solid fa-building-columns"></i> Universidades
        </a>
        <a href="<?php echo $url_base; ?>becas/inicio" class="side-link <?php echo nav_active('becas'); ?>">
            <i class="fa-solid fa-award"></i> Becas
        </a>
        <a href="<?php echo $url_base; ?>cuestionarios/inicio" class="side-link <?php echo nav_active('cuestionarios'); ?>">
            <i class="fa-solid fa-clipboard-list"></i> Test Vocacional
        </a>
        <a href="<?php echo $url_base; ?>simulacros/inicio" class="side-link <?php echo nav_active('simulacros'); ?>">
            <i class="fa-solid fa-pencil"></i> Pre-ICFES
        </a>
        <a href="<?php echo $url_base; ?>paginas/nosotros" class="side-link <?php echo nav_active('nosotros'); ?>">
            <i class="fa-solid fa-people-group"></i> Nosotros
        </a>
        <?php if ($logado): ?>
        <a href="<?php echo $url_base; ?>usuarios/dashboard" class="side-link <?php echo nav_active('usuarios/dashboard'); ?>">
            <i class="fa-solid fa-gauge"></i> Mi Panel
        </a>
        <?php if (isset($_SESSION['usuario']['rol']) && $_SESSION['usuario']['rol'] === 'admin'): ?>
        <a href="<?php echo $url_base; ?>admin/dashboard" class="side-link <?php echo nav_active('admin'); ?>">
            <i class="fa-solid fa-screwdriver-wrench"></i> Admin
        </a>
        <?php endif; ?>
        <?php endif; ?>
    </nav>

    <div class="sidebar-foot">
        <button id="theme-toggle" class="side-link theme-side-btn" type="button" title="Cambiar tema">
            <i class="fa-solid fa-moon"></i> Tema
        </button>
        <?php if ($logado): ?>
            <a href="<?php echo $url_base; ?>usuarios/logout" class="side-link side-logout">
                <i class="fa-solid fa-right-from-bracket"></i> Salir
            </a>
        <?php else: ?>
            <a href="<?php echo $url_base; ?>usuarios/login" class="side-link">
                <i class="fa-solid fa-right-to-bracket"></i> Ingresar
            </a>
            <a href="<?php echo $url_base; ?>usuarios/registro" class="btn btn-accent" style="width:100%; margin-top:8px; font-size:0.9rem;">
                Registrarse
            </a>
        <?php endif; ?>
    </div>
</aside>

<header class="app-topbar">
    <button type="button" class="sidebar-toggle" id="sidebar-toggle" aria-label="Menú">
        <i class="fa-solid fa-bars"></i>
    </button>
    <div class="topbar-search-hint">
        <i class="fa-solid fa-compass"></i>
        <span>Tu viaje hacia el futuro comienza aquí</span>
    </div>
    <div class="topbar-actions">
        <?php if ($logado): ?>
            <button type="button" class="topbar-user-btn" id="user-menu-btn" aria-haspopup="true" aria-expanded="false">
                <span class="topbar-avatar"><?php echo $emoji; ?></span>
                <span class="topbar-name"><?php echo $nombre; ?></span>
                <i class="fa-solid fa-chevron-down" style="font-size:0.7rem; opacity:0.7;"></i>
            </button>
            <div class="user-menu" id="user-menu">
                <a href="<?php echo $url_base; ?>usuarios/dashboard">
                    <i class="fa-solid fa-gauge"></i> Mi Panel
                </a>
                <a href="<?php echo $url_base; ?>cuestionarios/inicio">
                    <i class="fa-solid fa-clipboard-list"></i> Test Vocacional
                </a>
                <a href="<?php echo $url_base; ?>simulacros/inicio">
                    <i class="fa-solid fa-pencil"></i> Pre-ICFES
                </a>
                <?php if (isset($_SESSION['usuario']['rol']) && $_SESSION['usuario']['rol'] === 'admin'): ?>
                <a href="<?php echo $url_base; ?>admin/dashboard">
                    <i class="fa-solid fa-screwdriver-wrench"></i> Admin
                </a>
                <?php endif; ?>
                <a href="<?php echo $url_base; ?>usuarios/logout" class="danger">
                    <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
                </a>
            </div>
        <?php else: ?>
            <a href="<?php echo $url_base; ?>usuarios/login" class="topbar-user-btn">
                <span class="topbar-avatar">👤</span>
                <span class="topbar-name">Ingresar</span>
            </a>
        <?php endif; ?>
    </div>
</header>

<script>
(function() {
    var btn = document.getElementById('user-menu-btn');
    var menu = document.getElementById('user-menu');
    if (btn && menu) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            var open = menu.classList.toggle('open');
            btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
        document.addEventListener('click', function() {
            menu.classList.remove('open');
            btn.setAttribute('aria-expanded', 'false');
        });
        menu.addEventListener('click', function(e) { e.stopPropagation(); });
    }
})();
</script>
