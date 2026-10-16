<?php
$url_base = defined('URL_BASE') ? constant('URL_BASE') : '';
$tab = $tab ?? 'universidades';
$msg = $msg ?? '';
$edit_uni = $edit_uni ?? null;
$edit_beca = $edit_beca ?? null;
$edit_prog = $edit_prog ?? null;
$lista_unis = $lista_unis ?? [];
$lista_becas = $lista_becas ?? [];
$lista_progs = $lista_progs ?? [];
$todas_unis = $todas_unis ?? [];
$areas = $areas ?? [];
?>
<div class="admin-wrap" style="max-width:1100px;margin:0 auto;">
  <a href="<?php echo $url_base; ?>usuarios/admin" class="page-sub" style="text-decoration:none;"><i class="fa-solid fa-arrow-left"></i> Volver al panel</a>
  <h1 style="font-family:Outfit,sans-serif;margin:8px 0;">Gestionar contenido</h1>
  <?php if ($msg): ?><div class="card-premium" style="padding:12px;margin-bottom:12px;border-left:4px solid #10b981;"><?php echo htmlspecialchars($msg); ?></div><?php endif; ?>
  <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:14px;">
    <a class="btn <?php echo $tab==='universidades'?'btn-accent':'btn-outline'; ?>" href="<?php echo $url_base; ?>usuarios/adminGestion?tab=universidades">Universidades</a>
    <a class="btn <?php echo $tab==='programas'?'btn-accent':'btn-outline'; ?>" href="<?php echo $url_base; ?>usuarios/adminGestion?tab=programas">Carreras</a>
    <a class="btn <?php echo $tab==='becas'?'btn-accent':'btn-outline'; ?>" href="<?php echo $url_base; ?>usuarios/adminGestion?tab=becas">Becas</a>
  </div>

<?php if ($tab==='universidades'): ?>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;" class="admin-grid">
  <div class="card-premium" style="padding:16px;">
    <h3><?php echo $edit_uni?'Editar':'Nueva'; ?> universidad</h3>
    <form method="post" action="<?php echo $url_base; ?>usuarios/adminGestion">
      <input type="hidden" name="accion" value="<?php echo $edit_uni?'actualizar_uni':'crear_uni'; ?>">
      <input type="hidden" name="tab" value="universidades">
      <?php if ($edit_uni): ?><input type="hidden" name="id" value="<?php echo (int)$edit_uni['id_universidad']; ?>"><?php endif; ?>
      <div class="form-group"><label class="form-label">Nombre</label><input class="form-input" name="nombre" required value="<?php echo htmlspecialchars($edit_uni['nombre']??''); ?>"></div>
      <div class="form-group"><label class="form-label">Ciudad</label><input class="form-input" name="ciudad" required value="<?php echo htmlspecialchars($edit_uni['ciudad']??''); ?>"></div>
      <div class="form-group"><label class="form-label">Tipo</label>
        <select class="form-input" name="tipo"><option value="Pública">Pública</option><option value="Privada" selected>Privada</option></select>
      </div>
      <div class="form-group"><label class="form-label">Sitio web</label><input class="form-input" name="sitio_web" value="<?php echo htmlspecialchars($edit_uni['sitio_web']??''); ?>"></div>
      <div class="form-group"><label class="form-label">Jornadas</label><input class="form-input" name="jornadas" value="<?php echo htmlspecialchars($edit_uni['jornadas']??''); ?>"></div>
      <div class="form-group"><label class="form-label">Descripción</label><textarea class="form-input" name="descripcion" rows="3"><?php echo htmlspecialchars($edit_uni['descripcion']??''); ?></textarea></div>
      <button class="btn btn-accent" type="submit">Guardar</button>
    </form>
  </div>
  <div class="card-premium" style="padding:16px;">
    <h3>Listado (<?php echo count($lista_unis); ?>)</h3>
    <div style="max-height:420px;overflow:auto;">
      <table style="width:100%;font-size:.85rem;">
        <?php foreach ($lista_unis as $u): ?>
        <tr>
          <td><?php echo htmlspecialchars($u['nombre']); ?></td>
          <td><?php echo htmlspecialchars($u['ciudad']??''); ?></td>
          <td>
            <a href="<?php echo $url_base; ?>usuarios/adminGestion?tab=universidades&edit_uni=<?php echo (int)$u['id_universidad']; ?>">Editar</a>
            <a href="<?php echo $url_base; ?>usuarios/adminGestion?tab=universidades&del_uni=<?php echo (int)$u['id_universidad']; ?>" onclick="return confirm('¿Eliminar?');" style="color:#f87171;">Eliminar</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>

