<?php $url_base = constant('URL_BASE'); ?>
<div class="dir-page">
  <header class="dir-hero">
    <span class="badge badge-primary"><i class="fa-solid fa-graduation-cap"></i> Programas Académicos</span>
    <h1 class="dir-rotating-title" id="carRotateTitle">Elige sabiamente</h1>
    <p class="page-sub">Encuentra carreras de pregrado acordes a tu vocación.</p>
  </header>
  <div class="dir-legend-bar dir-legend-box">
    <span class="dir-legend-label">Ficha técnica</span>
    <div class="dir-legend-items">
      <span class="dir-leg dir-leg-box"><i class="fa-solid fa-book"></i> Área</span>
      <span class="dir-leg dir-leg-box"><i class="fa-solid fa-clock"></i> Duración</span>
      <span class="dir-leg dir-leg-box"><i class="fa-solid fa-building-columns"></i> Universidad</span>
    </div>
  </div>
  <div class="directory-layout compact-filters">
    <aside class="card filter-sidebar filter-compact">
      <h3 class="filter-title"><i class="fa-solid fa-sliders"></i> Filtrar</h3>
      <form method="GET" action="<?php echo $url_base; ?>programas/inicio">
        <div class="form-group">
          <label class="form-label" for="buscar">Buscar</label>
          <input type="text" class="form-input" id="buscar" name="buscar" placeholder="Medicina..." value="<?php echo htmlspecialchars($buscar); ?>">
        </div>
        <div class="form-group">
          <label class="form-label" for="area">Área</label>
          <select class="form-input" id="area" name="area">
            <option value="">Todas</option>
            <?php foreach ($areas as $a): ?>
              <option value="<?php echo htmlspecialchars($a); ?>" <?php echo ($area===$a)?'selected':''; ?>><?php echo htmlspecialchars($a); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label" for="id_universidad">Universidad</label>
          <select class="form-input" id="id_universidad" name="id_universidad">
            <option value="">Todas</option>
            <?php foreach ($universidades as $u): ?>
              <option value="<?php echo $u['id_universidad']; ?>" <?php echo ($id_universidad==$u['id_universidad'])?'selected':''; ?>><?php echo htmlspecialchars($u['nombre']); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;">Aplicar</button>
        <?php if ($buscar||$area||$id_universidad): ?>
          <a href="<?php echo $url_base; ?>programas/inicio" class="btn btn-outline" style="width:100%;margin-top:8px;">Limpiar</a>
        <?php endif; ?>
      </form>
    </aside>
    <div class="dir-results">
      <?php if (empty($programas)): ?>
        <div class="card" style="text-align:center;padding:40px 16px;"><h3>No se encontraron carreras</h3></div>
      <?php else: ?>
        <div class="uni-grid">
          <?php foreach ($programas as $prog): ?>
          <article class="uni-card uni-card-frame">
            <div class="uni-card-top">
              <span class="uni-badge uni-badge-pub"><i class="fa-solid fa-book"></i> <?php echo htmlspecialchars($prog['area'] ?? 'General'); ?></span>
              <span class="uni-ficha-tag"><i class="fa-solid fa-circle-info"></i> Ficha técnica</span>
            </div>
            <h3 class="uni-card-title"><?php echo htmlspecialchars($prog['n_programa'] ?? $prog['nombre'] ?? ''); ?></h3>
            <p class="uni-card-city"><i class="fa-solid fa-building-columns"></i> <?php echo htmlspecialchars($prog['universidad'] ?? $prog['nombre_universidad'] ?? ''); ?></p>
            <div class="uni-card-icons">
              <span class="uni-ico" title="Duración"><i class="fa-solid fa-clock"></i></span>
              <span style="font-size:.82rem;color:#94a3b8;align-self:center;"><?php echo htmlspecialchars($prog['duracion'] ?? '—'); ?></span>
            </div>
            <a href="<?php echo $url_base; ?>programas/detalle?id=<?php echo $prog['id_programa']; ?>" class="btn btn-accent uni-card-btn">Ver detalle</a>
          </article>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<script>
(function(){
  var msgs=["Elige sabiamente","Te gusta… ¿pero te apasiona?","La elección está dentro de ti..","Mucho de donde elegir"];
  var el=document.getElementById('carRotateTitle'); if(!el) return;
  var i=Math.floor(Math.random()*msgs.length);
  function next(){ el.classList.add('fade-out'); setTimeout(function(){ i=(i+1+Math.floor(Math.random()*(msgs.length-1)))%msgs.length; el.textContent=msgs[i]; el.classList.remove('fade-out'); },420); }
  setInterval(next, 4200);
})();
</script>
