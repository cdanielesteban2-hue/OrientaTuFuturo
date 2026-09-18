<?php $url_base = constant('URL_BASE'); ?>
<div style="margin-bottom: 30px;">
    <a href="<?php echo $url_base; ?>usuarios/dashboard" style="font-weight: 700; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 5px; margin-bottom: 15px;">
        <i class="fa-solid fa-arrow-left"></i> Regresar a mi Panel
    </a>
    
    <span class="badge badge-accent"><i class="fa-solid fa-code-compare"></i> Comparador Académico</span>
    <h1 style="font-size: 2.5rem; margin-top: 5px;">Comparación de Programas</h1>
    <p style="color: var(--text-secondary);">Compara los detalles clave de las carreras de tu interés para ayudarte a tomar la mejor decisión académica.</p>
</div>

<div class="card" style="padding: 20px; overflow-x: auto;">
    <table style="width: 100%; border-collapse: collapse; min-width: 600px; text-align: left; vertical-align: top;">
        <thead>
            <tr style="border-bottom: 2px solid var(--border-color); background-color: var(--bg-main);">
                <th style="padding: 15px; width: 20%; color: var(--text-secondary); font-weight: 700;">Características</th>
                <?php foreach ($programas_comparar as $index => $prog): ?>
                    <th style="padding: 15px; width: <?php echo 80 / count($programas_comparar); ?>%; text-align: center; border-left: 1px solid var(--border-color);">
                        <span class="badge badge-primary" style="font-size: 0.72rem; margin-bottom: 8px;"><?php echo htmlspecialchars($prog['area']); ?></span>
                        <h3 style="font-size: 1.25rem; color: var(--text-primary); margin: 0 0 5px 0;"><?php echo htmlspecialchars($prog['n_programa']); ?></h3>
                        <p style="font-size: 0.88rem; color: var(--primary); font-weight: 600; margin: 0 0 15px 0;">
                            <i class="fa-solid fa-building-columns"></i> <?php echo htmlspecialchars($prog['universidad_nombre']); ?>
                        </p>
                        
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            <a href="<?php echo $url_base; ?>programas/detalle?id=<?php echo $prog['id_programa']; ?>" class="btn btn-secondary" style="padding: 5px 12px; font-size: 0.8rem;">
                                <i class="fa-solid fa-eye"></i> Detalle
                            </a>
                            <a href="<?php echo $url_base; ?>usuarios/eliminarPrograma?id=<?php echo $prog['id_programa']; ?>" class="btn btn-outline" style="padding: 5px 10px; font-size: 0.8rem; border-color: var(--danger); color: var(--danger);" title="Eliminar de la comparación">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                    </th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <!-- Fila: Costo de Matrícula -->
            <tr style="border-bottom: 1px solid var(--border-color); background-color: #faf5ff;">
                <td style="padding: 18px 15px; font-weight: 700; color: #6b21a8;"><i class="fa-solid fa-coins"></i> Matrícula Semestral</td>
                <?php foreach ($programas_comparar as $prog): ?>
                    <td style="padding: 18px 15px; text-align: center; border-left: 1px solid var(--border-color); font-weight: 800; font-size: 1.15rem; color: var(--primary);">
                        <?php echo ($prog['costo'] == 0) ? 'Gratuito / Variable' : '$' . number_format($prog['costo'], 0, ',', '.'); ?>
                    </td>
                <?php endforeach; ?>
            </tr>

            <!-- Fila: Duración -->
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 18px 15px; font-weight: 700; color: var(--text-primary);"><i class="fa-solid fa-hourglass-half"></i> Duración</td>
                <?php foreach ($programas_comparar as $prog): ?>
                    <td style="padding: 18px 15px; text-align: center; border-left: 1px solid var(--border-color); font-weight: 600;">
                        <?php echo htmlspecialchars($prog['duracion']); ?> Semestres
                    </td>
                <?php endforeach; ?>
            </tr>

            <!-- Fila: Ubicación -->
            <tr style="border-bottom: 1px solid var(--border-color); background-color: var(--bg-main);">
                <td style="padding: 18px 15px; font-weight: 700; color: var(--text-primary);"><i class="fa-solid fa-location-dot"></i> Ciudad / Sede</td>
                <?php foreach ($programas_comparar as $prog): ?>
                    <td style="padding: 18px 15px; text-align: center; border-left: 1px solid var(--border-color); font-weight: 600;">
                        <?php echo htmlspecialchars($prog['universidad_ciudad']); ?>
                    </td>
                <?php endforeach; ?>
            </tr>

            <!-- Fila: Reseña de la Universidad -->
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 18px 15px; font-weight: 700; color: var(--text-primary);"><i class="fa-solid fa-circle-info"></i> Sobre el Campus</td>
                <?php foreach ($programas_comparar as $prog): ?>
                    <td style="padding: 18px 15px; border-left: 1px solid var(--border-color); font-size: 0.85rem; color: var(--text-secondary); text-align: justify; line-height: 1.6;">
                        <?php echo htmlspecialchars($prog['universidad_descripcion']); ?>
                    </td>
                <?php endforeach; ?>
            </tr>

            <!-- Fila: Sitio Web -->
            <tr>
                <td style="padding: 18px 15px; font-weight: 700; color: var(--text-primary);"><i class="fa-solid fa-earth-americas"></i> Sitio Web Oficial</td>
                <?php foreach ($programas_comparar as $prog): ?>
                    <td style="padding: 18px 15px; text-align: center; border-left: 1px solid var(--border-color);">
                        <a href="<?php echo htmlspecialchars($prog['sitio_web']); ?>" target="_blank" class="btn btn-outline" style="font-size: 0.82rem; padding: 6px 15px; display: inline-flex; align-items: center; gap: 4px;">
                            Portal del Campus <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.7rem;"></i>
                        </a>
                    </td>
                <?php endforeach; ?>
            </tr>
        </tbody>
    </table>
</div>
