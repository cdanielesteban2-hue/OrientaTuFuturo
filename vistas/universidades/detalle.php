<?php $url_base = constant('URL_BASE'); ?>
<!-- Recursos de Leaflet.js para el mapa interactivo -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<div style="margin-bottom: 30px;">
    <a href="<?php echo $url_base; ?>universidades/inicio" style="font-weight: 700; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 5px; margin-bottom: 15px;">
        <i class="fa-solid fa-arrow-left"></i> Regresar al Directorio
    </a>
    
    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 15px;">
        <div>
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                <span class="badge <?php echo ($universidad['tipo'] == 0) ? 'badge-primary' : 'badge-accent'; ?>">
                    <?php echo ($universidad['tipo'] == 0) ? 'Pública' : 'Privada'; ?>
                </span>
                <span style="font-size: 0.85rem; color: var(--text-secondary); font-weight: 600;">
                    <i class="fa-solid fa-location-dot" style="color: var(--primary);"></i> <?php echo htmlspecialchars($universidad['ciudad']); ?>
                </span>
            </div>
            <h1 style="font-size: 2.5rem; line-height: 1.2; color: var(--text-primary);"><?php echo htmlspecialchars($universidad['nombre']); ?></h1>
        </div>
        
        <a href="<?php echo htmlspecialchars($universidad['sitio_web']); ?>" target="_blank" class="btn btn-primary">
            <i class="fa-solid fa-earth-americas"></i> Visitar Sitio Web Oficial
        </a>
    </div>
</div>

