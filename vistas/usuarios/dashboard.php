<?php
/** @var array $programas */
/** @var array $becas */
/** @var array $cuestionarios */
$url_base = defined('URL_BASE') ? constant('URL_BASE') : '';
?>
<div class="dashboard-welcome">
    <h2><i class="fa-solid fa-sparkles"></i> ¡Hola, <?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?>!</h2>
    <p>Bienvenido a tu panel de control vocacional. Desde aquí puedes monitorear tus tests, revisar tus universidades favoritas y consultar las becas de tu interés.</p>
</div>

<div class="dashboard-grid">
    <div>
        <div class="card" style="margin-bottom: 30px;">
            <h3 class="section-title" style="color: var(--primary);">
                <i class="fa-solid fa-clipboard-list"></i> Historial de Cuestionarios Realizados
            </h3>
            <?php if (count($cuestionarios) === 0): ?>
                <div style="text-align: center; padding: 30px; background-color: var(--bg-main); border-radius: var(--radius-md);">
                    <div style="font-size: 2.5rem; color: var(--text-secondary); margin-bottom: 12px;">
                        <i class="fa-solid fa-circle-question"></i>
                    </div>
                    <p style="color: var(--text-secondary); margin-bottom: 20px;">Aún no has resuelto ningún test de orientación vocacional.</p>
                    <a href="<?php echo $url_base; ?>cuestionarios/inicio" class="btn btn-primary">
                        <i class="fa-solid fa-play"></i> Realizar mi Primer Test
                    </a>
                </div>
            <?php else: ?>
                <div class="dashboard-list">
                    <?php foreach ($cuestionarios as $cuest): ?>
                        <div class="list-item-fav">
                            <div>
                                <h4 style="margin-bottom: 4px;"><?php echo htmlspecialchars($cuest['descripcion']); ?></h4>
                                <small style="color: var(--text-secondary);">
                                    <i class="fa-solid fa-calendar-day"></i> Completado el: <?php echo date("d/m/Y", strtotime($cuest['fecha'])); ?>
                                </small>
                            </div>
                            <div>
                                <a href="<?php echo $url_base; ?>cuestionarios/resultado?id=<?php echo $cuest['id_cuestionario']; ?>" class="btn btn-secondary" style="padding: 6px 14px; font-size: 0.85rem;">
                                    <i class="fa-solid fa-square-poll-vertical"></i> Ver Resultados
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="card">
            <h3 class="section-title" style="color: var(--accent);">
                <i class="fa-solid fa-bookmark"></i> Programas Académicos de Interés
            </h3>
            <?php if (count($programas) === 0): ?>
                <div style="text-align: center; padding: 30px; background-color: var(--bg-main); border-radius: var(--radius-md);">
                    <div style="font-size: 2.5rem; color: var(--text-secondary); margin-bottom: 12px;">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <p style="color: var(--text-secondary); margin-bottom: 20px;">Aún no has guardado programas de tu agrado en favoritos.</p>
                    <a href="<?php echo $url_base; ?>programas/inicio" class="btn btn-outline">
                        <i class="fa-solid fa-magnifying-glass"></i> Buscar Programas
                    </a>
                </div>
            <?php else: ?>
                <p style="font-size: 0.85rem; color: var(--text-secondary); margin-bottom: 15px;"><i class="fa-solid fa-circle-info"></i> Puedes seleccionar hasta 3 programas para compararlos lado a lado.</p>
                <div class="dashboard-list">
                    <?php foreach ($programas as $prog): ?>
                        <div class="list-item-fav">
                            <div style="display: flex; align-items: flex-start; gap: 15px;">
                                <input type="checkbox" class="compare-checkbox" value="<?php echo $prog['id_programa']; ?>" onchange="toggleCompare(event)" style="margin-top: 5px; transform: scale(1.3); cursor: pointer;" title="Seleccionar para comparar">
                                <div>
                                    <h4 style="margin-bottom: 4px;"><?php echo htmlspecialchars($prog['n_programa']); ?></h4>
                                    <p style="font-size: 0.85rem; color: var(--text-secondary); margin-bottom: 2px;">
                                        <i class="fa-solid fa-building-columns"></i> <?php echo htmlspecialchars($prog['universidad_nombre']); ?> (<?php echo htmlspecialchars($prog['universidad_ciudad']); ?>)
                                    </p>
                                    <span class="badge badge-primary" style="font-size: 0.7rem;"><?php echo htmlspecialchars($prog['area']); ?></span>
                                </div>
                            </div>
                            <div style="display: flex; gap: 8px; align-items: center;">
                                <a href="<?php echo $url_base; ?>programas/detalle?id=<?php echo $prog['id_programa']; ?>" class="btn btn-secondary" style="padding: 6px 12px; font-size: 0.8rem;">
                                    <i class="fa-solid fa-eye"></i> Ver
                                </a>
                                <a href="<?php echo $url_base; ?>usuarios/eliminarPrograma?id=<?php echo $prog['id_programa']; ?>" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.8rem; border-color: var(--danger); color: var(--danger);">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div id="compare-container" style="display: none; position: sticky; bottom: 20px; background: var(--bg-card); padding: 15px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.15); border: 2px solid var(--primary); text-align: center; margin-top: 20px; z-index: 100;">
                    <span id="compare-count" style="font-weight: 600; color: var(--primary); margin-right: 15px;">0 seleccionados</span>
                    <button onclick="goToCompare()" class="btn btn-primary" style="padding: 8px 25px;">
                        <i class="fa-solid fa-code-compare"></i> Comparar Seleccionados
                    </button>
                    <p style="font-size: 0.8rem; color: var(--text-secondary); margin-top: 5px; margin-bottom: 0;">Selecciona 2 o 3 programas para comparar.</p>
                </div>
                <script>
                function toggleCompare(event) {
                    const checkedBoxes = document.querySelectorAll('.compare-checkbox:checked');
                    const container = document.getElementById('compare-container');
                    const countText = document.getElementById('compare-count');
                    if (checkedBoxes.length > 3) {
                        event.target.checked = false;
                        alert('Puedes seleccionar un máximo de 3 programas para comparar.');
                        return;
                    }
                    if (checkedBoxes.length >= 2) {
                        container.style.display = 'block';
                        countText.textContent = checkedBoxes.length + ' seleccionados';
                    } else {
                        container.style.display = 'none';
                    }
                }
                function goToCompare() {
                    const checkedBoxes = document.querySelectorAll('.compare-checkbox:checked');
                    if (checkedBoxes.length >= 2 && checkedBoxes.length <= 3) {
                        const ids = Array.from(checkedBoxes).map(cb => cb.value).join(',');
                        window.location.href = '<?php echo $url_base; ?>programas/comparar?ids=' + ids;
                    }
                }
                </script>
            <?php endif; ?>
        </div>
    </div>

    <div>
        <div class="card" style="margin-bottom: 30px;">
            <h3 class="section-title" style="color: var(--warning);">
                <i class="fa-solid fa-award"></i> Becas Favoritas
            </h3>
            <?php if (count($becas) === 0): ?>
                <div style="text-align: center; padding: 20px; background-color: var(--bg-main); border-radius: var(--radius-md);">
                    <p style="color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 15px;">No has marcado becas en tu portafolio.</p>
                    <a href="<?php echo $url_base; ?>becas/inicio" class="btn btn-outline" style="padding: 6px 14px; font-size: 0.85rem;">
                        <i class="fa-solid fa-magnifying-glass"></i> Consultar Becas
                    </a>
                </div>
            <?php else: ?>
                <div class="dashboard-list">
                    <?php foreach ($becas as $beca): ?>
                        <?php
                            $dias = (int)floor((strtotime($beca['fecha_limite']) - time()) / 86400);
                            if ($dias < 0) {
                                $badge_style = 'background:#f3f4f6; color:#6b7280; border:1px solid #e5e7eb;';
                                $badge_text = '<i class="fa-solid fa-ban"></i> Convocatoria cerrada';
                            } elseif ($dias < 15) {
                                $badge_style = 'background:#fee2e2; color:#dc2626; border:1px solid #fca5a5;';
                                $badge_text = '<i class="fa-solid fa-triangle-exclamation"></i> ¡Quedan ' . $dias . ' día(s)!';
                            } elseif ($dias < 30) {
                                $badge_style = 'background:#fef9c3; color:#854d0e; border:1px solid #fde047;';
                                $badge_text = '<i class="fa-solid fa-clock"></i> Quedan ' . $dias . ' días';
                            } else {
                                $badge_style = 'background:#d1fae5; color:#065f46; border:1px solid #6ee7b7;';
                                $badge_text = '<i class="fa-solid fa-circle-check"></i> Abierta';
                            }
                        ?>
                        <div class="list-item-fav" style="padding: 12px 15px;">
                            <div>
                                <h4 style="font-size: 0.95rem; margin-bottom: 4px;"><?php echo htmlspecialchars($beca['nombre_beca']); ?></h4>
                                <span style="font-size: 0.75rem; padding: 3px 9px; border-radius: 20px; display:inline-block; margin-top:4px; font-weight:700; <?php echo $badge_style; ?>"><?php echo $badge_text; ?></span>
                            </div>
                            <div style="display: flex; gap: 6px;">
                                <a href="<?php echo $url_base; ?>becas/detalle?id=<?php echo $beca['id_becas']; ?>" style="padding: 5px 8px; font-size: 0.75rem;" class="btn btn-secondary">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>
                                <a href="<?php echo $url_base; ?>usuarios/eliminarBeca?id=<?php echo $beca['id_becas']; ?>" style="padding: 5px 8px; font-size: 0.75rem; border-color: var(--danger); color: var(--danger);" class="btn btn-outline">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="card-premium">
            <?php
            $perfil_ok = isset($perfil_ok) ? $perfil_ok : '';
            if ($perfil_ok === '1'): ?>
                <div style="background:#d1fae5; border:1px solid #6ee7b7; color:#065f46; padding:10px 15px; border-radius:8px; margin-bottom:15px; font-size:0.9rem;"><i class="fa-solid fa-circle-check"></i> ¡Perfil actualizado correctamente!</div>
            <?php elseif ($perfil_ok === 'pass_ok'): ?>
                <div style="background:#d1fae5; border:1px solid #6ee7b7; color:#065f46; padding:10px 15px; border-radius:8px; margin-bottom:15px; font-size:0.9rem;"><i class="fa-solid fa-circle-check"></i> ¡Contraseña actualizada correctamente!</div>
            <?php elseif ($perfil_ok === 'error_pass'): ?>
                <div style="background:#fee2e2; border:1px solid #fca5a5; color:#991b1b; padding:10px 15px; border-radius:8px; margin-bottom:15px; font-size:0.9rem;"><i class="fa-solid fa-circle-xmark"></i> Contraseña actual incorrecta o las contraseñas no coinciden.</div>
            <?php endif; ?>

            <h3 style="font-size: 1.2rem; margin-bottom: 15px; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
                <i class="fa-solid fa-address-card"></i> Mi Perfil
            </h3>

            <?php
            $avatares = ['av1'=>'👤','av2'=>'🎓','av3'=>'🚀','av4'=>'🌟','av5'=>'💡','av6'=>'🔬','av7'=>'🎨','av8'=>'⚙️'];
            $avatar_actual = $_SESSION['usuario']['avatar'] ?? 'av1';
            ?>
            <div style="text-align:center; margin-bottom: 20px;">
                <div style="font-size: 4rem; margin-bottom: 5px;"><?php echo $avatares[$avatar_actual] ?? '👤'; ?></div>
                <strong><?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?></strong>
            </div>

            <form action="<?php echo $url_base; ?>usuarios/actualizarPerfil" method="POST">
                <label style="font-size:0.78rem; font-weight:700; color:var(--text-secondary); text-transform:uppercase; display:block; margin-bottom:4px;">Nombre</label>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?>" required style="width:100%; padding:10px 12px; border:1px solid var(--border-color); border-radius:var(--radius-md); font-size:0.9rem; background:var(--bg-main); color:var(--text-primary); margin-bottom:12px;">

                <label style="font-size:0.78rem; font-weight:700; color:var(--text-secondary); text-transform:uppercase; display:block; margin-bottom:4px;">Ciudad</label>
                <select name="ciudad" style="width:100%; padding:10px 12px; border:1px solid var(--border-color); border-radius:var(--radius-md); font-size:0.9rem; background:var(--bg-main); color:var(--text-primary); margin-bottom:15px; appearance:none;">
                    <?php 
                    if (!isset($ciudades) || !is_array($ciudades)) {
                        $ciudades = [];
                    }
                    $ciudad_actual = $_SESSION['usuario']['ciudad'] ?? '';
                    foreach ($ciudades as $c) {
                        $selected = ($ciudad_actual === $c) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($c) . '" ' . $selected . '>' . htmlspecialchars($c) . '</option>';
                    }
                    if (!in_array($ciudad_actual, $ciudades) && !empty($ciudad_actual) && $ciudad_actual !== 'Otra') {
                        echo '<option value="' . htmlspecialchars($ciudad_actual) . '" selected>' . htmlspecialchars($ciudad_actual) . '</option>';
                    }
                    ?>
                    <option value="Otra" <?php echo ($ciudad_actual === 'Otra') ? 'selected' : ''; ?>>Otra</option>
                </select>

                <label style="font-size:0.78rem; font-weight:700; color:var(--text-secondary); text-transform:uppercase; display:block; margin-bottom:8px;">Elige tu Avatar</label>
                <div style="display:flex; flex-wrap:wrap; gap:8px; margin-bottom:15px;">
                    <?php foreach ($avatares as $key => $emoji): ?>
                        <label style="cursor:pointer;">
                            <input type="radio" name="avatar" class="avatar-radio" value="<?php echo $key; ?>" <?php echo ($avatar_actual === $key) ? 'checked' : ''; ?> style="display:none;">
                            <span class="avatar-span" style="font-size:1.8rem; padding:6px; border-radius:10px; border:2px solid transparent; display:block; transition:all 0.2s;" title="<?php echo $key; ?>"><?php echo $emoji; ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
                <style>
                .avatar-radio:checked + .avatar-span {
                    border-color: var(--primary) !important;
                    background-color: var(--bg-main);
                    transform: scale(1.1);
                }
                .avatar-span:hover {
                    background-color: var(--bg-main);
                }
                </style>
                <div id="preview-avatar" style="display:none;"></div>

                <button type="submit" class="btn btn-primary" style="width:100%; padding:10px;">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar Cambios
                </button>
            </form>

            <div style="margin-top: 20px; border-top: 1px solid var(--border-color); padding-top: 15px;">
                <button onclick="document.getElementById('pass-form').classList.toggle('hidden-form')" class="btn btn-outline" style="width:100%; font-size:0.88rem; padding:9px;">
                    <i class="fa-solid fa-key"></i> Cambiar Contraseña
                </button>
                <div id="pass-form" class="hidden-form" style="margin-top:12px;">
                    <form action="<?php echo $url_base; ?>usuarios/cambiarPassword" method="POST">
                        <input type="password" name="pass_actual" placeholder="Contraseña actual" required style="width:100%; padding:9px 12px; border:1px solid var(--border-color); border-radius:var(--radius-md); font-size:0.88rem; margin-bottom:8px; background:var(--bg-main); color:var(--text-primary);">
                        <input type="password" name="nueva_pass" placeholder="Nueva contraseña (mín. 6 caracteres)" required minlength="6" style="width:100%; padding:9px 12px; border:1px solid var(--border-color); border-radius:var(--radius-md); font-size:0.88rem; margin-bottom:8px; background:var(--bg-main); color:var(--text-primary);">
                        <input type="password" name="confirmar_pass" placeholder="Confirmar nueva contraseña" required minlength="6" style="width:100%; padding:9px 12px; border:1px solid var(--border-color); border-radius:var(--radius-md); font-size:0.88rem; margin-bottom:10px; background:var(--bg-main); color:var(--text-primary);">
                        <button type="submit" class="btn btn-primary" style="width:100%; font-size:0.88rem; padding:9px;">
                            <i class="fa-solid fa-lock"></i> Actualizar Contraseña
                        </button>
                    </form>
                </div>
            </div>

            <style>
            .hidden-form { display: none !important; }
            </style>
        </div>
    </div>
</div>
