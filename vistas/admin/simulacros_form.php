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
        <header class="mb-6">
            <a href="<?php echo $url_base; ?>admin/simulacros" class="text-brand-blue hover:underline text-sm font-medium mb-2 inline-block"><i class="fa-solid fa-arrow-left"></i> Volver a Simulacros</a>
            <h1 class="text-3xl font-bold font-heading text-slate-900 dark:text-white">
                <?php echo $simulacro ? 'Editar Simulacro' : 'Nuevo Simulacro'; ?>
            </h1>
        </header>

        <form action="<?php echo $url_base; ?>admin/guardarSimulacro" method="POST" id="simulacroForm">

            <?php if($simulacro): ?>
                <input type="hidden" name="id_simulacro" value="<?php echo $simulacro['id_simulacro']; ?>">
            <?php endif; ?>

            <!-- Datos generales del simulacro -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 p-6 md:p-8 mb-6">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4"><i class="fa-solid fa-info-circle text-brand-blue"></i> Información General</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Título del Simulacro</label>
                        <input type="text" name="titulo" required 
                               value="<?php echo $simulacro ? htmlspecialchars($simulacro['titulo']) : ''; ?>"
                               placeholder="Ej: Simulacro Matemáticas - Nivel Intermedio"
                               class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue focus:border-transparent outline-none transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Materia</label>
                        <select name="materia" required class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue focus:border-transparent outline-none transition-all">
                            <?php
                            $materias = ['Matemáticas', 'Lectura Crítica', 'Ciencias Naturales', 'Ciencias Sociales', 'Inglés', 'Competencias Ciudadanas', 'General'];
                            foreach($materias as $m):
                            ?>
                            <option value="<?php echo $m; ?>" <?php echo ($simulacro && $simulacro['materia'] == $m) ? 'selected' : ''; ?>><?php echo $m; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Color del Simulacro</label>
                        <div class="flex items-center gap-3">
                            <input type="color" name="color" 
                                   value="<?php echo $simulacro ? htmlspecialchars($simulacro['color'] ?? '#3b82f6') : '#3b82f6'; ?>"
                                   class="w-12 h-10 rounded-lg border border-slate-300 cursor-pointer">
                            <span class="text-sm text-slate-500">Selecciona un color representativo</span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Ícono (clase FontAwesome)</label>
                        <input type="text" name="icono" 
                               value="<?php echo $simulacro ? htmlspecialchars($simulacro['icono'] ?? 'fa-solid fa-book') : 'fa-solid fa-book'; ?>"
                               placeholder="fa-solid fa-calculator"
                               class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue focus:border-transparent outline-none transition-all">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Descripción</label>
                    <textarea name="descripcion" rows="3" 
                              placeholder="Descripción breve del simulacro..."
                              class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue focus:border-transparent outline-none transition-all"><?php echo $simulacro ? htmlspecialchars($simulacro['descripcion'] ?? '') : ''; ?></textarea>
                </div>
            </div>

            <!-- Preguntas existentes (si estamos editando) -->
            <?php if($simulacro && !empty($preguntas)): ?>
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 p-6 md:p-8 mb-6">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4">
                    <i class="fa-solid fa-list-check text-green-500"></i> 
                    Preguntas Existentes (<?php echo count($preguntas); ?>)
                </h2>
                
                <?php foreach($preguntas as $i => $preg): ?>
                <div class="border border-slate-200 dark:border-slate-600 rounded-xl p-5 mb-4 bg-slate-50 dark:bg-slate-700/30">
                    <div class="flex justify-between items-start mb-3">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-brand-blue text-white text-sm font-bold"><?php echo $i + 1; ?></span>
                        <a href="<?php echo $url_base; ?>admin/eliminarPreguntaSimulacro?id=<?php echo $preg['id_pregunta']; ?>&id_sim=<?php echo $simulacro['id_simulacro']; ?>" 
                           class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition-colors text-sm" 
                           onclick="return confirm('¿Eliminar esta pregunta?');"
                           title="Eliminar pregunta">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>

                    <input type="hidden" name="preguntas[<?php echo $i; ?>][id]" value="<?php echo $preg['id_pregunta']; ?>">
                    
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-500 mb-1">Pregunta</label>
                            <textarea name="preguntas[<?php echo $i; ?>][pregunta]" rows="2" required
                                      class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-blue outline-none"><?php echo htmlspecialchars($preg['pregunta']); ?></textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-blue-100 text-blue-700 text-xs font-bold shrink-0">A</span>
                                <input type="text" name="preguntas[<?php echo $i; ?>][opcion_a]" required value="<?php echo htmlspecialchars($preg['opcion_a']); ?>"
                                       class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue outline-none">
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-green-100 text-green-700 text-xs font-bold shrink-0">B</span>
                                <input type="text" name="preguntas[<?php echo $i; ?>][opcion_b]" required value="<?php echo htmlspecialchars($preg['opcion_b']); ?>"
                                       class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue outline-none">
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold shrink-0">C</span>
                                <input type="text" name="preguntas[<?php echo $i; ?>][opcion_c]" required value="<?php echo htmlspecialchars($preg['opcion_c']); ?>"
                                       class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue outline-none">
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-red-100 text-red-700 text-xs font-bold shrink-0">D</span>
                                <input type="text" name="preguntas[<?php echo $i; ?>][opcion_d]" required value="<?php echo htmlspecialchars($preg['opcion_d']); ?>"
                                       class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue outline-none">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-medium text-slate-500 mb-1">Respuesta Correcta</label>
                                <select name="preguntas[<?php echo $i; ?>][correcta]" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue outline-none">
                                    <option value="A" <?php echo ($preg['correcta'] == 'A') ? 'selected' : ''; ?>>A</option>
                                    <option value="B" <?php echo ($preg['correcta'] == 'B') ? 'selected' : ''; ?>>B</option>
                                    <option value="C" <?php echo ($preg['correcta'] == 'C') ? 'selected' : ''; ?>>C</option>
                                    <option value="D" <?php echo ($preg['correcta'] == 'D') ? 'selected' : ''; ?>>D</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-500 mb-1">Justificación (opcional)</label>
                                <input type="text" name="preguntas[<?php echo $i; ?>][justificacion]" value="<?php echo htmlspecialchars($preg['justificacion'] ?? ''); ?>"
                                       placeholder="¿Por qué esa es la respuesta?"
                                       class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue outline-none">
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Constructor de nuevas preguntas -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 p-6 md:p-8 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">
                        <i class="fa-solid fa-plus-circle text-brand-blue"></i> Agregar Nuevas Preguntas
                    </h2>
                    <button type="button" id="btnAgregarPregunta" class="btn btn-outline text-brand-blue border-brand-blue hover:bg-brand-blue/10 text-sm px-4 py-2 rounded-lg font-medium transition-colors">
                        <i class="fa-solid fa-plus"></i> Añadir Pregunta
                    </button>
                </div>
                
                <div id="nuevasPreguntas" class="space-y-4">
                    <!-- Las preguntas se agregan dinámicamente aquí -->
                </div>
                <p id="noPreguntas" class="text-center text-slate-400 py-6">
                    <i class="fa-solid fa-question-circle text-2xl block mb-2"></i>
                    Haz clic en "Añadir Pregunta" para agregar preguntas al simulacro.
                </p>
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-end gap-4">
                <a href="<?php echo $url_base; ?>admin/simulacros" class="btn btn-outline text-slate-600 px-6 py-3 rounded-xl font-medium">Cancelar</a>
                <button type="submit" class="btn btn-primary bg-brand-dark hover:bg-brand-blue px-6 py-3 rounded-xl font-medium">
                    <i class="fa-solid fa-save"></i> Guardar Simulacro y Preguntas
                </button>
            </div>

        </form>
    </main>