<div class="dashboard-grid">
    <!-- Left: Detailed description and offered degrees list -->
    <div>
        <div class="card" style="margin-bottom: 30px;">
            <h3 style="font-size: 1.3rem; margin-bottom: 15px; color: var(--primary); border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
                <i class="fa-solid fa-circle-info"></i> Reseña Institucional
            </h3>
            <p style="color: var(--text-secondary); font-size: 1rem; line-height: 1.7; white-space: pre-line;">
                <?php echo htmlspecialchars($universidad['descripcion']); ?>
            </p>
        </div>

        <div class="card">
            <h3 style="font-size: 1.3rem; margin-bottom: 20px; color: var(--accent); display: flex; align-items: center; gap: 10px;">
                <i class="fa-solid fa-graduation-cap"></i> Programas Académicos Ofertados
            </h3>
            
            <?php if (count($programas) === 0): ?>
                <p style="color: var(--text-secondary); text-align: center; padding: 20px;">No se registraron carreras asociadas a esta institución en este momento.</p>
            <?php else: ?>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.92rem;">
                        <thead>
                            <tr style="border-bottom: 2px solid var(--border-color); color: var(--text-secondary); font-weight: 600;">
                                <th style="padding: 12px 10px;">Carrera / Programa</th>
                                <th style="padding: 12px 10px;">Área</th>
                                <th style="padding: 12px 10px; text-align: center;">Semestres</th>
                                <th style="padding: 12px 10px; text-align: right;">Costo Matrícula</th>
                                <th style="padding: 12px 10px; text-align: center;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($programas as $prog): ?>
                                <tr style="border-bottom: 1px solid var(--border-color); transition: var(--transition);" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='transparent'">
                                    <td style="padding: 14px 10px; font-weight: 700; color: var(--text-primary);">
                                        <?php echo htmlspecialchars($prog['n_programa']); ?>
                                    </td>
                                    <td style="padding: 14px 10px;">
                                        <span class="badge badge-primary" style="font-size: 0.72rem;"><?php echo htmlspecialchars($prog['area']); ?></span>
                                    </td>
                                    <td style="padding: 14px 10px; text-align: center; font-weight: 600;">
                                        <?php echo htmlspecialchars($prog['duracion']); ?>
                                    </td>
                                    <td style="padding: 14px 10px; text-align: right; font-weight: 700; color: var(--primary);">
                                        <?php echo ($prog['costo'] == 0) ? 'Gratuito / Variable' : '$' . number_format($prog['costo'], 0, ',', '.'); ?>
                                    </td>
                                    <td style="padding: 14px 10px; text-align: center;">
                                        <div style="display: flex; gap: 8px; justify-content: center;">
                                            <a href="<?php echo $url_base; ?>programas/detalle?id=<?php echo $prog['id_programa']; ?>" class="btn btn-secondary" style="padding: 4px 8px; font-size: 0.75rem;">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="<?php echo $url_base; ?>usuarios/guardarPrograma?id=<?php echo $prog['id_programa']; ?>" class="btn btn-outline" style="padding: 4px 8px; font-size: 0.75rem; border-color: #f43f5e; color: #f43f5e;">
                                                <i class="fa-solid fa-heart"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Right: Quick info box -->
    <div>
        <div class="card-premium" style="position: sticky; top: 100px;">
            <h3 style="font-size: 1.15rem; margin-bottom: 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
                <i class="fa-solid fa-list-check"></i> Ficha de Datos
            </h3>
            
            <div style="display: flex; flex-direction: column; gap: 18px; font-size: 0.9rem;">
                <div>
                    <span style="color: var(--text-secondary); display: block; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; margin-bottom: 2px;">Sede de Consulta</span>
                    <strong><i class="fa-solid fa-city"></i> <?php echo htmlspecialchars($universidad['ciudad']); ?></strong>
                </div>
                
                <div>
                    <span style="color: var(--text-secondary); display: block; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; margin-bottom: 2px;">Régimen Administrativo</span>
                    <strong>
                        <?php if ($universidad['tipo'] == 0): ?>
                            <i class="fa-solid fa-shield-halved" style="color: var(--primary);"></i> Universidad Pública Estatal
                        <?php else: ?>
                            <i class="fa-solid fa-building" style="color: var(--accent);"></i> Corporación / Corporativo Privado
                        <?php endif; ?>
                    </strong>
                </div>

                <div>
                    <span style="color: var(--text-secondary); display: block; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; margin-bottom: 2px;">Metodología y Horarios</span>
                    <strong><i class="fa-solid fa-clock"></i> <?php echo htmlspecialchars($universidad['jornadas']); ?></strong>
                </div>

                <div style="border-top: 1px solid var(--border-color); padding-top: 15px; margin-top: 5px;">
                    <a href="<?php echo htmlspecialchars($universidad['sitio_web']); ?>" target="_blank" class="btn btn-outline" style="width: 100%; font-size: 0.85rem; padding: 10px;">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Abrir Portal del Campus
                    </a>
                </div>
            </div>
        </div>

        <!-- Tarjeta del Mapa de Ubicación -->
        <div class="map-card-container">
            <h3 style="font-size: 1.15rem; margin-bottom: 5px; color: var(--primary);">
                <i class="fa-solid fa-map-location-dot"></i> Ubicación del Campus
            </h3>
            <span style="color: var(--text-secondary); display: block; font-size: 0.78rem; margin-bottom: 12px;">
                Consulta la ubicación física y sede principal.
            </span>
            <div id="map" class="map-frame"></div>
        </div>
    </div>
</div>

