<?php $url_base = constant('URL_BASE'); ?>

<!-- Hero Section Premium Tailwind -->
<section id="hero-section" class="relative bg-brand-darker text-white overflow-hidden rounded-b-[40px] lg:rounded-b-[60px] pb-24 pt-20 px-6 lg:px-12 flex flex-col lg:flex-row items-center justify-between gap-12 max-w-[1400px] mx-auto">
    <!-- Background Particles -->
    <div id="tsparticles" class="absolute inset-0 z-0"></div>
    <div class="absolute inset-0 opacity-30 z-0" style="background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px); background-size: 24px 24px;"></div>
    
    <!-- Hero Text -->
    <div class="relative z-10 lg:w-1/2 flex flex-col items-center lg:items-start text-center lg:text-left">
        <div class="inline-flex items-center gap-2 bg-brand-gold/10 text-brand-gold border border-brand-gold/40 px-4 py-1.5 rounded-full text-sm font-bold uppercase tracking-wide mb-6">
            <i class="fa-solid fa-star"></i> Descubre tu verdadero potencial
        </div>
        
        <h1 class="text-5xl lg:text-7xl font-heading font-extrabold leading-tight mb-6">
            Diseña tu <span class="bg-gradient-to-r from-brand-gold to-yellow-600 bg-clip-text text-transparent">FUTURO</span> con confianza
        </h1>
        
        <p class="text-slate-400 text-lg lg:text-xl leading-relaxed mb-10 max-w-xl">
            Plataforma integral de orientación vocacional. Evaluamos tus habilidades, comparamos programas académicos y te conectamos con las mejores oportunidades de becas.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 mb-12">
            <a href="<?php echo $url_base; ?>cuestionarios/inicio" class="inline-flex justify-center items-center gap-2 px-8 py-4 bg-gradient-to-r from-brand-gold to-yellow-600 text-black font-bold rounded-xl hover:-translate-y-1 hover:shadow-[0_10px_25px_rgba(234,179,8,0.4)] transition-all duration-300">
                Comenzar Test <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="<?php echo $url_base; ?>universidades/inicio" class="inline-flex justify-center items-center gap-2 px-8 py-4 bg-transparent border-2 border-white/20 text-white font-bold rounded-xl hover:bg-white/10 hover:border-white hover:-translate-y-1 transition-all duration-300">
                <i class="fa-solid fa-magnifying-glass"></i> Explorar Opciones
            </a>
        </div>
        
        <!-- Stats -->
        <div class="flex items-center gap-6 lg:gap-10">
            <div class="flex flex-col">
                <strong class="text-3xl lg:text-4xl text-white leading-tight">+500</strong>
                <span class="text-slate-400 text-sm">Programas</span>
            </div>
            <div class="w-px h-10 bg-white/10"></div>
            <div class="flex flex-col">
                <strong class="text-3xl lg:text-4xl text-white leading-tight">100%</strong>
                <span class="text-slate-400 text-sm">Científico</span>
            </div>
            <div class="w-px h-10 bg-white/10"></div>
            <div class="flex flex-col">
                <strong class="text-3xl lg:text-4xl text-white leading-tight">Gratis</strong>
                <span class="text-slate-400 text-sm">Estudiantes</span>
            </div>
        </div>
    </div>
    
    <!-- Hero Visual / Carousel -->
    <div class="relative z-10 w-full lg:w-1/2 max-w-md lg:max-w-none">
        <div class="bg-white/5 border border-white/10 rounded-3xl p-8 backdrop-blur-md relative overflow-hidden h-[300px]">
            <div class="relative h-full" id="benefitsCarousel">
                
                <!-- Slide 1 -->
                <div class="absolute inset-0 transition-all duration-500 carousel-slide opacity-100 translate-x-0" data-index="0">
                    <div class="bg-white rounded-2xl p-8 h-full flex flex-col justify-center">
                        <div class="w-14 h-14 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-2xl mb-6">
                            <i class="fa-solid fa-brain"></i>
                        </div>
                        <h3 class="text-slate-900 text-2xl font-heading font-bold mb-3">Test Psicofisiológico</h3>
                        <p class="text-slate-600">Evaluamos tu aptitud y personalidad con precisión para encontrar la carrera ideal.</p>
                    </div>
                </div>
                
                <!-- Slide 2 -->
                <div class="absolute inset-0 transition-all duration-500 carousel-slide opacity-0 translate-x-8 pointer-events-none" data-index="1">
                    <div class="bg-white rounded-2xl p-8 h-full flex flex-col justify-center">
                        <div class="w-14 h-14 rounded-xl bg-yellow-100 text-yellow-600 flex items-center justify-center text-2xl mb-6">
                            <i class="fa-solid fa-award"></i>
                        </div>
                        <h3 class="text-slate-900 text-2xl font-heading font-bold mb-3">Directorio de Becas</h3>
                        <p class="text-slate-600">Accede a financiamiento y convenios exclusivos para asegurar tu futuro sin deudas.</p>
                    </div>
                </div>
                
                <!-- Slide 3 -->
                <div class="absolute inset-0 transition-all duration-500 carousel-slide opacity-0 translate-x-8 pointer-events-none" data-index="2">
                    <div class="bg-white rounded-2xl p-8 h-full flex flex-col justify-center">
                        <div class="w-14 h-14 rounded-xl bg-slate-100 text-slate-900 flex items-center justify-center text-2xl mb-6">
                            <i class="fa-solid fa-building-columns"></i>
                        </div>
                        <h3 class="text-slate-900 text-2xl font-heading font-bold mb-3">Catálogo Universitario</h3>
                        <p class="text-slate-600">Filtra y compara instituciones según tus preferencias, presupuesto y ubicación.</p>
                    </div>
                </div>
                
            </div>
            
            <div class="absolute bottom-6 left-0 right-0 flex justify-center gap-2">
                <button class="w-8 h-1 rounded-full bg-brand-gold transition-all duration-300 indicator" onclick="moveCarousel(0)"></button>
                <button class="w-6 h-1 rounded-full bg-white/20 transition-all duration-300 indicator" onclick="moveCarousel(1)"></button>
                <button class="w-6 h-1 rounded-full bg-white/20 transition-all duration-300 indicator" onclick="moveCarousel(2)"></button>
            </div>
        </div>
    </div>
