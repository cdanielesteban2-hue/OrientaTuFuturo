<?php $url_base = constant('URL_BASE'); ?>

<!-- Hero Section Principal -->
<section class="hero-theme-section relative text-white border-b border-slate-800/80 overflow-hidden">
    <div class="absolute inset-0 opacity-15 pointer-events-none" style="background-image: linear-gradient(to right, rgba(255,255,255,0.07) 1px, transparent 1px), linear-gradient(to bottom, rgba(255,255,255,0.07) 1px, transparent 1px); background-size: 40px 40px;"></div>
    <div class="relative max-w-7xl mx-auto px-6 py-20 lg:py-28 flex flex-col lg:flex-row items-center justify-between gap-14">
        <div class="w-full lg:w-7/12 flex flex-col items-start text-left">
            <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-amber-400/10 text-amber-300 border border-amber-400/30 mb-6">
                <i class="fa-solid fa-graduation-cap text-amber-400"></i> Plataforma de Orientación Vocacional Universitaria
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-heading font-extrabold text-white leading-tight tracking-tight mb-6">
                Elige tu vocación con certeza y asegura tu <span class="text-amber-400">futuro profesional</span>
            </h1>
            <p class="text-slate-300 text-lg sm:text-xl leading-relaxed mb-8 max-w-2xl font-normal">
                Diseñado para estudiantes que van a ingresar a la educación superior: evalúa tus fortalezas con el test vocacional, compara programas y descubre becas.
            </p>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 w-full sm:w-auto mb-12">
                <a href="<?php echo $url_base; ?>cuestionarios/inicio" class="inline-flex justify-center items-center gap-3 px-8 py-4 bg-amber-400 hover:bg-amber-300 text-black font-extrabold rounded-xl shadow-lg shadow-amber-400/20 transition text-base">
                    <span>Comenzar Test Vocacional</span> <i class="fa-solid fa-arrow-right"></i>
                </a>
                <a href="<?php echo $url_base; ?>universidades/inicio" class="inline-flex justify-center items-center gap-2.5 px-7 py-4 bg-slate-900/90 hover:bg-slate-800 text-white font-semibold rounded-xl border border-slate-700/80 transition text-base">
                    <i class="fa-solid fa-building-columns text-blue-400"></i> <span>Ver Universidades</span>
                </a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 pt-6 border-t border-slate-800/80 w-full">
                <div><div class="text-2xl sm:text-3xl font-extrabold text-white">+120</div><div class="text-xs text-slate-400 uppercase font-semibold mt-1">Universidades</div></div>
                <div><div class="text-2xl sm:text-3xl font-extrabold text-amber-400">+500</div><div class="text-xs text-slate-400 uppercase font-semibold mt-1">Carreras</div></div>
                <div><div class="text-2xl sm:text-3xl font-extrabold text-blue-400">100%</div><div class="text-xs text-slate-400 uppercase font-semibold mt-1">Gratuito</div></div>
                <div><div class="text-2xl sm:text-3xl font-extrabold text-white">ICFES</div><div class="text-xs text-slate-400 uppercase font-semibold mt-1">Saber 11</div></div>
            </div>
        </div>
        <div class="w-full lg:w-5/12 max-w-lg mx-auto">
            <div class="bg-slate-900/90 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-2xl">
                <div class="text-xs font-bold uppercase tracking-wider text-amber-400 mb-2">Simulador en vivo</div>
                <h2 class="text-xl font-heading font-bold text-white mb-4">Explora por áreas de afinidad</h2>
                <p class="text-sm text-slate-300 mb-4">Toma el test RIASEC, compara universidades y practica Pre-ICFES en un solo lugar.</p>
                <a href="<?php echo $url_base; ?>programas/inicio" class="w-full py-3 px-4 rounded-xl bg-slate-800 hover:bg-slate-700 text-white text-sm font-bold flex items-center justify-center gap-2 border border-slate-700 transition">
                    Explorar catálogo de programas <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 py-8 px-6">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-amber-400 text-black flex items-center justify-center font-bold"><i class="fa-solid fa-magnifying-glass"></i></div>
            <div>
                <h3 class="text-base font-bold text-slate-900 dark:text-white">Búsqueda rápida por vocación</h3>
                <p class="text-xs text-slate-500">Programas, instituciones y becas vigentes</p>
            </div>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="<?php echo $url_base; ?>programas/inicio" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200">Ingeniería de Sistemas</a>
            <a href="<?php echo $url_base; ?>programas/inicio" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200">Medicina</a>
            <a href="<?php echo $url_base; ?>becas/inicio" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-amber-400/20 text-amber-700 dark:text-amber-300 border border-amber-400/40">Becas 100%</a>
        </div>
    </div>
</section>