<!-- Lógica interactiva para inicializar y cargar el mapa con Leaflet.js -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Nombre y ciudad de la universidad actual desde PHP
    const uniNombre = "<?php echo addslashes($universidad['nombre']); ?>";
    const uniCiudad = "<?php echo addslashes($universidad['ciudad']); ?>";

    // Coordenadas fijas para las universidades por defecto (Seeder)
    const coordinadasDefecto = {
        "Universidad Nacional de Colombia": [4.63819, -74.0841],
        "Universidad de los Andes": [4.6015, -74.0661],
        "Universidad de Antioquia": [6.2625, -75.5684],
        "Universidad del Valle": [3.3768, -76.5336],
        "Universidad Pontificia Javeriana": [4.6284, -74.0648]
    };

    // Coordenadas aproximadas para las ciudades principales
    const coordenadasCiudades = {
        "Bogotá": [4.6097, -74.0817],
        "Medellín": [6.2442, -75.5812],
        "Cali": [3.4372, -76.5225],
        "Barranquilla": [10.9639, -74.7964],
        "Bucaramanga": [7.1254, -73.1198],
        "Cartagena": [10.3910, -75.4794]
    };

    let lat = 4.6097; // Fallback nacional
    let lng = -74.0817;
    let zoomLevel = 15;

    // 1. Verificar si es una universidad por defecto
    if (coordinadasDefecto[uniNombre]) {
        lat = coordinadasDefecto[uniNombre][0];
        lng = coordinadasDefecto[uniNombre][1];
        inicializarMapa(lat, lng, zoomLevel);
    } 
    // 2. Si no, intentar geocodificar con Nominatim (OpenStreetMap) en tiempo real
    else {
        const query = encodeURIComponent(`${uniNombre}, ${uniCiudad}, Colombia`);
        fetch(`https://nominatim.openstreetmap.org/search?format=json&limit=1&q=${query}`)
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    lat = parseFloat(data[0].lat);
                    lng = parseFloat(data[0].lon);
                    inicializarMapa(lat, lng, zoomLevel);
                } else {
                    // Fallback a coordenadas de la ciudad
                    if (coordenadasCiudades[uniCiudad]) {
                        lat = coordenadasCiudades[uniCiudad][0];
                        lng = coordenadasCiudades[uniCiudad][1];
                    }
                    zoomLevel = 12; // Menor zoom porque es de nivel ciudad
                    inicializarMapa(lat, lng, zoomLevel);
                }
            })
            .catch(error => {
                console.error("Error geocodificando la universidad:", error);
                if (coordenadasCiudades[uniCiudad]) {
                    lat = coordenadasCiudades[uniCiudad][0];
                    lng = coordenadasCiudades[uniCiudad][1];
                }
                zoomLevel = 12;
                inicializarMapa(lat, lng, zoomLevel);
            });
    }

    function inicializarMapa(lat, lng, zoom) {
        // Inicializar el mapa de Leaflet
        const map = L.map('map').setView([lat, lng], zoom);

        // Capa de mosaico de OpenStreetMap con estilo limpio
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Icono de marcador personalizado
        const marker = L.marker([lat, lng]).addTo(map);
        
        // Pop-up con el nombre de la universidad
        marker.bindPopup(`<strong>${uniNombre}</strong><br><i class="fa-solid fa-location-dot"></i> Campus ${uniCiudad}`).openPopup();
    }
});
</script>
<!-- Sección de Reseñas y Calificaciones -->
<div style="margin-top: 40px;">

    <!-- Encabezado Promedio -->
    <div class="card-premium" style="margin-bottom: 25px; text-align: center;">
        <h2 style="font-size: 1.6rem; margin-bottom: 10px;"><i class="fa-solid fa-star" style="color: #f59e0b;"></i> Calificación de Estudiantes</h2>
        <?php if ($calificacion['total'] > 0): ?>
            <div style="font-size: 3rem; font-weight: 800; color: var(--primary); line-height: 1;"><?php echo $calificacion['promedio']; ?></div>
            <div style="font-size: 1.4rem; margin: 8px 0; color: #f59e0b;">
                <?php for ($s = 1; $s <= 5; $s++): ?>
                    <?php echo ($s <= round($calificacion['promedio'])) ? '★' : '☆'; ?>
                <?php endfor; ?>
            </div>
            <p style="color: var(--text-secondary); font-size: 0.9rem;">Basado en <?php echo $calificacion['total']; ?> reseña(s) de estudiantes.</p>
        <?php else: ?>
            <p style="color: var(--text-secondary);">Aún no hay reseñas. ¡Sé el primero en opinar!</p>
        <?php endif; ?>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px;">

        <!-- Formulario Nueva Reseña -->
        <div class="card">
            <h3 style="font-size: 1.2rem; margin-bottom: 20px; color: var(--primary); border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
                <i class="fa-solid fa-pen-to-square"></i> Deja tu Opinión
            </h3>
            <?php if (isset($_SESSION['usuario'])): ?>
                <form action="<?php echo $url_base; ?>universidades/guardarResenia" method="POST">
                    <input type="hidden" name="id_universidad" value="<?php echo $universidad['id_universidad']; ?>">
                    
                    <label style="font-size: 0.85rem; font-weight: 700; display: block; margin-bottom: 8px; color: var(--text-secondary);">CALIFICACIÓN</label>
                    <div id="star-selector" style="font-size: 2rem; margin-bottom: 15px; cursor: pointer; color: #d1d5db; display: flex; gap: 5px;">
                        <?php for ($s = 1; $s <= 5; $s++): ?>
                            <span data-val="<?php echo $s; ?>" onclick="setStars(<?php echo $s; ?>)" style="transition: color 0.15s;">★</span>
                        <?php endfor; ?>
                    </div>
                    <input type="hidden" name="calificacion" id="calificacion-input" value="0">
                    
                    <label style="font-size: 0.85rem; font-weight: 700; display: block; margin-bottom: 8px; color: var(--text-secondary);">TU COMENTARIO</label>
                    <textarea name="comentario" rows="4" placeholder="Cuéntanos tu experiencia con la infraestructura, los docentes, el ambiente..." style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: var(--radius-md); font-family: var(--font-main); font-size: 0.9rem; resize: vertical; background: var(--bg-main); color: var(--text-primary);" required minlength="10"></textarea>
                    
                    <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 15px;">
                        <i class="fa-solid fa-paper-plane"></i> Publicar Reseña
                    </button>
                </form>
            <?php else: ?>
                <div style="text-align: center; padding: 20px; background: var(--bg-main); border-radius: var(--radius-md);">
                    <p style="color: var(--text-secondary); margin-bottom: 15px;"><i class="fa-solid fa-lock"></i> Debes iniciar sesión para dejar una reseña.</p>
                    <a href="<?php echo $url_base; ?>usuarios/login" class="btn btn-primary">Iniciar Sesión</a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Lista de Reseñas -->
        <div class="card">
            <h3 style="font-size: 1.2rem; margin-bottom: 20px; color: var(--accent); border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
                <i class="fa-solid fa-comments"></i> Reseñas Recientes
            </h3>
            <?php if (count($resenias) === 0): ?>
                <div style="text-align: center; padding: 30px; color: var(--text-secondary);">
                    <i class="fa-solid fa-comment-slash" style="font-size: 2rem; margin-bottom: 10px; display: block;"></i>
                    Aún no hay reseñas para esta universidad.
                </div>
            <?php else: ?>
                <div style="display: flex; flex-direction: column; gap: 15px; max-height: 420px; overflow-y: auto; padding-right: 5px;">
                    <?php foreach ($resenias as $r): ?>
                        <div style="border-bottom: 1px solid var(--border-color); padding-bottom: 15px;">
                            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                                <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--secondary)); display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 1rem; flex-shrink: 0;">
                                    <?php echo strtoupper(substr($r['autor_nombre'], 0, 1)); ?>
                                </div>
                                <div>
                                    <strong style="font-size: 0.9rem;"><?php echo htmlspecialchars($r['autor_nombre']); ?></strong>
                                    <div style="color: #f59e0b; font-size: 0.85rem;">
                                        <?php for ($s = 1; $s <= 5; $s++) echo ($s <= $r['calificacion']) ? '★' : '☆'; ?>
                                    </div>
                                </div>
                                <small style="margin-left: auto; color: var(--text-secondary); font-size: 0.78rem;"><?php echo date("d/m/Y", strtotime($r['fecha'])); ?></small>
                            </div>
                            <p style="font-size: 0.9rem; color: var(--text-secondary); line-height: 1.6; margin: 0;"><?php echo htmlspecialchars($r['comentario']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
function setStars(val) {
    document.getElementById('calificacion-input').value = val;
    const stars = document.querySelectorAll('#star-selector span');
    stars.forEach((s, i) => {
        s.style.color = i < val ? '#f59e0b' : '#d1d5db';
    });
}
</script>
