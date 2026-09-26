<?php $url_base = constant('URL_BASE'); ?>

<!-- Hero Section Principal (Colores: Negro, Azul, Amarillo, Blanco) -->
<section class="hero-theme-section relative text-white border-b border-slate-800/80 overflow-hidden">
    <!-- Fondo con gradiente sutil y cuadrícula arquitectónica limpia -->
    <div class="absolute inset-0 opacity-15 pointer-events-none" style="background-image: linear-gradient(to right, rgba(255,255,255,0.07) 1px, transparent 1px), linear-gradient(to bottom, rgba(255,255,255,0.07) 1px, transparent 1px); background-size: 40px 40px;"></div>
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 -right-32 w-96 h-96 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-6 py-20 lg:py-28 flex flex-col lg:flex-row items-center justify-between gap-14">
        
        <!-- Columna Izquierda: Información Principal -->
        <div class="w-full lg:w-7/12 flex flex-col items-start text-left">
            
            <!-- Badge Oficial -->
            <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-amber-400/10 text-amber-300 border border-amber-400/30 mb-6">
                <i class="fa-solid fa-graduation-cap text-amber-400"></i> Plataforma de Orientación Vocacional Universitaria
            </div>

            <!-- Título Humano y Contundente -->
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-heading font-extrabold text-white leading-tight tracking-tight mb-6">
                Elige tu vocación con certeza y asegura tu <span class="text-amber-400">futuro profesional</span>
            </h1>

            <!-- Descripción -->
            <p class="text-slate-300 text-lg sm:text-xl leading-relaxed mb-8 max-w-2xl font-normal">
                Diseñado para estudiantes que van a ingresar a la educación superior: evalúa tus fortalezas cognitivas con nuestro test vocacional, compara programas de las mejores universidades del país y descubre becas con cobertura total.
            </p>

            <!-- Botones de Acción Directos -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 w-full sm:w-auto mb-12">
                <a href="<?php echo $url_base; ?>cuestionarios/inicio" class="inline-flex justify-center items-center gap-3 px-8 py-4 bg-amber-400 hover:bg-amber-300 text-black font-extrabold rounded-xl shadow-lg shadow-amber-400/20 hover:-translate-y-0.5 transition duration-200 text-base">
                    <span>Comenzar Test Vocacional</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
                <a href="<?php echo $url_base; ?>universidades/inicio" class="inline-flex justify-center items-center gap-2.5 px-7 py-4 hero-light-btn bg-slate-900/90 hover:bg-slate-800 text-white font-semibold rounded-xl border border-slate-700/80 hover:border-slate-500 hover:-translate-y-0.5 transition duration-200 text-base">
                    <i class="fa-solid fa-building-columns text-blue-400"></i>
                    <span>Ver Universidades</span>
                </a>
            </div>

            <!-- Métricas / Indicadores de Confianza -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 pt-6 border-t border-slate-800/80 w-full">
                <div>
                    <div class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">+120</div>
                    <div class="text-xs text-slate-400 uppercase tracking-wider font-semibold mt-1">Universidades</div>
                </div>
                <div>
                    <div class="text-2xl sm:text-3xl font-extrabold text-amber-400 tracking-tight">+500</div>
                    <div class="text-xs text-slate-400 uppercase tracking-wider font-semibold mt-1">Carreras</div>
                </div>
                <div>
                    <div class="text-2xl sm:text-3xl font-extrabold text-blue-400 tracking-tight">100%</div>
                    <div class="text-xs text-slate-400 uppercase tracking-wider font-semibold mt-1">Gratuito</div>
                </div>
                <div>
                    <div class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">ICFES</div>
                    <div class="text-xs text-slate-400 uppercase tracking-wider font-semibold mt-1">Saber 11</div>
                </div>
            </div>

        </div>

        <!-- Columna Derecha: Tarjeta Interactiva de Exploración Vocacional -->
        <div class="w-full lg:w-5/12 max-w-lg mx-auto">
            <div class="bg-slate-900/90 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-2xl backdrop-blur-xl relative">
                
                <div class="flex items-center justify-between mb-5 pb-4 border-b border-slate-800">
                    <div>
                        <div class="text-xs font-bold uppercase tracking-wider text-amber-400 flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                            Simulador en vivo
                        </div>
                        <h2 class="text-xl font-heading font-bold text-white mt-1">Explora por áreas de afinidad</h2>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-blue-600/20 text-blue-400 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-compass"></i>
                    </div>
                </div>

                <!-- Pestañas de las 6 Áreas RIASEC (Filadd + Holland) -->
                <div class="grid grid-cols-3 gap-1.5 mb-6" id="areaTabs">
                    <button type="button" class="area-tab-btn active px-2 py-2 rounded-xl text-xs font-bold flex flex-col items-center justify-center gap-1 transition duration-150 bg-blue-600 text-white" onclick="selectArea('tech')">
                        <i class="fa-solid fa-screwdriver-wrench"></i> <span>Técnica (R)</span>
                    </button>
                    <button type="button" class="area-tab-btn px-2 py-2 rounded-xl text-xs font-bold flex flex-col items-center justify-center gap-1 transition duration-150 bg-slate-800/80 text-slate-300 hover:bg-slate-800" onclick="selectArea('salud')">
                        <i class="fa-solid fa-microscope"></i> <span>Científica (I)</span>
                    </button>
                    <button type="button" class="area-tab-btn px-2 py-2 rounded-xl text-xs font-bold flex flex-col items-center justify-center gap-1 transition duration-150 bg-slate-800/80 text-slate-300 hover:bg-slate-800" onclick="selectArea('diseno')">
                        <i class="fa-solid fa-palette"></i> <span>Artística (A)</span>
                    </button>
                    <button type="button" class="area-tab-btn px-2 py-2 rounded-xl text-xs font-bold flex flex-col items-center justify-center gap-1 transition duration-150 bg-slate-800/80 text-slate-300 hover:bg-slate-800" onclick="selectArea('social')">
                        <i class="fa-solid fa-hand-holding-heart"></i> <span>Social (S)</span>
                    </button>
                    <button type="button" class="area-tab-btn px-2 py-2 rounded-xl text-xs font-bold flex flex-col items-center justify-center gap-1 transition duration-150 bg-slate-800/80 text-slate-300 hover:bg-slate-800" onclick="selectArea('negocios')">
                        <i class="fa-solid fa-chart-line"></i> <span>Negocios (E)</span>
                    </button>
                    <button type="button" class="area-tab-btn px-2 py-2 rounded-xl text-xs font-bold flex flex-col items-center justify-center gap-1 transition duration-150 bg-slate-800/80 text-slate-300 hover:bg-slate-800" onclick="selectArea('admin')">
                        <i class="fa-solid fa-clipboard-check"></i> <span>Gestión (C)</span>
                    </button>
                </div>

                <!-- Contenido Dinámico de la Tarjeta -->
                <div id="areaContent" class="bg-slate-950/70 border border-slate-800 rounded-2xl p-5 mb-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <span id="areaCategory" class="text-xs font-bold px-2.5 py-1 rounded-md bg-blue-500/20 text-blue-400 border border-blue-500/30">Ingeniería & Software</span>
                        <span id="areaDemand" class="text-xs font-medium text-amber-400"><i class="fa-solid fa-star"></i> Alta Demanda Laboral</span>
                    </div>

                    <div>
                        <div class="text-xs text-slate-400 font-medium mb-1">Perfil y competencias:</div>
                        <p id="areaDescription" class="text-sm text-slate-200 leading-snug">
                            Pensamiento analítico, resolución estructurada de problemas y pasión por la innovación tecnológica.
                        </p>
                    </div>

                    <div>
                        <div class="text-xs text-slate-400 font-medium mb-2">Carreras sugeridas en Colombia:</div>
                        <div id="areaCareers" class="flex flex-wrap gap-1.5">
                            <span class="px-2.5 py-1 rounded-lg text-xs bg-slate-800 text-white font-medium">Ingeniería de Sistemas</span>
                            <span class="px-2.5 py-1 rounded-lg text-xs bg-slate-800 text-white font-medium">Ciencia de Datos</span>
                            <span class="px-2.5 py-1 rounded-lg text-xs bg-slate-800 text-white font-medium">Ciberseguridad</span>
                        </div>
                    </div>

                    <div class="pt-2 border-t border-slate-800/80 flex items-center justify-between text-xs text-slate-400">
                        <span>Universidades líderes:</span>
                        <strong id="areaUnis" class="text-white font-semibold">U. Nacional, UniAndes, EAFIT</strong>
                    </div>
                </div>

                <!-- Botón de acción en la tarjeta -->
                <a href="<?php echo $url_base; ?>programas/inicio" class="simulator-catalog-btn w-full py-3 px-4 rounded-xl bg-slate-800 hover:bg-slate-700 text-white text-sm font-bold flex items-center justify-center gap-2 border border-slate-700 transition">
                    <span>Explorar catálogo de programas</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>

            </div>
        </div>

    </div>
