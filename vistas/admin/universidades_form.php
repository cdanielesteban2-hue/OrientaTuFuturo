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
                <a href="<?php echo $url_base; ?>admin/universidades" class="text-brand-blue hover:underline text-sm font-medium mb-2 inline-block"><i class="fa-solid fa-arrow-left"></i> Volver a Universidades</a>
                <h1 class="text-3xl font-bold font-heading text-slate-900 dark:text-white">
                    <?php echo $universidad ? 'Editar Universidad' : 'Nueva Universidad'; ?>
                </h1>
            </div>
        </header>

        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 p-6 md:p-8 max-w-3xl">
            <form action="<?php echo $url_base; ?>admin/guardarUniversidad" method="POST" class="space-y-6">
                
                <?php if($universidad): ?>
                    <input type="hidden" name="id_universidad" value="<?php echo $universidad['id_universidad']; ?>">
                <?php endif; ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Nombre de la Institución</label>
                        <input type="text" name="nombre" required 
                               value="<?php echo $universidad ? htmlspecialchars($universidad['nombre']) : ''; ?>"
                               class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue focus:border-transparent outline-none transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Ciudad Principal</label>
                        <input type="text" name="ciudad" required 
                               value="<?php echo $universidad ? htmlspecialchars($universidad['ciudad']) : ''; ?>"
                               class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue focus:border-transparent outline-none transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Tipo de Institución</label>
                        <select name="tipo" required class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue focus:border-transparent outline-none transition-all">
                            <option value="Pública" <?php echo ($universidad && $universidad['tipo'] == 'Pública') ? 'selected' : ''; ?>>Pública</option>
                            <option value="Privada" <?php echo ($universidad && $universidad['tipo'] == 'Privada') ? 'selected' : ''; ?>>Privada</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Sitio Web Oficial</label>
                        <input type="url" name="sitio_web" 
                               value="<?php echo $universidad ? htmlspecialchars($universidad['sitio_web']) : ''; ?>"
                               class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue focus:border-transparent outline-none transition-all">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Jornadas Disponibles</label>
                    <input type="text" name="jornadas" placeholder="Ej: Diurna, Nocturna, Distancia" required 
                           value="<?php echo $universidad ? htmlspecialchars($universidad['jornadas']) : ''; ?>"
                           class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue focus:border-transparent outline-none transition-all">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Descripción Corta</label>
                    <textarea name="descripcion" rows="4" required
                              class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue focus:border-transparent outline-none transition-all"><?php echo $universidad ? htmlspecialchars($universidad['descripcion']) : ''; ?></textarea>
                </div>

                <div class="pt-4 border-t border-slate-100 dark:border-slate-700 flex justify-end gap-4">
                    <a href="<?php echo $url_base; ?>admin/universidades" class="btn btn-outline text-slate-600">Cancelar</a>
                    <button type="submit" class="btn btn-primary bg-brand-dark hover:bg-brand-blue">
                        <i class="fa-solid fa-save"></i> Guardar Institución
                    </button>
                </div>

            </form>
        </div>
    </main>
</div>
