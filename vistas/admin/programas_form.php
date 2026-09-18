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
        <header class="mb-6">
            <a href="<?php echo $url_base; ?>admin/programas?id_uni=<?php echo $universidad['id_universidad']; ?>" class="text-brand-blue hover:underline text-sm font-medium mb-2 inline-block"><i class="fa-solid fa-arrow-left"></i> Volver a Programas</a>
            <h1 class="text-3xl font-bold font-heading text-slate-900 dark:text-white">
                <?php echo $programa ? 'Editar Programa' : 'Nuevo Programa'; ?>
            </h1>
            <p class="text-slate-500 dark:text-slate-400">Universidad: <strong class="text-slate-700 dark:text-slate-200"><?php echo htmlspecialchars($universidad['nombre'] ?? 'N/A'); ?></strong></p>
        </header>

        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 p-6 md:p-8 max-w-3xl">
            <form action="<?php echo $url_base; ?>admin/guardarPrograma" method="POST" class="space-y-6">
                
                <input type="hidden" name="id_universidad" value="<?php echo $universidad['id_universidad']; ?>">
                <?php if($programa): ?>
                    <input type="hidden" name="id_programa" value="<?php echo $programa['id_programa']; ?>">
                <?php endif; ?>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Nombre del Programa</label>
                    <input type="text" name="n_programa" required 
                           value="<?php echo $programa ? htmlspecialchars($programa['n_programa']) : ''; ?>"
                           placeholder="Ej: Ingeniería de Sistemas"
                           class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue focus:border-transparent outline-none transition-all">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Área del Conocimiento</label>
                        <select name="area" required class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue focus:border-transparent outline-none transition-all">
                            <?php
                            $areas_lista = ['Ingeniería', 'Ciencias de la Salud', 'Ciencias Sociales', 'Ciencias Exactas', 'Artes', 'Humanidades', 'Ciencias Económicas', 'Derecho', 'Educación', 'Tecnología'];
                            foreach($areas_lista as $a):
                            ?>
                            <option value="<?php echo $a; ?>" <?php echo ($programa && $programa['area'] == $a) ? 'selected' : ''; ?>><?php echo $a; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Duración (semestres)</label>
                        <input type="number" name="duracion" min="1" max="16" required 
                               value="<?php echo $programa ? $programa['duracion'] : '10'; ?>"
                               class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue focus:border-transparent outline-none transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Costo por Semestre ($)</label>
                        <input type="number" name="costo" min="0" required 
                               value="<?php echo $programa ? $programa['costo'] : ''; ?>"
                               placeholder="Ej: 3500000"
                               class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue focus:border-transparent outline-none transition-all">
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 dark:border-slate-700 flex justify-end gap-4">
                    <a href="<?php echo $url_base; ?>admin/programas?id_uni=<?php echo $universidad['id_universidad']; ?>" class="btn btn-outline text-slate-600">Cancelar</a>
                    <button type="submit" class="btn btn-primary bg-brand-dark hover:bg-brand-blue">
                        <i class="fa-solid fa-save"></i> Guardar Programa
                    </button>
                </div>

            </form>
        </div>
    </main>
</div>
