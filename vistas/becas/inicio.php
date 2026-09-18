<?php $url_base = constant('URL_BASE'); ?>
<div style="margin-bottom: 30px;">
    <span class="badge badge-primary"><i class="fa-solid fa-award"></i> Apoyo Financiero</span>
    <h1 style="font-size: 2.5rem; margin-top: 5px;">Becas y Convenios Vigentes</h1>
    <p style="color: var(--text-secondary);">Consulta e investiga becas gubernamentales, créditos condonables y convenios de descuento directo de universidades.</p>
</div>

<?php if (count($becas) === 0): ?>
    <div class="card" style="text-align: center; padding: 60px 20px; max-width: 600px; margin: 40px auto;">
        <div style="font-size: 3rem; color: var(--text-secondary); margin-bottom: 15px;">
            <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <h3>No hay becas publicadas en este momento</h3>
        <p style="color: var(--text-secondary); margin-top: 8px;">Por favor regresa más tarde para consultar nuevas oportunidades de apoyo.</p>
    </div>
<?php else: ?>
    <div class="grid-cards">
        <?php foreach ($becas as $beca): ?>
            <div class="card" style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <span class="badge badge-accent">
                            <i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($beca['campus']); ?>
                        </span>
                        
                        <!-- Colorear límite si está próximo -->
                        <span style="font-size: 0.8rem; color: var(--danger); font-weight: 700;">
                            <i class="fa-solid fa-calendar-day"></i> Límite: <?php echo date("d/m/Y", strtotime($beca['fecha_limite'])); ?>
                        </span>
                    </div>
                    
                    <h3 style="font-size: 1.25rem; margin-bottom: 10px; color: var(--text-primary);"><?php echo htmlspecialchars($beca['nombre_beca']); ?></h3>
                    
                    <p style="font-size: 0.88rem; color: var(--text-secondary); margin-bottom: 15px; font-weight: 600;">Requisitos:</p>
                    <p style="font-size: 0.85rem; color: var(--text-secondary); margin-bottom: 20px; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                        <?php echo htmlspecialchars($beca['requisitos']); ?>
                    </p>
                </div>
                
                <div style="border-top: 1px solid var(--border-color); padding-top: 15px; display: flex; align-items: center; justify-content: space-between; margin-top: 10px;">
                    <a href="<?php echo htmlspecialchars($beca['enlace']); ?>" target="_blank" style="font-size: 0.85rem; font-weight: 700; color: var(--primary);">
                        Portal Beca <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.75rem;"></i>
                    </a>
                    
                    <div style="display: flex; gap: 8px;">
                        <a href="<?php echo $url_base; ?>usuarios/guardarBeca?id=<?php echo $beca['id_becas']; ?>" class="btn btn-outline" style="padding: 6px 10px; border-color: #f43f5e; color: #f43f5e;">
                            <i class="fa-solid fa-heart"></i>
                        </a>
                        <a href="<?php echo $url_base; ?>becas/detalle?id=<?php echo $beca['id_becas']; ?>" class="btn btn-secondary" style="padding: 6px 14px; font-size: 0.85rem;">
                            Detalles
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