</section>

<!-- Barra Rápida de Búsqueda y Filtros de Interés -->
<section class="bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 py-8 px-6">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="flex items-center gap-3 w-full md:w-auto">
            <div class="w-10 h-10 rounded-xl bg-amber-400 text-black flex items-center justify-center font-bold text-lg shrink-0">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div>
                <h3 class="text-base font-bold text-slate-900 dark:text-white leading-tight">Búsqueda rápida por vocación</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">Encuentra al instante programas, instituciones y becas vigentes</p>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider mr-1">Filtros frecuentes:</span>
            <a href="<?php echo $url_base; ?>programas/inicio" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-blue-600 hover:text-white transition">
                Ingeniería de Sistemas
            </a>
            <a href="<?php echo $url_base; ?>programas/inicio" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-blue-600 hover:text-white transition">
                Medicina
            </a>
            <a href="<?php echo $url_base; ?>programas/inicio" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-blue-600 hover:text-white transition">
                Derecho
            </a>
            <a href="<?php echo $url_base; ?>programas/inicio" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-blue-600 hover:text-white transition">
                Psicología
            </a>
            <a href="<?php echo $url_base; ?>becas/inicio" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-amber-400/20 text-amber-700 dark:text-amber-300 border border-amber-400/40 hover:bg-amber-400 hover:text-black transition">
                <i class="fa-solid fa-award"></i> Becas 100%
            </a>
        </div>
    </div>
