<!-- Proceso en 3 Pasos -->
<section class="py-16 px-6 max-w-7xl mx-auto">
    <div class="text-center max-w-2xl mx-auto mb-12">
        <span class="badge badge-primary">Metodología</span>
        <h2 class="text-3xl font-heading font-extrabold mt-3 mb-3" style="color: var(--text-primary);">Tu camino en 3 pasos</h2>
        <p style="color: var(--text-secondary); font-size: 0.95rem;">Diagnóstico, comparación y financiación en un solo flujo.</p>
    </div>
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;">
        <div class="card" style="padding: 24px;">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: var(--primary); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 800; margin-bottom: 14px;">01</div>
            <h3 style="font-size: 1.1rem; margin-bottom: 8px;">Diagnóstico</h3>
            <p style="font-size: 0.88rem; color: var(--text-secondary); margin-bottom: 14px;">Test vocacional RIASEC para mapear tus fortalezas.</p>
            <a href="<?php echo $url_base; ?>cuestionarios/inicio" class="btn btn-secondary" style="padding: 8px 14px; font-size: 0.82rem;">Hacer test</a>
        </div>
        <div class="card" style="padding: 24px; border-color: var(--accent);">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: var(--accent); color: #0a0a0a; display: flex; align-items: center; justify-content: center; font-weight: 800; margin-bottom: 14px;">02</div>
            <h3 style="font-size: 1.1rem; margin-bottom: 8px;">Comparar</h3>
            <p style="font-size: 0.88rem; color: var(--text-secondary); margin-bottom: 14px;">Universidades, costos, jornadas y planes de estudio.</p>
            <a href="<?php echo $url_base; ?>universidades/inicio" class="btn btn-accent" style="padding: 8px 14px; font-size: 0.82rem;">Directorio</a>
        </div>
        <div class="card" style="padding: 24px;">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: var(--black); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 800; margin-bottom: 14px;">03</div>
            <h3 style="font-size: 1.1rem; margin-bottom: 8px;">Becas</h3>
            <p style="font-size: 0.88rem; color: var(--text-secondary); margin-bottom: 14px;">Oportunidades de financiación alineadas a tu perfil.</p>
            <a href="<?php echo $url_base; ?>becas/inicio" class="btn btn-secondary" style="padding: 8px 14px; font-size: 0.82rem;">Ver becas</a>
        </div>
    </div>
</section>

<style>
@media (max-width: 800px) {
  section .card { }
  section div[style*="grid-template-columns: repeat(3"] { grid-template-columns: 1fr !important; }
}
</style>
