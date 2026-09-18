-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2026 a las 13:13:02
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `orienta_tu_futuro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id_areas` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id_areas`, `nombre`, `descripcion`) VALUES
(1, 'Ingeniería y Tecnología', 'Enfocada en el desarrollo tecnológico, desarrollo de software, análisis de sistemas y construcción f'),
(2, 'Ciencias de la Salud', 'Orientada a la prevención, diagnóstico, tratamiento de enfermedades y cuidado del bienestar mental y'),
(3, 'Ciencias Sociales y Humanidade', 'Enfocada en el estudio del comportamiento humano, leyes, negocios, comunicación y administración púb'),
(4, 'Artes y Diseño', 'Centrada en la expresión creativa, diseño estético, arquitectura, música, artes visuales y escénicas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `becas`
--

CREATE TABLE `becas` (
  `id_becas` int(11) NOT NULL,
  `nombre_beca` varchar(100) NOT NULL,
  `campus` varchar(50) DEFAULT NULL,
  `requisitos` text DEFAULT NULL,
  `fecha_limite` date DEFAULT NULL,
  `enlace` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `becas`
--

INSERT INTO `becas` (`id_becas`, `nombre_beca`, `campus`, `requisitos`, `fecha_limite`, `enlace`) VALUES
(1, 'Beca Nacional de Excelencia', 'Bogotá y Medellín', '• Ser bachiller graduado con alto desempeño escolar.\n• Puntaje Prueba ICFES superior a 380.\n• Clasificación en el grupo A, B o C del Sisbén IV.\n• Haber superado el proceso de admisión en una Institución de Educación Superior avalada por el Ministerio.', '2026-08-17', 'https://becas.gob.co'),
(2, 'Beca Mujeres en Tecnología (STEM)', 'Virtual / Presencial', '• Postulante de género femenino.\n• Ser bachiller de un colegio nacional con título y acta de grado.\n• Haber sido admitida en un programa de Ingeniería, Matemáticas o Ciencia de Datos pura.\n• Promedio global del colegio superior a 4.5.\n• Mantener un promedio semestral mínimo de 3.8 y participar en los foros de liderazgo femenino de la red de becarias.', '2026-07-17', 'https://womenintech.org'),
(3, 'Beca Talento Artístico', 'Cali y Bogotá', '• Ser ciudadano colombiano o residente legal.\n• Haber culminado estudios de educación media (Bachillerato).\n• Presentar los resultados de las pruebas ICFES Saber 11.\n• Completar el formulario de solicitud en las fechas establecidas.\n• Demostrar excelencia académica o vulnerabilidad económica mediante certificados formales.\n• Aprobar las fases de entrevista o pruebas técnicas internas del administrador del fondo.', '2026-06-17', 'https://mincultura.gov.co'),
(4, 'Crédito-Beca Condurable para Ciencias de la Salud', 'Nacional', '• Ser ciudadano colombiano.\n• Estar admitido en un programa técnico, tecnológico o universitario en áreas de alta demanda según la convocatoria.\n• Tener un deudor solidario (codeudor) aprobado por el ICETEX (si aplica la línea de crédito condonable).\n• Para condonar un alto porcentaje de la deuda: Obtener el título profesional dentro del periodo establecido, no presentar morosidad y certificar vinculación laboral en la industria un año tras la graduación.', '2026-09-17', 'https://icetex.gov.co'),
(5, 'Programa Generación E / Política de Gratuidad', 'U. Nacional, UdeA, ITM, Univalle', '• Ser de nacionalidad colombiana.\n• Tener entre 14 y 28 años al momento de la postulación.\n• Estar registrado en el Sisbén IV y pertenecer a los grupos A, B o C (en cualquier subgrupo).\n• No tener título universitario previo (aplica si tienes título técnico o tecnólogo).\n• Haber sido admitido en primera opción en un programa de pregrado de una Institución de Educación Superior Pública.\n• No estar recibiendo apoyo concurrente de otra beca del estado para el mismo fin.', '2026-10-18', 'https://www.mineducacion.gov.co'),
(6, 'Jóvenes en Acción (Prosperidad Social)', 'U. Nacional, UdeA, ITM, Univalle', '• Tener entre 14 y 28 años de edad.\n• Ser bachiller graduado con título y acta de grado.\n• No contar con un título profesional universitario.\n• Pertenecer a alguna población focalizada: Jóvenes en situación de pobreza extrema o vulnerabilidad según Sisbén IV, jóvenes indígenas, jóvenes del ICBF o víctimas del conflicto armado.\n• Estar matriculado en el SENA o en una IES Pública aliada.\n• Mantener un buen promedio académico y asistir a talleres de habilidades para la vida.', '2026-08-18', 'https://prosperidadsocial.gov.co'),
(7, 'Fondo EPM - Educación Superior', 'EAFIT, UPB, ITM, UdeM, EIA, UdeA', '• Ser residente del municipio de Medellín o el Valle de Aburrá por al menos los últimos 3 años.\n• Haber nacido o residir en estratos socioeconómicos 1, 2, 3 o 4.\n• Haber presentado las Pruebas Saber 11 (ICFES) a partir de 2014.\n• Promedio del bachillerato igual o superior a 3.5 o pertenecer al tercio superior en las Pruebas ICFES.\n• Contar con la admisión definitiva en una Institución de Educación Superior aliada al fondo.\n• Compromiso de realizar 80 horas semestrales de Servicio Social para la condonación del crédito.', '2026-07-18', 'https://www.sapiencia.gov.co'),
(8, 'Presupuesto Participativo', 'ITM, UdeM, UPB, EAFIT', '• Demostrar residencia continua (mínimo 3 años) en la comuna de Medellín que haya priorizado los recursos de PP Educación.\n• No poseer título universitario previo o estar cursando simultáneamente otro pregrado.\n• Haber aprobado el proceso de admisión en una institución aliada de Sapiencia.\n• Aprobación de la Junta de Acción Comunal o certificado vecinal (según comuna).\n• Mantener un promedio semestral mínimo de 3.2.\n• Cumplir con 60 horas de servicio comunitario en la misma comuna para garantizar la condonación total.', '2026-09-18', 'https://www.sapiencia.gov.co'),
(9, 'Beca Quiero Estudiar', 'Universidad de los Andes', '• Exclusivo para bachilleres de colegios de calendario A o B graduados en el último año.\n• Obtener un puntaje sobresaliente en las pruebas ICFES Saber 11 (generalmente superior a 360 puntos).\n• Demostrar necesidad económica extrema a través de un estudio socioeconómico riguroso (visita domiciliaria).\n• Haber sido admitido a la Universidad de los Andes en cualquier programa de pregrado.\n• Mantener un promedio acumulado superior a 3.8 durante toda la carrera.\n• Firmar un compromiso de apoyo mutuo, mediante el cual el estudiante se compromete a aportar financieramente al fondo una vez sea un profesional exitoso (apoyo a futuras generaciones).', '2026-06-18', 'https://apoyofinanciero.uniandes.edu.co'),
(10, 'Beca Nivelación Excelencia EAFIT', 'Universidad EAFIT', '• Ser bachiller de un colegio público o privado del Valle de Aburrá.\n• Pertenecer a estrato 1, 2 o 3, comprobable mediante recibos de servicios públicos y estudio socioeconómico.\n• Haber obtenido un puntaje global en el ICFES superior a 350 puntos.\n• Promedio acumulado del colegio (grados 9 a 11) superior a 4.2 sobre 5.0.\n• Pasar exitosamente la entrevista con el comité de becas de la universidad.\n• Cumplir con las horas de monitoría académica exigidas semestralmente.', '2026-11-18', 'https://www.eafit.edu.co'),
(11, 'Beca Honor al Mérito Solidario', 'Universidad Pontificia Bolivariana (UPB)', '• Postularse durante el proceso de admisión como candidato de excelencia.\n• Promedio académico del colegio superior a 4.0.\n• Presentar certificado de ingresos familiares para validar la necesidad del apoyo solidario.\n• Carta de recomendación del rector o coordinador del colegio de procedencia.\n• Mantenimiento del beneficio condicionado a un promedio semestral mínimo de 3.8 y no tener sanciones disciplinarias.', '2026-08-18', 'https://www.upb.edu.co'),
(12, 'Beca a la Excelencia Académica EIA', 'Universidad EIA', '• Presentar el examen de admisión interno de la EIA y quedar en el Top 5% de los mejores puntajes.\n• Resultados sobresalientes en la prueba ICFES Saber 11 en matemáticas, física y lectura crítica.\n• Ser postulado oficialmente por el colegio de procedencia como uno de sus mejores bachilleres.\n• Participar y aprobar el Assessment Center (centro de evaluación de habilidades blandas y técnicas).\n• Dedicación exclusiva al estudio e imposibilidad económica demostrada para el pago pleno de la matrícula.', '2026-07-18', 'https://www.eia.edu.co'),
(13, 'Beca Ingresa Javeriana', 'Pontificia Universidad Javeriana', '• Postularse al fondo antes de pagar los derechos de inscripción.\n• Dirigida exclusivamente a estudiantes de colegios a nivel nacional que demuestren excelencia académica integral (promedio de 4.0+ y buen ICFES).\n• Pertenecer a familias cuyos ingresos mensuales no superen los 4 salarios mínimos legales vigentes.\n• Presentar formulario de aplicación con ensayo de motivación vocacional.\n• Mantener estatus de estudiante regular, tomar la carga académica completa y no perder asignaturas.', '2026-09-18', 'https://www.javeriana.edu.co'),
(14, 'Beca Fundadores UdeM', 'Universidad de Medellín', '• Estar ya matriculado como estudiante activo de pregrado en la institución.\n• Haber cursado como mínimo un semestre en la universidad con carga completa (al menos 16 créditos).\n• Obtener un promedio en el último semestre superior a 4.5.\n• No contar con llamados de atención disciplinarios o faltas graves en el expediente.\n• El beneficio se otorga semestralmente y debe re-postularse cada periodo académico compitiendo con los mejores de cada facultad.', '2026-10-18', 'https://www.udem.edu.co'),
(15, 'Crédito Condonable Talento Tech / ICETEX', 'Todas (Públicas y Privadas)', '• Ser ciudadano colombiano.\n• Estar admitido en un programa técnico, tecnológico o universitario en áreas de alta demanda según la convocatoria.\n• Tener un deudor solidario (codeudor) aprobado por el ICETEX (si aplica la línea de crédito condonable).\n• Para condonar un alto porcentaje de la deuda: Obtener el título profesional dentro del periodo establecido, no presentar morosidad y certificar vinculación laboral en la industria un año tras la graduación.', '2027-01-18', 'https://web.icetex.gov.co');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuestionario`
--

