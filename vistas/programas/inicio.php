<?php $url_base = constant('URL_BASE'); ?>
<div style="margin-bottom: 8px;">
    <span class="badge badge-primary"><i class="fa-solid fa-graduation-cap"></i> Programas Académicos</span>
    <h1 style="font-size: 2.1rem; margin-top: 8px;">Explorador de Carreras</h1>
    <p style="color: var(--text-secondary); font-size: 0.95rem;">Encuentra carreras de pregrado acordes a tu vocación y ajústalas a tu presupuesto.</p>
</div>

<div class="directory-layout">
    <div class="card filter-sidebar">
        <h3 class="filter-title"><i class="fa-solid fa-sliders"></i> Filtrar</h3>
        <form method="GET" action="<?php echo $url_base; ?>programas/inicio">
            <div class="form-group">
                <label class="form-label" for="buscar">Buscar carrera</label>
                <div style="position: relative;">
                    <i class="fa-solid fa-magnifying-glass" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:var(--text-muted); font-size:0.85rem;"></i>
                    <input type="text" class="form-input" id="buscar" name="buscar"
                           placeholder="Ej: Medicina, Derecho..."
                           value="<?php echo htmlspecialchars($buscar); ?>"
                           style="padding-left: 36px;">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="area">Área vocacional</label>
                <select class="form-input" id="area" name="area">
                    <option value="">Todas las áreas</option>
                    <?php foreach ($areas as $a): ?>
                        <option value="<?php echo htmlspecialchars($a); ?>" <?php echo ($area === $a) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($a); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="id_universidad">Universidad</label>
                <select class="form-input" id="id_universidad" name="id_universidad">
                    <option value="">Todas</option>
                    <?php foreach ($universidades as $uni): ?>
                        <option value="<?php echo $uni['id_universidad']; ?>" <?php echo ($id_universidad == $uni['id_universidad']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($uni['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label class="form-label" for="costoMax">Matrícula máxima</label>
                <select class="form-input" id="costoMax" name="costoMax">
                    <option value="">Cualquier costo</option>
                    <option value="1000000" <?php echo ($costoMax === '1000000') ? 'selected' : ''; ?>>Hasta $1.000.000</option>
                    <option value="5000000" <?php echo ($costoMax === '5000000') ? 'selected' : ''; ?>>Hasta $5.000.000</option>
                    <option value="12000000" <?php echo ($costoMax === '12000000') ? 'selected' : ''; ?>>Hasta $12.000.000</option>
                    <option value="25000000" <?php echo ($costoMax === '25000000') ? 'selected' : ''; ?>>Hasta $25.000.000</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <i class="fa-solid fa-magnifying-glass"></i> Buscar
            </button>
            <?php if ($area !== '' || $costoMax !== '' || $id_universidad !== '' || $buscar !== ''): ?>
                <a href="<?php echo $url_base; ?>programas/inicio" class="btn btn-outline" style="width: 100%; margin-top: 10px; font-size: 0.85rem;">Limpiar</a>
            <?php endif; ?>
        </form>
    </div>

    <div>
        <?php if (count($programas) === 0): ?>
            <div class="card" style="text-align: center; padding: 48px 20px;">
                <div style="font-size: 2.5rem; color: var(--text-muted); margin-bottom: 12px;"><i class="fa-solid fa-book-open-reader"></i></div>
                <h3>No se encontraron programas</h3>
                <p style="color: var(--text-secondary); margin-top: 6px; font-size: 0.9rem;">Prueba variando área, universidad o costo.</p>
            </div>
        <?php else: ?>
            <div class="carreras-list">
                <?php foreach ($programas as $prog): ?>
                    <article class="carrera-row">
                        <div class="carrera-row-main">
                            <h3 class="carrera-row-title"><?php echo htmlspecialchars($prog['n_programa']); ?></h3>
                            <div class="carrera-row-meta">
                                <span class="badge badge-primary" style="font-size: 0.65rem;"><?php echo htmlspecialchars($prog['area']); ?></span>
                                <span><i class="fa-solid fa-building-columns"></i>
                                    <a href="<?php echo $url_base; ?>universidades/detalle?id=<?php echo $prog['id_universidad']; ?>"><?php echo htmlspecialchars($prog['universidad_nombre']); ?></a>
                                </span>
                                <span><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($prog['universidad_ciudad']); ?></span>
                                <span><i class="fa-solid fa-clock"></i> <?php echo htmlspecialchars($prog['duracion']); ?> sem.</span>
                            </div>
                        </div>
                        <div class="carrera-row-cost">
                            <?php echo ($prog['costo'] == 0) ? 'Variable' : '$' . number_format($prog['costo'], 0, ',', '.'); ?>
                        </div>
                        <div class="carrera-row-actions">
                            <a href="<?php echo $url_base; ?>usuarios/guardarPrograma?id=<?php echo $prog['id_programa']; ?>" class="btn btn-outline" style="padding: 7px 11px; border-color: #f43f5e; color: #f43f5e;" title="Guardar">
                                <i class="fa-solid fa-heart"></i>
                            </a>
                            <a href="<?php echo $url_base; ?>programas/detalle?id=<?php echo $prog['id_programa']; ?>" class="btn btn-accent" style="padding: 7px 16px; font-size: 0.82rem;">
                                Ver detalle
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <?php if ($total_paginas > 1):
                $params_base = http_build_query(array_filter([
                    'area' => $area,
                    'costoMax' => $costoMax,
                    'id_universidad' => $id_universidad,
                    'buscar' => $buscar,
                ]));
                $paginas_mostrar = [];
                for ($p = 1; $p <= $total_paginas; $p++) {
                    if ($p === 1 || $p === $total_paginas || abs($p - $pagina) <= 2) {
                        $paginas_mostrar[] = $p;
                    }
                }
            ?>
            <nav class="paginacion-compacta" aria-label="Paginación">
                <?php if ($pagina > 1): ?>
                    <a class="pag-btn" href="<?php echo $url_base; ?>programas/inicio?<?php echo $params_base; ?>&pagina=<?php echo $pagina - 1; ?>">‹</a>
                <?php endif; ?>
                <?php $prev = 0; foreach ($paginas_mostrar as $p):
                    if ($prev && $p - $prev > 1): ?><span class="pag-ellipsis">…</span><?php endif; ?>
                    <a class="pag-btn <?php echo ($p === $pagina) ? 'pag-active' : ''; ?>" href="<?php echo $url_base; ?>programas/inicio?<?php echo $params_base; ?>&pagina=<?php echo $p; ?>"><?php echo $p; ?></a>
                <?php $prev = $p; endforeach; ?>
                <?php if ($pagina < $total_paginas): ?>
                    <a class="pag-btn" href="<?php echo $url_base; ?>programas/inicio?<?php echo $params_base; ?>&pagina=<?php echo $pagina + 1; ?>">›</a>
                <?php endif; ?>
            </nav>
            <p class="pag-info">Pág. <?php echo $pagina; ?> / <?php echo $total_paginas; ?> · <?php echo $total_registros; ?> programas</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
