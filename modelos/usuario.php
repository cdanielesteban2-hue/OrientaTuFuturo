<?php
include_once "conexion.php";

class Usuario {
    public $id;
    public $nombre;
    public $correo;
    public $ciudad;
    public $f_registro;
    public $avatar;
    public $rol;

    public function __construct($id, $nombre, $correo, $ciudad, $f_registro, $avatar = 'av1', $rol = 'usuario') {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->ciudad = $ciudad;
        $this->f_registro = $f_registro;
        $this->avatar = $avatar;
        $this->rol = $rol;
    }

    public static function crear($nombre, $correo, $password, $ciudad) {
        $db = baseDatos::crearInstancia();
        $passHash = password_hash($password, PASSWORD_BCRYPT);
        $fecha = date("Y-m-d");

        $sql = "INSERT INTO usuarios (nombre, correo, password, ciudad, f_registro, rol) VALUES (?, ?, ?, ?, ?, 'usuario')";
        $consulta = $db->prepare($sql);
        $consulta->execute([$nombre, $correo, $passHash, $ciudad, $fecha]);
        return $db->lastInsertId();
    }

    public static function login($correo, $password) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT * FROM usuarios WHERE correo = ?";
        $consulta = $db->prepare($sql);
        $consulta->execute([$correo]);
        $usuario = $consulta->fetch();

        if ($usuario && password_verify($password, $usuario['password'])) {
            return new Usuario($usuario['id_usuarios'], $usuario['nombre'], $usuario['correo'], $usuario['ciudad'], $usuario['f_registro'], $usuario['avatar'] ?? 'av1', $usuario['rol'] ?? 'usuario');
        }
        return false;
    }

    public static function obtenerPorId($id) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT * FROM usuarios WHERE id_usuarios = ?";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id]);
        $usuario = $consulta->fetch();

        if ($usuario) {
            return new Usuario($usuario['id_usuarios'], $usuario['nombre'], $usuario['correo'], $usuario['ciudad'], $usuario['f_registro'], $usuario['avatar'] ?? 'av1', $usuario['rol'] ?? 'usuario');
        }
        return null;
    }

    public static function actualizarPerfil($id, $nombre, $ciudad, $avatar) {
        $db = baseDatos::crearInstancia();
        $sql = "UPDATE usuarios SET nombre = ?, ciudad = ?, avatar = ? WHERE id_usuarios = ?";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$nombre, $ciudad, $avatar, $id]);
    }

    public static function cambiarPassword($id, $pass_actual, $nueva_pass) {
        $db = baseDatos::crearInstancia();
        $row = $db->prepare("SELECT password FROM usuarios WHERE id_usuarios = ?");
        $row->execute([$id]);
        $usuario = $row->fetch();
        if (!$usuario || !password_verify($pass_actual, $usuario['password'])) {
            return false; // Contraseña actual incorrecta
        }
        $nuevo_hash = password_hash($nueva_pass, PASSWORD_BCRYPT);
        $stmt = $db->prepare("UPDATE usuarios SET password = ? WHERE id_usuarios = ?");
        return $stmt->execute([$nuevo_hash, $id]);
    }

    public static function correoExiste($correo) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT id_usuarios FROM usuarios WHERE correo = ?";
        $consulta = $db->prepare($sql);
        $consulta->execute([$correo]);
        return $consulta->fetch() ? true : false;
    }

    // Guardar programas favoritos
    public static function guardarPrograma($id_usuario, $id_programa) {
        $db = baseDatos::crearInstancia();
        try {
            $sql = "INSERT INTO usuario_programa (id_usuario, id_programa) VALUES (?, ?)";
            $consulta = $db->prepare($sql);
            return $consulta->execute([$id_usuario, $id_programa]);
        } catch (Exception $e) {
            return false; // Ya guardado
        }
    }

    public static function eliminarProgramaGuardado($id_usuario, $id_programa) {
        $db = baseDatos::crearInstancia();
        $sql = "DELETE FROM usuario_programa WHERE id_usuario = ? AND id_programa = ?";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$id_usuario, $id_programa]);
    }

    public static function obtenerProgramasGuardados($id_usuario) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT p.*, u.nombre as universidad_nombre, u.ciudad as universidad_ciudad 
                FROM usuario_programa up 
                JOIN programas_academicos p ON up.id_programa = p.id_programa
                JOIN universidades u ON p.id_universidad = u.id_universidad
                WHERE up.id_usuario = ?";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id_usuario]);
        return $consulta->fetchAll();
    }

    // Guardar becas favoritas
    public static function guardarBeca($id_usuario, $id_beca) {
        $db = baseDatos::crearInstancia();
        try {
            $sql = "INSERT INTO usuario_becas (id_usuario, id_beca) VALUES (?, ?)";
            $consulta = $db->prepare($sql);
            return $consulta->execute([$id_usuario, $id_beca]);
        } catch (Exception $e) {
            return false; // Ya guardado
        }
    }

    public static function eliminarBecaGuardada($id_usuario, $id_beca) {
        $db = baseDatos::crearInstancia();
        $sql = "DELETE FROM usuario_becas WHERE id_usuario = ? AND id_beca = ?";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$id_usuario, $id_beca]);
    }

    public static function obtenerBecasGuardadas($id_usuario) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT b.* FROM usuario_becas ub 
                JOIN becas b ON ub.id_beca = b.id_becas 
                WHERE ub.id_usuario = ?";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id_usuario]);
        return $consulta->fetchAll();
    }
}
?>