</section>

<!-- Proceso en 3 Pasos Metodológicos -->
<section class="py-20 px-6 max-w-7xl mx-auto">
    <div class="text-center max-w-3xl mx-auto mb-16">
        <span class="text-xs font-extrabold uppercase tracking-wider text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 px-3.5 py-1 rounded-full">
            Metodología Orientada al Éxito
        </span>
        <h2 class="text-3xl sm:text-4xl font-heading font-extrabold text-slate-900 dark:text-white mt-4 mb-4">
            Tu camino hacia la universidad en 3 pasos
        </h2>
        <p class="text-base sm:text-lg text-slate-600 dark:text-slate-400">
            Un proceso estructurado para eliminar la incertidumbre y ayudarte a tomar una decisión informada, respaldada por datos y opciones reales.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <!-- Paso 1 -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-8 relative flex flex-col justify-between shadow-sm hover:shadow-md transition">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <span class="w-12 h-12 rounded-2xl bg-blue-600 text-white font-heading font-extrabold text-xl flex items-center justify-center shadow-md shadow-blue-600/30">
                        01
                    </span>
                    <i class="fa-solid fa-brain text-2xl text-slate-400"></i>
                </div>
                <h3 class="text-xl font-heading font-bold text-slate-900 dark:text-white mb-3">
                    Diagnóstico de Habilidades
                </h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed mb-6">
                    Responde preguntas situacionales e intereses de conocimiento para mapear tus inteligencias dominantes y áreas de mayor potencial.
                </p>
            </div>
            <a href="<?php echo $url_base; ?>cuestionarios/inicio" class="inline-flex items-center gap-2 text-sm font-bold text-blue-600 dark:text-blue-400 hover:underline">
                Realizar test vocacional <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        <!-- Paso 2 -->
        <div class="bg-white dark:bg-slate-900 border-2 border-amber-400/80 rounded-3xl p-8 relative flex flex-col justify-between shadow-sm hover:shadow-md transition">
            <div class="absolute -top-3 right-6 bg-amber-400 text-black text-[11px] font-extrabold uppercase tracking-wider px-3 py-0.5 rounded-full shadow">
                Comparador Oficial
            </div>
            <div>
                <div class="flex items-center justify-between mb-6">
                    <span class="w-12 h-12 rounded-2xl bg-amber-400 text-black font-heading font-extrabold text-xl flex items-center justify-center shadow-md shadow-amber-400/30">
                        02
                    </span>
                    <i class="fa-solid fa-scale-balanced text-2xl text-amber-500"></i>
                </div>
                <h3 class="text-xl font-heading font-bold text-slate-900 dark:text-white mb-3">
                    Comparación de Opciones
                </h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed mb-6">
                    Cruza resultados con instituciones acreditadas. Analiza planes curriculares, costos semestrales, sedes y modalidades formativas.
                </p>
            </div>
            <a href="<?php echo $url_base; ?>universidades/inicio" class="inline-flex items-center gap-2 text-sm font-bold text-amber-600 dark:text-amber-400 hover:underline">
                Explorar directorio <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        <!-- Paso 3 -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-8 relative flex flex-col justify-between shadow-sm hover:shadow-md transition">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <span class="w-12 h-12 rounded-2xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 font-heading font-extrabold text-xl flex items-center justify-center shadow-md">
                        03
                    </span>
                    <i class="fa-solid fa-award text-2xl text-slate-400"></i>
                </div>
                <h3 class="text-xl font-heading font-bold text-slate-900 dark:text-white mb-3">
                    Financiación y Becas
                </h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed mb-6">
                    Identifica oportunidades de becas públicas y privadas vigentes con los requisitos que ya cumples, facilitando tu ingreso seguro.
                </p>
            </div>
            <a href="<?php echo $url_base; ?>becas/inicio" class="inline-flex items-center gap-2 text-sm font-bold text-blue-600 dark:text-blue-400 hover:underline">
                Consultar becas vigentes <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

    </div>
