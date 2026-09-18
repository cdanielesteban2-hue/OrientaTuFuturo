<?php
include_once "conexion.php";
include_once "usuario.php";
include_once "universidad.php";
include_once "programaacademico.php";
include_once "beca.php";
include_once "cuestionario.php";

class Seeder {
    public static function ejecutar() {
        $db = baseDatos::crearInstancia();

        // 1. Verificar si ya hay datos en "areas" para no duplicar
        $check = $db->query("SELECT COUNT(*) FROM areas")->fetchColumn();
        if ($check > 0) {
            return; // Ya está sembrado
        }

        // 2. Insertar Áreas Vocacionales
        Cuestionario::crearArea("Ingeniería y Tecnología", "Enfocada en el desarrollo tecnológico, desarrollo de software, análisis de sistemas y construcción física o de datos.");
        Cuestionario::crearArea("Ciencias de la Salud", "Orientada a la prevención, diagnóstico, tratamiento de enfermedades y cuidado del bienestar mental y físico.");
        Cuestionario::crearArea("Ciencias Sociales y Humanidades", "Enfocada en el estudio del comportamiento humano, leyes, negocios, comunicación y administración pública.");
        Cuestionario::crearArea("Artes y Diseño", "Centrada en la expresión creativa, diseño estético, arquitectura, música, artes visuales y escénicas.");

        // Obtener ids de las áreas creadas
        $areas = $db->query("SELECT * FROM areas")->fetchAll();
        $idIng = $areas[0]['id_areas'];
        $idSalud = $areas[1]['id_areas'];
        $idSoc = $areas[2]['id_areas'];
        $idArtes = $areas[3]['id_areas'];

        // 3. Insertar Universidades (tipo: 0 = Pública, 1 = Privada)
        Universidad::crear("Universidad Nacional de Colombia", "Bogotá", 0, "https://unal.edu.co", "La universidad pública más prestigiosa del país, líder en investigación y formación académica de excelencia.", "Diurna / Nocturna");
        Universidad::crear("Universidad de los Andes", "Bogotá", 1, "https://uniandes.edu.co", "Una de las mejores universidades privadas de América Latina, con un campus de vanguardia y convenios globales.", "Diurna");
        Universidad::crear("Universidad de Antioquia", "Medellín", 0, "https://udea.edu.co", "Referente académico e investigativo en el departamento de Antioquia, con un gran impacto social.", "Diurna");
        Universidad::crear("Universidad del Valle", "Cali", 0, "https://univalle.edu.co", "Líder indiscutible del suroccidente colombiano, con un campus campestre espectacular y alta calidad.", "Diurna / Nocturna");
        Universidad::crear("Universidad Pontificia Javeriana", "Bogotá", 1, "https://javeriana.edu.co", "Universidad privada de tradición jesuita, reconocida por su formación integral y humana.", "Diurna / Virtual");

        // Obtener ids de las universidades creadas
        $unis = $db->query("SELECT * FROM universidades")->fetchAll();
        $uNal = $unis[0]['id_universidad'];
        $uAndes = $unis[1]['id_universidad'];
        $uUdea = $unis[2]['id_universidad'];
        $uUnivalle = $unis[3]['id_universidad'];
        $uJaveriana = $unis[4]['id_universidad'];

        // 4. Insertar Programas Académicos (duracion en semestres)
        // Universidad Nacional
        ProgramasAcademicos::crear($uNal, "Ingeniería de Sistemas", "Ingeniería y Tecnología", 10, 850000);
        ProgramasAcademicos::crear($uNal, "Medicina", "Ciencias de la Salud", 12, 950000);
        ProgramasAcademicos::crear($uNal, "Derecho", "Ciencias Sociales y Humanidades", 10, 750000);
        ProgramasAcademicos::crear($uNal, "Diseño Gráfico", "Artes y Diseño", 8, 800000);

        // Universidad de los Andes
        ProgramasAcademicos::crear($uAndes, "Ingeniería de Sistemas y Computación", "Ingeniería y Tecnología", 10, 22000000);
        ProgramasAcademicos::crear($uAndes, "Medicina", "Ciencias de la Salud", 12, 28000000);
        ProgramasAcademicos::crear($uAndes, "Administración de Empresas", "Ciencias Sociales y Humanidades", 10, 21000000);
        ProgramasAcademicos::crear($uAndes, "Arquitectura", "Artes y Diseño", 10, 22000000);

        // Universidad de Antioquia
        ProgramasAcademicos::crear($uUdea, "Bioingeniería", "Ingeniería y Tecnología", 10, 600000);
        ProgramasAcademicos::crear($uUdea, "Psicología", "Ciencias de la Salud", 10, 500000);
        ProgramasAcademicos::crear($uUdea, "Comunicación Social", "Ciencias Sociales y Humanidades", 8, 450000);

        // Universidad del Valle
        ProgramasAcademicos::crear($uUnivalle, "Ingeniería Civil", "Ingeniería y Tecnología", 10, 400000);
        ProgramasAcademicos::crear($uUnivalle, "Enfermería", "Ciencias de la Salud", 9, 350000);
        ProgramasAcademicos::crear($uUnivalle, "Sociología", "Ciencias Sociales y Humanidades", 10, 300000);

        // Universidad Javeriana
        ProgramasAcademicos::crear($uJaveriana, "Nutrición y Dietética", "Ciencias de la Salud", 9, 9500000);
        ProgramasAcademicos::crear($uJaveriana, "Ciencia Política", "Ciencias Sociales y Humanidades", 8, 10500000);
        ProgramasAcademicos::crear($uJaveriana, "Artes Visuales", "Artes y Diseño", 8, 11000000);

        // 5. Insertar Becas
        Beca::crear("Beca Nacional de Excelencia", "Bogotá y Medellín", "Puntaje Saber 11 superior a 380, SISBEN A, B o C.", date("Y-m-d", strtotime("+3 months")), "https://becas.gob.co");
        Beca::crear("Beca Mujeres en Tecnología (STEM)", "Virtual / Presencial", "Mujer bachiller admitida en programa de Ingeniería, promedio bachillerato > 4.5.", date("Y-m-d", strtotime("+2 months")), "https://womenintech.org");
        Beca::crear("Beca Talento Artístico", "Cali y Bogotá", "Aprobación de examen de suficiencia artística y portafolio de obras.", date("Y-m-d", strtotime("+1 month")), "https://mincultura.gov.co");
        Beca::crear("Crédito-Beca Condurable para Ciencias de la Salud", "Nacional", "Admisión en Medicina u Odontología en universidad de alta calidad y SISBEN.", date("Y-m-d", strtotime("+4 months")), "https://icetex.gov.co");

        // 6. Crear un Cuestionario Vocacional Principal
        Cuestionario::crearCuestionario("Test de Orientación Vocacional Completo", $idIng); // Se le asigna por defecto

        // Obtener el ID del Cuestionario creado
        $questId = $db->query("SELECT id_cuestionario FROM cuestionario LIMIT 1")->fetchColumn();

        // 7. Insertar 5 Preguntas clave del Test
        // Las opciones corresponden a las áreas: A=Tecnología, B=Salud/Cuidado, C=Sociales/Negocios, D=Arte/Creación
        Cuestionario::crearPregunta($questId, 
            "¿Cuál de las siguientes actividades disfrutas más realizar en tu tiempo libre?",
            "Resolver acertijos, programar o armar/desarmar aparatos electrónicos.",
            "Ayudar a personas enfermas, investigar sobre nutrición o comprender la mente.",
            "Debatir ideas, liderar un equipo de trabajo o planear un negocio.",
            "Dibujar, escribir historias, componer música o diseñar espacios visuales.",
            1 // ID de área de Ingeniería y Tecnología como referencia o índice
        );

        Cuestionario::crearPregunta($questId, 
            "Si tuvieras que leer un libro o ver un documental para aprender algo nuevo, ¿de qué temática sería?",
            "El desarrollo de la Inteligencia Artificial y el espacio exterior.",
            "Cómo funciona el cerebro humano y los secretos de la medicina moderna.",
            "Historia de la política mundial o biografías de grandes emprendedores.",
            "Historia del arte, evolución del cine o técnicas de fotografía creativa.",
            2 // Salud
        );

        Cuestionario::crearPregunta($questId, 
            "Imagina que tu comunidad tiene un problema grave de salud pública debido a la contaminación del agua. ¿Cómo preferirías ayudar?",
            "Diseñando un sistema de filtración tecnológico automatizado o un software de monitoreo de agua.",
            "Atendiendo directamente a las personas afectadas y recetando tratamientos preventivos.",
            "Organizando mesas de debate de políticas públicas para exigir leyes de protección ambiental y gestión social.",
            "Creando una campaña visual y artística impactante para concientizar e inspirar a la población.",
            3 // Sociales
        );

        Cuestionario::crearPregunta($questId, 
            "Al trabajar en un proyecto de grupo escolar o universitario, ¿qué rol sueles asumir naturalmente?",
            "El analista técnico que programa la presentación, revisa datos y optimiza los procesos.",
            "El mediador que se preocupa por la armonía del grupo, la salud mental y que todos se sientan bien.",
            "El líder estratégico que organiza las tareas, expone los argumentos y maneja los presupuestos.",
            "El diseñador creativo que se encarga del estilo visual, la originalidad y la estética del proyecto.",
            4 // Artes
        );

        Cuestionario::crearPregunta($questId, 
            "¿Qué tipo de entorno de trabajo del futuro te resultaría más estimulante e inspirador?",
            "Un laboratorio tecnológico o una oficina de desarrollo de software rodeado de computadores y códigos.",
            "Un hospital, clínica o consultorio interactuando con personas y brindando bienestar físico o mental.",
            "Una oficina de consultoría de leyes, un corporativo de negocios o coordinando campañas en la comunidad.",
            "Un estudio de diseño, un set de grabación, una firma de arquitectura o un espacio creativo al aire libre.",
            1
        );

        // Registrar un usuario de prueba por defecto
        Usuario::crear("Usuario de Prueba", "prueba@correo.com", "123456", "Bogotá");
    }
}
?>
