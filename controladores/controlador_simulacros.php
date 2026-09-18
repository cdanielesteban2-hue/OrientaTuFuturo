<?php
include_once "modelos/simulacro.php";

class ControladorSimulacros {
    public function inicio() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/login");
            exit;
        }

        $simulacros = Simulacro::obtenerTodos();
        $intentos = Simulacro::obtenerIntentosUsuario($_SESSION['usuario']['id']);

        include_once "vistas/simulacros/inicio.php";
    }

    public function resolver() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/login");
            exit;
        }

        if (!isset($_GET['id'])) {
            header("Location: " . URL_BASE . "simulacros/inicio");
            exit;
        }

        $id_simulacro = $_GET['id'];
        $simulacro = Simulacro::obtenerPorId($id_simulacro);
        
        if (!$simulacro) {
            header("Location: " . URL_BASE . "paginas/error");
            exit;
        }

        $preguntas = Simulacro::obtenerPreguntas($id_simulacro);
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
                    $respuesta_usuario = $respuestas_enviadas[$id_pregunta];
                    $es_correcta = ($respuesta_usuario === $pregunta['correcta']) ? 1 : 0;
                    
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
                $id_intento = Simulacro::guardarIntento($_SESSION['usuario']['id'], $id_simulacro, $puntaje);

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

        include_once "vistas/simulacros/resultado.php";
    }
}
?>
