<?php if(!defined('URL_BASE')) exit; $url_base = constant('URL_BASE'); ?>
<div class="admin-wrap">
    <div class="admin-hero">
        <div>
            <span class="badge badge-accent"><i class="fa-solid fa-users"></i> Administración</span>
            <h1 class="admin-page-title">Gestión de usuarios</h1>
            <p class="page-sub" style="margin:0;">Estudiantes y administradores registrados.</p>
        </div>
    </div>

    <div class="admin-card" style="padding:0; overflow:hidden;">
        <div class="admin-table-wrap" style="margin:0;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Ciudad</th>
                        <th>Rol</th>
                        <th>Registro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($usuarios)): ?>
                        <tr><td colspan="6" style="text-align:center; padding:24px;">No hay usuarios.</td></tr>
                    <?php else: ?>
                        <?php foreach ($usuarios as $user): ?>
                        <tr>
                            <td>#<?php echo (int)($user['id_usuarios'] ?? 0); ?></td>
                            <td class="admin-cell-clip"><?php echo htmlspecialchars($user['nombre'] ?? ''); ?></td>
                            <td class="admin-cell-clip"><?php echo htmlspecialchars($user['correo'] ?? ''); ?></td>
                            <td class="admin-cell-clip"><?php echo htmlspecialchars($user['ciudad'] ?? '—'); ?></td>
                            <td>
                                <?php if (($user['rol'] ?? 'usuario') === 'admin'): ?>
                                    <span class="admin-role is-admin">Admin</span>
                                <?php else: ?>
                                    <span class="admin-role">Estudiante</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo !empty($user['f_registro']) ? date('d/m/Y', strtotime($user['f_registro'])) : '—'; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
.admin-wrap{max-width:100%;width:100%;margin:0 auto;box-sizing:border-box;overflow-x:hidden}
.admin-page-title{margin:10px 0 6px;font-family:'Roboto Slab',Georgia,serif;font-size:clamp(1.35rem,3vw,1.75rem);font-weight:800}
.admin-hero{margin-bottom:16px}
.admin-card{min-width:0;background:rgba(15,23,42,.55);border:1px solid rgba(255,255,255,.08);border-radius:8px;box-sizing:border-box;overflow:hidden}
[data-theme="light"] .admin-card{background:rgba(255,255,255,.92);border:1.5px solid #0f172a}
.admin-table-wrap{overflow-x:auto;-webkit-overflow-scrolling:touch;max-width:100%}
.admin-table{width:100%;border-collapse:collapse;font-size:.86rem;table-layout:fixed}
.admin-table th,.admin-table td{text-align:left;padding:12px 14px;border-bottom:1px solid rgba(255,255,255,.06);vertical-align:middle}
[data-theme="light"] .admin-table th,[data-theme="light"] .admin-table td{border-bottom-color:#f1f5f9}
.admin-table th{color:#94a3b8;font-size:.72rem;text-transform:uppercase;letter-spacing:.04em;white-space:nowrap}
.admin-table th:nth-child(1),.admin-table td:nth-child(1){width:8%}
.admin-table th:nth-child(2),.admin-table td:nth-child(2){width:20%}
.admin-table th:nth-child(3),.admin-table td:nth-child(3){width:28%}
.admin-table th:nth-child(4),.admin-table td:nth-child(4){width:16%}
.admin-table th:nth-child(5),.admin-table td:nth-child(5){width:14%}
.admin-table th:nth-child(6),.admin-table td:nth-child(6){width:14%}
.admin-cell-clip{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:0}
.admin-role{display:inline-block;padding:2px 8px;border-radius:4px;background:rgba(255,255,255,.08);font-size:.75rem;font-weight:700}
.admin-role.is-admin{background:rgba(234,179,8,.2);color:#eab308}
@media (max-width:700px){
  .admin-table{table-layout:auto;min-width:560px}
  .admin-cell-clip{max-width:180px}
}
</style>
