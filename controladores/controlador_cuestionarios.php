<?php
include_once "modelos/cuestionario.php";
include_once "modelos/programaacademico.php";

class ControladorCuestionarios {
    public function inicio() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/login");
            exit;
        }

        $id_cuestionario = isset($_GET['id']) ? $_GET['id'] : 2; // ID 2 es el Test Maestro RIASEC
        $cuestionario = Cuestionario::obtenerPorId($id_cuestionario);

        include_once "vistas/cuestionarios/inicio.php";
    }

    public function resolver() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/login");
            exit;
        }

        $id_cuestionario = isset($_GET['id']) ? $_GET['id'] : 2;
        $cuestionario = Cuestionario::obtenerPorId($id_cuestionario);

        if (!$cuestionario) {
            header("Location: " . URL_BASE . "paginas/error");
            exit;
        }

        $preguntas = Cuestionario::obtenerPreguntas($id_cuestionario);
        $error = "";

        if ($_POST) {
            $id_usuario = $_SESSION['usuario']['id'];
            $respuestas_enviadas = isset($_POST['respuestas']) ? $_POST['respuestas'] : [];

            if (count($respuestas_enviadas) < count($preguntas)) {
                $error = "Por favor responde todas las preguntas antes de enviar el test.";
            } else {
                // Guardar respuestas individuales
                foreach ($respuestas_enviadas as $id_pregunta => $opcion) {
                    Cuestionario::guardarRespuesta($id_usuario, $id_cuestionario, $id_pregunta, $opcion);
                }
                
                // Registrar intento completado
                Cuestionario::registrarIntento($id_usuario, $id_cuestionario);

                header("Location: " . URL_BASE . "cuestionarios/resultado?id=" . $id_cuestionario);
                exit;
            }
        }

        include_once "vistas/cuestionarios/resolver.php";
    }

    public function resultado() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/login");
            exit;
        }

        $id_cuestionario = isset($_GET['id']) ? $_GET['id'] : 2;
        $id_usuario = $_SESSION['usuario']['id'];

        $cuestionario = Cuestionario::obtenerPorId($id_cuestionario);
        $respuestas = Cuestionario::obtenerRespuestasUsuario($id_usuario, $id_cuestionario);

        if (!$cuestionario || count($respuestas) === 0) {
            header("Location: " . URL_BASE . "cuestionarios/inicio");
            exit;
        }

        // Calcular porcentajes (6 opciones RIASEC)
        $conteo = ['a' => 0, 'b' => 0, 'c' => 0, 'd' => 0, 'e' => 0, 'f' => 0];
        $total = count($respuestas);

        foreach ($respuestas as $resp) {
            $r = strtolower($resp['respuesta']);
            if (isset($conteo[$r])) {
                $conteo[$r]++;
            }
        }

        // Áreas oficiales del Código de Holland (RIASEC)
        $areas_map = [
            'a' => [
                'nombre' => 'Realista (El Hacedor)',
                'busqueda' => ['Realista (El Hacedor)', 'Ingeniería y Tecnología'],
                'descripcion' => 'Posees un enfoque práctico y disfrutas el uso de herramientas o máquinas. Te apasiona la mecánica, la ingeniería estructural, el software o el hardware. Eres una persona objetiva y orientada a la acción.',
                'color' => '#3b82f6', // Azul
                'especialidad' => true,
                'id_microtest' => 3
            ],
            'b' => [
                'nombre' => 'Investigador (El Pensador)',
                'busqueda' => ['Investigador (El Pensador)', 'Ciencias de la Salud'],
                'descripcion' => 'Tienes una fuerte vocación analítica y científica. Te motiva entender el porqué de las cosas, investigar, resolver problemas matemáticos, químicos o médicos, y aportar a la ciencia.',
                'color' => '#10b981', // Verde
                'especialidad' => true,
                'id_microtest' => 4
            ],
            'c' => [
                'nombre' => 'Artístico (El Creador)',
                'busqueda' => ['Artístico (El Creador)', 'Artes y Diseño'],
                'descripcion' => 'Tu motor es la imaginación y la expresión estética. Valoras la originalidad, el diseño, la composición visual o musical, la arquitectura y los canales artísticos para plasmar tus ideas únicas.',
                'color' => '#ec4899', // Rosa
                'especialidad' => false
            ],
            'd' => [
                'nombre' => 'Social (El Ayudador)',
                'busqueda' => ['Social (El Ayudador)', 'Ciencias Sociales y Humanidade'],
                'descripcion' => 'Destacas por tus habilidades comunicativas y empatía. Disfrutas de ayudar, enseñar, curar emocionalmente, liderar equipos comunitarios o abogar por la justicia social e igualdad.',
                'color' => '#f59e0b', // Naranja
                'especialidad' => false
            ],
            'e' => [
                'nombre' => 'Emprendedor (El Persuasor)',
                'busqueda' => ['Emprendedor (El Persuasor)', 'Ciencias Sociales y Humanidade'],
                'descripcion' => 'Tienes gran capacidad para persuadir, dirigir proyectos y tomar decisiones de impacto. Te atraen las ventas, la administración de empresas, la política, el derecho o iniciar tu propia empresa.',
                'color' => '#8b5cf6', // Morado
                'especialidad' => false
            ],
            'f' => [
                'nombre' => 'Convencional (El Organizador)',
                'busqueda' => ['Convencional (El Organizador)'],
                'descripcion' => 'Posees una mente estructurada y orientada al detalle y la logística. Eres excelente organizando datos, gestionando bases de datos, auditorías, contabilidad y tareas administrativas.',
                'color' => '#64748b', // Gris
                'especialidad' => false
            ]
        ];

        // Determinar área dominante
        $max_opcion = 'a';
        $max_votos = -1;

        foreach ($conteo as $opcion => $votos) {
            if ($votos > $max_votos) {
                $max_votos = $votos;
                $max_opcion = $opcion;
            }
        }

        $area_dominante = $areas_map[$max_opcion];
        $porcentaje_dominante = round(($max_votos / $total) * 100);
        $mostrar_microtest = $area_dominante['especialidad'];

        // Obtener programas sugeridos según las áreas asociadas
        $programas_sugeridos = ProgramasAcademicos::filtrarPorAreas($area_dominante['busqueda']);

        include_once "vistas/cuestionarios/resultado.php";
    }

    public function imprimir() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/login");
            exit;
        }

        $id_cuestionario = isset($_GET['id']) ? $_GET['id'] : 2;
        $id_usuario = $_SESSION['usuario']['id'];

        $cuestionario = Cuestionario::obtenerPorId($id_cuestionario);
        $respuestas = Cuestionario::obtenerRespuestasUsuario($id_usuario, $id_cuestionario);

        if (!$cuestionario || count($respuestas) === 0) {
            header("Location: " . URL_BASE . "cuestionarios/inicio");
            exit;
        }

        $conteo = ['a' => 0, 'b' => 0, 'c' => 0, 'd' => 0, 'e' => 0, 'f' => 0];
        $total = count($respuestas);

        foreach ($respuestas as $resp) {
            $r = strtolower($resp['respuesta']);
            if (isset($conteo[$r])) {
                $conteo[$r]++;
            }
        }

        $areas_map = [
            'a' => [
                'nombre' => 'Realista (El Hacedor)',
                'busqueda' => ['Realista (El Hacedor)', 'Ingeniería y Tecnología'],
                'descripcion' => 'Posees un enfoque práctico y disfrutas el uso de herramientas o máquinas. Te apasiona la mecánica, la ingeniería estructural, el software o el hardware. Eres una persona objetiva y orientada a la acción.',
                'color' => '#3b82f6'
            ],
            'b' => [
                'nombre' => 'Investigador (El Pensador)',
                'busqueda' => ['Investigador (El Pensador)', 'Ciencias de la Salud'],
                'descripcion' => 'Tienes una fuerte vocación analítica y científica. Te motiva entender el porqué de las cosas, investigar, resolver problemas matemáticos, químicos o médicos, y aportar a la ciencia.',
                'color' => '#10b981'
            ],
            'c' => [
                'nombre' => 'Artístico (El Creador)',
                'busqueda' => ['Artístico (El Creador)', 'Artes y Diseño'],
                'descripcion' => 'Tu motor es la imaginación y la expresión estética. Valoras la originalidad, el diseño, la composición visual o musical, la arquitectura y los canales artísticos para plasmar tus ideas únicas.',
                'color' => '#ec4899'
            ],
            'd' => [
                'nombre' => 'Social (El Ayudador)',
                'busqueda' => ['Social (El Ayudador)', 'Ciencias Sociales y Humanidade'],
                'descripcion' => 'Destacas por tus habilidades comunicativas y empatía. Disfrutas de ayudar, enseñar, curar emocionalmente, liderar equipos comunitarios o abogar por la justicia social e igualdad.',
                'color' => '#f59e0b'
            ],
            'e' => [
                'nombre' => 'Emprendedor (El Persuasor)',
                'busqueda' => ['Emprendedor (El Persuasor)', 'Ciencias Sociales y Humanidade'],
                'descripcion' => 'Tienes gran capacidad para persuadir, dirigir proyectos y tomar decisiones de impacto. Te atraen las ventas, la administración de empresas, la política, el derecho o iniciar tu propia empresa.',
                'color' => '#8b5cf6'
            ],
            'f' => [
                'nombre' => 'Convencional (El Organizador)',
                'busqueda' => ['Convencional (El Organizador)'],
                'descripcion' => 'Posees una mente estructurada y orientada al detalle y la logística. Eres excelente organizando datos, gestionando bases de datos, auditorías, contabilidad y tareas administrativas.',
                'color' => '#64748b'
            ]
        ];

        $max_opcion = 'a';
        $max_votos = -1;

        foreach ($conteo as $opcion => $votos) {
            if ($votos > $max_votos) {
                $max_votos = $votos;
                $max_opcion = $opcion;
            }
        }

        $area_dominante = $areas_map[$max_opcion];
        $porcentaje_dominante = round(($max_votos / $total) * 100);

        $programas_sugeridos = ProgramasAcademicos::filtrarPorAreas($area_dominante['busqueda']);

        include_once "vistas/cuestionarios/imprimir.php";
    }
}
?>
