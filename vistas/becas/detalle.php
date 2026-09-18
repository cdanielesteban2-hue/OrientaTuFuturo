<?php $url_base = constant('URL_BASE'); ?>
<div style="max-width: 750px; margin: 0 auto;">
    <a href="<?php echo $url_base; ?>becas/inicio" style="font-weight: 700; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 5px; margin-bottom: 20px;">
        <i class="fa-solid fa-arrow-left"></i> Regresar al Listado de Becas
    </a>

    <div class="card-premium" style="margin-bottom: 30px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 15px; margin-bottom: 20px;">
            <div>
                <span class="badge badge-accent" style="margin-bottom: 8px;"><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($beca['campus']); ?></span>
                <h1 style="font-size: 2.2rem; line-height: 1.2; color: var(--text-primary);"><?php echo htmlspecialchars($beca['nombre_beca']); ?></h1>
            </div>
            
            <a href="<?php echo $url_base; ?>usuarios/guardarBeca?id=<?php echo $beca['id_becas']; ?>" class="btn btn-primary" style="background: linear-gradient(135deg, #f43f5e 0%, #be123c 100%); box-shadow: 0 4px 14px rgb(244 63 94 / 0.3);">
                <i class="fa-solid fa-heart"></i> Guardar en Favoritas
            </a>
        </div>

        <div style="background-color: #fef2f2; border: 1px solid #fecaca; border-radius: var(--radius-md); padding: 15px 20px; display: flex; align-items: center; gap: 12px; margin-top: 25px; color: var(--danger);">
            <div style="font-size: 1.5rem;"><i class="fa-solid fa-hourglass-half"></i></div>
            <div>
                <strong style="display: block; font-size: 0.95rem;">Fecha de Cierre de Inscripción</strong>
                <span style="font-size: 0.88rem; font-weight: 600;">Las postulaciones se recibirán únicamente hasta el <?php echo date("d/m/Y", strtotime($beca['fecha_limite'])); ?>.</span>
            </div>
        </div>
    </div>

    <!-- Requirements details -->
    <div class="card" style="margin-bottom: 30px;">
        <h3 style="font-size: 1.25rem; margin-bottom: 20px; color: var(--primary); border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
            <i class="fa-solid fa-list-check"></i> Requisitos de Postulación
        </h3>
        
        <div style="line-height: 1.7; color: var(--text-secondary); font-size: 1rem; white-space: pre-line; background-color: var(--bg-main); padding: 20px; border-radius: var(--radius-md);">
            <?php echo htmlspecialchars($beca['requisitos']); ?>
        </div>

        <div style="margin-top: 30px; text-align: center;">
            <p style="font-size: 0.9rem; color: var(--text-secondary); margin-bottom: 15px;">
                <i class="fa-solid fa-circle-info"></i> Serás redirigido al portal externo oficial del administrador de la beca para radicar tus documentos.
            </p>
            <a href="<?php echo htmlspecialchars($beca['enlace']); ?>" target="_blank" class="btn btn-accent btn-lg" style="width: 100%; max-width: 400px;">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> Postularse en el Sitio Oficial <i class="fa-solid fa-external-link" style="font-size: 0.8rem; margin-left: 3px;"></i>
            </a>
        </div>
    </div>
</div>
