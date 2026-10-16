<?php $url_base = constant('URL_BASE'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

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
        <a href="<?php echo htmlspecialchars($universidad['sitio_web']); ?>" target="_blank" rel="noopener" class="btn btn-primary">
            <i class="fa-solid fa-earth-americas"></i> Visitar Sitio Web Oficial
        </a>
    </div>
</div>

<div class="dashboard-grid detalle-uni-grid">
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
            <h3 style="font-size: 1.3rem; margin-bottom: 20px; color: var(--accent);">
                <i class="fa-solid fa-graduation-cap"></i> Programas Académicos Ofertados
            </h3>
            <?php if (count($programas) === 0): ?>
                <p style="color: var(--text-secondary); text-align: center; padding: 20px;">No se registraron carreras asociadas a esta institución.</p>
            <?php else: ?>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.92rem;">
                        <thead>
                            <tr style="border-bottom: 2px solid var(--border-color); color: var(--text-secondary); font-weight: 600;">
                                <th style="padding: 12px 10px;">Carrera / Programa</th>
                                <th style="padding: 12px 10px;">Área</th>
                                <th style="padding: 12px 10px; text-align: center;">Semestres</th>
                                <th style="padding: 12px 10px; text-align: center;">Precios</th>
                                <th style="padding: 12px 10px; text-align: center;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($programas as $prog): ?>
                                <tr class="prog-row" style="border-bottom: 1px solid var(--border-color);">
                                    <td style="padding: 14px 10px; font-weight: 700;"><?php echo htmlspecialchars($prog['n_programa']); ?></td>
                                    <td style="padding: 14px 10px;"><span class="badge badge-primary" style="font-size: 0.72rem;"><?php echo htmlspecialchars($prog['area']); ?></span></td>
                                    <td style="padding: 14px 10px; text-align: center; font-weight: 600;"><?php echo htmlspecialchars($prog['duracion']); ?></td>
                                    <td style="padding: 14px 10px; text-align: center;">
                                        <a href="<?php echo htmlspecialchars($universidad['sitio_web']); ?>" target="_blank" rel="noopener" class="btn btn-outline" style="padding:5px 10px; font-size:0.75rem;">
                                            <i class="fa-solid fa-coins"></i> Consultar precios
                                        </a>
                                    </td>
                                    <td style="padding: 14px 10px; text-align: center;">
                                        <div style="display: flex; gap: 8px; justify-content: center;">
                                            <a href="<?php echo $url_base; ?>programas/detalle?id=<?php echo $prog['id_programa']; ?>" class="btn btn-secondary" style="padding: 4px 8px; font-size: 0.75rem;"><i class="fa-solid fa-eye"></i></a>
                                            <a href="<?php echo $url_base; ?>usuarios/guardarPrograma?id=<?php echo $prog['id_programa']; ?>" class="btn btn-outline" style="padding: 4px 8px; font-size: 0.75rem; border-color: #f43f5e; color: #f43f5e;"><i class="fa-solid fa-heart"></i></a>
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

    <div class="detalle-sidebar">
        <div class="card-premium ficha-datos-card">
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
                            <i class="fa-solid fa-building" style="color: var(--accent);"></i> Corporación / Privado
                        <?php endif; ?>
                    </strong>
                </div>
                <div>
                    <span style="color: var(--text-secondary); display: block; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; margin-bottom: 2px;">Metodología y Horarios</span>
                    <strong><i class="fa-solid fa-clock"></i> <?php echo htmlspecialchars($universidad['jornadas']); ?></strong>
                </div>
                <div style="border-top: 1px solid var(--border-color); padding-top: 15px; display:flex; flex-direction:column; gap:8px;">
                    <a href="<?php echo htmlspecialchars($universidad['sitio_web']); ?>" target="_blank" rel="noopener" class="btn btn-outline" style="width: 100%; font-size: 0.85rem; padding: 10px;">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Abrir Portal del Campus
                    </a>
                    <a href="<?php echo htmlspecialchars($universidad['sitio_web']); ?>" target="_blank" rel="noopener" class="btn btn-accent" style="width: 100%; font-size: 0.85rem; padding: 10px;">
                        <i class="fa-solid fa-coins"></i> Consultar precios
                    </a>
                </div>
            </div>
        </div>

        <div class="map-card-container">
            <h3 style="font-size: 1.15rem; margin-bottom: 5px; color: var(--primary);">
                <i class="fa-solid fa-map-location-dot"></i> Ubicación del Campus
            </h3>
            <span style="color: var(--text-secondary); display: block; font-size: 0.78rem; margin-bottom: 12px;">Consulta la ubicación física y sede principal.</span>
            <div id="map" class="map-frame"></div>
        </div>
    </div>
</div>

<style>
.detalle-uni-grid { align-items: start; }
.detalle-sidebar { display: flex; flex-direction: column; gap: 20px; }
/* Ficha en flujo normal: ya no se sobrepone al mapa */
.ficha-datos-card { position: relative; z-index: 1; }
.map-card-container { position: relative; z-index: 2; }
.map-frame { height: 250px; width: 100%; border-radius: 8px; border: 1px solid var(--border-color); z-index: 1; }
.prog-row:hover { background: rgba(26,79,186,0.06); }
[data-theme="dark"] .prog-row:hover { background: rgba(255,255,255,0.04); }
.detalle-uni-grid .card:hover,
.detalle-uni-grid .card-premium:hover { transform: none !important; }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const uniNombre = <?php echo json_encode($universidad['nombre']); ?>;
    const uniCiudad = <?php echo json_encode($universidad['ciudad']); ?>;
    const coordinadasDefecto = {
        "Universidad Nacional de Colombia": [4.63819, -74.0841],
        "Universidad de los Andes": [4.6015, -74.0661],
        "Universidad de Antioquia": [6.2625, -75.5684],
        "Universidad del Valle": [3.3768, -76.5336],
        "Universidad Pontificia Javeriana": [4.6284, -74.0648]
    };
    const coordenadasCiudades = {
        "Bogotá": [4.6097, -74.0817], "Medellín": [6.2442, -75.5812],
        "Cali": [3.4372, -76.5225], "Barranquilla": [10.9639, -74.7964],
        "Bucaramanga": [7.1254, -73.1198], "Cartagena": [10.3910, -75.4794]
    };
    let lat = 4.6097, lng = -74.0817, zoomLevel = 15;
    function inicializarMapa(lat, lng, zoom) {
        const map = L.map('map').setView([lat, lng], zoom);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);
        L.marker([lat, lng]).addTo(map).bindPopup('<strong>' + uniNombre + '</strong><br>Campus ' + uniCiudad).openPopup();
    }
    if (coordinadasDefecto[uniNombre]) {
        lat = coordinadasDefecto[uniNombre][0]; lng = coordinadasDefecto[uniNombre][1];
        inicializarMapa(lat, lng, zoomLevel);
    } else {
        fetch('https://nominatim.openstreetmap.org/search?format=json&limit=1&q=' + encodeURIComponent(uniNombre + ', ' + uniCiudad + ', Colombia'))
            .then(r => r.json()).then(data => {
                if (data && data.length > 0) {
                    lat = parseFloat(data[0].lat); lng = parseFloat(data[0].lon);
                } else if (coordenadasCiudades[uniCiudad]) {
                    lat = coordenadasCiudades[uniCiudad][0]; lng = coordenadasCiudades[uniCiudad][1]; zoomLevel = 12;
                }
                inicializarMapa(lat, lng, zoomLevel);
            }).catch(() => {
                if (coordenadasCiudades[uniCiudad]) {
                    lat = coordenadasCiudades[uniCiudad][0]; lng = coordenadasCiudades[uniCiudad][1];
                }
                inicializarMapa(lat, lng, 12);
            });
    }
});
</script>