</section>

<!-- Catálogo Destacado: Universidades de Alta Calidad y Becas Activas -->
<section class="py-16 px-6 bg-slate-50 dark:bg-slate-950/60 border-y border-slate-200 dark:border-slate-800/80">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400">Ecosistema Académico</span>
                <h2 class="text-3xl font-heading font-extrabold text-slate-900 dark:text-white mt-1">Instituciones y Becas Destacadas</h2>
            </div>
            <div class="flex items-center gap-3">
                <a href="<?php echo $url_base; ?>universidades/inicio" class="text-sm font-bold text-blue-600 dark:text-blue-400 hover:underline flex items-center gap-1.5">
                    Ver todas las universidades <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Columna de Universidades Reales -->
            <div class="space-y-4">
                <div class="text-sm font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 flex items-center gap-2 mb-3">
                    <i class="fa-solid fa-building-columns text-blue-600"></i> Universidades Líderes en Colombia
                </div>

                <!-- Universidad 1 -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 flex items-center justify-between gap-4 hover:border-blue-500 transition">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-lg shrink-0">
                            UN
                        </div>
                        <div>
                            <h4 class="font-heading font-bold text-slate-900 dark:text-white text-base">Universidad Nacional de Colombia</h4>
                            <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                <span><i class="fa-solid fa-location-dot"></i> Bogotá / Medellín</span>
                                <span>•</span>
                                <span class="text-emerald-600 dark:text-emerald-400 font-semibold">Pública · Alta Calidad</span>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo $url_base; ?>universidades/inicio" class="px-3.5 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-xs font-bold hover:bg-blue-600 hover:text-white transition shrink-0">
                        Ver Ficha
                    </a>
                </div>

                <!-- Universidad 2 -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 flex items-center justify-between gap-4 hover:border-blue-500 transition">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 flex items-center justify-center font-bold text-lg shrink-0">
                            UA
                        </div>
                        <div>
                            <h4 class="font-heading font-bold text-slate-900 dark:text-white text-base">Universidad de los Andes</h4>
                            <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                <span><i class="fa-solid fa-location-dot"></i> Bogotá</span>
                                <span>•</span>
                                <span class="text-blue-600 dark:text-blue-400 font-semibold">Privada · Convenios Globales</span>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo $url_base; ?>universidades/inicio" class="px-3.5 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-xs font-bold hover:bg-blue-600 hover:text-white transition shrink-0">
                        Ver Ficha
                    </a>
                </div>

                <!-- Universidad 3 -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 flex items-center justify-between gap-4 hover:border-blue-500 transition">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-lg shrink-0">
                            UD
                        </div>
                        <div>
                            <h4 class="font-heading font-bold text-slate-900 dark:text-white text-base">Universidad de Antioquia</h4>
                            <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                <span><i class="fa-solid fa-location-dot"></i> Medellín</span>
                                <span>•</span>
                                <span class="text-emerald-600 dark:text-emerald-400 font-semibold">Pública · Investigación</span>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo $url_base; ?>universidades/inicio" class="px-3.5 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-xs font-bold hover:bg-blue-600 hover:text-white transition shrink-0">
                        Ver Ficha
                    </a>
                </div>

                <!-- Universidad 4 -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 flex items-center justify-between gap-4 hover:border-blue-500 transition">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 flex items-center justify-center font-bold text-lg shrink-0">
                            UJ
                        </div>
                        <div>
                            <h4 class="font-heading font-bold text-slate-900 dark:text-white text-base">Pontificia Universidad Javeriana</h4>
                            <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                <span><i class="fa-solid fa-location-dot"></i> Bogotá</span>
                                <span>•</span>
                                <span class="text-blue-600 dark:text-blue-400 font-semibold">Privada · Formación Integral</span>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo $url_base; ?>universidades/inicio" class="px-3.5 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-xs font-bold hover:bg-blue-600 hover:text-white transition shrink-0">
                        Ver Ficha
                    </a>
                </div>

            </div>

            <!-- Columna de Becas y Apoyos Activos -->
            <div class="space-y-4">
                <div class="text-sm font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 flex items-center gap-2 mb-3">
                    <i class="fa-solid fa-award text-amber-500"></i> Convocatorias y Becas Vigentes
                </div>

                <!-- Beca 1 -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 hover:border-amber-400 transition">
                    <div class="flex items-start justify-between gap-3 mb-2">
                        <div>
                            <span class="text-[11px] font-extrabold uppercase px-2 py-0.5 rounded bg-amber-400/20 text-amber-700 dark:text-amber-300">
                                100% Matrícula
                            </span>
                            <h4 class="font-heading font-bold text-slate-900 dark:text-white text-base mt-2">Beca Nacional de Excelencia Académica</h4>
                        </div>
                        <span class="text-xs text-slate-500 dark:text-slate-400 shrink-0">Saber 11 > 380</span>
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mb-3">
                        Exclusivo para bachilleres de alto rendimiento escolar y clasificación Sisbén IV (grupos A, B o C).
                    </p>
                    <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100 dark:border-slate-800">
                        <span class="text-slate-500"><i class="fa-regular fa-clock"></i> Convocatoria semestral</span>
                        <a href="<?php echo $url_base; ?>becas/inicio" class="font-bold text-blue-600 dark:text-blue-400 hover:underline">Ver requisitos</a>
                    </div>
                </div>

                <!-- Beca 2 -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 hover:border-amber-400 transition">
                    <div class="flex items-start justify-between gap-3 mb-2">
                        <div>
                            <span class="text-[11px] font-extrabold uppercase px-2 py-0.5 rounded bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300">
                                Mujeres en Tecnología
                            </span>
                            <h4 class="font-heading font-bold text-slate-900 dark:text-white text-base mt-2">Beca STEM para Ingenierías y Datos</h4>
                        </div>
                        <span class="text-xs text-slate-500 dark:text-slate-400 shrink-0">Promedio > 4.5</span>
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mb-3">
                        Financiación total en programas de Ciencias de la Computación, Matemáticas y Ciencias Aplicadas.
                    </p>
                    <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100 dark:border-slate-800">
                        <span class="text-slate-500"><i class="fa-regular fa-clock"></i> Modalidad presencial / virtual</span>
                        <a href="<?php echo $url_base; ?>becas/inicio" class="font-bold text-blue-600 dark:text-blue-400 hover:underline">Ver requisitos</a>
                    </div>
                </div>

                <!-- Beca 3 -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 hover:border-amber-400 transition">
                    <div class="flex items-start justify-between gap-3 mb-2">
                        <div>
                            <span class="text-[11px] font-extrabold uppercase px-2 py-0.5 rounded bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300">
                                Crédito Condonable
                            </span>
                            <h4 class="font-heading font-bold text-slate-900 dark:text-white text-base mt-2">Fondo Educación Superior EPM / Sapiencia</h4>
                        </div>
                        <span class="text-xs text-slate-500 dark:text-slate-400 shrink-0">Valle de Aburrá</span>
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mb-3">
                        Matrícula y apoyo económico de sostenimiento con condonación mediante horas de servicio social.
                    </p>
                    <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100 dark:border-slate-800">
                        <span class="text-slate-500"><i class="fa-regular fa-clock"></i> Estratos 1, 2, 3 y 4</span>
                        <a href="<?php echo $url_base; ?>becas/inicio" class="font-bold text-blue-600 dark:text-blue-400 hover:underline">Ver requisitos</a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<!-- Testimonios de Estudiantes Reales -->
