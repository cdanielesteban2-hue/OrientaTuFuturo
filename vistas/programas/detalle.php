<?php
/** @var array $programa */
$url_base = defined('URL_BASE') ? constant('URL_BASE') : '';
?>
<div style="max-width: 800px; margin: 0 auto;">
    <a href="<?php echo $url_base; ?>programas/inicio" style="font-weight: 700; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 5px; margin-bottom: 20px;">
        <i class="fa-solid fa-arrow-left"></i> Regresar al Explorador de Carreras
    </a>

    <div class="card-premium" style="margin-bottom: 30px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 15px; margin-bottom: 20px;">
            <div>
                <span class="badge badge-primary" style="margin-bottom: 8px;"><?php echo htmlspecialchars($programa['area']); ?></span>
                <h1 style="font-size: 2.2rem; line-height: 1.2; color: var(--text-primary);"><?php echo htmlspecialchars($programa['n_programa']); ?></h1>
                <p style="font-size: 1.05rem; color: var(--text-secondary); margin-top: 5px;">
                    Ofrecido por: <a href="<?php echo $url_base; ?>universidades/detalle?id=<?php echo $programa['id_universidad']; ?>" style="font-weight: 700; text-decoration: underline;">
                        <?php echo htmlspecialchars($programa['universidad_nombre']); ?>
                    </a>
                </p>
            </div>
            
            <a href="<?php echo $url_base; ?>usuarios/guardarPrograma?id=<?php echo $programa['id_programa']; ?>" class="btn btn-primary" style="background: linear-gradient(135deg, #f43f5e 0%, #be123c 100%); box-shadow: 0 4px 14px rgb(244 63 94 / 0.3);">
                <i class="fa-solid fa-heart"></i> Guardar en Favoritos
            </a>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; background-color: var(--bg-main); padding: 20px; border-radius: var(--radius-md); margin-top: 25px;">
            <div>
                <span style="color: var(--text-secondary); display: block; font-size: 0.78rem; font-weight: 600; text-transform: uppercase; margin-bottom: 2px;">Duración de la Carrera</span>
                <strong style="font-size: 1.15rem;"><i class="fa-solid fa-hourglass-half"></i> <?php echo htmlspecialchars($programa['duracion']); ?> Semestres</strong>
            </div>
            <div>
                <span style="color: var(--text-secondary); display: block; font-size: 0.78rem; font-weight: 600; text-transform: uppercase; margin-bottom: 2px;">Matrícula por Semestre</span>
                <strong style="font-size: 1.15rem; color: var(--primary);">
                    <i class="fa-solid fa-coins"></i> <?php echo ($programa['costo'] == 0) ? 'Gratuito / Variable' : '$' . number_format($programa['costo'], 0, ',', '.'); ?>
                </strong>
            </div>
            <div>
                <span style="color: var(--text-secondary); display: block; font-size: 0.78rem; font-weight: 600; text-transform: uppercase; margin-bottom: 2px;">Ubicación del Campus</span>
                <strong style="font-size: 1.15rem;"><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($programa['universidad_ciudad']); ?></strong>
            </div>
        </div>
    </div>

    <!-- University profile summary -->
    <div class="card">
        <h3 style="font-size: 1.25rem; margin-bottom: 15px; color: var(--accent); border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
            <i class="fa-solid fa-building-columns"></i> Sobre la Institución Educativa
        </h3>
        <p style="color: var(--text-secondary); line-height: 1.6; font-size: 0.95rem; margin-bottom: 20px;">
            <?php echo htmlspecialchars($programa['universidad_descripcion']); ?>
        </p>
        
        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
            <a href="<?php echo $url_base; ?>universidades/detalle?id=<?php echo $programa['id_universidad']; ?>" class="btn btn-secondary">
                <i class="fa-solid fa-circle-info"></i> Ver Perfil Completo de la Universidad
            </a>
            <a href="<?php echo htmlspecialchars($programa['sitio_web']); ?>" target="_blank" class="btn btn-outline">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> Portal Web del Campus <i class="fa-solid fa-up-right-from-square" style="font-size: 0.75rem; margin-left: 3px;"></i>
            </a>
        </div>
    </div>

    <!-- Calculadora de ROI -->
    <?php if ($programa['costo'] > 0): ?>
    <div class="card" style="margin-top: 20px; border-left: 6px solid var(--success);">
        <h3 style="font-size: 1.25rem; margin-bottom: 15px; color: var(--success); border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
            <i class="fa-solid fa-chart-line"></i> Calculadora Financiera de Retorno de Inversión (ROI)
        </h3>
        <p style="color: var(--text-secondary); font-size: 0.95rem; margin-bottom: 20px;">Estima el tiempo aproximado en el que recuperarás la inversión total de esta carrera, basándonos en salarios promedio del mercado para tu área de estudio.</p>
        
        <div style="background-color: var(--bg-main); padding: 20px; border-radius: 8px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 20px;">
            <div>
                <small style="color: var(--text-secondary); font-weight: 600; display: block; margin-bottom: 5px;">INVERSIÓN TOTAL ESTIMADA</small>
                <div style="font-size: 1.5rem; font-weight: 800; color: var(--text-primary);">$<span id="roi-inversion">0</span></div>
            </div>
            <div>
                <small style="color: var(--text-secondary); font-weight: 600; display: block; margin-bottom: 5px;">SALARIO PROMEDIO (ÁREA)</small>
                <div style="font-size: 1.5rem; font-weight: 800; color: var(--text-primary);">$<span id="roi-salario">0</span> <span style="font-size: 0.9rem; font-weight: 400;">/ mes</span></div>
            </div>
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display: flex; justify-content: space-between; font-weight: 600; color: var(--text-primary); margin-bottom: 15px; font-size: 0.95rem;">
                Porcentaje de tu salario futuro destinado a recuperar la inversión: <span id="roi-porcentaje-label" style="color: var(--primary); font-size: 1.1rem;">20%</span>
            </label>
            <input type="range" id="roi-slider" min="5" max="50" step="5" value="20" style="width: 100%; cursor: pointer; accent-color: var(--primary);" oninput="calcularROI()">
        </div>

        <div style="text-align: center; background-color: rgba(16, 185, 129, 0.1); padding: 25px; border-radius: 8px;">
            <h4 style="color: var(--success); margin-bottom: 10px; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px;">Tiempo Estimado de Recuperación</h4>
            <div style="font-size: 2.8rem; font-weight: 800; color: var(--success); line-height: 1;"><span id="roi-anos">0</span> <span style="font-size: 1.2rem; font-weight: 600;">años y</span> <span id="roi-meses">0</span> <span style="font-size: 1.2rem; font-weight: 600;">meses</span></div>
        </div>
    </div>
    
    <script>
    const salariosPromedio = {
        'Ingeniería y Tecnología': 3500000,
        'Ciencias de la Salud': 3000000,
        'Ciencias Sociales y Humanidades': 2500000,
        'Artes y Diseño': 2000000
    };
    
    const costoSemestre = <?php echo $programa['costo']; ?>;
    const duracion = <?php echo $programa['duracion']; ?>;
    const area = "<?php echo htmlspecialchars($programa['area']); ?>";
    
    function calcularROI() {
        const inversion = costoSemestre * duracion;
        const salario = salariosPromedio[area] || 2500000;
        
        document.getElementById('roi-inversion').textContent = new Intl.NumberFormat('es-CO').format(inversion);
        document.getElementById('roi-salario').textContent = new Intl.NumberFormat('es-CO').format(salario);
        
        const porcentaje = document.getElementById('roi-slider').value;
        document.getElementById('roi-porcentaje-label').textContent = porcentaje + '%';
        
        const aporteMensual = salario * (porcentaje / 100);
        const mesesTotales = inversion / aporteMensual;
        
        const anos = Math.floor(mesesTotales / 12);
        const meses = Math.ceil(mesesTotales % 12);
        
        document.getElementById('roi-anos').textContent = anos;
        document.getElementById('roi-meses').textContent = meses;
    }
    
    document.addEventListener('DOMContentLoaded', calcularROI);
    </script>
    <?php else: ?>
    <div class="card" style="margin-top: 20px; border-left: 6px solid var(--success); background-color: rgba(16, 185, 129, 0.05);">
        <h3 style="font-size: 1.25rem; margin-bottom: 10px; color: var(--success);">
            <i class="fa-solid fa-check-circle"></i> Educación Pública (Gratuita)
        </h3>
        <p style="color: var(--text-primary); margin: 0;">Al ser un programa sin costo semestral matriculado, el retorno de inversión es inmediato tras graduarte.</p>
    </div>
    <?php endif; ?>
</div>
