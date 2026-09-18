<?php
include_once "conexion.php";

class Resenia {
    public static function crear($id_usuario, $id_universidad, $calificacion, $comentario) {
        $db = baseDatos::crearInstancia();
        $sql = "INSERT INTO resenias (id_usuario, id_universidad, calificacion, comentario) VALUES (?, ?, ?, ?)";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$id_usuario, $id_universidad, $calificacion, $comentario]);
    }

    public static function obtenerPorUniversidad($id_universidad) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT r.*, u.nombre as autor_nombre, u.avatar as autor_avatar
                FROM resenias r
                JOIN usuarios u ON r.id_usuario = u.id_usuarios
                WHERE r.id_universidad = ?
                ORDER BY r.fecha DESC";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id_universidad]);
        return $consulta->fetchAll();
    }

    public static function promedioCalificacion($id_universidad) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT ROUND(AVG(calificacion), 1) as promedio, COUNT(*) as total FROM resenias WHERE id_universidad = ?";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id_universidad]);
        return $consulta->fetch();
    }

    public static function yaResenoUsuario($id_usuario, $id_universidad) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT COUNT(*) FROM resenias WHERE id_usuario = ? AND id_universidad = ?";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id_usuario, $id_universidad]);
        return $consulta->fetchColumn() > 0;
    }
}
?>