</section>

<!-- Timeline: Cómo Funciona -->
<section class="py-24 px-6 max-w-[1200px] mx-auto">
    <div class="text-center mb-16" data-aos="fade-up">
        <h2 class="text-4xl font-heading font-bold text-slate-900 dark:text-white mb-4">Tu camino al éxito en 3 pasos</h2>
        <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">Un proceso diseñado para eliminar la incertidumbre de tu elección profesional.</p>
    </div>
    
    <div class="flex flex-col md:flex-row justify-between items-center md:items-start max-w-4xl mx-auto relative gap-8 md:gap-0">
        <!-- Connecting Line for Desktop -->
        <div class="hidden md:block absolute top-10 left-0 right-0 h-0.5 bg-slate-200 dark:bg-slate-700 z-0" data-aos="fade-in" data-aos-delay="300"></div>
        
        <!-- Step 1 -->
        <div class="relative z-10 flex flex-col items-center text-center w-full md:w-64 group" data-aos="fade-up" data-aos-delay="100">
            <div class="w-20 h-20 rounded-full bg-brand-blue text-white flex items-center justify-center text-2xl font-bold mb-6 shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">1</div>
            <h3 class="text-xl font-heading font-bold text-slate-900 dark:text-white mb-2">Descubre tu Perfil</h3>
            <p class="text-slate-600 dark:text-slate-400 text-sm">Realiza nuestro test interactivo para conocer tus inteligencias dominantes.</p>
        </div>
        
        <!-- Step 2 -->
        <div class="relative z-10 flex flex-col items-center text-center w-full md:w-64 group" data-aos="fade-up" data-aos-delay="300">
            <div class="w-20 h-20 rounded-full bg-brand-gold text-white flex items-center justify-center text-2xl font-bold mb-6 shadow-lg shadow-yellow-500/30 group-hover:scale-110 transition-transform duration-300">2</div>
            <h3 class="text-xl font-heading font-bold text-slate-900 dark:text-white mb-2">Compara Opciones</h3>
            <p class="text-slate-600 dark:text-slate-400 text-sm">Guarda y compara universidades y programas según tus resultados.</p>
        </div>
        
        <!-- Step 3 -->
        <div class="relative z-10 flex flex-col items-center text-center w-full md:w-64 group" data-aos="fade-up" data-aos-delay="500">
            <div class="w-20 h-20 rounded-full bg-brand-dark text-white flex items-center justify-center text-2xl font-bold mb-6 shadow-lg shadow-slate-900/30 group-hover:scale-110 transition-transform duration-300 border-2 border-slate-700">3</div>
            <h3 class="text-xl font-heading font-bold text-slate-900 dark:text-white mb-2">Asegura tu Ingreso</h3>
            <p class="text-slate-600 dark:text-slate-400 text-sm">Aplica a becas vigentes y toma una decisión informada.</p>
        </div>
    </div>
