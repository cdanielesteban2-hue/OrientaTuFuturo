<?php
include_once "modelos/usuario.php";
include_once "modelos/universidad.php";
include_once "modelos/beca.php";
include_once "modelos/cuestionario.php";
include_once "modelos/simulacro.php";
include_once "modelos/programaacademico.php";

class ControladorAdmin {

    public function __construct() {
        // Protección global para todo el controlador
        if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['rol']) || $_SESSION['usuario']['rol'] !== 'admin') {
            header("Location: " . URL_BASE . "paginas/inicio");
            exit;
        }
    }

    public function dashboard() {
        // Estadísticas rápidas para el dashboard
        $db = baseDatos::crearInstancia();
        
        $totalUsuarios = $db->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
        $totalUniversidades = $db->query("SELECT COUNT(*) FROM universidades")->fetchColumn();
        $totalBecas = $db->query("SELECT COUNT(*) FROM becas")->fetchColumn();
        $totalSimulacros = $db->query("SELECT COUNT(*) FROM simulacros")->fetchColumn();

        include_once "vistas/admin/dashboard.php";
    }

    public function usuarios() {
        $db = baseDatos::crearInstancia();
        $usuarios = $db->query("SELECT * FROM usuarios ORDER BY f_registro DESC")->fetchAll();
        include_once "vistas/admin/usuarios.php";
    }
    
    // ============================================
    // MÓDULO UNIVERSIDADES
    // ============================================

    public function universidades() {
        $universidades = Universidad::listar();
        include_once "vistas/admin/universidades.php";
    }

    public function universidadForm() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $universidad = null;
        if ($id) {
            $universidad = Universidad::obtenerPorId($id);
        }
        include_once "vistas/admin/universidades_form.php";
    }

    public function guardarUniversidad() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id_universidad']) ? $_POST['id_universidad'] : '';
            $nombre = $_POST['nombre'];
            $ciudad = $_POST['ciudad'];
            $tipo = $_POST['tipo'];
            $sitio_web = $_POST['sitio_web'];
            $descripcion = $_POST['descripcion'];
            $jornadas = $_POST['jornadas'];
            $slug = Universidad::generarSlug($nombre);

            if ($id) {
                // Actualizar
                Universidad::actualizar($id, $nombre, $ciudad, $tipo, $sitio_web, $descripcion, $jornadas, $slug);
            } else {
                // Crear
                Universidad::crear($nombre, $ciudad, $tipo, $sitio_web, $descripcion, $jornadas);
            }
            header("Location: " . URL_BASE . "admin/universidades");
            exit;
        }
    }

    public function eliminarUniversidad() {
        if (isset($_GET['id'])) {
            Universidad::eliminar($_GET['id']);
        }
        header("Location: " . URL_BASE . "admin/universidades");
        exit;
    }

    // ============================================
    // MÓDULO PROGRAMAS ACADÉMICOS
    // ============================================

    public function programas() {
        if (!isset($_GET['id_uni'])) {
            header("Location: " . URL_BASE . "admin/universidades");
            exit;
        }
        $id_universidad = $_GET['id_uni'];
        $universidad = Universidad::obtenerPorId($id_universidad);
        if (!$universidad) {
            header("Location: " . URL_BASE . "admin/universidades");
            exit;
        }
        $programas = Universidad::obtenerProgramas($id_universidad);
        include_once "vistas/admin/programas.php";
    }

    public function programaForm() {
        $id_uni = isset($_GET['id_uni']) ? $_GET['id_uni'] : null;
        $id_prog = isset($_GET['id_prog']) ? $_GET['id_prog'] : null;
        
        if (!$id_uni) {
            header("Location: " . URL_BASE . "admin/universidades");
            exit;
        }
        $universidad = Universidad::obtenerPorId($id_uni);
        if (!$universidad) {
            header("Location: " . URL_BASE . "admin/universidades");
            exit;
        }
        $programa = null;
        if ($id_prog) {
            $programa = ProgramasAcademicos::obtenerPorId($id_prog);
        }
        include_once "vistas/admin/programas_form.php";
    }

    public function guardarPrograma() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_uni = $_POST['id_universidad'];
            $id_prog = isset($_POST['id_programa']) ? $_POST['id_programa'] : '';
            
            $n_programa = $_POST['n_programa'];
            $area = $_POST['area'];
            $duracion = $_POST['duracion'];
            $costo = $_POST['costo'];
            $slug = ProgramasAcademicos::generarSlug($n_programa) . '-' . time();

            if ($id_prog) {
                // Actualizar
                ProgramasAcademicos::actualizar($id_prog, $id_uni, $n_programa, $area, $duracion, $costo, $slug);
            } else {
                // Crear
                ProgramasAcademicos::crear($id_uni, $n_programa, $area, $duracion, $costo);
            }
            header("Location: " . URL_BASE . "admin/programas?id_uni=" . $id_uni);
            exit;
        }
    }

    public function eliminarPrograma() {
        $id_uni = isset($_GET['id_uni']) ? $_GET['id_uni'] : '';
        if (isset($_GET['id'])) {
            ProgramasAcademicos::eliminar($_GET['id']);
        }
        header("Location: " . URL_BASE . "admin/programas?id_uni=" . $id_uni);
        exit;
    }

    // ============================================
    // MÓDULO BECAS
    // ============================================

    public function becas() {
        include_once "modelos/beca.php";
        $becas = Beca::listar();
        include_once "vistas/admin/becas.php";
    }

    public function becaForm() {
        include_once "modelos/beca.php";
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $beca = null;
        if ($id) {
            $beca = Beca::obtenerPorId($id);
        }
        include_once "vistas/admin/becas_form.php";
    }

    public function guardarBeca() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            include_once "modelos/beca.php";
            $id = isset($_POST['id_becas']) ? $_POST['id_becas'] : '';
            $nombre_beca = $_POST['nombre_beca'];
            $campus = $_POST['campus'];
            $requisitos = $_POST['requisitos'];
            $fecha_limite = $_POST['fecha_limite'];
            $enlace = $_POST['enlace'];

            if ($id) {
                Beca::actualizar($id, $nombre_beca, $campus, $requisitos, $fecha_limite, $enlace);
            } else {
                Beca::crear($nombre_beca, $campus, $requisitos, $fecha_limite, $enlace);
            }
            header("Location: " . URL_BASE . "admin/becas");
            exit;
        }
    }

    public function eliminarBeca() {
        include_once "modelos/beca.php";
        if (isset($_GET['id'])) {
            Beca::eliminar($_GET['id']);
        }
        header("Location: " . URL_BASE . "admin/becas");
        exit;
    }

    // ============================================
    // MÓDULO SIMULACROS / TESTS PRE-ICFES
    // ============================================

    public function simulacros() {
        $simulacros = Simulacro::obtenerTodos();
        include_once "vistas/admin/simulacros.php";
    }

    public function simulacroForm() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $simulacro = null;
        $preguntas = [];
        if ($id) {
            $simulacro = Simulacro::obtenerPorId($id);
            $preguntas = Simulacro::obtenerPreguntas($id);
        }
        include_once "vistas/admin/simulacros_form.php";
    }

    public function guardarSimulacro() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id_simulacro']) ? $_POST['id_simulacro'] : '';
            $titulo = $_POST['titulo'];
            $materia = $_POST['materia'];
            $color = $_POST['color'] ?? '#3b82f6';
            $icono = $_POST['icono'] ?? 'fa-solid fa-book';
            $descripcion = $_POST['descripcion'] ?? '';

            if ($id) {
                Simulacro::actualizar($id, $titulo, $materia, $color, $icono, $descripcion);
                $id_simulacro = $id;
            } else {
                $id_simulacro = Simulacro::crear($titulo, $materia, $color, $icono, $descripcion);
            }

            // Procesar preguntas si vienen en el POST
            if (isset($_POST['preguntas']) && is_array($_POST['preguntas'])) {
                foreach ($_POST['preguntas'] as $pregData) {
                    $p_id = $pregData['id'] ?? '';
                    $p_pregunta = $pregData['pregunta'] ?? '';
                    $p_a = $pregData['opcion_a'] ?? '';
                    $p_b = $pregData['opcion_b'] ?? '';
                    $p_c = $pregData['opcion_c'] ?? '';
                    $p_d = $pregData['opcion_d'] ?? '';
                    $p_correcta = $pregData['correcta'] ?? 'A';
                    $p_justificacion = $pregData['justificacion'] ?? '';

                    if (empty(trim($p_pregunta))) continue;

                    if ($p_id) {
                        Simulacro::actualizarPregunta($p_id, $p_pregunta, $p_a, $p_b, $p_c, $p_d, $p_correcta, $p_justificacion);
                    } else {
                        Simulacro::crearPregunta($id_simulacro, $p_pregunta, $p_a, $p_b, $p_c, $p_d, $p_correcta, $p_justificacion);
                    }
                }
            }

            header("Location: " . URL_BASE . "admin/simulacroForm?id=" . $id_simulacro);
            exit;
        }
    }

    public function eliminarSimulacro() {
        if (isset($_GET['id'])) {
            Simulacro::eliminar($_GET['id']);
        }
        header("Location: " . URL_BASE . "admin/simulacros");
        exit;
    }

    public function eliminarPreguntaSimulacro() {
        $id_simulacro = isset($_GET['id_sim']) ? $_GET['id_sim'] : '';
        if (isset($_GET['id'])) {
            Simulacro::eliminarPregunta($_GET['id']);
        }
        header("Location: " . URL_BASE . "admin/simulacroForm?id=" . $id_simulacro);
        exit;
    }
}
?>
