<?php
include_once "modelos/simulacro.php";

class ControladorSimulacros {
    private const LIMITE_PREGUNTAS = 25;

    public function inicio() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/login");
            exit;
        }

        $simulacros = Simulacro::obtenerTodos();
        $materias = Simulacro::obtenerMateriasPreIcfes();
        $intentos = Simulacro::obtenerIntentosUsuario($_SESSION['usuario']['id']);

        include_once "vistas/simulacros/inicio.php";
    }

    public function profundizado() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/login");
            exit;
        }

        $materias = Simulacro::obtenerMateriasPreIcfes();
        $intentos = Simulacro::obtenerIntentosUsuario($_SESSION['usuario']['id']);
        include_once "vistas/simulacros/profundizado.php";
    }

    public function resolver() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/login");
            exit;
        }

        $modo = isset($_GET['modo']) ? trim($_GET['modo']) : '';
        $materia = isset($_GET['materia']) ? trim($_GET['materia']) : '';
        $materias_validas = Simulacro::obtenerMateriasPreIcfes();

        if ($modo === 'aleatorio') {
            $simulacro = Simulacro::obtenerSimulacroAleatorio();
            $preguntas = Simulacro::obtenerPreguntasAleatorias(self::LIMITE_PREGUNTAS);
        } elseif (in_array($materia, $materias_validas, true)) {
            $simulacro = Simulacro::obtenerSimulacroPorMateria($materia);
            $preguntas = Simulacro::obtenerPreguntasPorMateria($materia, self::LIMITE_PREGUNTAS);
        } elseif (isset($_GET['id'])) {
            $simulacro = Simulacro::obtenerPorId($_GET['id']);
            $preguntas = $simulacro ? Simulacro::obtenerPreguntas($simulacro['id_simulacro']) : [];
        } else {
            header("Location: " . URL_BASE . "simulacros/inicio");
            exit;
        }

        if (!$simulacro || count($preguntas) === 0) {
            header("Location: " . URL_BASE . "simulacros/inicio?sin_preguntas=1");
            exit;
        }

        $error = "";

        if ($_POST) {
            $respuestas_enviadas = isset($_POST['respuestas']) ? $_POST['respuestas'] : [];

            if (count($respuestas_enviadas) < count($preguntas)) {
                $error = "Por favor responde todas las preguntas antes de terminar el simulacro.";
            } else {
                // Calcular puntaje
                $correctas = 0;
                $total_preguntas = count($preguntas);
                $respuestas_evaluadas = [];

                foreach ($preguntas as $pregunta) {
                    $id_pregunta = $pregunta['id_pregunta'];
                    $respuesta_usuario = isset($respuestas_enviadas[$id_pregunta]) ? strtolower(trim($respuestas_enviadas[$id_pregunta])) : '';
                    $es_correcta = ($respuesta_usuario === strtolower($pregunta['correcta'])) ? 1 : 0;
                    
                    if ($es_correcta) {
                        $correctas++;
                    }

                    $respuestas_evaluadas[] = [
                        'id_pregunta' => $id_pregunta,
                        'respuesta_usuario' => $respuesta_usuario,
                        'es_correcta' => $es_correcta
                    ];
                }

                $puntaje = round(($correctas / $total_preguntas) * 100);

                // Guardar Intento
                $id_intento = Simulacro::guardarIntento($_SESSION['usuario']['id'], $simulacro['id_simulacro'], $puntaje);

                // Guardar Respuestas Individuales
                foreach ($respuestas_evaluadas as $resp) {
                    Simulacro::guardarRespuesta($id_intento, $resp['id_pregunta'], $resp['respuesta_usuario'], $resp['es_correcta']);
                }

                header("Location: " . URL_BASE . "simulacros/resultado?id=" . $id_intento);
                exit;
            }
        }

        include_once "vistas/simulacros/resolver.php";
    }

    public function resultado() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/login");
            exit;
        }

        if (!isset($_GET['id'])) {
            header("Location: " . URL_BASE . "simulacros/inicio");
            exit;
        }

        $id_intento = $_GET['id'];
        $intento = Simulacro::obtenerIntento($id_intento);
        
        if (!$intento || $intento['id_usuario'] != $_SESSION['usuario']['id']) {
            header("Location: " . URL_BASE . "paginas/error");
            exit;
        }

        $respuestas = Simulacro::obtenerRespuestasIntento($id_intento);
        $correctas = count(array_filter($respuestas, static function ($respuesta) {
            return (int) $respuesta['es_correcta'] === 1;
        }));
        $incorrectas = count($respuestas) - $correctas;

        include_once "vistas/simulacros/resultado.php";
    }
}
?>