</section>

<!-- Bento Box Features -->
<section class="pb-24 px-6 max-w-[1200px] mx-auto">
    <div class="text-center mb-16" data-aos="fade-up">
        <h2 class="text-4xl font-heading font-bold text-slate-900 dark:text-white mb-4">Herramientas Premium a tu disposición</h2>
        <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">Todo lo que necesitas en una sola plataforma, diseñada con la mejor tecnología.</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 auto-rows-fr">
        <!-- Main Feature: Test -->
        <div class="md:col-span-1 md:row-span-2 bg-brand-darker text-white rounded-3xl p-10 relative overflow-hidden group hover:-translate-y-2 transition-transform duration-300 shadow-xl border border-slate-800" data-aos="fade-right">
            <div class="relative z-10 h-full flex flex-col">
                <div class="inline-block border border-brand-gold text-brand-gold px-3 py-1 rounded-full text-xs font-bold uppercase mb-6 w-fit">Precisión</div>
                <h3 class="text-3xl lg:text-4xl font-heading font-bold mb-4">Test Vocacional Inteligente</h3>
                <p class="text-slate-300 text-lg mb-8 max-w-md">Un algoritmo que cruza tus intereses con la demanda laboral actual para sugerirte la mejor ruta.</p>
                <div class="mt-auto">
                    <a href="<?php echo $url_base; ?>cuestionarios/inicio" class="inline-flex items-center gap-2 text-brand-gold font-bold hover:text-white transition-colors">
                        Realizar test ahora <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <i class="fa-solid fa-microscope absolute -bottom-10 -right-10 text-[12rem] text-white/5 group-hover:scale-110 transition-transform duration-500 z-0"></i>
        </div>
        
        <!-- Secondary 1: Universidades -->
        <div class="bg-brand-blue text-white rounded-3xl p-8 relative overflow-hidden group hover:-translate-y-2 transition-transform duration-300 shadow-lg border border-blue-600" data-aos="fade-left" data-aos-delay="100">
            <div class="relative z-10">
                <h3 class="text-2xl font-heading font-bold mb-3">Universidades</h3>
                <p class="text-blue-100 mb-6 max-w-sm">Conoce los mejores campus del país, sus metodologías y jornadas.</p>
                <a href="<?php echo $url_base; ?>universidades/inicio" class="inline-flex items-center gap-2 text-white font-bold hover:text-blue-200 transition-colors">
                    Explorar <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <i class="fa-solid fa-building-columns absolute -bottom-4 -right-4 text-[7rem] text-black/10 group-hover:scale-110 transition-transform duration-500 z-0"></i>
        </div>
        
        <!-- Secondary 2: Becas -->
        <div class="bg-white border-2 border-brand-gold text-slate-900 rounded-3xl p-8 relative overflow-hidden group hover:-translate-y-2 transition-transform duration-300 shadow-lg dark:bg-slate-800 dark:text-white dark:border-brand-gold/60" data-aos="fade-left" data-aos-delay="200">
            <div class="relative z-10">
                <h3 class="text-2xl font-heading font-bold mb-3">Becas y Apoyos</h3>
                <p class="text-slate-600 dark:text-slate-300 mb-6 max-w-sm">Financia tu carrera soñada hoy mismo con opciones exclusivas.</p>
                <a href="<?php echo $url_base; ?>becas/inicio" class="inline-flex items-center gap-2 text-slate-900 dark:text-white font-bold hover:text-brand-gold transition-colors">
                    Consultar <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <i class="fa-solid fa-hand-holding-dollar absolute -bottom-4 -right-4 text-[7rem] text-brand-gold/10 group-hover:scale-110 transition-transform duration-500 z-0"></i>
        </div>
    </div>
