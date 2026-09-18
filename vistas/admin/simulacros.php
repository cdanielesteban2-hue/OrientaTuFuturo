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
            <a href="<?php echo $url_base; ?>admin/becas" class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 font-medium rounded-xl transition-colors">
                <i class="fa-solid fa-award w-5"></i> Becas
            </a>
            <a href="<?php echo $url_base; ?>admin/simulacros" class="flex items-center gap-3 px-4 py-3 bg-brand-gold/10 text-brand-darkgold font-medium rounded-xl">
                <i class="fa-solid fa-clipboard-list w-5"></i> Tests y Simulacros
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1">
        <header class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold font-heading text-slate-900 dark:text-white">Tests y Simulacros Pre-ICFES</h1>
                <p class="text-slate-500 dark:text-slate-400">Gestiona los simulacros disponibles para los estudiantes.</p>
            </div>
            <a href="<?php echo $url_base; ?>admin/simulacroForm" class="btn btn-primary bg-brand-dark hover:bg-brand-blue">
                <i class="fa-solid fa-plus"></i> Nuevo Simulacro
            </a>
        </header>

        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-slate-600 dark:text-slate-300">
                    <thead class="bg-slate-50 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 font-medium text-sm">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Título</th>
                            <th class="px-6 py-4">Materia</th>
                            <th class="px-6 py-4">Color</th>
                            <th class="px-6 py-4">Preguntas</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        <?php if(!empty($simulacros)): ?>
                        <?php foreach($simulacros as $sim): ?>
                        <?php
                            // Contar preguntas de este simulacro
                            $db_temp = baseDatos::crearInstancia();
                            $cnt = $db_temp->prepare("SELECT COUNT(*) FROM simulacro_preguntas WHERE id_simulacro = ?");
                            $cnt->execute([$sim['id_simulacro']]);
                            $numPreguntas = $cnt->fetchColumn();
                        ?>
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-4">#<?php echo $sim['id_simulacro']; ?></td>
                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                <div class="flex items-center gap-2">
                                    <?php if(!empty($sim['icono'])): ?>
                                    <i class="<?php echo htmlspecialchars($sim['icono']); ?>" style="color: <?php echo htmlspecialchars($sim['color'] ?? '#3b82f6'); ?>"></i>
                                    <?php endif; ?>
                                    <?php echo htmlspecialchars($sim['titulo'] ?? ''); ?>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300">
                                    <?php echo htmlspecialchars($sim['materia'] ?? 'General'); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-6 h-6 rounded-full border-2 border-white shadow-sm" style="background-color: <?php echo htmlspecialchars($sim['color'] ?? '#3b82f6'); ?>"></div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 dark:bg-slate-600 dark:text-slate-200">
                                    <?php echo $numPreguntas; ?> preguntas
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="<?php echo $url_base; ?>admin/simulacroForm?id=<?php echo $sim['id_simulacro']; ?>" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Editar / Agregar Preguntas">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="<?php echo $url_base; ?>admin/eliminarSimulacro?id=<?php echo $sim['id_simulacro']; ?>" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Eliminar" onclick="return confirm('¿Estás seguro? Se eliminarán TODAS las preguntas e intentos de este simulacro.');">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                                <i class="fa-solid fa-clipboard-list text-3xl mb-3 text-slate-300 block"></i>
                                No hay simulacros creados. Haz clic en "Nuevo Simulacro" para empezar.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
