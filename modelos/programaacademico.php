<?php
include_once "conexion.php";

class ProgramasAcademicos {
    public static function listar() {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT p.*, u.nombre as universidad_nombre, u.ciudad as universidad_ciudad 
                FROM programas_academicos p
                JOIN universidades u ON p.id_universidad = u.id_universidad
                ORDER BY p.n_programa ASC";
        $consulta = $db->query($sql);
        return $consulta->fetchAll();
    }

    public static function obtenerPorId($id) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT p.*, u.nombre as universidad_nombre, u.ciudad as universidad_ciudad, u.sitio_web, u.descripcion as universidad_descripcion, u.tipo as universidad_tipo, u.jornadas as universidad_jornadas
                FROM programas_academicos p
                JOIN universidades u ON p.id_universidad = u.id_universidad
                WHERE p.id_programa = ?";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id]);
        return $consulta->fetch();
    }

    public static function filtrar($area = '', $costoMax = '', $id_universidad = '', $pagina = 1, $por_pagina = 12) {
        $db = baseDatos::crearInstancia();
        $condiciones = [];
        $parametros = [];

        if ($area !== '') {
            $condiciones[] = "p.area = ?";
            $parametros[] = $area;
        }
        if ($costoMax !== '') {
            $condiciones[] = "p.costo <= ?";
            $parametros[] = $costoMax;
        }
        if ($id_universidad !== '') {
            $condiciones[] = "p.id_universidad = ?";
            $parametros[] = $id_universidad;
        }

        $sql = "SELECT p.*, u.nombre as universidad_nombre, u.ciudad as universidad_ciudad 
                FROM programas_academicos p
                JOIN universidades u ON p.id_universidad = u.id_universidad";
                
        if (count($condiciones) > 0) {
            $sql .= " WHERE " . implode(" AND ", $condiciones);
        }
        $sql .= " ORDER BY p.n_programa ASC";
        
        $offset = ($pagina - 1) * $por_pagina;
        $sql .= " LIMIT ? OFFSET ?";

        $consulta = $db->prepare($sql);
        $paramIndex = 1;
        foreach ($parametros as $val) {
            $consulta->bindValue($paramIndex++, $val);
        }
        $consulta->bindValue($paramIndex++, (int)$por_pagina, PDO::PARAM_INT);
        $consulta->bindValue($paramIndex++, (int)$offset, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public static function contarFiltrados($area = '', $costoMax = '', $id_universidad = '') {
        $db = baseDatos::crearInstancia();
        $condiciones = [];
        $parametros = [];
        if ($area !== '') { $condiciones[] = "p.area = ?"; $parametros[] = $area; }
        if ($costoMax !== '') { $condiciones[] = "p.costo <= ?"; $parametros[] = $costoMax; }
        if ($id_universidad !== '') { $condiciones[] = "p.id_universidad = ?"; $parametros[] = $id_universidad; }
        $sql = "SELECT COUNT(*) FROM programas_academicos p";
        if (count($condiciones) > 0) { $sql .= " WHERE " . implode(" AND ", $condiciones); }
        $consulta = $db->prepare($sql);
        $consulta->execute($parametros);
        return (int)$consulta->fetchColumn();
    }

    public static function obtenerAreas() {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT DISTINCT area FROM programas_academicos WHERE area IS NOT NULL AND area != '' ORDER BY area ASC";
        $consulta = $db->query($sql);
        return $consulta->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function crear($id_universidad, $n_programa, $area, $duracion, $costo) {
        $db = baseDatos::crearInstancia();
        $slug = self::generarSlug($n_programa) . '-' . time() . rand(10,99);
        $sql = "INSERT INTO programas_academicos (id_universidad, n_programa, area, duracion, costo, slug) VALUES (?, ?, ?, ?, ?, ?)";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$id_universidad, $n_programa, $area, $duracion, $costo, $slug]);
    }

    public static function generarSlug($texto) {
        $texto = mb_strtolower($texto, 'UTF-8');
        $reemplazos = ['á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ñ'=>'n','ü'=>'u'];
        $texto = strtr($texto, $reemplazos);
        $texto = preg_replace('/[^a-z0-9\s-]/', '', $texto);
        return preg_replace('/[\s-]+/', '-', trim($texto));
    }

    public static function obtenerPorSlug($slug) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT p.*, u.nombre as universidad_nombre, u.ciudad as universidad_ciudad, u.sitio_web, u.descripcion as universidad_descripcion, u.tipo as universidad_tipo, u.jornadas as universidad_jornadas
                FROM programas_academicos p
                JOIN universidades u ON p.id_universidad = u.id_universidad
                WHERE p.slug = ?";
        $consulta = $db->prepare($sql);
        $consulta->execute([$slug]);
        return $consulta->fetch();
    }
    public static function filtrarPorAreas($areas, $limite = 12) {
        if (empty($areas)) return [];
        
        $db = baseDatos::crearInstancia();
        $placeholders = implode(',', array_fill(0, count($areas), '?'));
        
        $sql = "SELECT p.*, u.nombre as universidad_nombre, u.ciudad as universidad_ciudad 
                FROM programas_academicos p
                JOIN universidades u ON p.id_universidad = u.id_universidad
                WHERE p.area IN ($placeholders)
                ORDER BY p.n_programa ASC
                LIMIT ?";
        
        $consulta = $db->prepare($sql);
        $paramIndex = 1;
        foreach ($areas as $area) {
            $consulta->bindValue($paramIndex++, $area);
        }
        $consulta->bindValue($paramIndex, (int)$limite, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public static function actualizar($id, $id_universidad, $n_programa, $area, $duracion, $costo, $slug) {
        $db = baseDatos::crearInstancia();
        $sql = "UPDATE programas_academicos SET id_universidad = ?, n_programa = ?, area = ?, duracion = ?, costo = ?, slug = ? WHERE id_programa = ?";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$id_universidad, $n_programa, $area, $duracion, $costo, $slug, $id]);
    }

    public static function eliminar($id) {
        $db = baseDatos::crearInstancia();
        $sql = "DELETE FROM programas_academicos WHERE id_programa = ?";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$id]);
    }
}
?>
