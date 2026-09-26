import { Question, RiasecKey, RiasecProfile } from '../types/vocational';

export const RIASEC_PROFILES: Record<RiasecKey, RiasecProfile> = {
  R: {
    key: 'R',
    letter: 'R',
    name: 'Técnica-Práctica (Realista)',
    shortName: 'Realista / Hacedor',
    filaddArea: 'Técnica-Práctica',
    color: '#2563eb', // Blue-600
    bgLight: '#eff6ff',
    icon: 'wrench',
    tagline: 'Construcción, tecnología tangible y resolución aplicada',
    description: 'Posees un enfoque eminentemente pragmático y orientado a la acción tangible. Disfrutas entender cómo funcionan los mecanismos físicos, la infraestructura digital, el hardware y los procesos operativos. Prefieres trabajar con herramientas, código de bajo nivel o maquinaria antes que con abstracciones puramente teóricas.',
    keySkills: ['Pensamiento lógico-espacial', 'Resolución técnica de problemas', 'Manejo de herramientas y tecnología', 'Destreza en prototipado'],
    workEnvironments: ['Laboratorios de robótica y computación', 'Obras de infraestructura civil', 'Plantas industriales automatizadas', 'Centros de operaciones técnicas'],
    studyHabits: 'Aprendizaje kinestésico y práctico: aprendes mejor construyendo proyectos reales, resolviendo casos técnicos y programando en lugar de solo memorizar apuntes.'
  },
  I: {
    key: 'I',
    letter: 'I',
    name: 'Científica-Investigativa (Investigador)',
    shortName: 'Investigador / Pensador',
    filaddArea: 'Científica-Investigativa',
    color: '#059669', // Emerald-600
    bgLight: '#ecfdf5',
    icon: 'microscope',
    tagline: 'Ciencia, investigación rigurosa y salud humana',
    description: 'Tu mente se estimula mediante el análisis metódico, la curiosidad intelectual y el método científico. Te apasiona comprender el origen profundo de los fenómenos naturales, la biología, la medicina, la química o las leyes matemáticas. Valoras el rigor, la evidencia comprobable y la búsqueda de la verdad.',
    keySkills: ['Razonamiento analítico complejo', 'Capacidad deductiva y científica', 'Diagnóstico e investigación clínica', 'Interpretación estadística'],
    workEnvironments: ['Institutos de investigación científica', 'Clínicas y hospitales de alta complejidad', 'Laboratorios biotecnológicos', 'Centros de desarrollo de algoritmos'],
    studyHabits: 'Aprendizaje investigativo: disfrutas leer artículos científicos, sintetizar literatura especializada, comprobar hipótesis y profundizar hasta entender la raíz conceptual.'
  },
  A: {
    key: 'A',
    letter: 'A',
    name: 'Artística-Creativa (Artístico)',
    shortName: 'Artístico / Creador',
    filaddArea: 'Artística-Creativa',
    color: '#db2777', // Pink-600
    bgLight: '#fdf2f8',
    icon: 'palette',
    tagline: 'Diseño, narrativa visual, innovación y estética',
    description: 'Tu motor vital es la imaginación, la originalidad y la estética. Te expresas a través de formas, colores, narrativas, sonidos o experiencias espaciales. Prefieres entornos dinámicos y flexibles donde se premie pensar fuera de la caja y romper convenciones estandarizadas.',
    keySkills: ['Pensamiento lateral y disruptivo', 'Diseño visual y espacial', 'Narrativa y comunicación expresiva', 'Sensibilidad armónica y estilística'],
    workEnvironments: ['Estudios de diseño y animación', 'Firmas de arquitectura y urbanismo', 'Agencias de creatividad y medios digitales', 'Talleres de producción artística'],
    studyHabits: 'Aprendizaje visual y conceptual: sintetizas información a través de mapas mentales, bocetos, diagramas estéticos y proyectos experimentales sin estructuras rígidas.'
  },
  S: {
    key: 'S',
    letter: 'S',
    name: 'Social-Humanitaria (Social)',
    shortName: 'Social / Servidor',
    filaddArea: 'Social-Humanitaria',
    color: '#ea580c', // Orange-600
    bgLight: '#fff7ed',
    icon: 'heart-handshake',
    tagline: 'Empatía, bienestar humano, docencia y salud mental',
    description: 'Te caracterizas por una profunda vocación de servicio, empatía e inteligencia interpersonal. Disfrutas acompañar a otras personas en su crecimiento emocional, educativo o de salud física. Te motiva el impacto social directo, la defensa de los derechos y la construcción de comunidades más solidarias y justas.',
    keySkills: ['Escucha activa y contención emocional', 'Facilidad pedagógica', 'Resolución pacífica de conflictos', 'Liderazgo comunitario y ético'],
    workEnvironments: ['Consultorios psicológicos y fundaciones', 'Instituciones educativas y universidades', 'Centros comunitarios y ONG internacionales', 'Hospitales en áreas de rehabilitación'],
    studyHabits: 'Aprendizaje colaborativo: asimilas mejor el conocimiento en discusiones grupales, debates reflexivos, asesorías entre pares y aplicando la teoría a problemáticas humanas reales.'
  },
  E: {
    key: 'E',
    letter: 'E',
    name: 'Empresarial-Comercial (Emprendedor)',
    shortName: 'Emprendedor / Líder',
    filaddArea: 'Empresarial-Comercial',
    color: '#7c3aed', // Violet-600
    bgLight: '#f5f3ff',
    icon: 'trending-up',
    tagline: 'Liderazgo estratégico, persuasión y creación de valor',
    description: 'Posees iniciativa, energía negociadora y visión estratégica. Te estimulan los desafíos comerciales, liderar equipos hacia metas ambiciosas, emprender proyectos innovadores y tomar decisiones clave bajo presión. Tienes facilidad para comunicar con convicción y motivar a otros.',
    keySkills: ['Liderazgo y gestión de proyectos', 'Persuasión y oratoria convincente', 'Visión financiera y estratégica', 'Tolerancia al riesgo calculado'],
    workEnvironments: ['Empresas multinacionales y startups de impacto', 'Sector bancario y financiero', 'Firmas de consultoría y negocios internacionales', 'Organismos gubernamentales y de debate público'],
    studyHabits: 'Aprendizaje pragmático y competitivo: te motivan los simuladores de negocios, el estudio de casos de éxito empresarial, el trabajo con métricas de impacto y el debate dialéctico.'
  },
  C: {
    key: 'C',
    letter: 'C',
    name: 'Administrativa-Organizacional (Convencional)',
    shortName: 'Convencional / Gestor',
    filaddArea: 'Administrativa-Organizacional',
    color: '#475569', // Slate-600
    bgLight: '#f8fafc',
    icon: 'clipboard-list',
    tagline: 'Precisión, auditoría, logística y optimización de datos',
    description: 'Valoras el orden, la estructura lógica, la exactitud numérica y los procedimientos bien definidos. Eres sobresaliente planificando cronogramas, administrando presupuestos, auditando información y garantizando que los sistemas funcionen sin margen de error ni descontrol.',
    keySkills: ['Atención minuciosa al detalle', 'Análisis contable y fiscal', 'Gestión de bases de datos y logística', 'Cumplimiento normativo y auditoría'],
    workEnvironments: ['Firmas de auditoría contable y tributaria', 'Departamentos de analítica y bases de datos', 'Operaciones logísticas y de cadena de suministro', 'Entidades de regulación y control'],
    studyHabits: 'Aprendizaje sistemático: utilizas cronogramas rigurosos, listas de chequeo, resúmenes secuenciales estructurados y ejercicios repetitivos hasta dominar cada norma y fórmula.'
  }
};

