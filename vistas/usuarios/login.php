<?php $url_base = constant('URL_BASE'); ?>
<div class="auth-wrapper">
    <div class="card-premium auth-card">
        <div class="auth-header">
            <div style="font-size: 2.5rem; color: var(--primary); margin-bottom: 10px;">
                <i class="fa-solid fa-right-to-bracket"></i>
            </div>
            <h2>Bienvenido de Nuevo</h2>
            <p style="color: var(--text-secondary); font-size: 0.9rem;">Ingresa tus credenciales para acceder a tu panel vocacional.</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert-error">
                <i class="fa-solid fa-circle-exclamation"></i> <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo $url_base; ?>usuarios/login">
            <div class="form-group">
                <label class="form-label" for="correo"><i class="fa-solid fa-envelope"></i> Correo Electrónico</label>
                <input class="form-input" type="email" id="correo" name="correo" placeholder="ejemplo@correo.com" required value="<?php echo isset($_POST['correo']) ? htmlspecialchars($_POST['correo']) : ''; ?>">
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
                <label class="form-label" for="password"><i class="fa-solid fa-lock"></i> Contraseña</label>
                <input class="form-input" type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px;">
                <i class="fa-solid fa-arrow-right-to-bracket"></i> Iniciar Sesión
            </button>
        </form>

        <div style="text-align: center; margin-top: 25px; font-size: 0.9rem; color: var(--text-secondary);">
            ¿Aún no tienes una cuenta? <a href="<?php echo $url_base; ?>usuarios/registro" style="font-weight: 700;">Regístrate aquí</a>
        </div>
    </div>
</div>