</section>

<!-- Testimonios Section -->
<section class="py-24 px-6 max-w-[1200px] mx-auto bg-slate-50 dark:bg-slate-900 rounded-3xl mb-16" data-aos="fade-up">
    <div class="text-center mb-16">
        <h2 class="text-4xl font-heading font-bold text-slate-900 dark:text-white mb-4">Lo que dicen nuestros estudiantes</h2>
        <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">Cientos de jóvenes ya encontraron su vocación y aseguraron su futuro con nosotros.</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Testimonial 1 -->
        <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 relative" data-aos="fade-up" data-aos-delay="100">
            <i class="fa-solid fa-quote-left text-4xl text-brand-gold/20 absolute top-6 right-6"></i>
            <div class="flex items-center gap-4 mb-6">
                <div class="w-14 h-14 bg-gradient-to-tr from-brand-blue to-blue-400 rounded-full flex items-center justify-center text-white font-bold text-xl">L</div>
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white">Laura G.</h4>
                    <span class="text-sm text-brand-blue dark:text-blue-400">Estudiante de Medicina</span>
                </div>
            </div>
            <p class="text-slate-600 dark:text-slate-300 italic">"Estaba muy perdida, pero el test psicofisiológico fue increíblemente exacto. Me dio la confianza para elegir Medicina y además encontré una beca del 50%."</p>
        </div>
        
        <!-- Testimonial 2 -->
        <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 relative" data-aos="fade-up" data-aos-delay="200">
            <i class="fa-solid fa-quote-left text-4xl text-brand-gold/20 absolute top-6 right-6"></i>
            <div class="flex items-center gap-4 mb-6">
                <div class="w-14 h-14 bg-gradient-to-tr from-brand-gold to-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-xl">D</div>
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white">Diego M.</h4>
                    <span class="text-sm text-brand-gold">Ingeniería de Software</span>
                </div>
            </div>
            <p class="text-slate-600 dark:text-slate-300 italic">"La herramienta para comparar universidades me ahorró semanas de investigación. Todo lo que necesitaba saber estaba en un solo lugar. ¡Totalmente recomendado!"</p>
        </div>
        
        <!-- Testimonial 3 -->
        <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 relative" data-aos="fade-up" data-aos-delay="300">
            <i class="fa-solid fa-quote-left text-4xl text-brand-gold/20 absolute top-6 right-6"></i>
            <div class="flex items-center gap-4 mb-6">
                <div class="w-14 h-14 bg-gradient-to-tr from-slate-700 to-slate-900 rounded-full flex items-center justify-center text-white font-bold text-xl">A</div>
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white">Andrea S.</h4>
                    <span class="text-sm text-slate-500 dark:text-slate-400">Arquitectura</span>
                </div>
            </div>
            <p class="text-slate-600 dark:text-slate-300 italic">"No creía que un test gratuito pudiera ser tan profesional. Me orientó hacia áreas creativas que no había considerado y ahora soy muy feliz con mi elección."</p>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="pb-24 px-6 max-w-[800px] mx-auto">
    <div class="text-center mb-12" data-aos="fade-up">
        <h2 class="text-3xl font-heading font-bold text-slate-900 dark:text-white mb-4">Preguntas Frecuentes</h2>
        <p class="text-slate-600 dark:text-slate-400">Resolvemos tus dudas principales para que des el siguiente paso con seguridad.</p>
    </div>
    
    <div class="space-y-4">
        <!-- FAQ Item 1 -->
        <details class="group bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 [&_summary::-webkit-details-marker]:hidden" data-aos="fade-up" data-aos-delay="100">
            <summary class="flex cursor-pointer items-center justify-between gap-1.5 p-6 text-slate-900 dark:text-white font-medium">
                <h3 class="font-bold text-lg">¿El Test Vocacional es realmente gratis?</h3>
                <span class="shrink-0 rounded-full bg-slate-50 dark:bg-slate-700 p-1.5 text-slate-900 dark:text-white sm:p-3">
                    <i class="fa-solid fa-plus transition duration-300 group-open:-rotate-45"></i>
                </span>
            </summary>
            <div class="px-6 pb-6 text-slate-600 dark:text-slate-300 leading-relaxed">
                Sí, el acceso al test psicofisiológico y la generación de tu perfil básico son 100% gratuitos para todos los estudiantes. Queremos que el factor económico no sea una barrera para tu orientación.
            </div>
        </details>
        
        <!-- FAQ Item 2 -->
        <details class="group bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 [&_summary::-webkit-details-marker]:hidden" data-aos="fade-up" data-aos-delay="200">
            <summary class="flex cursor-pointer items-center justify-between gap-1.5 p-6 text-slate-900 dark:text-white font-medium">
                <h3 class="font-bold text-lg">¿Cuánto tiempo se tarda en completar el test?</h3>
                <span class="shrink-0 rounded-full bg-slate-50 dark:bg-slate-700 p-1.5 text-slate-900 dark:text-white sm:p-3">
                    <i class="fa-solid fa-plus transition duration-300 group-open:-rotate-45"></i>
                </span>
            </summary>
            <div class="px-6 pb-6 text-slate-600 dark:text-slate-300 leading-relaxed">
                El test interactivo consta de múltiples secciones diseñadas para ser dinámicas. En promedio, los estudiantes lo completan en unos 15 a 20 minutos. Recomendamos hacerlo en un lugar tranquilo y sin distracciones.
            </div>
        </details>
        
        <!-- FAQ Item 3 -->
        <details class="group bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 [&_summary::-webkit-details-marker]:hidden" data-aos="fade-up" data-aos-delay="300">
            <summary class="flex cursor-pointer items-center justify-between gap-1.5 p-6 text-slate-900 dark:text-white font-medium">
                <h3 class="font-bold text-lg">¿Las becas mostradas están actualizadas?</h3>
                <span class="shrink-0 rounded-full bg-slate-50 dark:bg-slate-700 p-1.5 text-slate-900 dark:text-white sm:p-3">
                    <i class="fa-solid fa-plus transition duration-300 group-open:-rotate-45"></i>
                </span>
            </summary>
            <div class="px-6 pb-6 text-slate-600 dark:text-slate-300 leading-relaxed">
                Absolutamente. Nuestro equipo y algoritmos actualizan el directorio de becas semanalmente en colaboración directa con las instituciones educativas y fundaciones gubernamentales.
            </div>
        </details>
    </div>
