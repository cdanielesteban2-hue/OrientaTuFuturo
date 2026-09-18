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
            <a href="<?php echo $url_base; ?>admin/universidades" class="flex items-center gap-3 px-4 py-3 bg-brand-gold/10 text-brand-darkgold font-medium rounded-xl">
                <i class="fa-solid fa-building-columns w-5"></i> Universidades
            </a>
            <a href="<?php echo $url_base; ?>admin/becas" class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 font-medium rounded-xl transition-colors">
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
                <h1 class="text-3xl font-bold font-heading text-slate-900 dark:text-white">Universidades</h1>
                <p class="text-slate-500 dark:text-slate-400">Directorio de instituciones de educación superior.</p>
            </div>
            <a href="<?php echo $url_base; ?>admin/universidadForm" class="btn btn-primary bg-brand-dark hover:bg-brand-blue">
                <i class="fa-solid fa-plus"></i> Nueva Universidad
            </a>
        </header>

        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-slate-600 dark:text-slate-300">
                    <thead class="bg-slate-50 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 font-medium text-sm">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Nombre</th>
                            <th class="px-6 py-4">Ciudad</th>
                            <th class="px-6 py-4">Tipo</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        <?php foreach($universidades as $uni): ?>
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-4">#<?php echo $uni['id_universidad']; ?></td>
                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                <?php echo htmlspecialchars($uni['nombre'] ?? ''); ?>
                            </td>
                            <td class="px-6 py-4"><?php echo htmlspecialchars($uni['ciudad'] ?? ''); ?></td>
                            <td class="px-6 py-4">
                                <?php if($uni['tipo'] == 'Pública'): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Pública</span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Privada</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="<?php echo $url_base; ?>admin/universidadForm?id=<?php echo $uni['id_universidad']; ?>" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Editar">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="<?php echo $url_base; ?>admin/eliminarUniversidad?id=<?php echo $uni['id_universidad']; ?>" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar esta universidad? Todos sus programas también podrían verse afectados.');">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if(empty($universidades)): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                No hay universidades registradas. Haz clic en "Nueva Universidad" para empezar.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
