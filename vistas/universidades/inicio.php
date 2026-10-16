<?php $url_base = constant('URL_BASE'); ?>
<div class="page-head">
    <div>
        <span class="badge badge-primary"><i class="fa-solid fa-building-columns"></i> Educación Superior</span>
        <h1 class="page-title">Universidades</h1>
        <p class="page-sub">Explora instituciones de educación superior de Colombia.</p>
    </div>
</div>

<div class="directory-layout">
    <div class="card filter-sidebar">
        <h3 class="filter-title"><i class="fa-solid fa-sliders"></i> Filtrar</h3>
        <form method="GET" action="<?php echo $url_base; ?>universidades/inicio">
            <div class="form-group">
                <label class="form-label" for="buscar">Buscar</label>
                <input type="text" class="form-input" id="buscar" name="buscar" placeholder="Nacional, EAFIT..." value="<?php echo htmlspecialchars($buscar); ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="ciudad">Ciudad</label>
                <select class="form-input" id="ciudad" name="ciudad">
                    <option value="">Todas</option>
                    <?php foreach ($ciudades as $c): ?>
                        <option value="<?php echo htmlspecialchars($c); ?>" <?php echo ($ciudad === $c) ? 'selected' : ''; ?>><?php echo htmlspecialchars($c); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group" style="margin-bottom:18px;">
                <label class="form-label" for="tipo">Sector</label>
                <select class="form-input" id="tipo" name="tipo">
                    <option value="">Todos</option>
                    <option value="0" <?php echo ($tipo === '0') ? 'selected' : ''; ?>>Pública</option>
                    <option value="1" <?php echo ($tipo === '1') ? 'selected' : ''; ?>>Privada</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;">Aplicar</button>
            <?php if ($ciudad !== '' || $tipo !== '' || $buscar !== ''): ?>
                <a href="<?php echo $url_base; ?>universidades/inicio" class="btn btn-outline" style="width:100%; margin-top:8px; font-size:0.85rem;">Limpiar</a>
            <?php endif; ?>
        </form>
    </div>

    <div>
        <?php if (count($universidades) === 0): ?>
            <div class="card" style="text-align:center; padding:48px 20px;">
                <h3>No se encontraron universidades</h3>
                <p style="color:var(--text-secondary); margin-top:6px;">Ajusta ciudad o tipo de sector.</p>
            </div>
        <?php else: ?>
            <div class="list-rows">
                <?php foreach ($universidades as $uni): ?>
                    <article class="list-row">
                        <div class="list-row-main">
                            <div class="list-row-top">
                                <span class="uni-badge <?php echo ($uni['tipo'] == 0) ? 'uni-badge-pub' : 'uni-badge-priv'; ?>">
                                    <?php echo ($uni['tipo'] == 0) ? 'Pública' : 'Privada'; ?>
                                </span>
                                <span class="list-row-meta"><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($uni['ciudad']); ?></span>
                                <span class="list-row-meta"><i class="fa-solid fa-clock"></i> <?php echo htmlspecialchars($uni['jornadas']); ?></span>
                            </div>
                            <h3 class="list-row-title"><?php echo htmlspecialchars($uni['nombre']); ?></h3>
                            <p class="list-row-desc"><?php echo htmlspecialchars($uni['descripcion']); ?></p>
                        </div>
                        <div class="list-row-actions">
                            <a href="<?php echo $url_base; ?>universidades/detalle?id=<?php echo $uni['id_universidad']; ?>" class="btn btn-accent" style="padding:8px 16px; font-size:0.82rem;">
                                Ver perfil
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <?php if ($total_paginas > 1):
                $params_base = http_build_query(array_filter(['ciudad'=>$ciudad,'tipo'=>$tipo,'buscar'=>$buscar]));
                $paginas_mostrar = [];
                for ($p = 1; $p <= $total_paginas; $p++) {
                    if ($p === 1 || $p === $total_paginas || abs($p - $pagina) <= 2) $paginas_mostrar[] = $p;
                }
            ?>
            <nav class="paginacion-compacta">
                <?php if ($pagina > 1): ?><a class="pag-btn" href="<?php echo $url_base; ?>universidades/inicio?<?php echo $params_base; ?>&pagina=<?php echo $pagina-1; ?>">‹</a><?php endif; ?>
                <?php $prev=0; foreach ($paginas_mostrar as $p):
                    if ($prev && $p-$prev>1): ?><span class="pag-ellipsis">…</span><?php endif; ?>
                    <a class="pag-btn <?php echo ($p===$pagina)?'pag-active':''; ?>" href="<?php echo $url_base; ?>universidades/inicio?<?php echo $params_base; ?>&pagina=<?php echo $p; ?>"><?php echo $p; ?></a>
                <?php $prev=$p; endforeach; ?>
                <?php if ($pagina < $total_paginas): ?><a class="pag-btn" href="<?php echo $url_base; ?>universidades/inicio?<?php echo $params_base; ?>&pagina=<?php echo $pagina+1; ?>">›</a><?php endif; ?>
            </nav>
            <p class="pag-info">Pág. <?php echo $pagina; ?> / <?php echo $total_paginas; ?> · <?php echo $total_registros; ?> universidades</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
