<?php $url_base = constant('URL_BASE'); ?>
<div style="max-width: 500px; margin: 80px auto; text-align: center; padding: 20px;">
    <div style="font-size: 6rem; color: var(--primary); margin-bottom: 20px; animation: wobble 2s ease infinite;">
        <i class="fa-solid fa-compass-drafting"></i>
    </div>
    <h1 style="font-size: 3rem; margin-bottom: 10px; color: var(--text-primary);">404</h1>
    <h2 style="font-size: 1.5rem; margin-bottom: 15px; color: var(--text-secondary);">¿Te has desviado del camino?</h2>
    <p style="color: var(--text-secondary); margin-bottom: 30px;">
        La página o sección que buscas no existe o ha sido movida. ¡Pero no te preocupes! Encontrar tu carrera ideal a veces toma varios intentos. Retomemos el rumbo juntos.
    </p>
    <div style="display: flex; gap: 15px; justify-content: center;">
        <a href="<?php echo $url_base; ?>paginas/inicio" class="btn btn-primary">
            <i class="fa-solid fa-house"></i> Ir al Inicio
        </a>
        <a href="<?php echo $_SERVER['HTTP_REFERER'] ?? $url_base; ?>" class="btn btn-outline">
            <i class="fa-solid fa-arrow-left"></i> Regresar
        </a>
    </div>
</div>

<style>
@keyframes wobble {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(-8deg); }
    75% { transform: rotate(8deg); }
}
</style>
