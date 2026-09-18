<?php if(!defined('URL_BASE')) exit; $url_base = constant('URL_BASE'); ?>
<div class="flex flex-col md:flex-row gap-6 mt-4">
    <!-- Sidebar Admin -->
    <aside class="w-full md:w-64 shrink-0 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 p-4">
        <div class="p-4 border-b border-slate-100 dark:border-slate-700 mb-4">
            <h2 class="text-xl font-bold font-heading text-slate-900 dark:text-white">Admin Panel</h2>
        </div>
        <nav class="space-y-2">
            <a href="<?php echo $url_base; ?>admin/dashboard" class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 font-medium rounded-xl transition-colors">
                <i class="fa-solid fa-chart-pie w-5"></i> Resumen
            </a>
            <a href="<?php echo $url_base; ?>admin/usuarios" class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 font-medium rounded-xl transition-colors">
                <i class="fa-solid fa-users w-5"></i> Usuarios
            </a>
            <a href="<?php echo $url_base; ?>admin/universidades" class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 font-medium rounded-xl transition-colors">
                <i class="fa-solid fa-building-columns w-5"></i> Universidades
            </a>
            <a href="<?php echo $url_base; ?>admin/becas" class="flex items-center gap-3 px-4 py-3 bg-brand-gold/10 text-brand-darkgold font-medium rounded-xl">
                <i class="fa-solid fa-award w-5"></i> Becas
            </a>
            <a href="<?php echo $url_base; ?>admin/simulacros" class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 font-medium rounded-xl transition-colors">
                <i class="fa-solid fa-clipboard-list w-5"></i> Tests y Simulacros
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1">
        <header class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold font-heading text-slate-900 dark:text-white">Becas</h1>
                <p class="text-slate-500 dark:text-slate-400">Gestiona las oportunidades de financiamiento disponibles.</p>
            </div>
            <a href="<?php echo $url_base; ?>admin/becaForm" class="btn btn-primary bg-brand-dark hover:bg-brand-blue">
                <i class="fa-solid fa-plus"></i> Nueva Beca
            </a>
        </header>

        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-slate-600 dark:text-slate-300">
                    <thead class="bg-slate-50 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 font-medium text-sm">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Nombre de la Beca</th>
                            <th class="px-6 py-4">Campus / Entidad</th>
                            <th class="px-6 py-4">Fecha Límite</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        <?php if(!empty($becas)): ?>
                        <?php foreach($becas as $beca): ?>
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-4">#<?php echo $beca['id_becas']; ?></td>
                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                <?php echo htmlspecialchars($beca['nombre_beca'] ?? ''); ?>
                            </td>
                            <td class="px-6 py-4"><?php echo htmlspecialchars($beca['campus'] ?? '-'); ?></td>
                            <td class="px-6 py-4">
                                <?php if(!empty($beca['fecha_limite'])): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo (strtotime($beca['fecha_limite']) < time()) ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'; ?>">
                                        <?php echo date('d/m/Y', strtotime($beca['fecha_limite'])); ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-slate-400">Sin fecha</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <?php if(!empty($beca['enlace'])): ?>
                                    <a href="<?php echo htmlspecialchars($beca['enlace']); ?>" target="_blank" class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors" title="Ver enlace externo">
                                        <i class="fa-solid fa-external-link-alt"></i>
                                    </a>
                                    <?php endif; ?>
                                    <a href="<?php echo $url_base; ?>admin/becaForm?id=<?php echo $beca['id_becas']; ?>" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Editar">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="<?php echo $url_base; ?>admin/eliminarBeca?id=<?php echo $beca['id_becas']; ?>" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar esta beca?');">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                <i class="fa-solid fa-award text-3xl mb-3 text-slate-300 block"></i>
                                No hay becas registradas. Haz clic en "Nueva Beca" para empezar.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