<?php elseif ($tab==='programas'): ?>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;" class="admin-grid">
  <div class="card-premium" style="padding:16px;">
    <h3><?php echo $edit_prog?'Editar':'Nueva'; ?> carrera</h3>
    <form method="post" action="<?php echo $url_base; ?>usuarios/adminGestion">
      <input type="hidden" name="accion" value="<?php echo $edit_prog?'actualizar_prog':'crear_prog'; ?>">
      <input type="hidden" name="tab" value="programas">
      <?php if ($edit_prog): ?><input type="hidden" name="id" value="<?php echo (int)$edit_prog['id_programa']; ?>"><?php endif; ?>
      <div class="form-group"><label class="form-label">Universidad</label>
        <select class="form-input" name="id_universidad" required>
          <?php foreach ($todas_unis as $u): ?>
          <option value="<?php echo (int)$u['id_universidad']; ?>" <?php echo (($edit_prog['id_universidad']??'')==$u['id_universidad'])?'selected':''; ?>><?php echo htmlspecialchars($u['nombre']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group"><label class="form-label">Programa</label><input class="form-input" name="n_programa" required value="<?php echo htmlspecialchars($edit_prog['n_programa']??''); ?>"></div>
      <div class="form-group"><label class="form-label">Área</label><input class="form-input" name="area" value="<?php echo htmlspecialchars($edit_prog['area']??''); ?>"></div>
      <div class="form-group"><label class="form-label">Duración</label><input class="form-input" name="duracion" value="<?php echo htmlspecialchars($edit_prog['duracion']??''); ?>"></div>
      <div class="form-group"><label class="form-label">Costo</label><input class="form-input" type="number" step="0.01" name="costo" value="<?php echo htmlspecialchars((string)($edit_prog['costo']??'')); ?>"></div>
      <button class="btn btn-accent" type="submit">Guardar</button>
    </form>
  </div>
  <div class="card-premium" style="padding:16px;">
    <h3>Últimas carreras</h3>
    <div style="max-height:420px;overflow:auto;">
      <table style="width:100%;font-size:.85rem;">
        <?php foreach ($lista_progs as $p): ?>
        <tr>
          <td><?php echo htmlspecialchars($p['n_programa']); ?></td>
          <td><?php echo htmlspecialchars($p['universidad_nombre']??''); ?></td>
          <td>
            <a href="<?php echo $url_base; ?>usuarios/adminGestion?tab=programas&edit_prog=<?php echo (int)$p['id_programa']; ?>">Editar</a>
            <a href="<?php echo $url_base; ?>usuarios/adminGestion?tab=programas&del_prog=<?php echo (int)$p['id_programa']; ?>" onclick="return confirm('¿Eliminar?');" style="color:#f87171;">Eliminar</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>

<?php else: ?>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;" class="admin-grid">
  <div class="card-premium" style="padding:16px;">
    <h3><?php echo $edit_beca?'Editar':'Nueva'; ?> beca</h3>
    <form method="post" action="<?php echo $url_base; ?>usuarios/adminGestion">
      <input type="hidden" name="accion" value="<?php echo $edit_beca?'actualizar_beca':'crear_beca'; ?>">
      <input type="hidden" name="tab" value="becas">
      <?php if ($edit_beca): ?><input type="hidden" name="id" value="<?php echo (int)$edit_beca['id_becas']; ?>"><?php endif; ?>
      <div class="form-group"><label class="form-label">Nombre</label><input class="form-input" name="nombre_beca" required value="<?php echo htmlspecialchars($edit_beca['nombre_beca']??''); ?>"></div>
      <div class="form-group"><label class="form-label">Campus</label><input class="form-input" name="campus" value="<?php echo htmlspecialchars($edit_beca['campus']??''); ?>"></div>
      <div class="form-group"><label class="form-label">Requisitos</label><textarea class="form-input" name="requisitos" rows="3"><?php echo htmlspecialchars($edit_beca['requisitos']??''); ?></textarea></div>
      <div class="form-group"><label class="form-label">Fecha límite</label><input class="form-input" type="date" name="fecha_limite" value="<?php echo htmlspecialchars($edit_beca['fecha_limite']??''); ?>"></div>
      <div class="form-group"><label class="form-label">Enlace</label><input class="form-input" name="enlace" value="<?php echo htmlspecialchars($edit_beca['enlace']??''); ?>"></div>
      <button class="btn btn-accent" type="submit">Guardar</button>
    </form>
  </div>
  <div class="card-premium" style="padding:16px;">
    <h3>Listado becas</h3>
    <div style="max-height:420px;overflow:auto;">
      <table style="width:100%;font-size:.85rem;">
        <?php foreach ($lista_becas as $b): ?>
        <tr>
          <td><?php echo htmlspecialchars($b['nombre_beca']); ?></td>
          <td><?php echo htmlspecialchars($b['campus']??''); ?></td>
          <td>
            <a href="<?php echo $url_base; ?>usuarios/adminGestion?tab=becas&edit_beca=<?php echo (int)$b['id_becas']; ?>">Editar</a>
            <a href="<?php echo $url_base; ?>usuarios/adminGestion?tab=becas&del_beca=<?php echo (int)$b['id_becas']; ?>" onclick="return confirm('¿Eliminar?');" style="color:#f87171;">Eliminar</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
<?php endif; ?>
</div>
<style>.form-group{margin-bottom:10px;} @media(max-width:900px){.admin-grid{grid-template-columns:1fr!important;}}</style>
