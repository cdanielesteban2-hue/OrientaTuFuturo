<?php
/** @var array $cuestionario */
$url_base = defined('URL_BASE') ? constant('URL_BASE') : '';
?>
<div class="voc-page">
    <div class="voc-badge">
        <i class="fa-solid fa-graduation-cap" style="color:#eab308;"></i>
        Orientación Vocacional · Modelo John Holland (RIASEC)
    </div>

    <h1>Descubre tu vocación y proyecta tus <span class="accent">sueños profesionales</span></h1>

    <p class="voc-lead">
        Un test gratuito, rápido y validado psicométricamente para estudiantes de grados 10° y 11°.
        Conoce en qué áreas del conocimiento florecerás, compara opciones de pregrado en Colombia
        y reduce el riesgo de deserción antes de matricularte.
    </p>

    <div class="voc-actions">
        <a href="<?php echo $url_base; ?>cuestionarios/resolver?id=<?php echo $cuestionario['id_cuestionario'] ?? 2; ?>" class="btn btn-accent">
            Iniciar Test Vocacional Ahora <i class="fa-solid fa-arrow-right"></i>
        </a>
        <button type="button" onclick="abrirModalEtica()" class="btn btn-outline">
            <i class="fa-solid fa-scale-balanced" style="color:#eab308;"></i>
            Fuentes, Ética y Metodología
        </button>
    </div>

    <div class="voc-card">
        <div style="display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:10px; margin-bottom:8px;">
            <div>
                <span class="badge badge-primary">Estructura de la evaluación</span>
                <h3 style="margin:8px 0 0; font-family:'Roboto Slab',Georgia,serif;">¿Qué aspectos evalúa este test?</h3>
            </div>
            <span class="badge badge-accent"><i class="fa-solid fa-bolt"></i> 100% Gratuito</span>
        </div>
        <div class="voc-dims">
            <div class="voc-dim">
                <h4>1. Intereses Reales</h4>
                <p>Lo que te apasiona hacer de forma espontánea y despierta tu curiosidad.</p>
            </div>
            <div class="voc-dim">
                <h4>2. Habilidades Clave</h4>
                <p>Tus aptitudes cognitivas, manuales, analíticas y de liderazgo.</p>
            </div>
            <div class="voc-dim">
                <h4>3. Hábitos de Estudio</h4>
                <p>Cómo resuelves problemas y asimilas conocimientos en la práctica.</p>
            </div>
            <div class="voc-dim">
                <h4>4. Sueños y Estilo</h4>
                <p>El entorno laboral y el impacto con el que deseas trascender.</p>
            </div>
        </div>
    </div>

    <div class="voc-card" style="border-left: 3px solid #eab308;">
        <p style="margin:0; font-size:0.88rem; color:var(--text-secondary, #94a3b8); line-height:1.55;">
            <strong style="color:#eab308;">Reconocimiento institucional:</strong>
            Este test se inspira en el Test Vocacional de Filadd (modelo John Holland),
            el de la Universidad de Santander (UDES) y el de la Universidad de Medellín (UVirtualAbierta).
        </p>
    </div>
</div>

<div id="modalEtica" style="display:none; position:fixed; inset:0; z-index:50; align-items:center; justify-content:center; padding:16px; background:rgba(15,23,42,0.8);">
    <div class="voc-card" style="max-width:560px; width:100%; max-height:90vh; overflow-y:auto; position:relative;">
        <button type="button" onclick="cerrarModalEtica()" style="position:absolute; top:12px; right:12px; width:32px; height:32px; border:none; border-radius:4px; background:rgba(148,163,184,0.2); color:inherit; cursor:pointer;">✕</button>
        <h3 style="margin:0 0 12px; font-family:'Roboto Slab',Georgia,serif;">Fuentes y reconocimientos</h3>
        <p style="font-size:0.9rem; color:#94a3b8; line-height:1.55; margin-bottom:14px;">
            Este test de orientación vocacional se inspira y toma como referencia el Test Vocacional de Filadd (basado en el modelo de John Holland), el Test de Orientación Vocacional de la Universidad de Santander (UDES) y el de la Universidad de Medellín (UVirtualAbierta).
        </p>
        <p style="font-size:0.85rem; color:#eab308; margin-bottom:16px;">
            ⚠ Es una herramienta de orientación y no reemplaza asesoría profesional personalizada.
        </p>
        <button type="button" onclick="cerrarModalEtica()" class="btn btn-accent" style="width:100%;">Entendido</button>
    </div>
</div>
<script>
function abrirModalEtica(){ var m=document.getElementById('modalEtica'); if(m){ m.style.display='flex'; } }
function cerrarModalEtica(){ var m=document.getElementById('modalEtica'); if(m){ m.style.display='none'; } }
document.addEventListener('keydown', function(e){ if(e.key==='Escape') cerrarModalEtica(); });
</script>
