<?php
include_once "modelos/usuario.php";

class ControladorUsuarios {
    public function registro() {
        if (isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/dashboard");
            exit;
        }
        include_once "modelos/universidad.php";
        $ciudades = Universidad::obtenerCiudades();
        $error = "";
        if ($_POST) {
            $nombre = trim($_POST['nombre']);
            $correo = trim($_POST['correo']);
            $password = $_POST['password'];
            $ciudad = trim($_POST['ciudad']);
            $terminos = isset($_POST['terminos']) ? $_POST['terminos'] : null;
            if (empty($nombre) || empty($correo) || empty($password) || empty($ciudad)) {
                $error = "Todos los campos son obligatorios.";
            } elseif (!$terminos) {
                $error = "Debes aceptar los Términos y Condiciones para registrarte.";
            } elseif (Usuario::correoExiste($correo)) {
                $error = "El correo electrónico ya se encuentra registrado.";
            } else {
                $id = Usuario::crear($nombre, $correo, $password, $ciudad);
                if ($id) {
                    $usuario = Usuario::obtenerPorId($id);
                    $_SESSION['usuario'] = [
                        'id' => $usuario->id,
                        'nombre' => $usuario->nombre,
                        'correo' => $usuario->correo,
                        'ciudad' => $usuario->ciudad,
                        'avatar' => $usuario->avatar,
                        'rol' => $usuario->rol
                    ];
                    header("Location: " . URL_BASE . "usuarios/dashboard");
                    exit;
                } else {
                    $error = "Hubo un error al registrar el usuario. Por favor intenta de nuevo.";
                }
            }
        }
        include_once "vistas/usuarios/registro.php";
    }

    public function login() {
        if (isset($_SESSION['usuario'])) {
            $dest = (($_SESSION['usuario']['rol'] ?? '') === 'admin')
                ? URL_BASE . "usuarios/admin"
                : URL_BASE . "usuarios/dashboard";
            header("Location: " . $dest);
            exit;
        }
        $error = "";
        if ($_POST) {
            $correo = trim($_POST['correo']);
            $password = $_POST['password'];
            if (empty($correo) || empty($password)) {
                $error = "Por favor ingresa tu correo y contraseña.";
            } else {
                $usuario = Usuario::login($correo, $password);
                if ($usuario) {
                    $_SESSION['usuario'] = [
                        'id' => $usuario->id,
                        'nombre' => $usuario->nombre,
                        'correo' => $usuario->correo,
                        'ciudad' => $usuario->ciudad,
                        'avatar' => $usuario->avatar,
                        'rol' => $usuario->rol
                    ];
                    if (($usuario->rol ?? 'usuario') === 'admin') {
                        header("Location: " . URL_BASE . "usuarios/admin");
                    } else {
                        header("Location: " . URL_BASE . "usuarios/dashboard");
                    }
                    exit;
                } else {
                    $error = "Correo electrónico o contraseña incorrectos.";
                }
            }
        }
        include_once "vistas/usuarios/login.php";
    }

    public function logout() {
        session_destroy();
        header("Location: " . URL_BASE . "paginas/inicio");
        exit;
    }

