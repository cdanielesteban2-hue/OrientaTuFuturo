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
<!-- Dragón estilo tinta (mockup) -->
<svg class="app-dragon" viewBox="0 0 800 600" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
  <g fill="none" stroke="#334155" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M120 420c40-90 110-140 190-160 30-80 110-130 200-120 40-50 110-70 170-40 50 25 75 80 60 135 55 35 80 100 55 165-20 50-70 80-125 85 10 55-25 105-80 120-60 18-120-10-145-65-45 40-115 45-170 5-55-40-75-110-50-170-40-20-70-55-75-100-5-35 5-70 30-95"/>
    <path d="M280 220c25-45 80-70 130-55 35 12 55 45 50 80"/>
    <path d="M520 160c20-35 60-50 95-35 25 12 40 40 30 70"/>
    <path d="M180 300c-25 20-45 50-50 85"/>
    <path d="M400 280c15 40 10 85-15 120"/>
    <path d="M560 300c25 30 35 70 20 105"/>
    <path d="M620 200c40 5 70 30 80 65"/>
    <circle cx="640" cy="175" r="6" fill="#334155"/>
    <path d="M655 170c12-8 28-8 38 2"/>
    <path d="M200 450c30 25 70 30 105 15"/>
    <path d="M320 480c40 20 85 15 120-10"/>
  </g>
</svg>
<div class="app-vertical-text" aria-hidden="true">
  <span class="vt-block">情報決断前進</span>
</div>

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
            <a href="<?php echo $url_base; ?>usuarios/registro" class="btn btn-accent" style="width:100%; margin-top:8px; font-size:0.9rem;">Registrarse</a>
        <?php endif; ?>
    </div>
</aside>

<header class="app-topbar">
    <button type="button" class="sidebar-toggle" id="sidebar-toggle" aria-label="Menú"><i class="fa-solid fa-bars"></i></button>
    <div class="topbar-search-hint">
        <i class="fa-solid fa-compass"></i>
        <span>Tu viaje hacia el futuro comienza aquí</span>
    </div>
    <div class="topbar-actions">
        <?php if ($logado): ?>
            <button type="button" class="topbar-user-btn" id="user-menu-btn" aria-haspopup="true" aria-expanded="false">
                <span class="topbar-avatar"><?php echo $emoji; ?></span>
                <span class="topbar-name"><?php echo $nombre; ?></span>
                <i class="fa-solid fa-chevron-down" style="font-size:0.7rem; opacity:0.6;"></i>
            </button>
            <div class="user-menu" id="user-menu">
                <a href="<?php echo $url_base; ?>usuarios/dashboard"><i class="fa-solid fa-gauge"></i> Mi Panel</a>
                <a href="<?php echo $url_base; ?>cuestionarios/inicio"><i class="fa-solid fa-clipboard-list"></i> Test Vocacional</a>
                <a href="<?php echo $url_base; ?>simulacros/inicio"><i class="fa-solid fa-pencil"></i> Pre-ICFES</a>
                <a href="<?php echo $url_base; ?>usuarios/logout" class="danger"><i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión</a>
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
(function(){
  var btn=document.getElementById('user-menu-btn');
  var menu=document.getElementById('user-menu');
  if(btn&&menu){
    btn.addEventListener('click',function(e){e.stopPropagation();var o=menu.classList.toggle('open');btn.setAttribute('aria-expanded',o?'true':'false');});
    document.addEventListener('click',function(){menu.classList.remove('open');btn.setAttribute('aria-expanded','false');});
    menu.addEventListener('click',function(e){e.stopPropagation();});
  }
})();
</script>