export const VOCATIONAL_QUESTIONS: Question[] = [
  // --- DIMENSIÓN 1: INTERESES VOCACIONALES (Filadd + Holland) ---
  {
    id: 1,
    dimension: 'intereses',
    dimensionLabel: 'Dimensión 1: Intereses Vocacionales',
    question: '¿Qué tipo de actividades despiertan tu mayor entusiasmo y concentración en tu tiempo libre?',
    contextTip: 'Piensa en lo que harías por pura curiosidad y sin que nadie te lo obligue.',
    options: [
      { key: 'R', text: 'Programar, armar robots, configurar redes o desarmar aparatos para comprender su mecanismo.' },
      { key: 'I', text: 'Leer sobre descubrimientos en medicina, astronomía, genética o resolver enigmas matemáticos.' },
      { key: 'A', text: 'Dibujar, diseñar logotipos o ropa, escribir historias, editar videos o componer melodías.' },
      { key: 'S', text: 'Escuchar a amigos en crisis, hacer voluntariado social o enseñar materias a compañeros.' },
      { key: 'E', text: 'Planear negocios, vender productos, debatir sobre economía o liderar comités estudiantiles.' },
      { key: 'C', text: 'Organizar colecciones, llevar tablas de gastos personales o catalogar información con pulcritud.' }
    ]
  },
  {
    id: 2,
    dimension: 'intereses',
    dimensionLabel: 'Dimensión 1: Intereses Vocacionales',
    question: 'Si tuvieras la oportunidad de asistir a una conferencia magistral con un experto de talla mundial, ¿de qué temática elegirías?',
    contextTip: 'Imagina qué temas de actualidad te inspiran a profundizar durante horas.',
    options: [
      { key: 'R', text: 'Innovaciones en inteligencia artificial aplicada a la robótica, vehículos autónomos y energías limpias.' },
      { key: 'I', text: 'Nuevos tratamientos biotecnológicos para erradicar enfermedades complejas y neurociencias.' },
      { key: 'A', text: 'Tendencias globales en diseño arquitectónico sustentable, dirección de cine y arte contemporáneo.' },
      { key: 'S', text: 'Estrategias innovadoras de inclusión social, salud mental en jóvenes y pedagogía moderna.' },
      { key: 'E', text: 'Cómo escalar una startup de base tecnológica a nivel global y técnicas avanzadas de negociación.' },
      { key: 'C', text: 'Seguridad cibernética aplicada a finanzas corporativas, auditoría forense y macrodatos fiscales.' }
    ]
  },
  {
    id: 3,
    dimension: 'intereses',
    dimensionLabel: 'Dimensión 1: Intereses Vocacionales',
    question: 'Imagina que tu colegio o municipio organiza una semana interdisciplinaria. ¿En qué área preferirías liderar una muestra?',
    contextTip: 'Visualiza el stand donde te sentirías con mayor orgullo de mostrar tu talento.',
    options: [
      { key: 'R', text: 'Feria de robótica, domótica escolar o aplicaciones móviles desarrolladas por ti.' },
      { key: 'I', text: 'Laboratorio de experimentos químicos en vivo y muestra de biología molecular.' },
      { key: 'A', text: 'Galería de arte interactivo, diseño de escenografía, fotografía o podcast creativo.' },
      { key: 'S', text: 'Taller participativo de bienestar emocional, resolución de conflictos escolares y empatía.' },
      { key: 'E', text: 'Feria de emprendimiento con un modelo de negocio sostenible y ventas reales.' },
      { key: 'C', text: 'Oficina de logística del evento: manejo de cronogramas, acreditaciones y presupuesto.' }
    ]
  },
  {
    id: 4,
    dimension: 'intereses',
    dimensionLabel: 'Dimensión 1: Intereses Vocacionales',
    question: '¿Qué tipo de libros, podcasts o series de streaming consumes con mayor placer?',
    contextTip: 'Tus elecciones espontáneas de entretenimiento revelan mucho de tu brújula vocacional.',
    options: [
      { key: 'R', text: 'Documentales sobre mega-construcciones, ingeniería militar, tecnología aeroespacial y hardware.' },
      { key: 'I', text: 'Podcasts de divulgación médica, bioética, psicología del cerebro humano y misterios del cosmos.' },
      { key: 'A', text: 'Series con cinematografía deslumbrante, libros de literatura fantástica, diseño gráfico y moda.' },
      { key: 'S', text: 'Historias de líderes humanitarios, biografías de educadores y análisis de causas sociales.' },
      { key: 'E', text: 'Entrevistas a fundadores de unicornios empresariales, finanzas personales y geopolítica.' },
      { key: 'C', text: 'Casos reales de investigación de fraudes corporativos, optimización de tiempo y sistemas métricos.' }
    ]
  },

  // --- DIMENSIÓN 2: HABILIDADES Y APTITUDES (Modelo UDES de autoconocimiento) ---
  {
    id: 5,
    dimension: 'habilidades',
    dimensionLabel: 'Dimensión 2: Habilidades y Aptitudes',
    question: '¿Por cuál de estas habilidades sueles recibir más reconocimientos espontáneos de tus docentes y compañeros?',
    contextTip: 'Identifica esa cualidad que fluye en ti de manera casi natural frente a los demás.',
    options: [
      { key: 'R', text: 'Tu destreza lógica para reparar fallas técnicas, usar herramientas o entender diagramas.' },
      { key: 'I', text: 'Tu agudeza para hacer preguntas profundas, investigar fuentes fiables y sintetizar datos complejos.' },
      { key: 'A', text: 'Tu talento estético, imaginación para inventar historias o habilidad para crear diseños atractivos.' },
      { key: 'S', text: 'Tu capacidad de escuchar con paciencia, mediar en peleas y hacer sentir comprendida a la gente.' },
      { key: 'E', text: 'Tu carisma para convencer a la gente de tus ideas y coordinar grupos desmotivados.' },
      { key: 'C', text: 'Tu rigor con los detalles, puntualidad impecable y orden milimétrico en trabajos escritos.' }
    ]
  },
  {
    id: 6,
    dimension: 'habilidades',
    dimensionLabel: 'Dimensión 2: Habilidades y Aptitudes',
    question: 'Cuando un proyecto en equipo se encuentra bloqueado por un obstáculo imprevisto, ¿cuál es tu instinto principal?',
    contextTip: 'Tu reacción ante la incertidumbre muestra tus competencias más consolidadas.',
    options: [
      { key: 'R', text: 'Verificar la parte técnica o mecánica del trabajo y corregir los fallos funcionales uno por uno.' },
      { key: 'I', text: 'Analizar meticulosamente la causa raíz del error revisando la teoría y los datos antes de actuar.' },
      { key: 'A', text: 'Proponer un cambio de enfoque radical y creativo que sorprenda a todos y rompa la rutina.' },
      { key: 'S', text: 'Calmar los ánimos del grupo, motivar a los integrantes y repartir el apoyo de forma equitativa.' },
      { key: 'E', text: 'Tomar el timón, renegociar las fechas de entrega con el profesor y exigir resultados claros.' },
      { key: 'C', text: 'Revisar la rúbrica de evaluación oficial punto por punto para asegurar que cumplimos cada norma.' }
    ]
  },
  {
    id: 7,
    dimension: 'habilidades',
    dimensionLabel: 'Dimensión 2: Habilidades y Aptitudes',
    question: '¿En cuál de las siguientes áreas cognitivas sientes mayor fluidez y comodidad?',
    contextTip: 'Piensa en las asignaturas o destrezas donde notas que avanzas con menor esfuerzo relativo.',
    options: [
      { key: 'R', text: 'Física aplicada, informática práctica, dibujo técnico o geometría descriptiva.' },
      { key: 'I', text: 'Biología molecular, química general, cálculo infinitesimal o investigación científica.' },
      { key: 'A', text: 'Artes plásticas, literatura, producción audiovisual, música o diseño multimedia.' },
      { key: 'S', text: 'Filosofía, ciencias sociales, ética ciudadana, psicología o idiomas conversacionales.' },
      { key: 'E', text: 'Ciencias económicas, oratoria en público, debate competitivo o liderazgo estudiantil.' },
      { key: 'C', text: 'Estadística descriptiva, contabilidad básica, gestión de archivos y redacción estructurada.' }
    ]
  },
  {
    id: 8,
    dimension: 'habilidades',
    dimensionLabel: 'Dimensión 2: Habilidades y Aptitudes',
    question: 'Si tuvieras que enseñar una lección a un grupo de niños de primaria, ¿qué técnica te resultaría más intuitiva?',
    contextTip: 'La forma en que transmites conocimiento revela cómo procesas el mundo.',
    options: [
      { key: 'R', text: 'Ponerlos a armar un circuito eléctrico simple o una maqueta con piezas físicas.' },
      { key: 'I', text: 'Hacerles observar hojas de plantas con una lupa y guiarlos con preguntas científicas.' },
      { key: 'A', text: 'Estimularlos a pintar un mural libre, inventar un cuento de personajes fantásticos o actuar.' },
      { key: 'S', text: 'Hacer una ronda de diálogo sobre cómo se sienten, jugar a compartir y cultivar la empatía.' },
      { key: 'E', text: 'Simular una mini-tienda donde negocien roles, intercambien productos y ganen puntos.' },
      { key: 'C', text: 'Enseñarles a clasificar sus juguetes en casilleros ordenados con etiquetas y reglas de juego claras.' }
    ]
  },

  // --- DIMENSIÓN 3: HÁBITOS DE ESTUDIO Y RESOLUCIÓN DE PROBLEMAS ---
  {
    id: 9,
    dimension: 'habitos',
    dimensionLabel: 'Dimensión 3: Hábitos de Estudio',
    question: '¿Cómo preparas habitualmente un examen de alta exigencia académica?',
    contextTip: 'Tus hábitos actuales predicen en gran medida cómo rendirás en la educación superior.',
    options: [
      { key: 'R', text: 'Haciendo ejercicios prácticos y maquetas funcionales; la teoría pura sin práctica me agota.' },
      { key: 'I', text: 'Consultando varios libros, comparando explicaciones hasta que el concepto sea 100% claro.' },
      { key: 'A', text: 'Creando esquemas con colores llamativos, dibujos, mapas de ideas visuales o escuchando música.' },
      { key: 'S', text: 'Estudiando en grupo, explicándole el tema a otros compañeros para consolidar mis ideas.' },
      { key: 'E', text: 'Fijándome metas de alto rendimiento, compitiendo con amigos por la mejor nota y yendo al grano.' },
      { key: 'C', text: 'Siguiendo un horario estricto paso a paso, con fichas de memoria y resúmenes muy ordenados.' }
    ]
  },
  {
    id: 10,
    dimension: 'habitos',
    dimensionLabel: 'Dimensión 3: Hábitos de Estudio',
    question: 'Cuando estás frente a un problema con múltiples soluciones posibles, ¿qué criterio te da más certeza para elegir?',
    contextTip: 'Observa tu estándar interno de validación.',
    options: [
      { key: 'R', text: 'La opción que sea más viable técnicamente, duradera y comprobada en la práctica.' },
      { key: 'I', text: 'La opción que esté respaldada por evidencia científica concluyente y razonamiento lógico formal.' },
      { key: 'A', text: 'La opción que sea más innovadora, atractiva estéticamente y que transmita autenticidad.' },
      { key: 'S', text: 'La opción que beneficie a más personas y cause el menor daño emocional o humano.' },
      { key: 'E', text: 'La opción que ofrezca mayor rentabilidad, eficiencia de tiempo y ventaja estratégica.' },
      { key: 'C', text: 'La opción que cumpla estrictamente las normas legales y ofrezca el menor margen de error.' }
    ]
  },
  {
    id: 11,
    dimension: 'habitos',
    dimensionLabel: 'Dimensión 3: Hábitos de Estudio',
    question: '¿Qué tipo de retroalimentación de un profesor te resulta más constructiva y motivadora?',
    contextTip: 'El feedback que valoras refleja tus valores pedagógicos.',
    options: [
      { key: 'R', text: '"Tu modelo funciona a la perfección y resolviste el problema técnico con gran precisión."' },
      { key: 'I', text: '"Tu análisis teórico es brillante, demuestras una curiosidad y rigor científico destacable."' },
      { key: 'A', text: '"Tienes una mirada única, tu diseño es tremendamente original y con voz propia."' },
      { key: 'S', text: '"Demuestras una gran sensibilidad humana y tu trabajo genera un impacto comunitario real."' },
      { key: 'E', text: '"Tienes talento de líder: tu propuesta convence y tiene un gran potencial de mercado."' },
      { key: 'C', text: '"Tu trabajo es impecable en estructura, sin omisiones ni errores de formato."' }
    ]
  },
  {
    id: 12,
    dimension: 'habitos',
    dimensionLabel: 'Dimensión 3: Hábitos de Estudio',
    question: 'Imagina que tienes que elaborar un proyecto monográfico de grado. ¿Cuál sería tu metodología preferida?',
    contextTip: 'Visualiza la rutina diaria que mantendrías durante semanas.',
    options: [
      { key: 'R', text: 'Construir un prototipo tangible, software o dispositivo y someterlo a pruebas de rendimiento.' },
      { key: 'I', text: 'Formular una hipótesis científica rigurosa y recolectar datos empíricos en laboratorio o campo.' },
      { key: 'A', text: 'Producir una pieza artística, un diseño arquitectónico conceptual o un documental autoral.' },
      { key: 'S', text: 'Realizar un trabajo de campo con comunidades, encuestas psicosociales y talleres de acción.' },
      { key: 'E', text: 'Diseñar el plan de negocios financiero y legal de una empresa con proyección de impacto.' },
      { key: 'C', text: 'Analizar matrices de datos históricos, auditar balances y proponer guías estandarizadas.' }
    ]
  },

  // --- DIMENSIÓN 4: PREFERENCIAS DE VIDA Y SUEÑOS (UVirtualAbierta + UDES) ---
  {
    id: 13,
    dimension: 'estilo_vida',
    dimensionLabel: 'Dimensión 4: Estilo de Vida y Sueños',
    question: '¿En cuál de estos entornos de trabajo te visualizas feliz, realizado y con ganas de madrugar cada día?',
    contextTip: 'El espacio físico y social donde pasas 8 horas al día define tu bienestar futuro.',
    options: [
      { key: 'R', text: 'Un centro tecnológico de desarrollo, laboratorio de hardware o infraestructura de campo.' },
      { key: 'I', text: 'Un hospital universitario, instituto de investigación de vacunas o centro de datos científicos.' },
      { key: 'A', text: 'Un estudio de diseño luminoso, una productora de medios creativos o una agencia libre.' },
      { key: 'S', text: 'Un colegio, fundación humanitaria, clínica psicológica o centro comunitario de desarrollo.' },
      { key: 'E', text: 'Una sala de juntas ejecutiva, dirigiendo mi propia empresa o cerrando negocios internacionales.' },
      { key: 'C', text: 'Una firma de auditoría moderna, una entidad financiera o una dirección de logística de datos.' }
    ]
  },
  {
    id: 14,
    dimension: 'estilo_vida',
    dimensionLabel: 'Dimensión 4: Estilo de Vida y Sueños',
    question: 'Para ti, ¿qué logro personal definiría que tuviste un "éxito profesional auténtico" a los 35 años?',
    contextTip: 'Tus sueños vocacionales son la brújula para evitar la deserción universitaria.',
    options: [
      { key: 'R', text: 'Haber desarrollado un software, máquina o infraestructura que millones de personas usan a diario.' },
      { key: 'I', text: 'Haber contribuido a un descubrimiento científico o haber curado a cientos de pacientes graves.' },
      { key: 'A', text: 'Haber creado obras, diseños o contenidos visuales que conmuevan e inspiren a la cultura.' },
      { key: 'S', text: 'Saber que mi labor transformó la vida de comunidades vulnerables y personas con sufrimiento.' },
      { key: 'E', text: 'Tener independencia financiera total, haber generado empleo y liderar una empresa respetada.' },
      { key: 'C', text: 'Ser un referente de integridad y orden, con una carrera profesional estable, segura y valorada.' }
    ]
  },
  {
    id: 15,
    dimension: 'estilo_vida',
    dimensionLabel: 'Dimensión 4: Estilo de Vida y Sueños',
    question: 'Si recibieras una beca completa para hacer un voluntariado internacional de 6 meses, ¿a qué causa te postularías?',
    contextTip: 'Tus ideales éticos y solidarios muestran tu vocación más pura.',
    options: [
      { key: 'R', text: 'Instalación de paneles solares, redes de internet comunitario y agua potable en zonas rurales.' },
      { key: 'I', text: 'Apoyo a expediciones de biólogos en la Amazonía o investigación epidemiológica en hospitales.' },
      { key: 'A', text: 'Restauración de patrimonio histórico arquitectónico o creación de festivales de cine joven.' },
      { key: 'S', text: 'Educación y acompañamiento psicosocial a niños migrantes y programas de salud preventiva.' },
      { key: 'E', text: 'Asesorar a microempresarios locales en técnicas de venta, marketing digital y acceso a microcréditos.' },
      { key: 'C', text: 'Organizar la cadena de suministros de alimentos y medicinas para asegurar que nada se pierda.' }
    ]
  },
  {
    id: 16,
    dimension: 'estilo_vida',
    dimensionLabel: 'Dimensión 4: Estilo de Vida y Sueños',
    question: '¿Cuál es tu postura ante las normas, horarios rígidos y protocolos en el trabajo?',
    contextTip: 'Tu tolerancia a la estructura influye decisivamente en la elección de carrera.',
    options: [
      { key: 'R', text: 'Acepto las normas si tienen sentido práctico y me permiten concentrarme en construir resultados.' },
      { key: 'I', text: 'Prefiero la libertad intelectual para investigar sin límites, aunque respeto el método riguroso.' },
      { key: 'A', text: 'Me sofocan las reglas arbitrarias y los horarios fijos; necesito flexibilidad para crear.' },
      { key: 'S', text: 'Las normas son secundarias frente a las necesidades humanas y emocionales del momento.' },
      { key: 'E', text: 'Las normas son un marco que puedo adaptar o negociar estratégicamente para alcanzar objetivos.' },
      { key: 'C', text: 'Me encantan los manuales claros, los procedimientos definidos y los estándares previsibles.' }
    ]
  },
  {
    id: 17,
    dimension: 'estilo_vida',
    dimensionLabel: 'Dimensión 4: Estilo de Vida y Sueños',
    question: 'Al pensar en la economía de tu futuro profesional, ¿cuál es tu mayor prioridad?',
    contextTip: 'Equilibrar pasión y estabilidad es clave para una elección vocacional consciente.',
    options: [
      { key: 'R', text: 'Contar con una profesión técnica con altísima demanda en la industria tecnológica global.' },
      { key: 'I', text: 'Tener una carrera prestigiosa respaldada por años de estudio riguroso y aporte al conocimiento.' },
      { key: 'A', text: 'Vivir de mi vocación artística y creativa sin tener que traicionar mi identidad original.' },
      { key: 'S', text: 'Tener un salario digno haciendo lo que amo: ayudar a sanar, educar y transformar vidas.' },
      { key: 'E', text: 'Tener ingresos escalables sin techo, multiplicando mi capital mediante negocios e inversiones.' },
      { key: 'C', text: 'Garantizar máxima estabilidad contractual, previsibilidad financiera y seguridad a largo plazo.' }
    ]
  },
  {
    id: 18,
    dimension: 'estilo_vida',
    dimensionLabel: 'Dimensión 4: Estilo de Vida y Sueños',
    question: '¿Qué huella te gustaría dejar en la sociedad cuando mires hacia atrás al final de tu trayectoria profesional?',
    contextTip: 'La visión institucional de UDES y Universidad de Medellín: conectar tu pasión con el progreso del país.',
    options: [
      { key: 'R', text: 'Haber sido el constructor de herramientas tecnológicas que facilitaron la vida a la gente.' },
      { key: 'I', text: 'Haber sido el científico o profesional de la salud que salvó vidas o amplió la verdad humana.' },
      { key: 'A', text: 'Haber inspirado a generaciones con belleza, creatividad, diseño innovador y cultura viva.' },
      { key: 'S', text: 'Haber sido un pilar de compasión y justicia que devolvió la esperanza a quienes más lo necesitaban.' },
      { key: 'E', text: 'Haber sido el líder valiente que fundó empresas sólidas y modernizó la economía de su región.' },
      { key: 'C', text: 'Haber sido el garante de la transparencia, la precisión y la excelencia organizativa institucional.' }
    ]
  }
];
