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
<!-- Dragón de fondo en TODAS las páginas -->
<div class="app-dragon-bg" aria-hidden="true"></div>

<aside class="app-sidebar" id="app-sidebar">
    <div class="sidebar-brand">
        <a href="<?php echo $url_base; ?>paginas/inicio" class="sidebar-logo">
            <img src="<?php echo $url_base; ?>recursos/img/logo_navbar.png" alt="Logo OrientaTuFuturo" class="sidebar-logo-img">
            <span class="sidebar-logo-text">Orienta<span>Tu</span>Futuro</span>
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
        <a href="<?php echo $url_base; ?>simulacros/inicio" class="side-link <?php echo (nav_active('simulacros/inicio') || (nav_active('simulacros') && !nav_active('profundizado'))) ? 'active' : ''; ?>">
            <i class="fa-solid fa-pencil"></i> Pre-ICFES
        </a>
        <a href="<?php echo $url_base; ?>simulacros/profundizado" class="side-link <?php echo nav_active('profundizado'); ?>">
            <i class="fa-solid fa-layer-group"></i> Pre-ICFES profundizado
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
            <a href="<?php echo $url_base; ?>usuarios/registro" class="btn btn-accent" style="width:100%; margin-top:8px; font-size:0.85rem;">Registrarse</a>
        <?php endif; ?>
    </div>
</aside>

<header class="app-topbar">
    <button type="button" class="sidebar-toggle" id="sidebar-toggle" aria-label="Menú"><i class="fa-solid fa-bars"></i></button>
    <div class="topbar-search-hint">
        <i class="fa-solid fa-compass"></i>
        <span>Informar para decidir, decidir para avanzar</span>
    </div>
    <div class="topbar-actions">
        <?php if ($logado): ?>
            <button type="button" class="topbar-user-btn" id="user-menu-btn" aria-haspopup="true" aria-expanded="false">
                <span class="topbar-avatar"><?php echo $emoji; ?></span>
                <span class="topbar-name"><?php echo $nombre; ?></span>
                <i class="fa-solid fa-chevron-down" style="font-size:0.65rem; opacity:0.6;"></i>
            </button>
            <div class="user-menu" id="user-menu">
                <a href="<?php echo $url_base; ?>usuarios/dashboard"><i class="fa-solid fa-gauge"></i> Mi Panel</a>
                <a href="<?php echo $url_base; ?>cuestionarios/inicio"><i class="fa-solid fa-clipboard-list"></i> Test Vocacional</a>
                <a href="<?php echo $url_base; ?>simulacros/inicio"><i class="fa-solid fa-pencil"></i> Pre-ICFES</a>
                <a href="<?php echo $url_base; ?>simulacros/profundizado"><i class="fa-solid fa-layer-group"></i> Pre-ICFES profundizado</a>
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