<section class="py-20 px-6 max-w-7xl mx-auto">
    <div class="text-center max-w-2xl mx-auto mb-16">
        <span class="text-xs font-bold uppercase tracking-wider text-amber-500">Experiencias Universitarias</span>
        <h2 class="text-3xl font-heading font-extrabold text-slate-900 dark:text-white mt-1">Estudiantes que definieron su rumbo</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm">
            <div class="flex items-center gap-3.5 mb-4">
                <div class="w-11 h-11 rounded-full bg-blue-600 text-white font-extrabold flex items-center justify-center text-sm">
                    LG
                </div>
                <div>
                    <h3 class="font-heading font-bold text-slate-900 dark:text-white text-sm">Laura Gómez</h3>
                    <span class="text-xs text-slate-500 dark:text-slate-400">Medicina · U. Nacional</span>
                </div>
            </div>
            <p class="text-slate-600 dark:text-slate-300 text-sm italic leading-relaxed">
                "Dudaba entre Bioquímica y Medicina. El test vocacional me ayudó a entender cómo mi perfil respondía mejor al contacto asistencial. Hoy estoy en 4° semestre con beca de excelencia."
            </p>
        </div>

        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm">
            <div class="flex items-center gap-3.5 mb-4">
                <div class="w-11 h-11 rounded-full bg-amber-400 text-black font-extrabold flex items-center justify-center text-sm">
                    DM
                </div>
                <div>
                    <h3 class="font-heading font-bold text-slate-900 dark:text-white text-sm">Diego Morales</h3>
                    <span class="text-xs text-slate-500 dark:text-slate-400">Ingeniería de Sistemas · EAFIT</span>
                </div>
            </div>
            <p class="text-slate-600 dark:text-slate-300 text-sm italic leading-relaxed">
                "Comparé los planes de estudio y las jornadas directamente en el portal. Me ahorró semanas de buscar en páginas de universidades y me dio seguridad total para matricularme."
            </p>
        </div>

        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm">
            <div class="flex items-center gap-3.5 mb-4">
                <div class="w-11 h-11 rounded-full bg-slate-900 text-white dark:bg-slate-800 font-extrabold flex items-center justify-center text-sm">
                    AS
                </div>
                <div>
                    <h3 class="font-heading font-bold text-slate-900 dark:text-white text-sm">Andrea Salazar</h3>
                    <span class="text-xs text-slate-500 dark:text-slate-400">Arquitectura · Javeriana</span>
                </div>
            </div>
            <p class="text-slate-600 dark:text-slate-300 text-sm italic leading-relaxed">
                "El módulo de becas me permitió saber qué puntaje de ICFES necesitaba con exactitud para aplicar. Apliqué a tiempo y obtuve el subsidio institucional del 50%."
            </p>
        </div>

    </div>