</section>

<!-- Immersive Call to Action -->
<section class="relative py-24 px-6 text-center bg-brand-darker text-white overflow-hidden mt-10 rounded-t-[40px] lg:rounded-t-[60px] max-w-[1400px] mx-auto" data-aos="zoom-in" data-aos-duration="1000">
    <div class="absolute inset-0 z-0" style="background: radial-gradient(circle at center, rgba(37, 99, 235, 0.2) 0%, transparent 70%);"></div>
    
    <div class="relative z-10 max-w-3xl mx-auto">
        <h2 class="text-4xl lg:text-5xl font-heading font-bold mb-6">Únete a miles de estudiantes que ya encontraron su camino</h2>
        <p class="text-lg text-slate-400 mb-10">Crea tu perfil gratuito, guarda tus favoritos y no te pierdas ninguna oportunidad académica.</p>
        
        <?php if (!isset($_SESSION['usuario'])): ?>
            <a href="<?php echo $url_base; ?>usuarios/registro" class="inline-flex justify-center items-center gap-2 px-8 py-4 bg-gradient-to-r from-brand-gold to-yellow-600 text-black font-bold rounded-xl hover:-translate-y-1 hover:shadow-[0_10px_25px_rgba(234,179,8,0.4)] transition-all duration-300 text-lg">
                <i class="fa-solid fa-rocket"></i> Regístrate Gratis Ahora
            </a>
        <?php else: ?>
            <a href="<?php echo $url_base; ?>usuarios/dashboard" class="inline-flex justify-center items-center gap-2 px-8 py-4 bg-gradient-to-r from-brand-gold to-yellow-600 text-black font-bold rounded-xl hover:-translate-y-1 hover:shadow-[0_10px_25px_rgba(234,179,8,0.4)] transition-all duration-300 text-lg">
                <i class="fa-solid fa-gauge"></i> Ir a mi Panel de Control
            </a>
        <?php endif; ?>
    </div>
