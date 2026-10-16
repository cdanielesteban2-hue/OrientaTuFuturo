<?php $url_base = constant('URL_BASE'); ?>
<div style="margin-bottom: 20px;">
    <span class="badge badge-primary"><i class="fa-solid fa-building-columns"></i> Educación Superior</span>
    <h1 style="font-size: 2.5rem; margin-top: 5px;">Directorio de Universidades</h1>
    <p style="color: var(--text-secondary);">Explora e investiga las mejores instituciones de educación superior del país para tu crecimiento profesional.</p>
</div>

<div class="directory-layout">
    <!-- Filter Sidebar: sticky limitado para no solaparse con el footer -->
    <div class="card filter-sidebar" style="position: sticky; top: 90px; align-self: start; max-height: calc(100vh - 110px); overflow-y: auto; z-index: 5;">
        <h3 class="filter-title"><i class="fa-solid fa-filter"></i> Filtrar Búsqueda</h3>
        
        <form method="GET" action="<?php echo $url_base; ?>universidades/inicio">
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
            <div class="grid-cards grid-unis-9">
                <?php foreach ($universidades as $uni): ?>
                    <article class="uni-card">
                        <div class="uni-card-top">
                            <span class="uni-badge <?php echo ($uni['tipo'] == 0) ? 'uni-badge-pub' : 'uni-badge-priv'; ?>">
                                <?php echo ($uni['tipo'] == 0) ? 'Pública' : 'Privada'; ?>
                            </span>
                            <span class="uni-city">
                                <i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($uni['ciudad']); ?>
                            </span>
                        </div>
                        <h3 class="uni-name"><?php echo htmlspecialchars($uni['nombre']); ?></h3>
                        <p class="uni-desc"><?php echo htmlspecialchars($uni['descripcion']); ?></p>
                        <div class="uni-card-foot">
                            <span class="uni-jornada"><i class="fa-solid fa-clock"></i> <?php echo htmlspecialchars($uni['jornadas']); ?></span>
                            <a href="<?php echo $url_base; ?>universidades/detalle?id=<?php echo $uni['id_universidad']; ?>" class="uni-link">
                                Ver Perfil <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <?php if ($total_paginas > 1):
                $params_base = http_build_query(array_filter([
                    'ciudad' => $ciudad,
                    'tipo'   => $tipo,
                    'buscar' => $buscar,
                ]));
                // Paginación compacta: primera, última, actual ±2
                $paginas_mostrar = [];
                for ($p = 1; $p <= $total_paginas; $p++) {
                    if ($p === 1 || $p === $total_paginas || abs($p - $pagina) <= 2) {
                        $paginas_mostrar[] = $p;
                    }
                }
            ?>
            <nav class="paginacion-compacta" aria-label="Paginación">
                <?php if ($pagina > 1): ?>
                    <a href="<?php echo $url_base; ?>universidades/inicio?<?php echo $params_base; ?>&pagina=<?php echo $pagina - 1; ?>" class="pag-btn">‹</a>
                <?php endif; ?>

                <?php
                $prev = 0;
                foreach ($paginas_mostrar as $p):
                    if ($prev && $p - $prev > 1): ?>
                        <span class="pag-ellipsis">…</span>
                    <?php endif; ?>
                    <a href="<?php echo $url_base; ?>universidades/inicio?<?php echo $params_base; ?>&pagina=<?php echo $p; ?>"
                       class="pag-btn <?php echo ($p === $pagina) ? 'pag-active' : ''; ?>"><?php echo $p; ?></a>
                <?php $prev = $p; endforeach; ?>

                <?php if ($pagina < $total_paginas): ?>
                    <a href="<?php echo $url_base; ?>universidades/inicio?<?php echo $params_base; ?>&pagina=<?php echo $pagina + 1; ?>" class="pag-btn">›</a>
                <?php endif; ?>
            </nav>
            <p class="pag-info">Pág. <?php echo $pagina; ?> / <?php echo $total_paginas; ?> · <?php echo $total_registros; ?> universidades</p>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</div>

<style>
.grid-unis-9 {
    display: grid !important;
    grid-template-columns: repeat(3, 1fr) !important;
    gap: 16px !important;
}
.uni-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 18px 18px 14px;
    display: flex;
    flex-direction: column;
    min-height: 210px;
    transition: border-color .2s ease, box-shadow .2s ease;
}
.uni-card:hover {
    border-color: var(--primary);
    box-shadow: 0 4px 14px rgba(26, 79, 186, 0.12);
    transform: none; /* evita el agrandamiento excesivo */
}
.uni-card-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    gap: 8px;
}
.uni-badge {
    font-size: 0.68rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    padding: 3px 9px;
    border-radius: 999px;
}
.uni-badge-pub { background: #ddeaff; color: #1a4fba; }
.uni-badge-priv { background: #fef9c3; color: #a16207; }
[data-theme="dark"] .uni-badge-pub { background: rgba(37,99,235,.2); color: #93c5fd; }
[data-theme="dark"] .uni-badge-priv { background: rgba(234,179,8,.15); color: #fbbf24; }
.uni-city {
    font-size: 0.78rem;
    color: var(--text-secondary);
    font-weight: 600;
    white-space: nowrap;
}
.uni-city i { color: var(--primary); margin-right: 3px; }
.uni-name {
    font-size: 1.05rem;
    font-weight: 700;
    margin: 0 0 8px;
    color: var(--text-primary);
    line-height: 1.3;
}
.uni-desc {
    font-size: 0.84rem;
    color: var(--text-secondary);
    line-height: 1.45;
    margin: 0 0 14px;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.uni-card-foot {
    border-top: 1px solid var(--border-color);
    padding-top: 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
}
.uni-jornada {
    font-size: 0.74rem;
    color: var(--text-secondary);
}
.uni-link {
    font-size: 0.8rem;
    font-weight: 700;
    color: var(--primary);
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.uni-link:hover { text-decoration: underline; }

/* Paginación compacta */
.paginacion-compacta {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 4px;
    margin-top: 28px;
    flex-wrap: wrap;
}
.pag-btn {
    min-width: 32px;
    height: 32px;
    padding: 0 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    border: 1px solid var(--border-color);
    background: var(--bg-card);
    color: var(--text-secondary);
    font-size: 0.82rem;
    font-weight: 600;
    text-decoration: none;
    transition: background .15s, color .15s, border-color .15s;
}
.pag-btn:hover {
    border-color: var(--primary);
    color: var(--primary);
    transform: none;
}
.pag-btn.pag-active {
    background: var(--primary);
    border-color: var(--primary);
    color: #fff;
}
.pag-ellipsis {
    color: var(--text-secondary);
    font-size: 0.85rem;
    padding: 0 2px;
}
.pag-info {
    text-align: center;
    font-size: 0.78rem;
    color: var(--text-secondary);
    margin-top: 8px;
}

@media (max-width: 1100px) {
    .grid-unis-9 { grid-template-columns: repeat(2, 1fr) !important; }
}
@media (max-width: 640px) {
    .grid-unis-9 { grid-template-columns: 1fr !important; }
}
</style>
