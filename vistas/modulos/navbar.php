<?php $url_base = constant('URL_BASE'); ?>
<nav class="navbar">
    <div class="navbar-container">
        <a href="<?php echo $url_base; ?>paginas/inicio" class="navbar-brand">
            <img src="<?php echo $url_base; ?>recursos/img/logo_navbar.png" alt="Logo Orienta tu FUTURO" class="navbar-logo-img">
            <div class="brand-text-container">
                <span class="brand-title">Orienta tu <span class="brand-title-accent">FUTURO</span></span>
                <span class="brand-motto">Informar para decidir</span>
            </div>
        </a>
        
        <ul class="navbar-menu">
            <li class="navbar-item dropdown">
                <a href="<?php echo $url_base; ?>universidades/inicio" class="dropdown-toggle">
                    <i class="fa-solid fa-building-columns"></i> Universidades <i class="fa-solid fa-chevron-down" style="font-size: 0.75em; margin-left: 5px;"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo $url_base; ?>universidades/inicio"><i class="fa-solid fa-building-columns"></i> Ver Universidades</a></li>
                    <li><a href="<?php echo $url_base; ?>programas/inicio"><i class="fa-solid fa-book-open"></i> Programas Académicos</a></li>
                    <li><a href="<?php echo $url_base; ?>becas/inicio"><i class="fa-solid fa-award"></i> Becas y Apoyos</a></li>
                </ul>
            </li>
            <li class="navbar-item dropdown">
                <a href="#" class="dropdown-toggle">
                    <i class="fa-solid fa-clipboard-question"></i> Evaluaciones <i class="fa-solid fa-chevron-down" style="font-size: 0.75em; margin-left: 5px;"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo $url_base; ?>cuestionarios/inicio"><i class="fa-solid fa-clipboard-question"></i> Test Vocacional</a></li>
                    <li><a href="<?php echo $url_base; ?>simulacros/inicio"><i class="fa-solid fa-pencil"></i> Pre-ICFES</a></li>
                </ul>
            </li>
            <li class="navbar-item"><a href="<?php echo $url_base; ?>paginas/nosotros"><i class="fa-solid fa-people-group"></i> Nosotros</a></li>
        </ul>

        <div class="navbar-auth">
            <!-- Botón Alternador de Modo Oscuro -->
            <button id="theme-toggle" class="theme-toggle-btn" title="Cambiar tema claro/oscuro" aria-label="Cambiar tema">
                <i class="fa-solid fa-moon"></i>
            </button>

            <?php if (isset($_SESSION['usuario'])): ?>
                <?php
                $avatares = ['av1'=>'👤','av2'=>'🎓','av3'=>'🚀','av4'=>'🌟','av5'=>'💡','av6'=>'🔬','av7'=>'🎨','av8'=>'⚙️'];
                $avatar_actual = $_SESSION['usuario']['avatar'] ?? 'av1';
                $emoji = $avatares[$avatar_actual] ?? '👤';
                ?>
                <span style="font-size: 0.9rem; color: var(--text-secondary); margin-right: 10px; display: inline-flex; align-items: center; gap: 5px;">
                    <span style="font-size: 1.2rem;"><?php echo $emoji; ?></span> Hola, <strong><?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?></strong>
                </span>
                <a href="<?php echo $url_base; ?>usuarios/dashboard" class="btn btn-secondary" style="padding: 6px 14px; font-size: 0.85rem;">
                    <i class="fa-solid fa-gauge"></i> Mi Panel
                </a>
                <?php if (isset($_SESSION['usuario']['rol']) && $_SESSION['usuario']['rol'] === 'admin'): ?>
                <a href="<?php echo $url_base; ?>admin/dashboard" class="btn btn-primary" style="padding: 6px 14px; font-size: 0.85rem; background-color: var(--brand-dark);">
                    <i class="fa-solid fa-screwdriver-wrench"></i> Admin
                </a>
                <?php endif; ?>
                <a href="<?php echo $url_base; ?>usuarios/logout" class="btn btn-outline" style="padding: 6px 14px; font-size: 0.85rem; border-color: var(--danger); color: var(--danger);">
                    <i class="fa-solid fa-right-from-bracket"></i> Salir
                </a>
            <?php else: ?>
                <a href="<?php echo $url_base; ?>usuarios/login" class="btn btn-outline" style="padding: 8px 18px; font-size: 0.9rem;">
                    <i class="fa-solid fa-right-to-bracket"></i> Ingresar
                </a>
                <a href="<?php echo $url_base; ?>usuarios/registro" class="btn btn-primary" style="padding: 8px 18px; font-size: 0.9rem;">
                    <i class="fa-solid fa-user-plus"></i> Registrarse
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>