    public function dashboard() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/login");
            exit;
        }
        $id_usuario = $_SESSION['usuario']['id'];
        include_once "modelos/cuestionario.php";
        include_once "modelos/universidad.php";
        $ciudades = Universidad::obtenerCiudades();
        $perfil_ok = isset($_GET['perfil_ok']) ? $_GET['perfil_ok'] : '';
        $programas     = Usuario::obtenerProgramasGuardados($id_usuario);
        $becas         = Usuario::obtenerBecasGuardadas($id_usuario);
        $cuestionarios = Cuestionario::obtenerCuestionariosRealizados($id_usuario);
        include_once "vistas/usuarios/dashboard.php";
    }

    public function actualizarPerfil() {
        if (!isset($_SESSION['usuario'])) { header("Location: " . URL_BASE . "usuarios/login"); exit; }
        if ($_POST) {
            $id     = $_SESSION['usuario']['id'];
            $nombre = trim($_POST['nombre']);
            $ciudad = trim($_POST['ciudad']);
            $avatar = isset($_POST['avatar']) ? trim($_POST['avatar']) : 'av1';
            if (!empty($nombre)) {
                Usuario::actualizarPerfil($id, $nombre, $ciudad, $avatar);
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['ciudad']  = $ciudad;
                $_SESSION['usuario']['avatar']  = $avatar;
            }
        }
        header("Location: " . URL_BASE . "usuarios/dashboard?perfil_ok=1");
        exit;
    }

    public function cambiarPassword() {
        if (!isset($_SESSION['usuario'])) { header("Location: " . URL_BASE . "usuarios/login"); exit; }
        $msg = 'error_pass';
        if ($_POST) {
            $id           = $_SESSION['usuario']['id'];
            $pass_actual  = $_POST['pass_actual'];
            $nueva        = $_POST['nueva_pass'];
            $confirmar    = $_POST['confirmar_pass'];
            if ($nueva === $confirmar && strlen($nueva) >= 6) {
                $ok = Usuario::cambiarPassword($id, $pass_actual, $nueva);
                $msg = $ok ? 'pass_ok' : 'error_pass';
            }
        }
        header("Location: " . URL_BASE . "usuarios/dashboard?perfil_ok=$msg");
        exit;
    }

    public function guardarPrograma() {
        if (!isset($_SESSION['usuario'])) { header("Location: " . URL_BASE . "usuarios/login"); exit; }
        if (isset($_GET['id'])) {
            Usuario::guardarPrograma($_SESSION['usuario']['id'], $_GET['id']);
        }
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function eliminarPrograma() {
        if (!isset($_SESSION['usuario'])) { header("Location: " . URL_BASE . "usuarios/login"); exit; }
        if (isset($_GET['id'])) {
            Usuario::eliminarProgramaGuardado($_SESSION['usuario']['id'], $_GET['id']);
        }
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function guardarBeca() {
        if (!isset($_SESSION['usuario'])) { header("Location: " . URL_BASE . "usuarios/login"); exit; }
        if (isset($_GET['id'])) {
            Usuario::guardarBeca($_SESSION['usuario']['id'], $_GET['id']);
        }
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function eliminarBeca() {
        if (!isset($_SESSION['usuario'])) { header("Location: " . URL_BASE . "usuarios/login"); exit; }
        if (isset($_GET['id'])) {
            Usuario::eliminarBecaGuardada($_SESSION['usuario']['id'], $_GET['id']);
        }
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function admin() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/login");
            exit;
        }
        if (($_SESSION['usuario']['rol'] ?? '') !== 'admin') {
            header("Location: " . URL_BASE . "usuarios/dashboard");
            exit;
        }
        include_once "conexion.php";
        $db = baseDatos::crearInstancia();
        $count = function ($sql) use ($db) {
            try { return (int) $db->query($sql)->fetchColumn(); }
            catch (Exception $e) { return 0; }
        };
        $stats = [
            'usuarios' => $count("SELECT COUNT(*) FROM usuarios"),
            'universidades' => $count("SELECT COUNT(*) FROM universidades"),
            'programas' => $count("SELECT COUNT(*) FROM programas_academicos"),
            'becas' => $count("SELECT COUNT(*) FROM becas"),
            'tests_completados' => $count("SELECT COUNT(*) FROM usuario_cuestionario"),
            'simulacros' => $count("SELECT COUNT(*) FROM simulacro_intentos"),
            'preguntas_simulacro' => $count("SELECT COUNT(*) FROM simulacro_preguntas"),
            'preguntas_test' => $count("SELECT COUNT(*) FROM preguntas"),
            'respuestas_test' => $count("SELECT COUNT(*) FROM respuesta"),
            'promedio_icfes' => 0,
        ];
        try {
            $avg = $db->query("SELECT AVG(puntaje) FROM simulacro_intentos")->fetchColumn();
            $stats['promedio_icfes'] = $avg !== null ? round((float)$avg, 1) : 0;
        } catch (Exception $e) { $stats['promedio_icfes'] = 0; }
        $ultimos_usuarios = [];
        try {
            $ultimos_usuarios = $db->query("SELECT nombre, correo, ciudad, rol, f_registro FROM usuarios ORDER BY id_usuarios DESC LIMIT 12")->fetchAll();
        } catch (Exception $e) {}
        $filtro_ciudad = isset($_GET['ciudad']) ? trim($_GET['ciudad']) : '';
        $periodo = isset($_GET['periodo']) ? trim($_GET['periodo']) : 'all';
        $chart_ciudades = []; $chart_contenido = [];
        $chart_actividad = ['labels'=>['Sin datos'],'tests'=>[0],'icfes'=>[0]];
        $ciudades_filtro = [];
        try {
            $sql = "SELECT ciudad AS label, COUNT(*) AS value FROM universidades WHERE ciudad IS NOT NULL AND ciudad != '' GROUP BY ciudad ORDER BY value DESC LIMIT 12";
            $chart_ciudades = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            foreach ($chart_ciudades as &$r) { $r['value'] = (int)$r['value']; } unset($r);
            $chart_contenido = [
                ['label'=>'Universidades','value'=>(int)$stats['universidades']],
                ['label'=>'Carreras','value'=>$count("SELECT COUNT(*) FROM programas_academicos")],
                ['label'=>'Becas','value'=>$count("SELECT COUNT(*) FROM becas")],
                ['label'=>'Tests','value'=>$count("SELECT COUNT(*) FROM usuario_cuestionario")],
                ['label'=>'Pre-ICFES','value'=>$count("SELECT COUNT(*) FROM simulacro_intentos")],
            ];
            $ciudades_filtro = $db->query("SELECT DISTINCT ciudad FROM universidades WHERE ciudad IS NOT NULL AND ciudad != '' ORDER BY ciudad")->fetchAll(PDO::FETCH_COLUMN);
        } catch (Exception $e) {}
        include_once "vistas/usuarios/admin.php";
    }

    public function adminGestion() {
        include_once "controladores/admin_crud_proc.php";
    }
}
?>
