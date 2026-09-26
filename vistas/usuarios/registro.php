<?php $url_base = constant('URL_BASE'); ?>
<div class="auth-wrapper">
    <div class="card-premium auth-card">
        <div class="auth-header">
            <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 10px;">
                <i class="fa-solid fa-user-plus"></i>
            </div>
            <h2>Comienza tu Camino</h2>
            <p style="color: var(--text-secondary); font-size: 0.9rem;">Crea tu perfil y desbloquea el test vocacional y favoritos.</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert-error">
                <i class="fa-solid fa-circle-exclamation"></i> <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo $url_base; ?>usuarios/registro">
            <div class="form-group">
                <label class="form-label" for="nombre"><i class="fa-solid fa-user"></i> Nombre Completo</label>
                <input class="form-input" type="text" id="nombre" name="nombre" placeholder="Juan Pérez" required value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
            </div>

            <div class="form-group">
                <label class="form-label" for="correo"><i class="fa-solid fa-envelope"></i> Correo Electrónico</label>
                <input class="form-input" type="email" id="correo" name="correo" placeholder="juan@correo.com" required value="<?php echo isset($_POST['correo']) ? htmlspecialchars($_POST['correo']) : ''; ?>">
            </div>

            <div class="form-group">
                <label class="form-label" for="password"><i class="fa-solid fa-lock"></i> Contraseña</label>
                <div style="position: relative; display: flex; align-items: center;">
                    <input class="form-input" type="password" id="password" name="password" placeholder="Mínimo 6 caracteres" required style="width: 100%; padding-right: 44px;">
                    <button type="button" onclick="togglePasswordVisibility('password', this)" style="position: absolute; right: 12px; background: none; border: none; cursor: pointer; color: var(--text-secondary); font-size: 1.05rem; padding: 6px; display: flex; align-items: center; justify-content: center; transition: var(--transition);" title="Mostrar u ocultar contraseña" aria-label="Mostrar u ocultar contraseña">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
                <label class="form-label" for="ciudad"><i class="fa-solid fa-location-dot"></i> Ciudad de Residencia</label>
                <select class="form-input" id="ciudad" name="ciudad" required>
                    <option value="" disabled selected>Selecciona tu ciudad</option>
                    <option value="Bogotá" <?php echo (isset($_POST['ciudad']) && $_POST['ciudad'] == 'Bogotá') ? 'selected' : ''; ?>>Bogotá</option>
                    <option value="Medellín" <?php echo (isset($_POST['ciudad']) && $_POST['ciudad'] == 'Medellín') ? 'selected' : ''; ?>>Medellín</option>
                    <option value="Cali" <?php echo (isset($_POST['ciudad']) && $_POST['ciudad'] == 'Cali') ? 'selected' : ''; ?>>Cali</option>
                    <option value="Barranquilla" <?php echo (isset($_POST['ciudad']) && $_POST['ciudad'] == 'Barranquilla') ? 'selected' : ''; ?>>Barranquilla</option>
                    <option value="Bucaramanga" <?php echo (isset($_POST['ciudad']) && $_POST['ciudad'] == 'Bucaramanga') ? 'selected' : ''; ?>>Bucaramanga</option>
                    <option value="Otra" <?php echo (isset($_POST['ciudad']) && $_POST['ciudad'] == 'Otra') ? 'selected' : ''; ?>>Otra</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 25px; display: flex; align-items: flex-start; gap: 10px;">
                <input type="checkbox" id="terminos" name="terminos" required style="margin-top: 5px; width: 18px; height: 18px; cursor: pointer;">
                <label for="terminos" style="font-size: 0.9rem; color: var(--text-secondary); cursor: pointer; line-height: 1.5;">
                    He leído y acepto los <a href="<?php echo $url_base; ?>paginas/terminos" target="_blank" style="color: var(--primary); font-weight: 600; text-decoration: underline;">Términos y Condiciones de Uso</a> y autorizo el tratamiento de mis datos personales.
                </label>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-weight: 700; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35); border: none; color: white;">
                <i class="fa-solid fa-rocket"></i> Registrarme y Empezar
            </button>
        </form>

        <div style="text-align: center; margin-top: 25px; font-size: 0.9rem; color: var(--text-secondary);">
            ¿Ya tienes una cuenta? <a href="<?php echo $url_base; ?>usuarios/login" style="font-weight: 700;">Ingresa aquí</a>
        </div>
    </div>
</div>

<script>
function togglePasswordVisibility(inputId, button) {
    const input = document.getElementById(inputId);
    const icon = button.querySelector('i');
    if (!input || !icon) return;
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'fa-solid fa-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'fa-solid fa-eye';
    }
}
</script>
