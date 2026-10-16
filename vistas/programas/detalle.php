<?php
/** @var array $programa */
$url_base = defined('URL_BASE') ? constant('URL_BASE') : '';
$sitio = !empty($programa['sitio_web']) ? $programa['sitio_web'] : '';
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
                <span style="color: var(--text-secondary); display: block; font-size: 0.78rem; font-weight: 600; text-transform: uppercase; margin-bottom: 2px;">Matrícula / Precios</span>
                <?php if ($sitio): ?>
                <a href="<?php echo htmlspecialchars($sitio); ?>" target="_blank" rel="noopener" class="btn btn-outline" style="margin-top:6px; padding:8px 14px; font-size:0.85rem;">
                    <i class="fa-solid fa-coins"></i> Consultar precios
                </a>
                <?php else: ?>
                <strong style="font-size: 1rem; color: var(--text-secondary);">Ver en la universidad</strong>
                <?php endif; ?>
            </div>
            <div>
                <span style="color: var(--text-secondary); display: block; font-size: 0.78rem; font-weight: 600; text-transform: uppercase; margin-bottom: 2px;">Ubicación del Campus</span>
                <strong style="font-size: 1.15rem;"><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($programa['universidad_ciudad']); ?></strong>
            </div>
        </div>
    </div>

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
            <?php if ($sitio): ?>
            <a href="<?php echo htmlspecialchars($sitio); ?>" target="_blank" rel="noopener" class="btn btn-outline">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> Portal Web del Campus
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>
