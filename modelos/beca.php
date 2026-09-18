<?php
include_once "conexion.php";

class Beca {
    public static function listar() {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT * FROM becas ORDER BY fecha_limite ASC";
        $consulta = $db->query($sql);
        return $consulta->fetchAll();
    }

    public static function obtenerPorId($id) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT * FROM becas WHERE id_becas = ?";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id]);
        return $consulta->fetch();
    }

    public static function crear($nombre_beca, $campus, $requisitos, $fecha_limite, $enlace) {
        $db = baseDatos::crearInstancia();
        $sql = "INSERT INTO becas (nombre_beca, campus, requisitos, fecha_limite, enlace) VALUES (?, ?, ?, ?, ?)";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$nombre_beca, $campus, $requisitos, $fecha_limite, $enlace]);
    }

    public static function actualizar($id, $nombre_beca, $campus, $requisitos, $fecha_limite, $enlace) {
        $db = baseDatos::crearInstancia();
        $sql = "UPDATE becas SET nombre_beca = ?, campus = ?, requisitos = ?, fecha_limite = ?, enlace = ? WHERE id_becas = ?";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$nombre_beca, $campus, $requisitos, $fecha_limite, $enlace, $id]);
    }

    public static function eliminar($id) {
        $db = baseDatos::crearInstancia();
        // Primero eliminar relaciones en usuario_becas
        $sql1 = "DELETE FROM usuario_becas WHERE id_beca = ?";
        $db->prepare($sql1)->execute([$id]);
        // Luego eliminar la beca
        $sql = "DELETE FROM becas WHERE id_becas = ?";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$id]);
    }
}
?>
