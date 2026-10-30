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
        include_once "modelos/universidad.php";
        $db = baseDatos::crearInstancia();

        $filtro_ciudad = isset($_GET['ciudad']) ? trim($_GET['ciudad']) : '';
        $periodo = isset($_GET['periodo']) ? trim($_GET['periodo']) : 'all';

        $count = function ($sql, $params = []) use ($db) {
            try {
                if ($params) {
                    $st = $db->prepare($sql);
                    $st->execute($params);
                    return (int) $st->fetchColumn();
                }
                return (int) $db->query($sql)->fetchColumn();
            } catch (Exception $e) { return 0; }
        };

        if ($filtro_ciudad !== '') {
            $stats = [
                'usuarios' => $count("SELECT COUNT(*) FROM usuarios WHERE ciudad = ?", [$filtro_ciudad]),
                'universidades' => $count("SELECT COUNT(*) FROM universidades WHERE ciudad = ?", [$filtro_ciudad]),
                'programas' => $count("SELECT COUNT(*) FROM programas_academicos p JOIN universidades u ON p.id_universidad = u.id_universidad WHERE u.ciudad = ?", [$filtro_ciudad]),
                'becas' => $count("SELECT COUNT(*) FROM becas"),
                'tests_completados' => $count("SELECT COUNT(*) FROM usuario_cuestionario uc JOIN usuarios us ON uc.id_usuario = us.id_usuarios WHERE us.ciudad = ?", [$filtro_ciudad]),
                'preguntas_test' => $count("SELECT COUNT(*) FROM preguntas"),
                'respuestas_test' => $count("SELECT COUNT(*) FROM respuesta r JOIN usuarios us ON r.id_usuario = us.id_usuarios WHERE us.ciudad = ?", [$filtro_ciudad]),
            ];
        } else {
            $stats = [
                'usuarios' => $count("SELECT COUNT(*) FROM usuarios"),
                'universidades' => $count("SELECT COUNT(*) FROM universidades"),
                'programas' => $count("SELECT COUNT(*) FROM programas_academicos"),
                'becas' => $count("SELECT COUNT(*) FROM becas"),
                'tests_completados' => $count("SELECT COUNT(*) FROM usuario_cuestionario"),
                'preguntas_test' => $count("SELECT COUNT(*) FROM preguntas"),
                'respuestas_test' => $count("SELECT COUNT(*) FROM respuesta"),
            ];
        }

        $ultimos_usuarios = [];
        try {
            if ($filtro_ciudad !== '') {
                $st = $db->prepare("SELECT nombre, correo, ciudad, rol, f_registro FROM usuarios WHERE ciudad = ? ORDER BY id_usuarios DESC LIMIT 12");
                $st->execute([$filtro_ciudad]);
                $ultimos_usuarios = $st->fetchAll();
            } else {
                $ultimos_usuarios = $db->query("SELECT nombre, correo, ciudad, rol, f_registro FROM usuarios ORDER BY id_usuarios DESC LIMIT 12")->fetchAll();
            }
        } catch (Exception $e) {}

        $chart_ciudades = [];
        $chart_contenido = [];
        $chart_actividad = ['labels' => [], 'tests' => []];
        $ciudades_filtro = [];

        try {
            $chart_ciudades = Universidad::rankingVisitas($filtro_ciudad, 12);
            foreach ($chart_ciudades as &$r) { $r['value'] = (int)$r['value']; } unset($r);

            $chart_contenido = [
                ['label' => 'Universidades', 'value' => (int)$stats['universidades']],
                ['label' => 'Carreras', 'value' => (int)$stats['programas']],
                ['label' => 'Becas', 'value' => (int)$stats['becas']],
                ['label' => 'Tests', 'value' => (int)$stats['tests_completados']],
            ];

            $dateCond = '';
            $paramsAct = [];
            if ($periodo === '30') {
                $dateCond = " AND uc.fecha >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
            } elseif ($periodo === '90') {
                $dateCond = " AND uc.fecha >= DATE_SUB(CURDATE(), INTERVAL 90 DAY)";
            }

            $sqlAct = "SELECT DATE(uc.fecha) AS dia, COUNT(*) AS total FROM usuario_cuestionario uc INNER JOIN usuarios us ON us.id_usuarios = uc.id_usuario WHERE uc.fecha IS NOT NULL" . $dateCond;
            if ($filtro_ciudad !== '') {
                $sqlAct .= " AND us.ciudad = ?";
                $paramsAct[] = $filtro_ciudad;
            }
            $sqlAct .= " GROUP BY DATE(uc.fecha) ORDER BY dia ASC LIMIT 60";
            $st = $db->prepare($sqlAct);
            $st->execute($paramsAct);
            $rows = $st->fetchAll(PDO::FETCH_ASSOC);

            if (empty($rows)) {
                $dateCondR = '';
                $paramsR = [];
                if ($periodo === '30') {
                    $dateCondR = " AND r.fecha >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
                } elseif ($periodo === '90') {
                    $dateCondR = " AND r.fecha >= DATE_SUB(CURDATE(), INTERVAL 90 DAY)";
                }
                $sqlR = "SELECT DATE(r.fecha) AS dia, COUNT(DISTINCT r.id_usuario) AS total FROM respuesta r INNER JOIN usuarios us ON us.id_usuarios = r.id_usuario WHERE r.fecha IS NOT NULL" . $dateCondR;
                if ($filtro_ciudad !== '') {
                    $sqlR .= " AND us.ciudad = ?";
                    $paramsR[] = $filtro_ciudad;
                }
                $sqlR .= " GROUP BY DATE(r.fecha) ORDER BY dia ASC LIMIT 60";
                $st = $db->prepare($sqlR);
                $st->execute($paramsR);
                $rows = $st->fetchAll(PDO::FETCH_ASSOC);
            }

            if (!empty($rows)) {
                foreach ($rows as $row) {
                    $chart_actividad['labels'][] = $row['dia'];
                    $chart_actividad['tests'][] = (int)$row['total'];
                }
            } else {
                $chart_actividad = ['labels' => ['Sin datos'], 'tests' => [0]];
            }

            $ciudades_filtro = $db->query("SELECT DISTINCT ciudad FROM universidades WHERE ciudad IS NOT NULL AND ciudad != '' ORDER BY ciudad")->fetchAll(PDO::FETCH_COLUMN);
        } catch (Exception $e) {
            if (empty($chart_actividad['labels'])) {
                $chart_actividad = ['labels' => ['Sin datos'], 'tests' => [0]];
            }
        }

        include_once "vistas/usuarios/admin.php";
    }

    public function adminGestion() {
        include_once "controladores/admin_crud_proc.php";
    }
}
?>