</div>

<script>
(function() {
    const container = document.getElementById('nuevasPreguntas');
    const btnAgregar = document.getElementById('btnAgregarPregunta');
    const noPreguntas = document.getElementById('noPreguntas');
    let counter = <?php echo $simulacro && !empty($preguntas) ? count($preguntas) : 0; ?>;

    function crearPregunta() {
        const idx = counter++;
        noPreguntas.style.display = 'none';

        const div = document.createElement('div');
        div.className = 'border border-dashed border-brand-blue/40 rounded-xl p-5 bg-blue-50/50 dark:bg-blue-900/10 relative';
        div.innerHTML = `
            <div class="flex justify-between items-start mb-3">
                <span class="inline-flex items-center gap-2 text-sm font-bold text-brand-blue">
                    <i class="fa-solid fa-circle-question"></i> Nueva Pregunta
                </span>
                <button type="button" onclick="this.closest('.border').remove(); checkEmpty();" class="p-1.5 text-red-500 hover:bg-red-100 rounded-lg transition-colors text-sm" title="Quitar">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1">Pregunta</label>
                    <textarea name="preguntas[${idx}][pregunta]" rows="2" required placeholder="Escribe aquí la pregunta..."
                              class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-blue outline-none"></textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-blue-100 text-blue-700 text-xs font-bold shrink-0">A</span>
                        <input type="text" name="preguntas[${idx}][opcion_a]" required placeholder="Opción A"
                               class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue outline-none">
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-green-100 text-green-700 text-xs font-bold shrink-0">B</span>
                        <input type="text" name="preguntas[${idx}][opcion_b]" required placeholder="Opción B"
                               class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue outline-none">
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold shrink-0">C</span>
                        <input type="text" name="preguntas[${idx}][opcion_c]" required placeholder="Opción C"
                               class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue outline-none">
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-red-100 text-red-700 text-xs font-bold shrink-0">D</span>
                        <input type="text" name="preguntas[${idx}][opcion_d]" required placeholder="Opción D"
                               class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">Respuesta Correcta</label>
                        <select name="preguntas[${idx}][correcta]" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue outline-none">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">Justificación (opcional)</label>
                        <input type="text" name="preguntas[${idx}][justificacion]" placeholder="¿Por qué esa es la respuesta?"
                               class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-blue outline-none">
                    </div>
                </div>
            </div>
        `;
        container.appendChild(div);
        div.querySelector('textarea').focus();
    }

    window.checkEmpty = function() {
        if (container.children.length === 0) {
            noPreguntas.style.display = 'block';
        }
    };

    btnAgregar.addEventListener('click', crearPregunta);
})();
</script>
