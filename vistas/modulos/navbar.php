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
?>
<aside class="app-sidebar" id="app-sidebar">
    <div class="sidebar-brand">
        <a href="<?php echo $url_base; ?>paginas/inicio" class="sidebar-logo">
            <img src="<?php echo $url_base; ?>recursos/img/logo_navbar.png" alt="Logo" class="sidebar-logo-img">
            <span class="sidebar-logo-text">orienta<span>tu</span>futuro</span>
        </a>
    </div>

    <nav class="sidebar-nav">
        <a href="<?php echo $url_base; ?>paginas/inicio" class="side-link <?php echo nav_active('paginas/inicio') || $uri === '/' || substr($uri, -1) === '/' ? 'active' : ''; ?>">
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
        <?php if (isset($_SESSION['usuario'])): ?>
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
        <?php if (isset($_SESSION['usuario'])): ?>
            <a href="<?php echo $url_base; ?>usuarios/logout" class="side-link side-logout">
                <i class="fa-solid fa-right-from-bracket"></i> Salir
            </a>
        <?php else: ?>
            <a href="<?php echo $url_base; ?>usuarios/login" class="side-link">
                <i class="fa-solid fa-right-to-bracket"></i> Ingresar
            </a>
            <a href="<?php echo $url_base; ?>usuarios/registro" class="btn btn-accent" style="width:100%; margin-top:8px; font-size:0.85rem;">
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
        <?php if (isset($_SESSION['usuario'])): ?>
            <span class="topbar-user">
                <span class="topbar-avatar"><?php echo $emoji; ?></span>
                <span class="topbar-name"><?php echo $nombre; ?></span>
            </span>
        <?php else: ?>
            <a href="<?php echo $url_base; ?>usuarios/login" class="btn btn-outline" style="padding:7px 14px; font-size:0.82rem;">Ingresar</a>
            <a href="<?php echo $url_base; ?>usuarios/registro" class="btn btn-accent" style="padding:7px 14px; font-size:0.82rem;">Registrarse</a>
        <?php endif; ?>
    </div>
</header>
