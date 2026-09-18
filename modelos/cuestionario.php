<?php
include_once "conexion.php";

class Cuestionario {
    public static function listar() {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT c.*, a.nombre as area_nombre 
                FROM cuestionario c
                LEFT JOIN areas a ON c.id_area = a.id_areas
                ORDER BY c.id_cuestionario ASC";
        $consulta = $db->query($sql);
        return $consulta->fetchAll();
    }

    public static function obtenerPorId($id) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT c.*, a.nombre as area_nombre, a.descripcion as area_descripcion 
                FROM cuestionario c
                LEFT JOIN areas a ON c.id_area = a.id_areas
                WHERE c.id_cuestionario = ?";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id]);
        return $consulta->fetch();
    }

    public static function obtenerPreguntas($id_cuestionario) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT * FROM preguntas WHERE id_cuestionario = ? ORDER BY id_pregunta ASC";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id_cuestionario]);
        return $consulta->fetchAll();
    }

    public static function guardarRespuesta($id_usuario, $id_cuestionario, $id_pregunta, $respuesta_opcion) {
        $db = baseDatos::crearInstancia();
        $fecha = date("Y-m-d");
        
        // Borrar respuesta previa si existía
        $sqlDelete = "DELETE FROM respuesta WHERE id_usuario = ? AND id_pregunta = ?";
        $consultaDelete = $db->prepare($sqlDelete);
        $consultaDelete->execute([$id_usuario, $id_pregunta]);

        // Insertar respuesta nueva
        $sql = "INSERT INTO respuesta (id_usuario, id_cuestionario, id_pregunta, respuesta, fecha) VALUES (?, ?, ?, ?, ?)";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$id_usuario, $id_cuestionario, $id_pregunta, $respuesta_opcion, $fecha]);
    }

    public static function registrarIntento($id_usuario, $id_cuestionario) {
        $db = baseDatos::crearInstancia();
        $fecha = date("Y-m-d");

        // Borrar registro de intento previo
        $sqlDelete = "DELETE FROM usuario_cuestionario WHERE id_usuario = ? AND id_cuestionario = ?";
        $consultaDelete = $db->prepare($sqlDelete);
        $consultaDelete->execute([$id_usuario, $id_cuestionario]);

        // Registrar nuevo intento
        $sql = "INSERT INTO usuario_cuestionario (id_usuario, id_cuestionario, fecha) VALUES (?, ?, ?)";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$id_usuario, $id_cuestionario, $fecha]);
    }

    public static function obtenerRespuestasUsuario($id_usuario, $id_cuestionario) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT r.*, p.pregunta, p.correcta, p.a, p.b, p.c, p.d, p.e, p.f 
                FROM respuesta r
                JOIN preguntas p ON r.id_pregunta = p.id_pregunta
                WHERE r.id_usuario = ? AND r.id_cuestionario = ?";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id_usuario, $id_cuestionario]);
        return $consulta->fetchAll();
    }

    public static function obtenerCuestionariosRealizados($id_usuario) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT uc.*, c.descripcion, a.nombre as area_nombre 
                FROM usuario_cuestionario uc
                JOIN cuestionario c ON uc.id_cuestionario = c.id_cuestionario
                LEFT JOIN areas a ON c.id_area = a.id_areas
                WHERE uc.id_usuario = ?
                ORDER BY uc.fecha DESC";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id_usuario]);
        return $consulta->fetchAll();
    }

    // Gestión de áreas
    public static function listarAreas() {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT * FROM areas ORDER BY nombre ASC";
        $consulta = $db->query($sql);
        return $consulta->fetchAll();
    }

    public static function crearArea($nombre, $descripcion) {
        $db = baseDatos::crearInstancia();
        $sql = "INSERT INTO areas (nombre, descripcion) VALUES (?, ?)";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$nombre, $descripcion]);
    }

    public static function crearCuestionario($descripcion, $id_area) {
        $db = baseDatos::crearInstancia();
        $sql = "INSERT INTO cuestionario (descripcion, id_area) VALUES (?, ?)";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$descripcion, $id_area]);
    }

    public static function crearPregunta($id_cuestionario, $pregunta, $a, $b, $c, $d, $e = null, $f = null, $correcta = null) {
        $db = baseDatos::crearInstancia();
        $sql = "INSERT INTO preguntas (id_cuestionario, pregunta, a, b, c, d, e, f, correcta) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$id_cuestionario, $pregunta, $a, $b, $c, $d, $e, $f, $correcta]);
    }
}
?>