</section>

<!-- Preguntas Frecuentes (FAQ) -->
<section class="py-16 px-6 max-w-4xl mx-auto border-t border-slate-200 dark:border-slate-800">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-heading font-extrabold text-slate-900 dark:text-white">Preguntas Frecuentes</h2>
        <p class="text-sm text-slate-600 dark:text-slate-400 mt-2">Respuestas claras sobre la plataforma y el proceso vocacional.</p>
    </div>

    <div class="space-y-4">
        
        <details class="group bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-5 [&_summary::-webkit-details-marker]:hidden">
            <summary class="flex cursor-pointer items-center justify-between text-slate-900 dark:text-white font-bold text-base">
                <span>¿El test vocacional tiene algún costo?</span>
                <i class="fa-solid fa-chevron-down text-xs text-slate-400 group-open:rotate-180 transition duration-200"></i>
            </summary>
            <div class="mt-3 text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                No, el acceso al cuestionario psicotécnico y la generación de tu perfil con carreras sugeridas es completamente gratuito para todos los estudiantes.
            </div>
        </details>

        <details class="group bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-5 [&_summary::-webkit-details-marker]:hidden">
            <summary class="flex cursor-pointer items-center justify-between text-slate-900 dark:text-white font-bold text-base">
                <span>¿Cómo se calculan las recomendaciones de carrera?</span>
                <i class="fa-solid fa-chevron-down text-xs text-slate-400 group-open:rotate-180 transition duration-200"></i>
            </summary>
            <div class="mt-3 text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                El sistema evalúa tus respuestas en base al modelo de inteligencias múltiples de Howard Gardner y las correlaciona con la clasificación de áreas académicas reconocidas por el Ministerio de Educación Nacional.
            </div>
        </details>

        <details class="group bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-5 [&_summary::-webkit-details-marker]:hidden">
            <summary class="flex cursor-pointer items-center justify-between text-slate-900 dark:text-white font-bold text-base">
                <span>¿Las becas mostradas son de convocatorias oficiales?</span>
                <i class="fa-solid fa-chevron-down text-xs text-slate-400 group-open:rotate-180 transition duration-200"></i>
            </summary>
            <div class="mt-3 text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                Sí. Todas las convocatorias publicadas corresponden a programas de apoyo formal del Estado (ICETEX, MinEducación, Prosperidad Social) y fundaciones de universidades acreditadas.
            </div>
        </details>

    </div>