</section>

<!-- Carousel Logic -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const indicators = document.querySelectorAll('.indicator');
        let interval;
        
        window.moveCarousel = function(index) {
            slides.forEach(slide => {
                slide.classList.remove('opacity-100', 'translate-x-0');
                slide.classList.add('opacity-0', 'translate-x-8', 'pointer-events-none');
            });
            indicators.forEach(ind => {
                ind.classList.remove('bg-brand-gold', 'w-8');
                ind.classList.add('bg-white/20', 'w-6');
            });
            
            slides[index].classList.remove('opacity-0', 'translate-x-8', 'pointer-events-none');
            slides[index].classList.add('opacity-100', 'translate-x-0');
            
            indicators[index].classList.remove('bg-white/20', 'w-6');
            indicators[index].classList.add('bg-brand-gold', 'w-8');
            currentSlide = index;
            
            // Reset interval on manual click
            clearInterval(interval);
            startInterval();
        };
        
        function startInterval() {
            interval = setInterval(() => {
                if(slides.length > 0) {
                    let nextSlide = (currentSlide + 1) % slides.length;
                    moveCarousel(nextSlide);
                }
            }, 5000);
        }
        
        startInterval();
    });
</script>

<!-- tsParticles script & init -->
<script src="https://cdn.jsdelivr.net/npm/tsparticles-preset-links@2/tsparticles.preset.links.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if(typeof tsParticles !== 'undefined') {
            tsParticles.load("tsparticles", {
                preset: "links",
                background: {
                    color: {
                        value: "transparent",
                    },
                },
                particles: {
                    color: {
                        value: "#facc15",
                    },
                    links: {
                        color: "#2563eb",
                        distance: 150,
                        enable: true,
                        opacity: 0.3,
                        width: 1,
                    },
                    move: {
                        enable: true,
                        speed: 1,
                    },
                    number: {
                        density: {
                            enable: true,
                            area: 800,
                        },
                        value: 60,
                    },
                    opacity: {
                        value: 0.5,
                    },
                    size: {
                        value: { min: 1, max: 3 },
                    },
                },
                interactivity: {
                    events: {
                        onHover: {
                            enable: true,
                            mode: "grab",
                        },
                    },
                    modes: {
                        grab: {
                            distance: 200,
                            links: {
                                opacity: 0.5,
                            },
                        },
                    },
                },
            });
        }
    });
</script>
