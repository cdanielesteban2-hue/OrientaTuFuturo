<!-- Proceso en 3 Pasos -->
<section class="py-20 px-6 max-w-7xl mx-auto">
    <div class="text-center max-w-3xl mx-auto mb-16">
        <span class="text-xs font-extrabold uppercase tracking-wider text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 px-3.5 py-1 rounded-full">Metodología Orientada al Éxito</span>
        <h2 class="text-3xl sm:text-4xl font-heading font-extrabold text-slate-900 dark:text-white mt-4 mb-4">Tu camino hacia la universidad en 3 pasos</h2>
        <p class="text-base text-slate-600 dark:text-slate-400">Un proceso estructurado para tomar una decisión informada.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-8 shadow-sm">
            <span class="w-12 h-12 rounded-2xl bg-blue-600 text-white font-extrabold text-xl flex items-center justify-center mb-6">01</span>
            <h3 class="text-xl font-heading font-bold text-slate-900 dark:text-white mb-3">Diagnóstico de Habilidades</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400 mb-6">Responde preguntas situacionales para mapear tus áreas de mayor potencial.</p>
            <a href="<?php echo $url_base; ?>cuestionarios/inicio" class="text-sm font-bold text-blue-600 dark:text-blue-400 hover:underline">Realizar test vocacional →</a>
        </div>
        <div class="bg-white dark:bg-slate-900 border-2 border-amber-400/80 rounded-3xl p-8 shadow-sm relative">
            <div class="absolute -top-3 right-6 bg-amber-400 text-black text-[11px] font-extrabold uppercase px-3 py-0.5 rounded-full">Comparador</div>
            <span class="w-12 h-12 rounded-2xl bg-amber-400 text-black font-extrabold text-xl flex items-center justify-center mb-6">02</span>
            <h3 class="text-xl font-heading font-bold text-slate-900 dark:text-white mb-3">Comparación de Opciones</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400 mb-6">Analiza planes curriculares, costos, sedes y modalidades.</p>
            <a href="<?php echo $url_base; ?>universidades/inicio" class="text-sm font-bold text-amber-600 dark:text-amber-400 hover:underline">Explorar directorio →</a>
        </div>
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-8 shadow-sm">
            <span class="w-12 h-12 rounded-2xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 font-extrabold text-xl flex items-center justify-center mb-6">03</span>
            <h3 class="text-xl font-heading font-bold text-slate-900 dark:text-white mb-3">Financiación y Becas</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400 mb-6">Identifica becas públicas y privadas con los requisitos que cumples.</p>
            <a href="<?php echo $url_base; ?>becas/inicio" class="text-sm font-bold text-blue-600 dark:text-blue-400 hover:underline">Consultar becas →</a>
        </div>
    </div>
</section>

<!-- Bloque ICFES (reemplaza testimonios) -->
<section class="py-16 px-6 max-w-7xl mx-auto">
    <div class="rounded-3xl border border-slate-200 dark:border-slate-800 bg-gradient-to-br from-blue-50 to-white dark:from-slate-900 dark:to-slate-950 p-8 md:p-12 shadow-sm">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <div>
                <span class="text-xs font-extrabold uppercase tracking-wider text-blue-600 dark:text-blue-400 bg-blue-100 dark:bg-blue-900/40 border border-blue-200 dark:border-blue-800 px-3.5 py-1 rounded-full">Puntaje ICFES / Saber 11</span>
                <h2 class="text-3xl sm:text-4xl font-heading font-extrabold text-slate-900 dark:text-white mt-4 mb-3">¿A qué universidad entras con tu ICFES?</h2>
                <p class="text-slate-600 dark:text-slate-400 text-base leading-relaxed mb-6">Ingresa tus puntajes por área, elige una carrera y mira en qué universidades podrías entrar y cuántos puntos te faltan.</p>
                <ol class="space-y-3 text-sm text-slate-600 dark:text-slate-300 mb-8">
                    <li class="flex gap-3"><span class="w-6 h-6 rounded-full bg-blue-600 text-white text-xs font-bold flex items-center justify-center shrink-0">1</span> Escribe tus puntajes (0 a 100 por área).</li>
                    <li class="flex gap-3"><span class="w-6 h-6 rounded-full bg-blue-600 text-white text-xs font-bold flex items-center justify-center shrink-0">2</span> Calculamos tu ponderado según la carrera.</li>
                    <li class="flex gap-3"><span class="w-6 h-6 rounded-full bg-blue-600 text-white text-xs font-bold flex items-center justify-center shrink-0">3</span> Lo comparamos con el corte de admisión.</li>
                </ol>
                <a href="<?php echo $url_base; ?>simulacros/inicio" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm shadow-lg shadow-blue-600/25 transition">
                    <i class="fa-solid fa-calculator"></i> Ir a Pre-ICFES y practicar
                </a>
            </div>
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-md">
                <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-4"><i class="fa-solid fa-chart-simple text-amber-500"></i> Guarda tus puntajes en tu perfil</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between py-2 border-b border-slate-100 dark:border-slate-800"><span class="text-slate-500">Lectura crítica</span><span class="font-bold">0–100</span></div>
                    <div class="flex justify-between py-2 border-b border-slate-100 dark:border-slate-800"><span class="text-slate-500">Matemáticas</span><span class="font-bold">0–100</span></div>
                    <div class="flex justify-between py-2 border-b border-slate-100 dark:border-slate-800"><span class="text-slate-500">Sociales y ciudadanas</span><span class="font-bold">0–100</span></div>
                    <div class="flex justify-between py-2 border-b border-slate-100 dark:border-slate-800"><span class="text-slate-500">Ciencias naturales</span><span class="font-bold">0–100</span></div>
                    <div class="flex justify-between py-2"><span class="text-slate-500">Inglés</span><span class="font-bold">0–100</span></div>
                </div>
                <a href="<?php echo $url_base; ?>usuarios/dashboard" class="mt-5 w-full inline-flex justify-center items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-sm font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 transition">Completar en Mi Panel</a>
            </div>
        </div>
    </div>
</section>