</section>

<!-- Call to Action Final (Azul, Oro, Blanco y Negro) -->
<section class="py-16 px-6 bg-[#020617] text-white text-center border-t border-slate-800">
    <div class="max-w-3xl mx-auto">
        <h2 class="text-3xl sm:text-4xl font-heading font-extrabold mb-4">
            Tu futuro universitario comienza con una decisión informada
        </h2>
        <p class="text-slate-400 text-base mb-8 max-w-xl mx-auto">
            Únete a la comunidad de estudiantes que ya tienen claro su camino académico. Realiza el test hoy y guarda tus carreras favoritas.
        </p>

        <?php if (!isset($_SESSION['usuario'])): ?>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="<?php echo $url_base; ?>cuestionarios/inicio" class="px-8 py-4 bg-amber-400 hover:bg-amber-300 text-black font-extrabold rounded-xl shadow-lg shadow-amber-400/20 transition duration-200">
                    <i class="fa-solid fa-compass mr-2"></i> Iniciar Test Vocacional
                </a>
                <a href="<?php echo $url_base; ?>usuarios/registro" class="px-8 py-4 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl shadow-lg shadow-blue-600/20 transition duration-200">
                    <i class="fa-solid fa-user-plus mr-2"></i> Crear Cuenta Gratis
                </a>
            </div>
        <?php else: ?>
            <a href="<?php echo $url_base; ?>usuarios/dashboard" class="inline-flex items-center gap-2 px-8 py-4 bg-amber-400 hover:bg-amber-300 text-black font-extrabold rounded-xl shadow-lg shadow-amber-400/20 transition duration-200">
                <i class="fa-solid fa-gauge"></i> Ir a mi Panel de Control
            </a>
        <?php endif; ?>
    </div>
