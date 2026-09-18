<?php $url_base = constant('URL_BASE'); ?>
<div style="margin-bottom: 20px;">
    <span class="badge badge-primary"><i class="fa-solid fa-graduation-cap"></i> Programas Académicos</span>
    <h1 style="font-size: 2.5rem; margin-top: 5px;">Explorador de Carreras</h1>
    <p style="color: var(--text-secondary);">Encuentra e investiga las carreras de pregrado acordes a tu vocación e intereses y ajústalas a tu presupuesto.</p>
</div>

<div class="directory-layout">
    <!-- Filter Sidebar -->
    <div class="card filter-sidebar">
        <h3 class="filter-title"><i class="fa-solid fa-filter"></i> Filtrar Carreras</h3>
        
        <form method="GET" action="<?php echo $url_base; ?>programas/inicio">
            <div class="form-group">
                <label class="form-label" for="area">Área Vocacional</label>
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
                    <option value="">Todas las universidades</option>
                    <?php foreach ($universidades as $uni): ?>
                        <option value="<?php echo $uni['id_universidad']; ?>" <?php echo ($id_universidad == $uni['id_universidad']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($uni['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
                <label class="form-label" for="costoMax">Matrícula Semestral Máxima</label>
                <select class="form-input" id="costoMax" name="costoMax">
                    <option value="">Cualquier costo</option>
                    <option value="1000000" <?php echo ($costoMax === '1000000') ? 'selected' : ''; ?>>Hasta $1.000.000 COP</option>
                    <option value="5000000" <?php echo ($costoMax === '5000000') ? 'selected' : ''; ?>>Hasta $5.000.000 COP</option>
                    <option value="12000000" <?php echo ($costoMax === '12000000') ? 'selected' : ''; ?>>Hasta $12.000.000 COP</option>
                    <option value="25000000" <?php echo ($costoMax === '25000000') ? 'selected' : ''; ?>>Hasta $25.000.000 COP</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <i class="fa-solid fa-magnifying-glass"></i> Buscar Carreras
            </button>
            <?php if ($area !== '' || $costoMax !== '' || $id_universidad !== ''): ?>
                <a href="<?php echo $url_base; ?>programas/inicio" class="btn btn-outline" style="width: 100%; margin-top: 10px; font-size: 0.85rem; padding: 8px;">
                    Limpiar Búsqueda
                </a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Programs Grid -->
    <div>
        <?php if (count($programas) === 0): ?>
            <div class="card" style="text-align: center; padding: 60px 20px;">
                <div style="font-size: 3rem; color: var(--text-secondary); margin-bottom: 15px;">
                    <i class="fa-solid fa-book-open-reader"></i>
                </div>
                <h3>No se encontraron programas</h3>
                <p style="color: var(--text-secondary); margin-top: 8px;">Prueba variando tus filtros de área vocacional o matrícula semestral máxima.</p>
            </div>
        <?php else: ?>
            <div class="grid-cards">
                <?php foreach ($programas as $prog): ?>
                    <div class="card" style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                        <div>
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                                <span class="badge badge-primary" style="font-size: 0.72rem;"><?php echo htmlspecialchars($prog['area']); ?></span>
                                <span style="font-size: 0.8rem; color: var(--text-secondary); font-weight: 600;">
                                    <i class="fa-solid fa-clock"></i> <?php echo htmlspecialchars($prog['duracion']); ?> semestres
                                </span>
                            </div>
                            
                            <h3 style="font-size: 1.15rem; margin-bottom: 8px; color: var(--text-primary);"><?php echo htmlspecialchars($prog['n_programa']); ?></h3>
                            
                            <p style="font-size: 0.82rem; color: var(--text-secondary); margin-bottom: 15px;">
                                <i class="fa-solid fa-building-columns"></i> 
                                <a href="<?php echo $url_base; ?>universidades/detalle?id=<?php echo $prog['id_universidad']; ?>" style="font-weight: 600;">
                                    <?php echo htmlspecialchars($prog['universidad_nombre']); ?>
                                </a> 
                                <span style="display: block; font-size: 0.75rem; color: #64748b; margin-top: 2px;">
                                    <i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($prog['universidad_ciudad']); ?>
                                </span>
                            </p>
                        </div>
                        
                        <div style="border-top: 1px solid var(--border-color); padding-top: 15px; display: flex; align-items: center; justify-content: space-between; margin-top: 10px;">
                            <div>
                                <span style="display: block; font-size: 0.75rem; color: var(--text-secondary); font-weight: 600; text-transform: uppercase;">Semestre</span>
                                <strong style="color: var(--primary); font-size: 1.05rem;">
                                    <?php echo ($prog['costo'] == 0) ? 'Gratuito / Variable' : '$' . number_format($prog['costo'], 0, ',', '.'); ?>
                                </strong>
                            </div>
                            
                            <div style="display: flex; gap: 8px;">
                                <a href="<?php echo $url_base; ?>usuarios/guardarPrograma?id=<?php echo $prog['id_programa']; ?>" class="btn btn-outline" style="padding: 6px 10px; border-color: #f43f5e; color: #f43f5e;">
                                    <i class="fa-solid fa-heart"></i>
                                </a>
                                <a href="<?php echo $url_base; ?>programas/detalle?id=<?php echo $prog['id_programa']; ?>" class="btn btn-secondary" style="padding: 6px 12px; font-size: 0.85rem;">
                                    Detalle
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Paginación -->
            <?php if ($total_paginas > 1): ?>
            <div style="display:flex; justify-content:center; align-items:center; gap:8px; margin-top:30px; flex-wrap:wrap;">
                <?php
                $params_base = http_build_query(array_filter([
                    'area'          => $area,
                    'costoMax'      => $costoMax,
                    'id_universidad'=> $id_universidad,
                ]));
                ?>
                <?php if ($pagina > 1): ?>
                    <a href="<?php echo $url_base; ?>programas/inicio?<?php echo $params_base; ?>&pagina=<?php echo $pagina - 1; ?>"
                       class="btn btn-outline" style="padding:7px 14px;">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                <?php endif; ?>

                <?php for ($p = 1; $p <= $total_paginas; $p++): ?>
                    <a href="<?php echo $url_base; ?>programas/inicio?<?php echo $params_base; ?>&pagina=<?php echo $p; ?>"
                       class="btn <?php echo ($p === $pagina) ? 'btn-primary' : 'btn-outline'; ?>"
                       style="padding:7px 14px; min-width:40px; text-align:center;">
                        <?php echo $p; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($pagina < $total_paginas): ?>
                    <a href="<?php echo $url_base; ?>programas/inicio?<?php echo $params_base; ?>&pagina=<?php echo $pagina + 1; ?>"
                       class="btn btn-outline" style="padding:7px 14px;">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                <?php endif; ?>
            </div>
            <p style="text-align:center; font-size:0.82rem; color:var(--text-secondary); margin-top:10px;">
                Página <?php echo $pagina; ?> de <?php echo $total_paginas; ?> — <?php echo $total_registros; ?> programas en total
            </p>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</div>
