<?php $url_base = constant('URL_BASE'); ?>
<div class="page-head">
    <div>
        <span class="badge badge-primary"><i class="fa-solid fa-award"></i> Apoyo Financiero</span>
        <h1 class="page-title">Becas y Convenios</h1>
        <p class="page-sub">Becas, créditos y convenios vigentes para financiar tu carrera.</p>
    </div>
</div>

<?php if (count($becas) === 0): ?>
    <div class="card" style="text-align:center; padding:48px 20px; max-width:560px; margin:32px auto;">
        <h3>No hay becas publicadas</h3>
        <p style="color:var(--text-secondary); margin-top:6px;">Vuelve pronto para nuevas oportunidades.</p>
    </div>
<?php else: ?>
    <div class="becas-grid">
        <?php foreach ($becas as $beca): ?>
            <article class="beca-card">
                <span class="badge badge-accent"><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($beca['campus']); ?></span>
                <h3><?php echo htmlspecialchars($beca['nombre_beca']); ?></h3>
                <p class="beca-desc"><?php echo htmlspecialchars($beca['requisitos']); ?></p>
                <div class="beca-actions">
                    <a href="<?php echo $url_base; ?>usuarios/guardarBeca?id=<?php echo $beca['id_becas']; ?>" class="btn btn-outline" style="padding:7px 10px; border-color:#f43f5e; color:#f43f5e;" title="Guardar">
                        <i class="fa-solid fa-heart"></i>
                    </a>
                    <a href="<?php echo htmlspecialchars($beca['enlace']); ?>" target="_blank" class="btn btn-outline" style="padding:7px 12px; font-size:0.8rem;">Portal</a>
                    <a href="<?php echo $url_base; ?>becas/detalle?id=<?php echo $beca['id_becas']; ?>" class="btn btn-accent" style="padding:8px 14px; font-size:0.82rem;">Detalles</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