</section>

<!-- Lógica del Simulador de Áreas Vocacionales -->
<script>
    const areaData = {
        tech: {
            category: "Técnica-Práctica (Realista)",
            demand: "Alta Demanda (92% Empleabilidad)",
            description: "Pensamiento lógico-espacial, desarrollo de software, automatización robótica y pasión por la tecnología tangible.",
            careers: ["Ingeniería de Sistemas", "Ingeniería Mecatrónica", "Ingeniería Civil", "Tecnología en Software"],
            unis: "UDES, UdeM, U. Nacional, UniAndes, EAFIT, ITM"
        },
        salud: {
            category: "Científica-Investigativa (Investigador)",
            demand: "Alta Demanda (91% Empleabilidad)",
            description: "Rigor científico, investigación biomédica, curiosidad por los fenómenos naturales y método analítico.",
            careers: ["Medicina Humana", "Bioingeniería", "Química Farmacéutica", "Nutrición y Dietética"],
            unis: "UDES, U. de Antioquia, Javeriana, UniAndes"
        },
        diseno: {
            category: "Artística-Creativa (Artístico)",
            demand: "Sector Creativo (83% Empleabilidad)",
            description: "Sensibilidad espacial y estética, comunicación visual, pensamiento divergente e innovación conceptual.",
            careers: ["Arquitectura y Urbanismo", "Diseño Gráfico", "Cine y Medios Audiovisuales", "Diseño Industrial"],
            unis: "UdeM, UDES, Javeriana, UPB, U. Nacional"
        },
        social: {
            category: "Social-Humanitaria (Social)",
            demand: "Vocación de Servicio (87% Empleabilidad)",
            description: "Empatía profunda, escucha activa, vocación de servicio, salud comunitaria y mediación de conflictos.",
            careers: ["Psicología", "Enfermería", "Comunicación Social", "Fisioterapia", "Trabajo Social"],
            unis: "UDES, UdeM, Javeriana, UdeA, U. del Valle"
        },
        negocios: {
            category: "Empresarial-Comercial (Emprendedor)",
            demand: "Liderazgo y Estrategia (90% Empleabilidad)",
            description: "Capacidad de negociación, persuasión, visión de nuevos negocios, liderazgo comercial y derecho.",
            careers: ["Administración de Empresas", "Negocios Internacionales", "Derecho", "Economía"],
            unis: "UdeM, UDES, EAFIT, UniAndes, CESA"
        },
        admin: {
            category: "Administrativa-Organizacional (Convencional)",
            demand: "Gestión y Control (89% Empleabilidad)",
            description: "Atención meticulosa al detalle, gestión de datos, auditoría contable, logística y optimización de procesos.",
            careers: ["Contaduría Pública", "Ingeniería Industrial", "Administración Pública", "Gestión de Datos"],
            unis: "UDES, UdeM, U. Nacional, Javeriana, ITM"
        }
    };

    function selectArea(areaKey) {
        const data = areaData[areaKey];
        if (!data) return;

        // Actualizar botones
        document.querySelectorAll('.area-tab-btn').forEach(btn => {
            btn.classList.remove('bg-blue-600', 'text-white', 'active');
            btn.classList.add('bg-slate-800/80', 'text-slate-300');
        });
        const activeBtn = event.currentTarget;
        activeBtn.classList.remove('bg-slate-800/80', 'text-slate-300');
        activeBtn.classList.add('bg-blue-600', 'text-white', 'active');

        // Actualizar contenido
        document.getElementById('areaCategory').textContent = data.category;
        document.getElementById('areaDemand').innerHTML = '<i class="fa-solid fa-star"></i> ' + data.demand;
        document.getElementById('areaDescription').textContent = data.description;
        document.getElementById('areaUnis').textContent = data.unis;

        // Carreras en chips
        const careersContainer = document.getElementById('areaCareers');
        careersContainer.innerHTML = '';
        data.careers.forEach(c => {
            const span = document.createElement('span');
            span.className = 'px-2.5 py-1 rounded-lg text-xs bg-slate-800 text-white font-medium';
            span.textContent = c;
            careersContainer.appendChild(span);
        });
    }
</script>
