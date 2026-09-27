<?php
include_once "modelos/usuario.php";

class ControladorUsuarios {
    public function registro() {
        if (isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/dashboard");
            exit;
        }

        // Cargar las mismas ciudades que el filtro de universidades
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
            header("Location: " . URL_BASE . "usuarios/dashboard");
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
                    header("Location: " . URL_BASE . "usuarios/dashboard");
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

        // Ciudades dinámicas para el formulario de perfil (mismas que el filtro de universidades)
        $ciudades = Universidad::obtenerCiudades();
        
        // Mensajes de feedback para perfil
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
                // Refrescar la sesión
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
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/login");
            exit;
        }

        if (isset($_GET['id'])) {
            $id_usuario = $_SESSION['usuario']['id'];
            $id_programa = $_GET['id'];
            Usuario::guardarPrograma($id_usuario, $id_programa);
        }
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function eliminarPrograma() {
        if (!isset($_GET['id'])) {
            header("Location: " . URL_BASE . "usuarios/login");
            exit;
        }

        if (isset($_GET['id'])) {
            $id_usuario = $_SESSION['usuario']['id'];
            $id_programa = $_GET['id'];
            Usuario::eliminarProgramaGuardado($id_usuario, $id_programa);
        }
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function guardarBeca() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/login");
            exit;
        }

        if (isset($_GET['id'])) {
            $id_usuario = $_SESSION['usuario']['id'];
            $id_beca = $_GET['id'];
            Usuario::guardarBeca($id_usuario, $id_beca);
        }
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function eliminarBeca() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/login");
            exit;
        }

        if (isset($_GET['id'])) {
            $id_usuario = $_SESSION['usuario']['id'];
            $id_beca = $_GET['id'];
            Usuario::eliminarBecaGuardada($id_usuario, $id_beca);
        }
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
?>