CREATE TABLE `cuestionario` (
  `id_cuestionario` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `id_area` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuestionario`
--

INSERT INTO `cuestionario` (`id_cuestionario`, `descripcion`, `id_area`) VALUES
(1, 'Test de Orientación Vocacional Completo', 1),
(2, 'Test Vocacional Avanzado (Modelo RIASEC)', 1),
(3, 'Micro-Test de Especialidad: Ingeniería y Tecnologí', 1),
(4, 'Micro-Test de Especialidad: Ciencias de la Salud', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id_pregunta` int(11) NOT NULL,
  `id_cuestionario` int(11) DEFAULT NULL,
  `pregunta` text NOT NULL,
  `a` varchar(100) DEFAULT NULL,
  `b` varchar(100) DEFAULT NULL,
  `c` varchar(100) DEFAULT NULL,
  `d` varchar(100) DEFAULT NULL,
  `correcta` int(11) DEFAULT NULL,
  `e` text DEFAULT NULL,
  `f` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id_pregunta`, `id_cuestionario`, `pregunta`, `a`, `b`, `c`, `d`, `correcta`, `e`, `f`) VALUES
(1, 1, '¿Cuál de las siguientes actividades disfrutas más realizar en tu tiempo libre?', 'Resolver acertijos, programar o armar/desarmar aparatos electrónicos.', 'Ayudar a personas enfermas, investigar sobre nutrición o comprender la mente.', 'Debatir ideas, liderar un equipo de trabajo o planear un negocio.', 'Dibujar, escribir historias, componer música o diseñar espacios visuales.', 1, NULL, NULL),
(2, 1, 'Si tuvieras que leer un libro o ver un documental para aprender algo nuevo, ¿de qué temática sería?', 'El desarrollo de la Inteligencia Artificial y el espacio exterior.', 'Cómo funciona el cerebro humano y los secretos de la medicina moderna.', 'Historia de la política mundial o biografías de grandes emprendedores.', 'Historia del arte, evolución del cine o técnicas de fotografía creativa.', 2, NULL, NULL),
(3, 1, 'Imagina que tu comunidad tiene un problema grave de salud pública debido a la contaminación del agua. ¿Cómo preferirías ayudar?', 'Diseñando un sistema de filtración tecnológico automatizado o un software de monitoreo de agua.', 'Atendiendo directamente a las personas afectadas y recetando tratamientos preventivos.', 'Organizando mesas de debate de políticas públicas para exigir leyes de protección ambiental y gestió', 'Creando una campaña visual y artística impactante para concientizar e inspirar a la población.', 3, NULL, NULL),
(4, 1, 'Al trabajar en un proyecto de grupo escolar o universitario, ¿qué rol sueles asumir naturalmente?', 'El analista técnico que programa la presentación, revisa datos y optimiza los procesos.', 'El mediador que se preocupa por la armonía del grupo, la salud mental y que todos se sientan bien.', 'El líder estratégico que organiza las tareas, expone los argumentos y maneja los presupuestos.', 'El diseñador creativo que se encarga del estilo visual, la originalidad y la estética del proyecto.', 4, NULL, NULL),
(5, 1, '¿Qué tipo de entorno de trabajo del futuro te resultaría más estimulante e inspirador?', 'Un laboratorio tecnológico o una oficina de desarrollo de software rodeado de computadores y códigos', 'Un hospital, clínica o consultorio interactuando con personas y brindando bienestar físico o mental.', 'Una oficina de consultoría de leyes, un corporativo de negocios o coordinando campañas en la comunid', 'Un estudio de diseño, un set de grabación, una firma de arquitectura o un espacio creativo al aire l', 1, NULL, NULL),
(9, 3, 'Si pudieras liderar un gran proyecto tecnológico, ¿qué elegirías?', 'Crear la próxima gran inteligencia artificial o red social (Software).', 'Diseñar puentes colgantes e infraestructuras sostenibles (Civil).', 'Fabricar brazos robóticos y automatización industrial (Mecatrónica).', 'Configurar la ciberseguridad y servidores de un país (Sistemas/Redes).', NULL, NULL, NULL),
(10, 3, '¿Con qué herramienta prefieres trabajar?', 'Editores de código (VS Code) y lenguajes de programación.', 'Planos arquitectónicos, topografía y materiales de construcción.', 'Circuitos electrónicos, motores y hardware físico.', 'Consolas de comandos, routers y firewalls.', NULL, NULL, NULL),
(11, 4, '¿Qué aspecto del cuidado humano te llama más la atención?', 'Realizar cirugías, diagnosticar y curar enfermedades graves (Medicina).', 'Acompañar pacientes, administrar medicamentos y cuidados diarios (Enfermería).', 'Estudiar el comportamiento, las emociones y la salud mental (Psicología).', 'Planificar dietas para atletas o recuperar la salud metabólica (Nutrición).', NULL, NULL, NULL),
(12, 4, 'Si trabajaras en un hospital, ¿dónde preferirías estar?', 'En el quirófano o sala de emergencias tomando decisiones críticas.', 'En las habitaciones de recuperación charlando y cuidando a los pacientes.', 'En un consultorio privado escuchando los problemas de vida de las personas.', 'En el laboratorio clínico analizando muestras y planificando regímenes.', NULL, NULL, NULL),
(13, 2, '¿Cómo describirías tu espacio de trabajo perfecto?', 'Un taller, laboratorio de hardware o trabajo al aire libre rodeado de herramientas.', 'Un centro de investigación, observatorio o laboratorio científico silencioso.', 'Un estudio de diseño, taller de arte o una agencia creativa sin horarios rígidos.', 'Un aula de clases, hospital, clínica psicológica o centro de desarrollo comunitario.', NULL, 'Una sala de juntas ejecutiva, bolsa de valores o dirigiendo mi propia startup.', 'Una oficina corporativa moderna, ordenada, con sistemas contables y de bases de datos.'),
(14, 2, 'Si pudieras elegir el destino de una excursión profesional, ¿adónde irías?', 'A una gran planta ensambladora de automóviles o a una central hidroeléctrica.', 'Al acelerador de partículas CERN o a un laboratorio de biotecnología avanzada.', 'Al Museo del Louvre, un festival de cine independiente o un desfile de alta costura.', 'A una fundación de ayuda humanitaria o a un centro de innovación pedagógica.', NULL, 'A Wall Street, Silicon Valley o a un congreso internacional de liderazgo y negocios.', 'Al centro de operaciones de un banco internacional o a una agencia de auditoría.'),
(15, 2, '¿Qué ambiente te produce mayor satisfacción y menor estrés?', 'Aquel donde puedo ver un resultado físico tangible al final del día.', 'Aquel donde tengo tiempo ininterrumpido para analizar datos y pensar teorías.', 'Aquel donde tengo libertad total para expresarme y romper las reglas establecidas.', 'Aquel donde me siento parte de una comunidad cálida que se apoya mutuamente.', NULL, 'Aquel que es competitivo, dinámico y me reta a superar objetivos de ventas o expansión.', 'Aquel donde las reglas son claras, hay un manual de procedimientos y todo tiene un lugar.'),
(16, 2, 'Cuando te enfrentas a un problema complejo en la vida real, ¿cuál es tu primer instinto para resolverlo?', 'Desarmar el problema, usar mis manos y herramientas técnicas para arreglarlo directamente.', 'Buscar literatura científica, aislar las variables y hacer un análisis metódico.', 'Hacer un boceto, usar pensamiento lateral o buscar una solución visualmente creativa.', 'Reunir a las personas involucradas, escuchar sus sentimientos y llegar a un consenso.', NULL, 'Delegar tareas, trazar un plan estratégico de acción y negociar una solución rápida.', 'Consultar el reglamento, revisar los archivos históricos y aplicar la normativa vigente.'),
(17, 2, 'En una crisis dentro de un proyecto, ¿qué rol asumes para salvar la situación?', 'El ejecutor técnico: me encargo de que las máquinas, el software o el hardware funcionen.', 'El analista de datos: reviso qué falló en los cálculos o en la teoría inicial.', 'El innovador: propongo desechar lo anterior y crear un concepto completamente nuevo.', 'El mediador: me aseguro de que el equipo no se desmotive y manejo el estrés grupal.', NULL, 'El capitán: tomo el mando, asigno nuevas responsabilidades y protejo el presupuesto.', 'El auditor: reviso los cronogramas, reasigno el presupuesto y documento los errores.'),
(18, 2, '¿Qué tipo de \'rompecabezas\' te resulta más fascinante descifrar?', 'La reparación del motor de un vehículo o la configuración de una red informática.', 'Un problema matemático complejo o el diagnóstico de una enfermedad rara.', 'La creación de una armonía musical perfecta o el diseño de una interfaz de usuario atractiva.', 'Entender el origen del trauma psicológico de una persona para ayudarla a sanar.', NULL, 'Cómo convencer a un cliente difícil para que compre un producto de alto valor.', 'Encontrar un error de centavos en un balance contable masivo.'),
(19, 2, 'Si tuvieras un año sabático pagado, ¿a qué dedicarías la mayor parte de tu tiempo?', 'A construir una cabaña en el bosque, reparar autos clásicos o desarrollar aplicaciones.', 'A leer artículos científicos, estudiar astronomía o realizar experimentos de química.', 'A pintar una exposición de arte, escribir una novela o viajar fotografiando paisajes.', 'A hacer voluntariado en una ONG, enseñar en zonas rurales o cuidar a ancianos.', NULL, 'A iniciar un emprendimiento, invertir en la bolsa o hacer networking internacional.', 'A organizar meticulosamente mis finanzas personales, colecciones y automatizar mi casa.'),
(20, 2, '¿Qué tipo de contenido (libros, documentales, podcasts) consumes con mayor frecuencia?', 'Tutoriales de reparación, reviews de tecnología, supervivencia o ingeniería extrema.', 'Divulgación científica, documentales de naturaleza, medicina o física cuántica.', 'Historia del arte, crítica de cine, poesía o biografías de músicos famosos.', 'Psicología humana, superación personal, sociología o historias de activismo social.', NULL, 'Negocios, estrategias de marketing, liderazgo o biografías de multimillonarios.', 'Economía, organización personal, administración del tiempo o tutoriales de Excel.'),
(21, 2, 'Si tuvieras que enseñar algo a un grupo de personas, ¿qué tema elegirías?', 'Cómo programar una app básica o cómo hacer mantenimiento a una bicicleta.', 'Cómo funciona el sistema inmunológico o los principios de la termodinámica.', 'Técnicas de pintura en acuarela, actuación teatral o escritura creativa.', 'Primeros auxilios emocionales, técnicas de enseñanza infantil o trabajo social.', NULL, 'Cómo hablar en público para persuadir, técnicas de venta o gestión de proyectos.', 'Cómo llevar la contabilidad del hogar o cómo optimizar procesos con bases de datos.'),
(22, 2, '¿Por qué habilidad o cualidad sueles ser más reconocido o felicitado por tus amigos/familiares?', 'Por mi destreza física, habilidad manual o conocimientos de tecnología.', 'Por mi curiosidad, memoria para los datos y capacidad lógica para pensar.', 'Por mi originalidad, buen gusto, talento musical o sensibilidad estética.', 'Por mi empatía, saber escuchar y dar buenos consejos cuando están tristes.', NULL, 'Por mi carisma, energía inagotable y habilidad para convencer a cualquiera.', 'Por mi orden, puntualidad, responsabilidad y capacidad de planificación.'),
(23, 2, '¿Con qué tipo de \'herramientas\' prefieres trabajar en tu día a día?', 'Herramientas de ferretería, maquinaria pesada o código de programación.', 'Microscopios, tubos de ensayo, software de estadística o telescopios.', 'Pinceles, cámaras fotográficas, instrumentos musicales o tabletas gráficas.', 'La comunicación verbal, tests psicológicos, material didáctico y el contacto humano.', NULL, 'Presentaciones de impacto, estrategias de marketing, micrófonos y contratos.', 'Hojas de cálculo, calculadoras financieras, archivadores y software de gestión.'),
(24, 2, '¿Qué te resulta más fácil de hacer en comparación con la mayoría de las personas?', 'Entender cómo funcionan los aparatos electrónicos con solo mirarlos.', 'Concentrarme durante horas leyendo textos densos sobre ciencia o matemáticas.', 'Improvisar algo creativo o notar detalles estéticos que los demás pasan por alto.', 'Hacer que una persona desconocida se sienta cómoda y en confianza rápidamente.', NULL, 'Tomar el control de un grupo desorganizado y guiarlos hacia una meta.', 'Notar cuando falta un documento o hay una pequeña inconsistencia en un archivo.'),
(25, 2, '¿Cuál es tu definición de \'éxito profesional\'?', 'Diseñar o construir algo duradero y funcional que el mundo utilice a diario.', 'Descubrir algo nuevo que aporte al conocimiento científico de la humanidad.', 'Crear una obra (arte, diseño, música) que emocione profundamente a otras personas.', 'Saber que gracias a mi trabajo, he mejorado la calidad de vida de muchas personas.', NULL, 'Alcanzar la libertad financiera, liderar una gran empresa y ser un referente en el mercado.', 'Tener un trabajo seguro, estable, con una carrera ascendente y procesos predecibles.'),
(26, 2, 'Si fundaras tu propia organización, ¿cuál sería su misión principal?', 'Desarrollar infraestructura inteligente o innovar en productos tecnológicos tangibles.', 'Investigar curas para enfermedades raras o desarrollar nuevas teorías matemáticas.', 'Promover la cultura, producir películas independientes o diseñar modas vanguardistas.', 'Proteger los derechos humanos, educar a niños vulnerables o dar apoyo psicológico.', NULL, 'Dominar el mercado global, abrir franquicias internacionales y maximizar los beneficios.', 'Proveer servicios de auditoría fiscal, consultoría de eficiencia o seguridad de datos.'),
(27, 2, 'Al final de tu carrera, ¿cómo te gustaría ser recordado por la sociedad?', 'Como el ingeniero o técnico que construyó infraestructuras o tecnologías fundamentales.', 'Como el investigador o científico brillante que revolucionó nuestra forma de entender el mundo.', 'Como el artista o diseñador visionario que dejó un legado cultural inspirador.', 'Como el maestro o cuidador compasivo que transformó incontables vidas para bien.', NULL, 'Como el empresario o político influyente que lideró grandes cambios económicos.', 'Como el experto organizador o analista que mantuvo el sistema funcionando sin errores.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas_academicos`
--

CREATE TABLE `programas_academicos` (
  `id_programa` int(11) NOT NULL,
  `id_universidad` int(11) DEFAULT NULL,
  `n_programa` varchar(100) NOT NULL,
  `area` varchar(30) DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL,
  `costo` decimal(10,0) NOT NULL,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `programas_academicos`
--

INSERT INTO `programas_academicos` (`id_programa`, `id_universidad`, `n_programa`, `area`, `duracion`, `costo`, `slug`) VALUES
(1, 1, 'Ingeniería de Sistemas', 'Ingeniería y Tecnología', 10, 850000, 'ingenieria-de-sistemas-1'),
(2, 1, 'Medicina', 'Ciencias de la Salud', 12, 950000, 'medicina-2'),
(3, 1, 'Derecho', 'Ciencias Sociales y Humanidade', 10, 750000, 'derecho-3'),
(4, 1, 'Diseño Gráfico', 'Artes y Diseño', 8, 800000, 'diseno-grafico-4'),
(5, 2, 'Ingeniería de Sistemas y Computación', 'Ingeniería y Tecnología', 10, 22000000, 'ingenieria-de-sistemas-y-computacion-5'),
(6, 2, 'Medicina', 'Ciencias de la Salud', 12, 28000000, 'medicina-6'),
(7, 2, 'Administración de Empresas', 'Ciencias Sociales y Humanidade', 10, 21000000, 'administracion-de-empresas-7'),
(8, 2, 'Arquitectura', 'Artes y Diseño', 10, 22000000, 'arquitectura-8'),
(9, 3, 'Bioingeniería', 'Ingeniería y Tecnología', 10, 600000, 'bioingenieria-9'),
(10, 3, 'Psicología', 'Ciencias de la Salud', 10, 500000, 'psicologia-10'),
(11, 3, 'Comunicación Social', 'Ciencias Sociales y Humanidade', 8, 450000, 'comunicacion-social-11'),
(12, 4, 'Ingeniería Civil', 'Ingeniería y Tecnología', 10, 400000, 'ingenieria-civil-12'),
(13, 4, 'Enfermería', 'Ciencias de la Salud', 9, 350000, 'enfermeria-13'),
(14, 4, 'Sociología', 'Ciencias Sociales y Humanidade', 10, 300000, 'sociologia-14'),
(15, 5, 'Nutrición y Dietética', 'Ciencias de la Salud', 9, 9500000, 'nutricion-y-dietetica-15'),
(16, 5, 'Ciencia Política', 'Ciencias Sociales y Humanidade', 8, 10500000, 'ciencia-politica-16'),
(17, 5, 'Artes Visuales', 'Artes y Diseño', 8, 11000000, 'artes-visuales-17'),
(18, 6, 'Administración de Negocios', 'Ciencias Sociales y Humanidade', 9, 13500000, 'administracion-de-negocios-18'),
(19, 6, 'Ingeniería de Sistemas', 'Ingeniería y Tecnología', 9, 14200000, 'ingenieria-de-sistemas-19'),
(20, 6, 'Ingeniería Física', 'Ingeniería y Tecnología', 9, 13800000, 'ingenieria-fisica-20'),
(21, 7, 'Arquitectura', 'Artes y Diseño', 10, 11500000, 'arquitectura-21'),
(22, 7, 'Diseño Gráfico', 'Artes y Diseño', 8, 9800000, 'diseno-grafico-22'),
(23, 7, 'Ingeniería Mecánica', 'Ingeniería y Tecnología', 10, 10500000, 'ingenieria-mecanica-23'),
(24, 7, 'Medicina', 'Ciencias de la Salud', 12, 19500000, 'medicina-24'),
(25, 8, 'Ingeniería Electromecánica', 'Ingeniería y Tecnología', 10, 550000, 'ingenieria-electromecanica-25'),
(26, 8, 'Tecnología en Desarrollo de Software', 'Ingeniería y Tecnología', 6, 450000, 'tecnologia-en-desarrollo-de-software-26'),
(27, 8, 'Ingeniería Biomédica', 'Ciencias de la Salud', 10, 600000, 'ingenieria-biomedica-27'),
(28, 9, 'Derecho', 'Ciencias Sociales y Humanidade', 10, 8900000, 'derecho-28'),
(29, 9, 'Comunicación y Lenguajes Audiovisuales', 'Artes y Diseño', 9, 8500000, 'comunicacion-y-lenguajes-audiovisuales-29'),
(30, 9, 'Ingeniería Ambiental', 'Ingeniería y Tecnología', 10, 8700000, 'ingenieria-ambiental-30'),
(31, 10, 'Ingeniería Mecatrónica', 'Ingeniería y Tecnología', 10, 15000000, 'ingenieria-mecatronica-31'),
(32, 10, 'Medicina', 'Ciencias de la Salud', 12, 22000000, 'medicina-32'),
(33, 10, 'Ingeniería Biomédica', 'Ciencias de la Salud', 10, 15500000, 'ingenieria-biomedica-33'),
(34, 1, 'Administración de Empresas', 'Ciencias Sociales y Humanidade', 10, 670000, 'administracion-de-empresas-34'),
(35, 1, 'Ingeniería Electrónica', 'Ingeniería y Tecnología', 10, 200000, 'ingenieria-electronica-35'),
(36, 1, 'Ingeniería Industrial', 'Ingeniería y Tecnología', 10, 880000, 'ingenieria-industrial-36'),
(37, 1, 'Comunicación Social y Periodismo', 'Ciencias Sociales y Humanidade', 10, 210000, 'comunicacion-social-y-periodismo-37'),
(38, 1, 'Arquitectura de Software', 'Ingeniería y Tecnología', 10, 570000, 'arquitectura-de-software-38'),
(39, 1, 'Ingeniería Química', 'Ingeniería y Tecnología', 10, 700000, 'ingenieria-quimica-39'),
(40, 1, 'Ingeniería Ambiental', 'Ingeniería y Tecnología', 10, 730000, 'ingenieria-ambiental-40'),
(41, 1, 'Contaduría Pública', 'Ciencias Sociales y Humanidade', 10, 760000, 'contaduria-publica-41'),
(42, 1, 'Cine y Comunicación Audiovisual', 'Artes y Diseño', 9, 540000, 'cine-y-comunicacion-audiovisual-42'),
(43, 1, 'Artes Plásticas y Visuales', 'Artes y Diseño', 10, 260000, 'artes-plasticas-y-visuales-43'),
(44, 1, 'Ingeniería Mecánica', 'Ingeniería y Tecnología', 10, 310000, 'ingenieria-mecanica-44'),
(45, 1, 'Sociología', 'Ciencias Sociales y Humanidade', 10, 440000, 'sociologia-45'),
(46, 1, 'Fisioterapia', 'Ciencias de la Salud', 10, 560000, 'fisioterapia-46'),
(47, 1, 'Arquitectura', 'Artes y Diseño', 10, 560000, 'arquitectura-47'),
(48, 1, 'Diseño Industrial', 'Artes y Diseño', 10, 540000, 'diseno-industrial-48'),
(49, 1, 'Negocios Internacionales', 'Ciencias Sociales y Humanidade', 10, 640000, 'negocios-internacionales-49'),
(50, 1, 'Psicología', 'Ciencias de la Salud', 10, 230000, 'psicologia-50'),
(51, 1, 'Nutrición y Dietética', 'Ciencias de la Salud', 10, 430000, 'nutricion-y-dietetica-51'),
(52, 2, 'Nutrición y Dietética', 'Ciencias de la Salud', 10, 13200000, 'nutricion-y-dietetica-52'),
(53, 2, 'Odontología', 'Ciencias de la Salud', 10, 12300000, 'odontologia-53'),
(54, 2, 'Negocios Internacionales', 'Ciencias Sociales y Humanidade', 10, 6100000, 'negocios-internacionales-54'),
(55, 2, 'Ingeniería Química', 'Ingeniería y Tecnología', 10, 11000000, 'ingenieria-quimica-55'),
(56, 2, 'Ingeniería Electrónica', 'Ingeniería y Tecnología', 10, 15300000, 'ingenieria-electronica-56'),
(57, 2, 'Diseño Industrial', 'Artes y Diseño', 10, 5200000, 'diseno-industrial-57'),
(58, 2, 'Ciencia Política', 'Ciencias Sociales y Humanidade', 10, 12100000, 'ciencia-politica-58'),
(59, 2, 'Enfermería', 'Ciencias de la Salud', 10, 15600000, 'enfermeria-59'),
(60, 2, 'Ingeniería Ambiental', 'Ingeniería y Tecnología', 10, 7800000, 'ingenieria-ambiental-60'),
(61, 2, 'Diseño Gráfico', 'Artes y Diseño', 8, 5200000, 'diseno-grafico-61'),
(62, 2, 'Medicina Veterinaria', 'Ciencias de la Salud', 10, 12000000, 'medicina-veterinaria-62'),
(63, 2, 'Fisioterapia', 'Ciencias de la Salud', 10, 11400000, 'fisioterapia-63'),
(64, 2, 'Derecho', 'Ciencias Sociales y Humanidade', 10, 13300000, 'derecho-64'),
(65, 2, 'Psicología', 'Ciencias de la Salud', 10, 8800000, 'psicologia-65'),
(66, 2, 'Economía', 'Ciencias Sociales y Humanidade', 10, 8900000, 'economia-66'),
(67, 2, 'Cine y Comunicación Audiovisual', 'Artes y Diseño', 9, 7900000, 'cine-y-comunicacion-audiovisual-67'),
(68, 2, 'Arquitectura de Software', 'Ingeniería y Tecnología', 10, 16900000, 'arquitectura-de-software-68'),
(69, 3, 'Contaduría Pública', 'Ciencias Sociales y Humanidade', 10, 500000, 'contaduria-publica-69'),
(70, 3, 'Sociología', 'Ciencias Sociales y Humanidade', 10, 830000, 'sociologia-70'),
(71, 3, 'Ingeniería Química', 'Ingeniería y Tecnología', 10, 860000, 'ingenieria-quimica-71'),
(72, 3, 'Administración de Empresas', 'Ciencias Sociales y Humanidade', 10, 480000, 'administracion-de-empresas-72'),
(73, 3, 'Comunicación Social y Periodismo', 'Ciencias Sociales y Humanidade', 10, 580000, 'comunicacion-social-y-periodismo-73'),
(74, 3, 'Cine y Comunicación Audiovisual', 'Artes y Diseño', 9, 370000, 'cine-y-comunicacion-audiovisual-74'),
(75, 3, 'Odontología', 'Ciencias de la Salud', 10, 880000, 'odontologia-75'),
(76, 3, 'Fisioterapia', 'Ciencias de la Salud', 10, 400000, 'fisioterapia-76'),
(77, 3, 'Nutrición y Dietética', 'Ciencias de la Salud', 10, 610000, 'nutricion-y-dietetica-77'),
(78, 3, 'Ingeniería Ambiental', 'Ingeniería y Tecnología', 10, 680000, 'ingenieria-ambiental-78'),
(79, 3, 'Medicina', 'Ciencias de la Salud', 12, 260000, 'medicina-79'),
(80, 3, 'Arquitectura de Software', 'Ingeniería y Tecnología', 10, 860000, 'arquitectura-de-software-80'),
(81, 3, 'Negocios Internacionales', 'Ciencias Sociales y Humanidade', 10, 220000, 'negocios-internacionales-81'),
(82, 3, 'Ingeniería Industrial', 'Ingeniería y Tecnología', 10, 630000, 'ingenieria-industrial-82'),
(83, 3, 'Ingeniería Civil', 'Ingeniería y Tecnología', 10, 710000, 'ingenieria-civil-83'),
(84, 3, 'Diseño Industrial', 'Artes y Diseño', 10, 430000, 'diseno-industrial-84'),
(85, 3, 'Derecho', 'Ciencias Sociales y Humanidade', 10, 890000, 'derecho-85'),
(86, 3, 'Marketing y Publicidad', 'Ciencias Sociales y Humanidade', 8, 560000, 'marketing-y-publicidad-86'),
(87, 3, 'Ingeniería Mecatrónica', 'Ingeniería y Tecnología', 10, 740000, 'ingenieria-mecatronica-87'),
(88, 4, 'Nutrición y Dietética', 'Ciencias de la Salud', 10, 840000, 'nutricion-y-dietetica-88'),
(89, 4, 'Medicina', 'Ciencias de la Salud', 12, 270000, 'medicina-89'),
(90, 4, 'Arquitectura de Software', 'Ingeniería y Tecnología', 10, 400000, 'arquitectura-de-software-90'),
(91, 4, 'Cine y Comunicación Audiovisual', 'Artes y Diseño', 9, 860000, 'cine-y-comunicacion-audiovisual-91'),
(92, 4, 'Marketing y Publicidad', 'Ciencias Sociales y Humanidade', 8, 700000, 'marketing-y-publicidad-92'),
(93, 4, 'Psicología', 'Ciencias de la Salud', 10, 640000, 'psicologia-93'),
(94, 4, 'Ingeniería Industrial', 'Ingeniería y Tecnología', 10, 650000, 'ingenieria-industrial-94'),
(95, 4, 'Artes Plásticas y Visuales', 'Artes y Diseño', 10, 680000, 'artes-plasticas-y-visuales-95'),
(96, 4, 'Diseño Gráfico', 'Artes y Diseño', 8, 880000, 'diseno-grafico-96'),
(97, 4, 'Economía', 'Ciencias Sociales y Humanidade', 10, 210000, 'economia-97'),
(98, 4, 'Odontología', 'Ciencias de la Salud', 10, 640000, 'odontologia-98'),
(99, 4, 'Ingeniería Mecatrónica', 'Ingeniería y Tecnología', 10, 340000, 'ingenieria-mecatronica-99'),
(100, 4, 'Ingeniería Mecánica', 'Ingeniería y Tecnología', 10, 310000, 'ingenieria-mecanica-100'),
(101, 4, 'Arquitectura', 'Artes y Diseño', 10, 800000, 'arquitectura-101'),
(102, 4, 'Diseño Industrial', 'Artes y Diseño', 10, 580000, 'diseno-industrial-102'),
(103, 4, 'Ingeniería Electrónica', 'Ingeniería y Tecnología', 10, 550000, 'ingenieria-electronica-103'),
(104, 4, 'Ingeniería Ambiental', 'Ingeniería y Tecnología', 10, 290000, 'ingenieria-ambiental-104'),
(105, 4, 'Fisioterapia', 'Ciencias de la Salud', 10, 760000, 'fisioterapia-105'),
(106, 4, 'Contaduría Pública', 'Ciencias Sociales y Humanidade', 10, 720000, 'contaduria-publica-106'),
(107, 5, 'Ingeniería Química', 'Ingeniería y Tecnología', 10, 14300000, 'ingenieria-quimica-107'),
(108, 5, 'Administración de Empresas', 'Ciencias Sociales y Humanidade', 10, 16400000, 'administracion-de-empresas-108'),
(109, 5, 'Ingeniería Mecánica', 'Ingeniería y Tecnología', 10, 10100000, 'ingenieria-mecanica-109'),
(110, 5, 'Ingeniería Industrial', 'Ingeniería y Tecnología', 10, 13000000, 'ingenieria-industrial-110'),
(111, 5, 'Arquitectura', 'Artes y Diseño', 10, 10100000, 'arquitectura-111'),
(112, 5, 'Comunicación Social y Periodismo', 'Ciencias Sociales y Humanidade', 10, 5300000, 'comunicacion-social-y-periodismo-112'),
(113, 5, 'Diseño Gráfico', 'Artes y Diseño', 8, 14200000, 'diseno-grafico-113'),
(114, 5, 'Enfermería', 'Ciencias de la Salud', 10, 16800000, 'enfermeria-114'),
(115, 5, 'Contaduría Pública', 'Ciencias Sociales y Humanidade', 10, 13500000, 'contaduria-publica-115'),
(116, 5, 'Medicina Veterinaria', 'Ciencias de la Salud', 10, 15700000, 'medicina-veterinaria-116'),
(117, 5, 'Ingeniería Civil', 'Ingeniería y Tecnología', 10, 15600000, 'ingenieria-civil-117'),
(118, 5, 'Arquitectura de Software', 'Ingeniería y Tecnología', 10, 10400000, 'arquitectura-de-software-118'),
(119, 5, 'Fisioterapia', 'Ciencias de la Salud', 10, 5400000, 'fisioterapia-119'),
(120, 5, 'Economía', 'Ciencias Sociales y Humanidade', 10, 12600000, 'economia-120'),
(121, 5, 'Psicología', 'Ciencias de la Salud', 10, 6500000, 'psicologia-121'),
(122, 5, 'Artes Plásticas y Visuales', 'Artes y Diseño', 10, 18000000, 'artes-plasticas-y-visuales-122'),
(123, 5, 'Marketing y Publicidad', 'Ciencias Sociales y Humanidade', 8, 13700000, 'marketing-y-publicidad-123'),
(124, 5, 'Derecho', 'Ciencias Sociales y Humanidade', 10, 6300000, 'derecho-124'),
(125, 5, 'Negocios Internacionales', 'Ciencias Sociales y Humanidade', 10, 8300000, 'negocios-internacionales-125'),
(126, 6, 'Psicología', 'Ciencias de la Salud', 10, 13300000, 'psicologia-126'),
(127, 6, 'Ingeniería Electrónica', 'Ingeniería y Tecnología', 10, 7200000, 'ingenieria-electronica-127'),
(128, 6, 'Diseño Gráfico', 'Artes y Diseño', 8, 6300000, 'diseno-grafico-128'),
(129, 6, 'Comunicación Social y Periodismo', 'Ciencias Sociales y Humanidade', 10, 12100000, 'comunicacion-social-y-periodismo-129'),
(130, 6, 'Artes Plásticas y Visuales', 'Artes y Diseño', 10, 7200000, 'artes-plasticas-y-visuales-130'),
(131, 6, 'Ingeniería Mecatrónica', 'Ingeniería y Tecnología', 10, 12000000, 'ingenieria-mecatronica-131'),
(132, 6, 'Negocios Internacionales', 'Ciencias Sociales y Humanidade', 10, 8600000, 'negocios-internacionales-132'),
(133, 6, 'Ingeniería Industrial', 'Ingeniería y Tecnología', 10, 16000000, 'ingenieria-industrial-133'),
(134, 6, 'Arquitectura de Software', 'Ingeniería y Tecnología', 10, 11000000, 'arquitectura-de-software-134'),
(135, 6, 'Economía', 'Ciencias Sociales y Humanidade', 10, 6400000, 'economia-135'),
(136, 6, 'Sociología', 'Ciencias Sociales y Humanidade', 10, 17900000, 'sociologia-136'),
(137, 6, 'Administración de Empresas', 'Ciencias Sociales y Humanidade', 10, 13900000, 'administracion-de-empresas-137'),
(138, 6, 'Enfermería', 'Ciencias de la Salud', 10, 11800000, 'enfermeria-138'),
(139, 6, 'Ingeniería Ambiental', 'Ingeniería y Tecnología', 10, 12400000, 'ingenieria-ambiental-139'),
(140, 6, 'Contaduría Pública', 'Ciencias Sociales y Humanidade', 10, 9900000, 'contaduria-publica-140'),
(141, 6, 'Arquitectura', 'Artes y Diseño', 10, 15400000, 'arquitectura-141'),
(142, 6, 'Diseño Industrial', 'Artes y Diseño', 10, 7900000, 'diseno-industrial-142'),
(143, 6, 'Medicina', 'Ciencias de la Salud', 12, 24600000, 'medicina-143'),
(144, 6, 'Odontología', 'Ciencias de la Salud', 10, 13800000, 'odontologia-144'),
(145, 7, 'Ingeniería Química', 'Ingeniería y Tecnología', 10, 14400000, 'ingenieria-quimica-145'),
(146, 7, 'Fisioterapia', 'Ciencias de la Salud', 10, 5000000, 'fisioterapia-146'),
(147, 7, 'Negocios Internacionales', 'Ciencias Sociales y Humanidade', 10, 16300000, 'negocios-internacionales-147'),
(148, 7, 'Comunicación Social y Periodismo', 'Ciencias Sociales y Humanidade', 10, 13500000, 'comunicacion-social-y-periodismo-148'),
(149, 7, 'Ingeniería Electrónica', 'Ingeniería y Tecnología', 10, 7900000, 'ingenieria-electronica-149'),
(150, 7, 'Marketing y Publicidad', 'Ciencias Sociales y Humanidade', 8, 6000000, 'marketing-y-publicidad-150'),
(151, 7, 'Medicina Veterinaria', 'Ciencias de la Salud', 10, 14100000, 'medicina-veterinaria-151'),
(152, 7, 'Economía', 'Ciencias Sociales y Humanidade', 10, 8600000, 'economia-152'),
(153, 7, 'Contaduría Pública', 'Ciencias Sociales y Humanidade', 10, 17800000, 'contaduria-publica-153'),
(154, 7, 'Artes Plásticas y Visuales', 'Artes y Diseño', 10, 13200000, 'artes-plasticas-y-visuales-154'),
(155, 7, 'Ingeniería Ambiental', 'Ingeniería y Tecnología', 10, 14800000, 'ingenieria-ambiental-155'),
(156, 7, 'Ciencia Política', 'Ciencias Sociales y Humanidade', 10, 8100000, 'ciencia-politica-156'),
(157, 7, 'Enfermería', 'Ciencias de la Salud', 10, 10400000, 'enfermeria-157'),
(158, 7, 'Administración de Empresas', 'Ciencias Sociales y Humanidade', 10, 17000000, 'administracion-de-empresas-158'),
(159, 7, 'Ingeniería Mecatrónica', 'Ingeniería y Tecnología', 10, 7500000, 'ingenieria-mecatronica-159'),
(160, 7, 'Ingeniería de Sistemas', 'Ingeniería y Tecnología', 10, 6100000, 'ingenieria-de-sistemas-160'),
(161, 7, 'Odontología', 'Ciencias de la Salud', 10, 12500000, 'odontologia-161'),
(162, 7, 'Ingeniería Civil', 'Ingeniería y Tecnología', 10, 15300000, 'ingenieria-civil-162'),
(163, 8, 'Marketing y Publicidad', 'Ciencias Sociales y Humanidade', 8, 870000, 'marketing-y-publicidad-163'),
(164, 8, 'Ingeniería Mecatrónica', 'Ingeniería y Tecnología', 10, 710000, 'ingenieria-mecatronica-164'),
(165, 8, 'Medicina', 'Ciencias de la Salud', 12, 780000, 'medicina-165'),
(166, 8, 'Enfermería', 'Ciencias de la Salud', 10, 210000, 'enfermeria-166'),
(167, 8, 'Ingeniería Ambiental', 'Ingeniería y Tecnología', 10, 210000, 'ingenieria-ambiental-167'),
(168, 8, 'Economía', 'Ciencias Sociales y Humanidade', 10, 830000, 'economia-168'),
(169, 8, 'Ingeniería Electrónica', 'Ingeniería y Tecnología', 10, 690000, 'ingenieria-electronica-169'),
(170, 8, 'Comunicación Social y Periodismo', 'Ciencias Sociales y Humanidade', 10, 620000, 'comunicacion-social-y-periodismo-170'),
(171, 8, 'Nutrición y Dietética', 'Ciencias de la Salud', 10, 250000, 'nutricion-y-dietetica-171'),
(172, 8, 'Contaduría Pública', 'Ciencias Sociales y Humanidade', 10, 800000, 'contaduria-publica-172'),
(173, 8, 'Diseño Gráfico', 'Artes y Diseño', 8, 570000, 'diseno-grafico-173'),
(174, 8, 'Odontología', 'Ciencias de la Salud', 10, 540000, 'odontologia-174'),
(175, 8, 'Ciencia Política', 'Ciencias Sociales y Humanidade', 10, 200000, 'ciencia-politica-175'),
(176, 8, 'Cine y Comunicación Audiovisual', 'Artes y Diseño', 9, 720000, 'cine-y-comunicacion-audiovisual-176'),
(177, 8, 'Medicina Veterinaria', 'Ciencias de la Salud', 10, 770000, 'medicina-veterinaria-177'),
(178, 8, 'Ingeniería de Sistemas', 'Ingeniería y Tecnología', 10, 430000, 'ingenieria-de-sistemas-178'),
(179, 8, 'Negocios Internacionales', 'Ciencias Sociales y Humanidade', 10, 720000, 'negocios-internacionales-179'),
(180, 8, 'Derecho', 'Ciencias Sociales y Humanidade', 10, 790000, 'derecho-180'),
(181, 8, 'Arquitectura', 'Artes y Diseño', 10, 430000, 'arquitectura-181'),
(182, 8, 'Psicología', 'Ciencias de la Salud', 10, 610000, 'psicologia-182'),
(183, 9, 'Arquitectura', 'Artes y Diseño', 10, 15400000, 'arquitectura-183'),
(184, 9, 'Ingeniería Electrónica', 'Ingeniería y Tecnología', 10, 13600000, 'ingenieria-electronica-184'),
(185, 9, 'Sociología', 'Ciencias Sociales y Humanidade', 10, 18000000, 'sociologia-185'),
(186, 9, 'Ciencia Política', 'Ciencias Sociales y Humanidade', 10, 5700000, 'ciencia-politica-186'),
(187, 9, 'Ingeniería Industrial', 'Ingeniería y Tecnología', 10, 11000000, 'ingenieria-industrial-187'),
(188, 9, 'Fisioterapia', 'Ciencias de la Salud', 10, 15900000, 'fisioterapia-188'),
(189, 9, 'Odontología', 'Ciencias de la Salud', 10, 6200000, 'odontologia-189'),
(190, 9, 'Ingeniería Mecatrónica', 'Ingeniería y Tecnología', 10, 11200000, 'ingenieria-mecatronica-190'),
(191, 9, 'Medicina', 'Ciencias de la Salud', 12, 18000000, 'medicina-191'),
(192, 9, 'Cine y Comunicación Audiovisual', 'Artes y Diseño', 9, 9500000, 'cine-y-comunicacion-audiovisual-192'),
(193, 9, 'Comunicación Social y Periodismo', 'Ciencias Sociales y Humanidade', 10, 12600000, 'comunicacion-social-y-periodismo-193'),
(194, 9, 'Negocios Internacionales', 'Ciencias Sociales y Humanidade', 10, 10500000, 'negocios-internacionales-194'),
(195, 9, 'Marketing y Publicidad', 'Ciencias Sociales y Humanidade', 8, 14400000, 'marketing-y-publicidad-195'),
(196, 9, 'Ingeniería Mecánica', 'Ingeniería y Tecnología', 10, 11800000, 'ingenieria-mecanica-196'),
(197, 9, 'Medicina Veterinaria', 'Ciencias de la Salud', 10, 7700000, 'medicina-veterinaria-197'),
(198, 9, 'Ingeniería Química', 'Ingeniería y Tecnología', 10, 9700000, 'ingenieria-quimica-198'),
(199, 9, 'Enfermería', 'Ciencias de la Salud', 10, 11000000, 'enfermeria-199'),
(200, 9, 'Psicología', 'Ciencias de la Salud', 10, 10000000, 'psicologia-200'),
(201, 10, 'Nutrición y Dietética', 'Ciencias de la Salud', 10, 10800000, 'nutricion-y-dietetica-201'),
(202, 10, 'Psicología', 'Ciencias de la Salud', 10, 14100000, 'psicologia-202'),
(203, 10, 'Enfermería', 'Ciencias de la Salud', 10, 14400000, 'enfermeria-203'),
(204, 10, 'Ciencia Política', 'Ciencias Sociales y Humanidade', 10, 5400000, 'ciencia-politica-204'),
(205, 10, 'Diseño Industrial', 'Artes y Diseño', 10, 14000000, 'diseno-industrial-205'),
(206, 10, 'Ingeniería Ambiental', 'Ingeniería y Tecnología', 10, 7600000, 'ingenieria-ambiental-206'),
(207, 10, 'Arquitectura de Software', 'Ingeniería y Tecnología', 10, 17700000, 'arquitectura-de-software-207'),
(208, 10, 'Ingeniería Mecánica', 'Ingeniería y Tecnología', 10, 6400000, 'ingenieria-mecanica-208'),
(209, 10, 'Ingeniería Civil', 'Ingeniería y Tecnología', 10, 16800000, 'ingenieria-civil-209'),
(210, 10, 'Negocios Internacionales', 'Ciencias Sociales y Humanidade', 10, 8700000, 'negocios-internacionales-210'),
(211, 10, 'Medicina Veterinaria', 'Ciencias de la Salud', 10, 13400000, 'medicina-veterinaria-211'),
(212, 10, 'Fisioterapia', 'Ciencias de la Salud', 10, 8300000, 'fisioterapia-212'),
(213, 10, 'Ingeniería Industrial', 'Ingeniería y Tecnología', 10, 7000000, 'ingenieria-industrial-213'),
(214, 10, 'Ingeniería de Sistemas', 'Ingeniería y Tecnología', 10, 16900000, 'ingenieria-de-sistemas-214'),
(215, 10, 'Odontología', 'Ciencias de la Salud', 10, 6400000, 'odontologia-215'),
(216, 10, 'Economía', 'Ciencias Sociales y Humanidade', 10, 8100000, 'economia-216'),
(217, 10, 'Sociología', 'Ciencias Sociales y Humanidade', 10, 7700000, 'sociologia-217'),
(218, 10, 'Arquitectura', 'Artes y Diseño', 10, 16300000, 'arquitectura-218'),
(219, 7, 'Biología', 'Investigador (El Pensador)', 10, 800000, 'biologia-178001934554'),
(220, 5, 'Física', 'Investigador (El Pensador)', 10, 750000, 'fisica-178001934525'),
(221, 10, 'Matemáticas', 'Investigador (El Pensador)', 10, 700000, 'matematicas-178001934513'),
(222, 10, 'Química', 'Investigador (El Pensador)', 10, 850000, 'quimica-178001934556'),
(223, 9, 'Astronomía', 'Investigador (El Pensador)', 10, 900000, 'astronomia-178001934576'),
(224, 7, 'Bellas Artes', 'Artístico (El Creador)', 8, 1200000, 'bellas-artes-178001934536'),
(225, 4, 'Diseño Gráfico', 'Artístico (El Creador)', 8, 1150000, 'diseno-grafico-178001934586'),
(226, 9, 'Música', 'Artístico (El Creador)', 10, 1500000, 'musica-178001934529'),
(227, 9, 'Cine y Televisión', 'Artístico (El Creador)', 8, 2000000, 'cine-y-television-178001934513'),
(228, 4, 'Literatura', 'Artístico (El Creador)', 8, 900000, 'literatura-178001934548'),
(229, 7, 'Psicología', 'Social (El Ayudador)', 10, 1300000, 'psicologia-178001934564'),
(230, 9, 'Trabajo Social', 'Social (El Ayudador)', 8, 850000, 'trabajo-social-178001934565'),
(231, 10, 'Sociología', 'Social (El Ayudador)', 10, 900000, 'sociologia-178001934651'),
(232, 1, 'Enfermería', 'Social (El Ayudador)', 8, 1100000, 'enfermeria-178001934680'),
(233, 1, 'Licenciatura en Pedagogía', 'Social (El Ayudador)', 10, 800000, 'licenciatura-en-pedagogia-178001934644'),
(234, 8, 'Administración de Empresas', 'Emprendedor (El Persuasor)', 10, 1800000, 'administracion-de-empresas-178001934648'),
(235, 4, 'Negocios Internacionales', 'Emprendedor (El Persuasor)', 10, 2000000, 'negocios-internacionales-178001934631'),
(236, 7, 'Mercadeo y Publicidad', 'Emprendedor (El Persuasor)', 8, 1600000, 'mercadeo-y-publicidad-178001934629'),
(237, 5, 'Derecho', 'Emprendedor (El Persuasor)', 10, 1700000, 'derecho-178001934624'),
(238, 9, 'Relaciones Públicas', 'Emprendedor (El Persuasor)', 8, 1400000, 'relaciones-publicas-178001934655'),
(239, 9, 'Contaduría Pública', 'Convencional (El Organizador)', 10, 1200000, 'contaduria-publica-178001934646'),
(240, 8, 'Finanzas', 'Convencional (El Organizador)', 8, 1500000, 'finanzas-178001934670'),
(241, 5, 'Gestión Administrativa', 'Convencional (El Organizador)', 8, 1100000, 'gestion-administrativa-178001934627'),
(242, 9, 'Ingeniería Industrial', 'Convencional (El Organizador)', 10, 1900000, 'ingenieria-industrial-178001934688'),
(243, 3, 'Estadística', 'Convencional (El Organizador)', 8, 1000000, 'estadistica-178001934661'),
(244, 5, 'Ingeniería Mecánica', 'Realista (El Hacedor)', 10, 1600000, 'ingenieria-mecanica-178001952311'),
(245, 4, 'Arquitectura', 'Realista (El Hacedor)', 10, 2100000, 'arquitectura-178001952375'),
(246, 6, 'Ingeniería Civil', 'Realista (El Hacedor)', 10, 1800000, 'ingenieria-civil-178001952360'),
(247, 5, 'Agronomía', 'Realista (El Hacedor)', 10, 1200000, 'agronomia-178001952378'),
(248, 2, 'Topografía', 'Realista (El Hacedor)', 8, 900000, 'topografia-178001952340'),
(249, 8, 'Ingeniería Electrónica', 'Realista (El Hacedor)', 10, 1750000, 'ingenieria-electronica-178001952380'),
(250, 7, 'Ingeniería Ambiental', 'Realista (El Hacedor)', 10, 1400000, 'ingenieria-ambiental-178001952339');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resenias`
--

CREATE TABLE `resenias` (
  `id_resenia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_universidad` int(11) NOT NULL,
  `calificacion` tinyint(4) NOT NULL,
  `comentario` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resenias`
--

INSERT INTO `resenias` (`id_resenia`, `id_usuario`, `id_universidad`, `calificacion`, `comentario`, `fecha`) VALUES
(1, 1, 8, 5, 'excelente la recomiendo mucho', '2026-05-22 23:58:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id_usuario` int(11) NOT NULL,
  `id_cuestionario` int(11) DEFAULT NULL,
  `id_pregunta` int(11) NOT NULL,
  `respuesta` varchar(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`id_usuario`, `id_cuestionario`, `id_pregunta`, `respuesta`, `fecha`) VALUES
(1, 1, 1, 'd', '2026-05-18'),
(1, 1, 2, 'c', '2026-05-18'),
(1, 1, 3, 'b', '2026-05-18'),
(1, 1, 4, 'd', '2026-05-18'),
(1, 1, 5, 'd', '2026-05-18'),
(1, 3, 9, 'a', '2026-05-18'),
(1, 3, 10, 'c', '2026-05-18'),
(1, 4, 11, 'a', '2026-05-29'),
(1, 4, 12, 'd', '2026-05-29'),
(1, 2, 13, 'a', '2026-05-29'),
(1, 2, 14, 'a', '2026-05-29'),
(1, 2, 15, 'd', '2026-05-29'),
(1, 2, 16, 'c', '2026-05-29'),
(1, 2, 17, 'e', '2026-05-29'),
(1, 2, 18, 'd', '2026-05-29'),
(1, 2, 19, 'e', '2026-05-29'),
(1, 2, 20, 'd', '2026-05-29'),
(1, 2, 21, 'c', '2026-05-29'),
(1, 2, 22, 'a', '2026-05-29'),
(1, 2, 23, 'd', '2026-05-29'),
(1, 2, 24, 'e', '2026-05-29'),
(1, 2, 25, 'f', '2026-05-29'),
(1, 2, 26, 'e', '2026-05-29'),
(1, 2, 27, 'd', '2026-05-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `simulacros`
--

CREATE TABLE `simulacros` (
  `id_simulacro` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `materia` varchar(50) NOT NULL,
  `color` varchar(20) DEFAULT '#3b82f6',
  `icono` varchar(50) DEFAULT 'fa-solid fa-file-pen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `simulacros`
--

INSERT INTO `simulacros` (`id_simulacro`, `titulo`, `descripcion`, `materia`, `color`, `icono`) VALUES
(1, 'Simulacro Básico de Matemáticas', 'Evalúa tus conocimientos en álgebra, geometría y estadística según los lineamientos del ICFES.', 'Matemáticas', '#3b82f6', 'fa-solid fa-calculator'),
(2, 'Simulacro de Lectura Crítica', 'Pon a prueba tu capacidad de análisis, comprensión y evaluación de diferentes tipos de textos.', 'Lectura Crítica', '#10b981', 'fa-solid fa-book-open-reader'),
(3, 'simulacro de lectura critica', '¡Pon a prueba tu nivel para el ICFES Saber 11! 🚀\r\n\r\nEste simulacro de Lectura Crítica está diseñado bajo los estándares oficiales del examen de Estado. A través de textos continuos, discontinuos, filosóficos y literarios, evaluarás tus componentes clave: desde identificar la tesis de un autor hasta interpretar dobles sentidos e ironías.\r\n\r\nPreguntas tipo ICFES: Evaluadas por competencias (localizar, comprender y reflexionar).\r\n\r\nRetroalimentación inmediata: No solo sabrás si acertaste, sino el porqué de la respuesta correcta y trucos de descarte.\r\n\r\nPráctica ágil: Ideal para estudiar a tu propio ritmo, en cualquier momento y lugar.\r\n\r\n¡Entrena tu mente, mejora tu comprensión lectora y asegura tu cupo en la universidad! 🎯', 'Lectura Crítica', '#3bf761', 'fa-solid fa-book');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `simulacro_intentos`
--

CREATE TABLE `simulacro_intentos` (
  `id_intento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_simulacro` int(11) NOT NULL,
  `puntaje` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `simulacro_intentos`
--

INSERT INTO `simulacro_intentos` (`id_intento`, `id_usuario`, `id_simulacro`, `puntaje`, `fecha`) VALUES
(1, 1, 1, 25, '2026-05-29 02:30:30'),
(2, 1, 2, 67, '2026-05-31 01:39:08'),
(3, 3, 3, 0, '2026-05-31 03:01:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `simulacro_preguntas`
--

CREATE TABLE `simulacro_preguntas` (
  `id_pregunta` int(11) NOT NULL,
  `id_simulacro` int(11) NOT NULL,
  `pregunta` text NOT NULL,
  `opcion_a` text NOT NULL,
  `opcion_b` text NOT NULL,
  `opcion_c` text NOT NULL,
  `opcion_d` text NOT NULL,
  `correcta` char(1) NOT NULL,
  `justificacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `simulacro_preguntas`
--

INSERT INTO `simulacro_preguntas` (`id_pregunta`, `id_simulacro`, `pregunta`, `opcion_a`, `opcion_b`, `opcion_c`, `opcion_d`, `correcta`, `justificacion`) VALUES
(1, 1, 'Si un artículo tiene un descuento del 20% y su precio final es $80.000, ¿cuál era su precio original?', '$96.000', '$100.000', '$120.000', '$84.000', 'b', 'Si el precio final es el 80% (100% - 20%), hacemos regla de tres: (80.000 * 100) / 80 = 100.000.'),
(2, 1, '¿Cuál es el área de un triángulo cuya base es 10 cm y su altura es 5 cm?', '25 cm²', '50 cm²', '15 cm²', '100 cm²', 'a', 'El área de un triángulo es (base * altura) / 2. En este caso: (10 * 5) / 2 = 25.'),
(3, 1, 'Si f(x) = 2x² - 3x + 1, ¿cuál es el valor de f(2)?', '1', '3', '5', '7', 'b', 'Sustituyendo x por 2: f(2) = 2(2)² - 3(2) + 1 = 2(4) - 6 + 1 = 8 - 6 + 1 = 3.'),
(4, 1, 'En una caja hay 3 bolas rojas, 2 azules y 5 verdes. Si se saca una al azar, ¿cuál es la probabilidad de que sea roja?', '3/10', '1/3', '1/5', '1/2', 'a', 'Hay 3 bolas rojas de un total de 10 bolas (3+2+5). La probabilidad es Casos Favorables / Casos Totales = 3/10.'),
(5, 2, 'El calentamiento global no solo derrite los glaciares, sino que altera los patrones de lluvia y afecta la agricultura. Según el texto, el calentamiento global:', 'Solo afecta a los glaciares y el frío.', 'Tiene consecuencias multidimensionales en el clima y la alimentación.', 'Es un problema exclusivo de la agricultura.', 'No tiene solución a corto plazo.', 'b', 'El texto menciona múltiples efectos (glaciares, lluvias, agricultura), lo que indica consecuencias en varias dimensiones (clima y alimentación).'),
(6, 2, 'Lea el siguiente enunciado: \"La persistencia es el vehículo que te lleva a tus metas\". ¿Qué figura literaria predomina en la oración?', 'Metáfora', 'Símil', 'Hipérbole', 'Personificación', 'a', 'Se está identificando un concepto abstracto (la persistencia) con un objeto concreto (vehículo) sin usar nexos comparativos como \"como\" o \"parece\".'),
(7, 2, '¿Cuál es la función principal de un texto argumentativo?', 'Describir un paisaje o personaje de forma objetiva.', 'Contar una historia o suceso en orden cronológico.', 'Persuadir al lector sobre una postura o tesis específica.', 'Informar sobre un hecho noticioso sin dar opinión.', 'c', 'El texto argumentativo busca convencer al receptor mediante razones o argumentos sobre la validez de una tesis o postura.'),
(8, 3, 'A medida que las plataformas digitales se consolidan como el principal escenario de la interacción humana, se hace más evidente una paradoja: nunca antes habíamos estado tan comunicados y, al mismo tiempo, tan aislados. El sociólogo Zygmunt Bauman acuñó el término \"modernidad líquida\" para describir una época donde los vínculos humanos son precarios y volátiles. En el entorno virtual, esta liquidez se potencia. Las redes sociales nos ofrecen la ilusión de comunidad, pero lo que realmente nos brindan son conexiones, no relaciones. La diferencia no es meramente semántica; conectar exige solo un clic, relacionarse exige comprometer el cuerpo, el tiempo y la atención de manera sostenida.\r\n\r\nEl diseño de las interfaces digitales fomenta un consumo fragmentado de la realidad. Pasamos de una noticia trágica sobre el cambio climático a un video de baile de quince segundos, y de ahí a una publicidad de zapatos. Esta estimulación constante satura el sistema de recompensa del cerebro mediante ráfagas de dopamina, reduciendo drásticamente nuestra capacidad de concentración profunda y de empatía. Para compadecerse del sufrimiento ajeno o para comprender un argumento complejo, se necesita pausa. La velocidad de la navegación web, por el contrario, premia la reacción visceral e inmediata.\r\n\r\nQuienes defienden a ultranza la digitalización de la vida pública sostienen que las redes democratizan la palabra. Es cierto que hoy cualquiera puede publicar un pensamiento, pero esto no garantiza que sea escuchado. Lo que impera en la red no es el mejor argumento, sino el que genera más interacciones, y la psicología humana dicta que la indignación y el odio son los contenidos que más rápido se difunden. Así, el espacio público digital se convierte en un coliseo de monólogos furiosos, donde la deliberación democrática —el verdadero fin de la libre expresión— queda sepultada bajo el ruido algorítmico.\r\n\r\n\r\nDe acuerdo con el texto, la diferencia fundamental entre \"conectar\" y \"relacionarse\" radica en que:', 'Conectar es un proceso exclusivo de las generaciones jóvenes, mientras que relacionarse pertenece a los adultos', 'Relacionarse exige un compromiso de tiempo, cuerpo y atención, mientras que conectar solo requiere un clic.', 'Conectar fomenta la empatía y la deliberación profunda, mientras que relacionarse aísla a las personas.', 'Relacionarse depende del diseño de las interfaces virtuales y conectar depende del usuario.', 'B', '¡Correcto! El texto lo dice de manera explícita en el primer párrafo: conectar solo exige un clic, mientras que relacionarse exige comprometer cuerpo, tiempo y atención.'),
(9, 3, '¿Qué función cumple la mención de la \"modernidad líquida\" de Zygmunt Bauman en el primer párrafo del texto?', 'Contradecir la tesis del autor sobre el aislamiento en la sociedad contemporánea.', 'Demostrar que los vínculos humanos en internet son más fuertes que en el mundo físico', 'Servir como un argumento de autoridad para respaldar la idea de que los lazos actuales son precarios.', 'Introducir un concepto científico que explica el funcionamiento de los algoritmos digitales.', 'C', 'El autor usa a un pensador reconocido (Bauman) para darle peso y validez científica a su idea de que los lazos actuales son frágiles.'),
(10, 3, 'Considere la siguiente frase del segundo párrafo: “Esta estimulación constante satura el sistema de recompensa del cerebro mediante ráfagas de dopamina, reduciendo drásticamente nuestra capacidad de concentración profunda y de empatía”.\r\n\r\nA partir de este enunciado, se puede inferir correctamente que para el autor:', 'La velocidad y la fragmentación digital tienen un impacto biológico y psicológico negativo.', 'La dopamina es una sustancia que ayuda a comprender mejor los problemas del cambio climático.', 'Las interfaces digitales fueron creadas con el único propósito de curar enfermedades mentales', 'El cerebro humano prefiere los argumentos complejos a los videos de corta duración', 'A', 'Al hablar de \"satura el cerebro\", \"dopamina\" y \"reduce la empatía\", el autor conecta la tecnología con efectos biológicos y psicológicos dañinos'),
(11, 3, 'A partir del último párrafo, ¿cuál de los siguientes enunciados describe mejor la postura del autor frente a la idea de que las redes sociales democratizan la palabra?', 'La apoya totalmente, porque las redes permiten que cualquier ciudadano publique lo que piensa sin censura previa.', 'La cuestiona, argumentando que la visibilidad en las redes no depende de la calidad del argumento sino de la capacidad de generar interacciones y reacciones viscerales.', 'La ignora, prefiriendo centrarse en los efectos químicos de la dopamina en los jóvenes que usan internet.', 'La defiende a medias, sugiriendo que la indignación y el odio son herramientas necesarias para la deliberación democrática.', 'B', 'El autor no cree en la \"democratización\" pura de las redes; argumenta que los algoritmos premian el escándalo y el odio, no el valor de las ideas.'),
(12, 3, '¿Cuál es la estructura argumentativa que predomina en el texto anterior?', 'Presentación de una tesis, desarrollo de argumentos basados en causas/efectos y refutación de una postura contraria.', 'Narración cronológica de la evolución de internet, seguida de una lista de consejos para usar redes sociales.', 'Planteamiento de un problema científico, exposición de experimentos biológicos y conclusión con una moraleja.', 'Exposición de dos puntos de vista opuestos que se reconcilian al final mediante una síntesis teórica', 'A', 'El texto presenta una idea central, analiza sus causas/consecuencias (párrafo 2) y en el párrafo 3 presenta la postura contraria (democratización) para tumbarla.'),
(13, 3, 'Si se quisiera debilitar el argumento central del autor expuesto en el último párrafo, ¿cuál de los siguientes hechos reales sería el más adecuado?', 'Un estudio que demuestre que el odio en internet ha aumentado en los últimos cinco años.', 'El testimonio de un filósofo que afirma que los monólogos virtuales destruyen el tejido social.', 'Una campaña digital comunitaria que logró coordinar ayuda humanitaria internacional y recolectar fondos para un hospital público mediante un debate pacífico y organizado.', 'Una estadística que indique que las personas pasan más de seis horas diarias frente a una pantalla.', 'C', 'Si demuestras que una red social sirvió para un debate pacífico y constructivo que ayudó a una comunidad, destruyes la tesis del autor de que las redes \"solo generan odio y monólogos furiosos\".'),
(14, 3, 'La soga\r\n\r\nA las siete de la mañana, cuando el sol apenas lograba disipar la niebla del valle, don Lucas ya estaba de pie junto al pozo, sosteniendo entre sus manos callosas un trozo de soga vieja. No medía más de dos metros, pero para él tenía el peso de una condena entera. La soga había pertenecido al buey con el que su padre levantó los primeros muros de la casa, el mismo animal que una noche de invierno se despeñó por el barranco arrastrando consigo las esperanzas de la familia.\r\n\r\n—¿Todavía guarda esa porquería? —preguntó su hijo mayor, guardando las herramientas en el camión sin mirarlo—. Eso ya no sirve ni para amarrar un bulto de papas. Bótela, viejo. El futuro no se amarra con cabuya podrida.\r\n\r\nDon Lucas no respondió. Pasó los dedos por el cáñamo deshilachado, sintiendo la aspereza de la tierra reseca que aún habitaba entre los nudos. El muchacho tenía razón en algo: la soga no servía para el trabajo del campo. Sin embargo, para el viejo, la soga no era un instrumento de carga, sino un testigo. Guardarla era la única forma de recordar que la casa que hoy habitaban, con su techo de zinc y sus pisos de cemento, se había pagado con la piel de un animal y el lomo quebrado de un hombre que ya nadie mencionaba. El camión arrancó dejando una nube de humo negro. Don Lucas enrolló la soga con cuidado y la guardó de nuevo en el fondo del baúl, justo debajo de las escrituras de la tierra.\r\n\r\nEn el texto, el objeto que desencadena el conflicto generacional entre don Lucas y su hijo es:\r\n', 'El camión donde se guardan las herramientas de trabajo.', 'Las escrituras de la propiedad que están en el fondo del baúl.', 'Un trozo de soga vieja que perteneció al buey de la familia.', 'El techo de zinc y los pisos de cemento de la casa del valle.', 'C', 'Toda la discusión gira en torno a la soga vieja que don Lucas tiene en la mano y que su hijo le pide tirar a la basura.'),
(15, 3, '¿Qué significado tiene la soga para el hijo de don Lucas en comparación con lo que significa para el viejo?', 'Para el hijo representa un amuleto de la buena suerte; para el viejo, un recuerdo trágico.', 'Para el hijo es una herramienta inservible que debe desecharse; para el viejo, un símbolo de memoria y sacrificio familiar.', 'Para el hijo es un objeto valioso que quiere vender; para el viejo, una soga común para amarrar papas.', 'Para el hijo representa el futuro de la finca; para el viejo, el fin de su vejez.', 'B', 'Es el núcleo del texto: el hijo ve el objeto desde su utilidad material (no sirve), mientras el padre lo ve desde su carga emocional y de memoria.'),
(16, 3, 'Cuando el hijo dice: “El futuro no se amarra con cabuya podrida”, utiliza una metáfora para expresar que:', 'Las sogas de cáñamo deben ser reemplazadas por herramientas modernas de plástico o metal.', 'El éxito económico de la familia depende exclusivamente de la siembra y comercialización de la papa.', 'No se puede construir el porvenir o avanzar si se permanece atado a los recuerdos y tragedias del pasado.', 'Los padres no deben interferir en las decisiones laborales de los hijos que manejan camiones.', 'C', 'La \"cabuya podrida\" representa el pasado y el recuerdo del buey muerto. El hijo quiere decir que quedarse pensando en eso frena el progreso.'),
(17, 3, 'A partir de la lectura completa del texto, se puede concluir que el autor busca que el lector reflexione principalmente sobre:', 'La importancia de modernizar los procesos agrícolas para evitar accidentes con los animales.', 'El valor de la memoria histórica familiar frente al pragmatismo y desapego de las nuevas generaciones.', 'Los problemas legales derivados de la pérdida de escrituras de tierras en el sector rural.', 'La superioridad moral de los jóvenes frente a la terquedad e ignorancia de los ancianos.', 'B', 'El cuento contrasta la visión pragmática del hijo (olvidar lo viejo para avanzar) con la poética del padre (honrar el esfuerzo de los ancestros).'),
(18, 3, 'La acción de guardar la soga \"justo debajo de las escrituras de la tierra\" al final del texto sugiere simbólicamente que:', 'El valor real de la propiedad terrateniente está respaldado por el esfuerzo histórico y el sacrificio que costó conseguirla.', 'Don Lucas tiene miedo de que su hijo le robe los documentos legales de la casa', 'El baúl es el único lugar seguro de la casa donde no entra la humedad del valle.', 'La soga y las escrituras son objetos idénticos que sirven para la misma función legal.', 'A', 'Poner la soga junto a las escrituras significa que la tierra no es solo un papel legal; vale por el sudor y el lomo quebrado del abuelo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `simulacro_respuestas`
--

CREATE TABLE `simulacro_respuestas` (
  `id_intento` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `respuesta_usuario` char(1) NOT NULL,
  `es_correcta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `simulacro_respuestas`
--

INSERT INTO `simulacro_respuestas` (`id_intento`, `id_pregunta`, `respuesta_usuario`, `es_correcta`) VALUES
(1, 1, 'a', 0),
(1, 2, 'b', 0),
(1, 3, 'a', 0),
(1, 4, 'a', 1),
(2, 5, 'b', 1),
(2, 6, 'b', 0),
(2, 7, 'c', 1),
(3, 8, 'a', 0),
(3, 9, 'b', 0),
(3, 10, 'b', 0),
(3, 11, 'b', 0),
(3, 12, 'd', 0),
(3, 13, 'c', 0),
(3, 14, 'a', 0),
(3, 15, 'b', 0),
(3, 16, 'b', 0),
(3, 17, 'c', 0),
(3, 18, 'c', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `universidades`
--

CREATE TABLE `universidades` (
  `id_universidad` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `ciudad` varchar(30) DEFAULT NULL,
  `tipo` tinyint(4) DEFAULT NULL,
  `sitio_web` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `jornadas` varchar(50) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `universidades`
--

INSERT INTO `universidades` (`id_universidad`, `nombre`, `ciudad`, `tipo`, `sitio_web`, `descripcion`, `jornadas`, `slug`) VALUES
(1, 'Universidad Nacional de Colombia', 'Bogotá', 0, 'https://unal.edu.co', 'La universidad pública más prestigiosa del país, líder en investigación y formación académica de excelencia.', 'Diurna / Nocturna', 'universidad-nacional-de-colombia-1'),
(2, 'Universidad de los Andes', 'Bogotá', 1, 'https://uniandes.edu.co', 'Una de las mejores universidades privadas de América Latina, con un campus de vanguardia y convenios globales.', 'Diurna', 'universidad-de-los-andes-2'),
(3, 'Universidad de Antioquia', 'Medellín', 0, 'https://udea.edu.co', 'Referente académico e investigativo en el departamento de Antioquia, con un gran impacto social.', 'Diurna', 'universidad-de-antioquia-3'),
(4, 'Universidad del Valle', 'Cali', 0, 'https://univalle.edu.co', 'Líder indiscutible del suroccidente colombiano, con un campus campestre espectacular y alta calidad.', 'Diurna / Nocturna', 'universidad-del-valle-4'),
(5, 'Universidad Pontificia Javeriana', 'Bogotá', 1, 'https://javeriana.edu.co', 'Universidad privada de tradición jesuita, reconocida por su formación integral y humana.', 'Diurna / Virtual', 'universidad-pontificia-javeriana-5'),
(6, 'Universidad EAFIT', 'Medellín', 1, 'https://eafit.edu.co', 'Institución privada de alta calidad, reconocida por su liderazgo en negocios, ingeniería e innovación empresarial.', 'Diurna', 'universidad-eafit-6'),
(7, 'Universidad Pontificia Bolivariana (UPB)', 'Medellín', 1, 'https://upb.edu.co', 'Referente académico tradicional, destaca por su formación integral, diseño, arquitectura e ingenierías.', 'Diurna', 'universidad-pontificia-bolivariana-upb-7'),
(8, 'Instituto Tecnológico Metropolitano (ITM)', 'Medellín', 0, 'https://itm.edu.co', 'Institución universitaria pública enfocada en la formación tecnológica y ciencias aplicadas para la industria.', 'Diurna / Nocturna', 'instituto-tecnologico-metropolitano-itm-8'),
(9, 'Universidad de Medellín', 'Medellín', 1, 'https://udem.edu.co', 'Campus verde y ecológico, fuerte en ciencias sociales, derecho, comunicación e ingeniería ambiental.', 'Diurna', 'universidad-de-medellin-9'),
(10, 'Universidad EIA', 'Medellín', 1, 'https://eia.edu.co', 'Escuela de Ingeniería de Antioquia, especializada exclusivamente en formar los mejores ingenieros y profesionales de la salud del país.', 'Diurna', 'universidad-eia-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuarios` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ciudad` varchar(20) DEFAULT NULL,
  `rol` varchar(20) DEFAULT 'usuario',
  `f_registro` date DEFAULT NULL,
  `avatar` varchar(50) DEFAULT 'av1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `nombre`, `correo`, `password`, `ciudad`, `rol`, `f_registro`, `avatar`) VALUES
(1, 'Usuario de Prueba', 'prueba@correo.com', '$2y$10$.yjw./HZ3NNZaZmyfz3N3.j5a6AJbDtNJPIkwOdfN6MjNQD7iCvpG', 'Medellín', 'usuario', '2026-05-17', 'av2'),
(2, 'JUAN PEREZ', 'JUAN@GMAIL.COM', '$2y$10$kxNetdftI4zlVE0ol6sByOZU2X.8E5MaMeGxWSoKMXgJQP4LR8.HK', 'Medellín', 'usuario', '2026-05-18', 'av1'),
(3, 'Administrador', 'admin@orientatufuturo.com', '$2y$10$DZvAXUCzQHYNeLQJQZjKPONpQo732StkrTFVSEgow9C82Wk87rTDq', 'AdminCity', 'admin', '2026-05-30', 'av1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_becas`
--

CREATE TABLE `usuario_becas` (
  `id_usuario` int(11) NOT NULL,
  `id_beca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_becas`
--

INSERT INTO `usuario_becas` (`id_usuario`, `id_beca`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_cuestionario`
--

CREATE TABLE `usuario_cuestionario` (
  `id_usuario` int(11) NOT NULL,
  `id_cuestionario` int(11) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_cuestionario`
--

INSERT INTO `usuario_cuestionario` (`id_usuario`, `id_cuestionario`, `fecha`) VALUES
(1, 1, '2026-05-18'),
(1, 2, '2026-05-29'),
(1, 3, '2026-05-18'),
(1, 4, '2026-05-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_programa`
--

CREATE TABLE `usuario_programa` (
  `id_usuario` int(11) NOT NULL,
  `id_programa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_programa`
--

INSERT INTO `usuario_programa` (`id_usuario`, `id_programa`) VALUES
(1, 7),
(1, 8),
(1, 9);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id_areas`);

--
-- Indices de la tabla `becas`
--
ALTER TABLE `becas`
  ADD PRIMARY KEY (`id_becas`);

--
-- Indices de la tabla `cuestionario`
--
ALTER TABLE `cuestionario`
  ADD PRIMARY KEY (`id_cuestionario`),
  ADD KEY `fk_cuestionario_area` (`id_area`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `fk_preguntas_cuestionario` (`id_cuestionario`);

--
-- Indices de la tabla `programas_academicos`
--
ALTER TABLE `programas_academicos`
  ADD PRIMARY KEY (`id_programa`),
  ADD KEY `fk_prog_universidad` (`id_universidad`);

--
-- Indices de la tabla `resenias`
--
ALTER TABLE `resenias`
  ADD PRIMARY KEY (`id_resenia`),
  ADD KEY `id_universidad` (`id_universidad`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id_usuario`,`id_pregunta`),
  ADD KEY `fk_resp_cuestionario` (`id_cuestionario`),
  ADD KEY `fk_resp_pregunta` (`id_pregunta`);

--
-- Indices de la tabla `simulacros`
--
ALTER TABLE `simulacros`
  ADD PRIMARY KEY (`id_simulacro`);

--
-- Indices de la tabla `simulacro_intentos`
--
ALTER TABLE `simulacro_intentos`
  ADD PRIMARY KEY (`id_intento`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_simulacro` (`id_simulacro`);

--
-- Indices de la tabla `simulacro_preguntas`
--
ALTER TABLE `simulacro_preguntas`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `id_simulacro` (`id_simulacro`);

--
-- Indices de la tabla `simulacro_respuestas`
--
ALTER TABLE `simulacro_respuestas`
  ADD PRIMARY KEY (`id_intento`,`id_pregunta`),
  ADD KEY `id_pregunta` (`id_pregunta`);

--
-- Indices de la tabla `universidades`
--
ALTER TABLE `universidades`
  ADD PRIMARY KEY (`id_universidad`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuarios`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `usuario_becas`
--
ALTER TABLE `usuario_becas`
  ADD PRIMARY KEY (`id_usuario`,`id_beca`),
  ADD KEY `fk_ub_beca` (`id_beca`);

--
-- Indices de la tabla `usuario_cuestionario`
--
ALTER TABLE `usuario_cuestionario`
  ADD PRIMARY KEY (`id_usuario`,`id_cuestionario`),
  ADD KEY `fk_uc_cuestionario` (`id_cuestionario`);

--
-- Indices de la tabla `usuario_programa`
--
ALTER TABLE `usuario_programa`
  ADD PRIMARY KEY (`id_usuario`,`id_programa`),
  ADD KEY `fk_up_programa` (`id_programa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_areas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `becas`
--
ALTER TABLE `becas`
  MODIFY `id_becas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `cuestionario`
--
ALTER TABLE `cuestionario`
  MODIFY `id_cuestionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `programas_academicos`
--
ALTER TABLE `programas_academicos`
  MODIFY `id_programa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT de la tabla `resenias`
--
ALTER TABLE `resenias`
  MODIFY `id_resenia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `simulacros`
--
ALTER TABLE `simulacros`
  MODIFY `id_simulacro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `simulacro_intentos`
--
ALTER TABLE `simulacro_intentos`
  MODIFY `id_intento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `simulacro_preguntas`
--
ALTER TABLE `simulacro_preguntas`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `universidades`
--
ALTER TABLE `universidades`
  MODIFY `id_universidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuestionario`
--
ALTER TABLE `cuestionario`
  ADD CONSTRAINT `fk_cuestionario_area` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id_areas`);

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `fk_preguntas_cuestionario` FOREIGN KEY (`id_cuestionario`) REFERENCES `cuestionario` (`id_cuestionario`);

--
-- Filtros para la tabla `programas_academicos`
--
ALTER TABLE `programas_academicos`
  ADD CONSTRAINT `fk_prog_universidad` FOREIGN KEY (`id_universidad`) REFERENCES `universidades` (`id_universidad`);

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `fk_resp_cuestionario` FOREIGN KEY (`id_cuestionario`) REFERENCES `cuestionario` (`id_cuestionario`),
  ADD CONSTRAINT `fk_resp_pregunta` FOREIGN KEY (`id_pregunta`) REFERENCES `preguntas` (`id_pregunta`),
  ADD CONSTRAINT `fk_resp_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuarios`);

--
-- Filtros para la tabla `simulacro_intentos`
--
ALTER TABLE `simulacro_intentos`
  ADD CONSTRAINT `simulacro_intentos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE,
  ADD CONSTRAINT `simulacro_intentos_ibfk_2` FOREIGN KEY (`id_simulacro`) REFERENCES `simulacros` (`id_simulacro`) ON DELETE CASCADE;

--
-- Filtros para la tabla `simulacro_preguntas`
--
ALTER TABLE `simulacro_preguntas`
  ADD CONSTRAINT `simulacro_preguntas_ibfk_1` FOREIGN KEY (`id_simulacro`) REFERENCES `simulacros` (`id_simulacro`) ON DELETE CASCADE;

--
-- Filtros para la tabla `simulacro_respuestas`
--
ALTER TABLE `simulacro_respuestas`
  ADD CONSTRAINT `simulacro_respuestas_ibfk_1` FOREIGN KEY (`id_intento`) REFERENCES `simulacro_intentos` (`id_intento`) ON DELETE CASCADE,
  ADD CONSTRAINT `simulacro_respuestas_ibfk_2` FOREIGN KEY (`id_pregunta`) REFERENCES `simulacro_preguntas` (`id_pregunta`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuario_becas`
--
ALTER TABLE `usuario_becas`
  ADD CONSTRAINT `fk_ub_beca` FOREIGN KEY (`id_beca`) REFERENCES `becas` (`id_becas`),
  ADD CONSTRAINT `fk_ub_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuarios`);

--
-- Filtros para la tabla `usuario_cuestionario`
--
ALTER TABLE `usuario_cuestionario`
  ADD CONSTRAINT `fk_uc_cuestionario` FOREIGN KEY (`id_cuestionario`) REFERENCES `cuestionario` (`id_cuestionario`),
  ADD CONSTRAINT `fk_uc_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuarios`);

--
-- Filtros para la tabla `usuario_programa`
--
ALTER TABLE `usuario_programa`
  ADD CONSTRAINT `fk_up_programa` FOREIGN KEY (`id_programa`) REFERENCES `programas_academicos` (`id_programa`),
  ADD CONSTRAINT `fk_up_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuarios`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
