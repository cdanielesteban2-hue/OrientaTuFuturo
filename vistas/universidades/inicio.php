<?php $url_base = constant('URL_BASE'); ?>
<div class="dir-page">
  <header class="dir-hero">
    <span class="badge badge-primary"><i class="fa-solid fa-building-columns"></i> Educación Superior</span>
    <h1 class="dir-rotating-title" id="uniRotateTitle">¿Ya sabes cuál es tu uni?</h1>
    <p class="page-sub">Explora instituciones y elige con información clara.</p>
  </header>
  <div class="dir-legend-bar">
    <span class="dir-legend-label">Ficha técnica</span>
    <div class="dir-legend-items">
      <span class="dir-leg"><i class="fa-solid fa-sun leg-sun"></i> Diurna</span>
      <span class="dir-leg"><i class="fa-solid fa-moon"></i> Nocturna</span>
      <span class="dir-leg"><i class="fa-solid fa-circle-half-stroke"></i> Ambas</span>
      <span class="dir-leg"><i class="fa-solid fa-laptop"></i> Virtual</span>
      <span class="dir-leg"><i class="fa-solid fa-user"></i> Presencial</span>
    </div>
  </div>
  <div class="directory-layout compact-filters">
    <aside class="card filter-sidebar filter-compact">
      <h3 class="filter-title"><i class="fa-solid fa-sliders"></i> Filtrar</h3>
      <form method="GET" action="<?php echo $url_base; ?>universidades/inicio">
        <div class="form-group">
          <label class="form-label" for="buscar">Buscar</label>
          <input type="text" class="form-input" id="buscar" name="buscar" placeholder="Nombre..." value="<?php echo htmlspecialchars($buscar); ?>">
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
        <div class="form-group">
          <label class="form-label" for="tipo">Sector</label>
          <select class="form-input" id="tipo" name="tipo">
            <option value="">Todos</option>
            <option value="0" <?php echo ($tipo === '0') ? 'selected' : ''; ?>>Pública</option>
            <option value="1" <?php echo ($tipo === '1') ? 'selected' : ''; ?>>Privada</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;">Aplicar</button>
        <?php if ($ciudad !== '' || $tipo !== '' || $buscar !== ''): ?>
          <a href="<?php echo $url_base; ?>universidades/inicio" class="btn btn-outline" style="width:100%;margin-top:8px;">Limpiar</a>
        <?php endif; ?>
      </form>
    </aside>
    <div class="dir-results">
      <?php if (count($universidades) === 0): ?>
        <div class="card" style="text-align:center;padding:40px 16px;"><h3>No se encontraron universidades</h3></div>
      <?php else: ?>
        <div class="uni-grid">
          <?php foreach ($universidades as $uni):
            $j = mb_strtolower($uni['jornadas'] ?? '');
            $has_diurna = (strpos($j,'diurn') !== false || strpos($j,'mañana') !== false || strpos($j,'manana') !== false);
            $has_nocturna = (strpos($j,'nocturn') !== false || strpos($j,'noche') !== false);
            $has_virtual = (strpos($j,'virtual') !== false || strpos($j,'distancia') !== false);
            $has_presencial = (strpos($j,'presencial') !== false || (!$has_virtual && ($has_diurna || $has_nocturna || $j==='')));
            if ($has_diurna && $has_nocturna) { $jornada_icon = 'eclipse'; }
            elseif ($has_nocturna) { $jornada_icon = 'moon'; }
            elseif ($has_diurna) { $jornada_icon = 'sun'; }
            else { $jornada_icon = 'sun'; }
          ?>
          <article class="uni-card">
            <div class="uni-card-top">
              <span class="uni-badge <?php echo ($uni['tipo']==0)?'uni-badge-pub':'uni-badge-priv'; ?>"><?php echo ($uni['tipo']==0)?'Pública':'Privada'; ?></span>
              <span class="uni-ficha-tag" title="Ficha técnica"><i class="fa-solid fa-circle-info"></i> Ficha técnica</span>
            </div>
            <h3 class="uni-card-title"><?php echo htmlspecialchars($uni['nombre']); ?></h3>
            <p class="uni-card-city"><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($uni['ciudad']); ?></p>
            <div class="uni-card-icons">
              <?php if ($jornada_icon==='sun'): ?><span class="uni-ico" title="Diurna"><i class="fa-solid fa-sun leg-sun"></i></span>
              <?php elseif ($jornada_icon==='moon'): ?><span class="uni-ico" title="Nocturna"><i class="fa-solid fa-moon"></i></span>
              <?php else: ?><span class="uni-ico" title="Diurna y nocturna"><i class="fa-solid fa-circle-half-stroke"></i></span><?php endif; ?>
              <?php if ($has_virtual): ?><span class="uni-ico" title="Virtual"><i class="fa-solid fa-laptop"></i></span><?php endif; ?>
              <?php if ($has_presencial): ?><span class="uni-ico" title="Presencial"><i class="fa-solid fa-user"></i></span><?php endif; ?>
            </div>
            <p class="uni-card-desc"><?php echo htmlspecialchars(mb_strimwidth($uni['descripcion'] ?? '', 0, 120, '…')); ?></p>
            <a href="<?php echo $url_base; ?>universidades/detalle?id=<?php echo $uni['id_universidad']; ?>" class="btn btn-accent uni-card-btn">Ver perfil</a>
          </article>
          <?php endforeach; ?>
        </div>
        <?php if ($total_paginas > 1):
          $params_base = http_build_query(array_filter(['ciudad'=>$ciudad,'tipo'=>$tipo,'buscar'=>$buscar]));
        ?>
        <nav class="paginacion-compacta">
          <?php if ($pagina > 1): ?><a class="pag-btn" href="<?php echo $url_base; ?>universidades/inicio?<?php echo $params_base; ?>&pagina=<?php echo $pagina-1; ?>">‹</a><?php endif; ?>
          <?php for ($p=1;$p<=$total_paginas;$p++): if ($p===1||$p===$total_paginas||abs($p-$pagina)<=2): ?>
            <a class="pag-btn <?php echo $p===$pagina?'active':''; ?>" href="<?php echo $url_base; ?>universidades/inicio?<?php echo $params_base; ?>&pagina=<?php echo $p; ?>"><?php echo $p; ?></a>
          <?php endif; endfor; ?>
          <?php if ($pagina < $total_paginas): ?><a class="pag-btn" href="<?php echo $url_base; ?>universidades/inicio?<?php echo $params_base; ?>&pagina=<?php echo $pagina+1; ?>">›</a><?php endif; ?>
        </nav>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</div>
<script>
(function(){
  var msgs=["¿Ya sabes cuál es tu uni?","¿Estás listo para encontrar tu uni?","Aquí te espera el comienzo de algo grande..","Suficientes hasta para elegir!!!","72 son suficientes, no?","Tu futuro comienza aquí."];
  var el=document.getElementById('uniRotateTitle'); if(!el) return;
  var i=Math.floor(Math.random()*msgs.length);
  function next(){ el.classList.add('fade-out'); setTimeout(function(){ i=(i+1+Math.floor(Math.random()* (msgs.length-1)))%msgs.length; el.textContent=msgs[i]; el.classList.remove('fade-out'); },420); }
  setInterval(next, 4200);
})();
</script>
