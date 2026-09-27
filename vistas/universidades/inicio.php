<?php $url_base = constant('URL_BASE'); ?>
<div style="margin-bottom: 20px;">
    <span class="badge badge-primary"><i class="fa-solid fa-building-columns"></i> Educación Superior</span>
    <h1 style="font-size: 2.5rem; margin-top: 5px;">Directorio de Universidades</h1>
    <p style="color: var(--text-secondary);">Explora e investiga las mejores instituciones de educación superior del país para tu crecimiento profesional.</p>
</div>

<div class="directory-layout">
    <!-- Filter Sidebar -->
    <div class="card filter-sidebar">
        <h3 class="filter-title"><i class="fa-solid fa-filter"></i> Filtrar Búsqueda</h3>
        
        <form method="GET" action="<?php echo $url_base; ?>universidades/inicio">
            <!-- Buscador por nombre -->
            <div class="form-group">
                <label class="form-label" for="buscar">Buscar universidad</label>
                <div style="position: relative;">
                    <i class="fa-solid fa-magnifying-glass" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:var(--text-secondary); font-size:0.85rem;"></i>
                    <input type="text" class="form-input" id="buscar" name="buscar"
                           placeholder="Ej: Nacional, EAFIT..."
                           value="<?php echo htmlspecialchars($buscar); ?>"
                           style="padding-left: 36px;">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="ciudad">Ciudad</label>
                <select class="form-input" id="ciudad" name="ciudad">
                    <option value="">Todas las ciudades</option>
                    <?php foreach ($ciudades as $c): ?>
                        <option value="<?php echo htmlspecialchars($c); ?>" <?php echo ($ciudad === $c) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($c); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
                <label class="form-label" for="tipo">Sector / Tipo</label>
                <select class="form-input" id="tipo" name="tipo">
                    <option value="">Todos los sectores</option>
                    <option value="0" <?php echo ($tipo === '0') ? 'selected' : ''; ?>>Pública</option>
                    <option value="1" <?php echo ($tipo === '1') ? 'selected' : ''; ?>>Privada</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <i class="fa-solid fa-magnifying-glass"></i> Aplicar Filtros
            </button>
            <?php if ($ciudad !== '' || $tipo !== '' || $buscar !== ''): ?>
                <a href="<?php echo $url_base; ?>universidades/inicio" class="btn btn-outline" style="width: 100%; margin-top: 10px; font-size: 0.85rem; padding: 8px;">
                    Limpiar Búsqueda
                </a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Universities Grid: 3 columnas x 3 filas = 9 por página -->
    <div>
        <?php if (count($universidades) === 0): ?>
            <div class="card" style="text-align: center; padding: 60px 20px;">
                <div style="font-size: 3rem; color: var(--text-secondary); margin-bottom: 15px;">
                    <i class="fa-solid fa-building-circle-exclamation"></i>
                </div>
                <h3>No se encontraron universidades</h3>
                <p style="color: var(--text-secondary); margin-top: 8px;">Prueba ajustando tus filtros de ciudad o tipo de sector.</p>
            </div>
        <?php else: ?>
            <div class="grid-cards grid-unis-9" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                <?php foreach ($universidades as $uni): ?>
                    <div class="card" style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                        <div>
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                                <span class="badge <?php echo ($uni['tipo'] == 0) ? 'badge-primary' : 'badge-accent'; ?>">
                                    <?php echo ($uni['tipo'] == 0) ? 'Pública' : 'Privada'; ?>
                                </span>
                                <span style="font-size: 0.8rem; color: var(--text-secondary); font-weight: 600;">
                                    <i class="fa-solid fa-location-dot" style="color: var(--primary);"></i> <?php echo htmlspecialchars($uni['ciudad']); ?>
                                </span>
                            </div>
                            
                            <h3 style="font-size: 1.2rem; margin-bottom: 10px; color: var(--text-primary);"><?php echo htmlspecialchars($uni['nombre']); ?></h3>
                            <p style="font-size: 0.88rem; color: var(--text-secondary); margin-bottom: 20px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; line-height: 1.5;">
                                <?php echo htmlspecialchars($uni['descripcion']); ?>
                            </p>
                        </div>
                        
                        <div style="border-top: 1px solid var(--border-color); padding-top: 15px; display: flex; align-items: center; justify-content: space-between;">
                            <span style="font-size: 0.78rem; color: var(--text-secondary);">
                                <i class="fa-solid fa-clock"></i> <?php echo htmlspecialchars($uni['jornadas']); ?>
                            </span>
                            <a href="<?php echo $url_base; ?>universidades/detalle?id=<?php echo $uni['id_universidad']; ?>" class="btn btn-secondary" style="padding: 6px 14px; font-size: 0.85rem;">
                                Ver Perfil <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Paginación -->
            <?php if ($total_paginas > 1): ?>
            <div style="display:flex; justify-content:center; align-items:center; gap:8px; margin-top:30px; flex-wrap:wrap;">
                <?php
                $params_base = http_build_query(array_filter([
                    'ciudad' => $ciudad,
                    'tipo'   => $tipo,
                    'buscar' => $buscar,
                ]));
                ?>
                <?php if ($pagina > 1): ?>
                    <a href="<?php echo $url_base; ?>universidades/inicio?<?php echo $params_base; ?>&pagina=<?php echo $pagina - 1; ?>"
                       class="btn btn-outline" style="padding:7px 14px;">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                <?php endif; ?>

                <?php for ($p = 1; $p <= $total_paginas; $p++): ?>
                    <a href="<?php echo $url_base; ?>universidades/inicio?<?php echo $params_base; ?>&pagina=<?php echo $p; ?>"
                       class="btn <?php echo ($p === $pagina) ? 'btn-primary' : 'btn-outline'; ?>"
                       style="padding:7px 14px; min-width:40px; text-align:center;">
                        <?php echo $p; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($pagina < $total_paginas): ?>
                    <a href="<?php echo $url_base; ?>universidades/inicio?<?php echo $params_base; ?>&pagina=<?php echo $pagina + 1; ?>"
                       class="btn btn-outline" style="padding:7px 14px;">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                <?php endif; ?>
            </div>
            <p style="text-align:center; font-size:0.82rem; color:var(--text-secondary); margin-top:10px;">
                Página <?php echo $pagina; ?> de <?php echo $total_paginas; ?> — <?php echo $total_registros; ?> universidades en total
            </p>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</div>

<style>
/* Grid 3x3 en escritorio; 2 y 1 columnas en pantallas más pequeñas */
.grid-unis-9 {
    display: grid !important;
    grid-template-columns: repeat(3, 1fr) !important;
    gap: 20px !important;
}
@media (max-width: 1100px) {
    .grid-unis-9 {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}
@media (max-width: 640px) {
    .grid-unis-9 {
        grid-template-columns: 1fr !important;
    }
}
</style>
