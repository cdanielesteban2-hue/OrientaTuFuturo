<?php
include_once "modelos/simulacro.php";

class ControladorSimulacros {

    private function bloquearAdmin() {
        if (isset($_SESSION['usuario']['rol']) && $_SESSION['usuario']['rol'] === 'admin') {
            header("Location: " . URL_BASE . "usuarios/admin");
            exit;
        }
    }

    public function inicio() {
        $this->bloquearAdmin();
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/login");
            exit;
        }

        $modalidades = Simulacro::obtenerModalidadesAleatorias();
        $materias = Simulacro::obtenerMateriasPreIcfes();
        $intentos = Simulacro::obtenerIntentosUsuario($_SESSION['usuario']['id']);

        include_once "vistas/simulacros/inicio.php";
    }

    public function profundizado() {
        $this->bloquearAdmin();
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/login");
            exit;
        }

        $materias = Simulacro::obtenerMateriasPreIcfes();
        $intentos = Simulacro::obtenerIntentosUsuario($_SESSION['usuario']['id']);
        include_once "vistas/simulacros/profundizado.php";
    }

    public function resolver() {
        $this->bloquearAdmin();
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/login");
            exit;
        }

        $modo = isset($_GET['modo']) ? trim($_GET['modo']) : '';
        $materia = isset($_GET['materia']) ? trim($_GET['materia']) : '';
        $cantidad = isset($_GET['cantidad']) ? (int) $_GET['cantidad'] : 25;
        $cantidades_validas = [10, 25, 50];
        if (!in_array($cantidad, $cantidades_validas, true)) $cantidad = 25;
        $modalidad = isset($_GET['modalidad']) ? trim($_GET['modalidad']) : 'corto';
        $materias_validas = Simulacro::obtenerMateriasPreIcfes();
        $modalidades = Simulacro::obtenerModalidadesAleatorias();
        $es_aleatorio = ($modo === 'aleatorio' && isset($modalidades[$modalidad]));
        $session_key = 'preicfes_' . ($es_aleatorio ? 'aleatorio_' . $modalidad : 'materia_' . md5($materia . '|' . $cantidad));
        $es_normal = $es_aleatorio && $modalidad === 'normal';

        if ($es_aleatorio) {
            $configuracion = $modalidades[$modalidad];
            $simulacro = Simulacro::obtenerSimulacroAleatorio($modalidad);
            $tiempo_limite_segundos = $configuracion['segundos'];
            $duracion_texto = $configuracion['duracion'];
            if ($_POST && !empty($_SESSION[$session_key]['preguntas'])) {
                $preguntas = Simulacro::obtenerPreguntasPorIds($_SESSION[$session_key]['preguntas']);
            } elseif (!empty($_SESSION[$session_key]['preguntas'])) {
                $preguntas = Simulacro::obtenerPreguntasPorIds($_SESSION[$session_key]['preguntas']);
            } else {
                $preguntas = Simulacro::obtenerPreguntasAleatorias($configuracion['preguntas']);
                $_SESSION[$session_key] = [
                    'preguntas' => array_column($preguntas, 'id_pregunta'),
                    'inicio' => time(),
                    'fase' => 1,
                    'respuestas' => []
                ];
            }
        } elseif (in_array($materia, $materias_validas, true)) {
            $simulacro = Simulacro::obtenerSimulacroPorMateria($materia);
            $tiempo_limite_segundos = 0;
            $duracion_texto = '';
            if ($_POST && !empty($_SESSION[$session_key]['preguntas'])) {
                $preguntas = Simulacro::obtenerPreguntasPorIds($_SESSION[$session_key]['preguntas']);
            } else {
                $preguntas = Simulacro::obtenerPreguntasPorMateria($materia, $cantidad);
                $_SESSION[$session_key] = [
                    'preguntas' => array_column($preguntas, 'id_pregunta'),
                    'inicio' => time()
                ];
            }
        } elseif (isset($_GET['id'])) {
            $simulacro = Simulacro::obtenerPorId($_GET['id']);
            $preguntas = $simulacro ? Simulacro::obtenerPreguntas($simulacro['id_simulacro']) : [];
            $tiempo_limite_segundos = 0;
            $duracion_texto = '';
        } else {
            header("Location: " . URL_BASE . "simulacros/inicio");
            exit;
        }

        if (!$simulacro || count($preguntas) === 0) {
            header("Location: " . URL_BASE . "simulacros/inicio?sin_preguntas=1");
            exit;
        }

        $fase = $es_normal ? (int) ($_SESSION[$session_key]['fase'] ?? 1) : 1;
        $preguntas_vista = $es_normal
            ? ($fase === 1 ? array_slice($preguntas, 0, 123) : array_slice($preguntas, 123, 124))
            : $preguntas;

        $error = "";
        $tiempo_agotado = false;
        if ($_POST) {
            $respuestas_enviadas = isset($_POST['respuestas']) ? $_POST['respuestas'] : [];
            $inicio = $_SESSION[$session_key]['inicio'] ?? time();
            $tiempo_agotado = $tiempo_limite_segundos > 0 && (time() - $inicio) > $tiempo_limite_segundos;
            if ($es_normal && $fase === 1 && (isset($_POST['continuar_segunda_seccion']) || $tiempo_agotado)) {
                if (!$tiempo_agotado && count($respuestas_enviadas) < count($preguntas_vista)) {
                    $error = "Responde las 123 preguntas de la primera sección antes de continuar.";
                } else {
                    $_SESSION[$session_key]['respuestas'] = $respuestas_enviadas;
                    $_SESSION[$session_key]['fase'] = 2;
                    $_SESSION[$session_key]['inicio'] = time();
                    header("Location: " . URL_BASE . "simulacros/resolver?modo=aleatorio&modalidad=normal");
                    exit;
                }
            } elseif (!$tiempo_agotado && count($respuestas_enviadas) < count($preguntas_vista)) {
                $error = "Por favor responde todas las preguntas antes de terminar el simulacro.";
            } else {
                if ($es_normal) {
                    $respuestas_enviadas = array_merge($_SESSION[$session_key]['respuestas'] ?? [], $respuestas_enviadas);
                }
                $correctas = 0;
                $total_preguntas = count($preguntas);
                $respuestas_evaluadas = [];
                foreach ($preguntas as $pregunta) {
                    $id_pregunta = $pregunta['id_pregunta'];
                    $respuesta_usuario = isset($respuestas_enviadas[$id_pregunta]) ? strtolower(trim($respuestas_enviadas[$id_pregunta])) : '';
                    $es_correcta = ($respuesta_usuario !== '' && $respuesta_usuario === strtolower($pregunta['correcta'])) ? 1 : 0;
                    if ($es_correcta) $correctas++;
                    $respuestas_evaluadas[] = ['id_pregunta' => $id_pregunta, 'respuesta_usuario' => $respuesta_usuario, 'es_correcta' => $es_correcta];
                }
                $puntaje = $total_preguntas > 0 ? round(($correctas / $total_preguntas) * 100) : 0;
                $id_intento = Simulacro::guardarIntento($_SESSION['usuario']['id'], $simulacro['id_simulacro'], $puntaje);
                foreach ($respuestas_evaluadas as $resp) {
                    Simulacro::guardarRespuesta($id_intento, $resp['id_pregunta'], $resp['respuesta_usuario'], $resp['es_correcta']);
                }
                unset($_SESSION[$session_key]);
                header("Location: " . URL_BASE . "simulacros/resultado?id=" . $id_intento);
                exit;
            }
        }

        include_once "vistas/simulacros/resolver.php";
    }

    public function resultado() {
        $this->bloquearAdmin();
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
