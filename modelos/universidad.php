<?php
include_once "conexion.php";

class Universidad {
    public static function listar() {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT * FROM universidades ORDER BY nombre ASC";
        $consulta = $db->query($sql);
        return $consulta->fetchAll();
    }

    public static function obtenerPorId($id) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT * FROM universidades WHERE id_universidad = ?";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id]);
        return $consulta->fetch();
    }

    public static function filtrar($ciudad = '', $tipo = '', $pagina = 1, $por_pagina = 8, $buscar = '') {
        $db = baseDatos::crearInstancia();
        $condiciones = [];
        $parametros = [];

        if ($buscar !== '') {
            $condiciones[] = "(nombre LIKE ? OR descripcion LIKE ?)";
            $parametros[] = '%' . $buscar . '%';
            $parametros[] = '%' . $buscar . '%';
        }
        if ($ciudad !== '') {
            $condiciones[] = "ciudad = ?";
            $parametros[] = $ciudad;
        }
        if ($tipo !== '') {
            $condiciones[] = "tipo = ?";
            $parametros[] = $tipo;
        }

        $sql = "SELECT * FROM universidades";
        if (count($condiciones) > 0) {
            $sql .= " WHERE " . implode(" AND ", $condiciones);
        }
        $sql .= " ORDER BY nombre ASC";
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

    public static function contarFiltrados($ciudad = '', $tipo = '', $buscar = '') {
        $db = baseDatos::crearInstancia();
        $condiciones = [];
        $parametros = [];
        if ($buscar !== '') {
            $condiciones[] = "(nombre LIKE ? OR descripcion LIKE ?)";
            $parametros[] = '%' . $buscar . '%';
            $parametros[] = '%' . $buscar . '%';
        }
        if ($ciudad !== '') { $condiciones[] = "ciudad = ?"; $parametros[] = $ciudad; }
        if ($tipo !== '') { $condiciones[] = "tipo = ?"; $parametros[] = $tipo; }
        $sql = "SELECT COUNT(*) FROM universidades";
        if (count($condiciones) > 0) { $sql .= " WHERE " . implode(" AND ", $condiciones); }
        $consulta = $db->prepare($sql);
        $consulta->execute($parametros);
        return (int)$consulta->fetchColumn();
    }

    public static function obtenerProgramas($id_universidad) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT * FROM programas_academicos WHERE id_universidad = ? ORDER BY n_programa ASC";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id_universidad]);
        return $consulta->fetchAll();
    }

    public static function obtenerCiudades() {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT DISTINCT ciudad FROM universidades WHERE ciudad IS NOT NULL AND ciudad != '' ORDER BY ciudad ASC";
        $consulta = $db->query($sql);
        return $consulta->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function crear($nombre, $ciudad, $tipo, $sitio_web, $descripcion, $jornadas) {
        $db = baseDatos::crearInstancia();
        $sql = "INSERT INTO universidades (nombre, ciudad, tipo, sitio_web, descripcion, jornadas) VALUES (?, ?, ?, ?, ?, ?)";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$nombre, $ciudad, $tipo, $sitio_web, $descripcion, $jornadas]);
    }

    public static function generarSlug($texto) {
        $texto = mb_strtolower($texto, 'UTF-8');
        $reemplazos = ['á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ñ'=>'n'];
        $texto = strtr($texto, $reemplazos);
        $texto = preg_replace('/[^a-z0-9\s-]/', '', $texto);
        return preg_replace('/[\s-]+/', '-', trim($texto));
    }

    public static function obtenerPorSlug($slug) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT * FROM universidades WHERE slug = ?";
        $consulta = $db->prepare($sql);
        $consulta->execute([$slug]);
        return $consulta->fetch();
    }

    public static function actualizar($id, $nombre, $ciudad, $tipo, $sitio_web, $descripcion, $jornadas, $slug) {
        $db = baseDatos::crearInstancia();
        $sql = "UPDATE universidades SET nombre = ?, ciudad = ?, tipo = ?, sitio_web = ?, descripcion = ?, jornadas = ?, slug = ? WHERE id_universidad = ?";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$nombre, $ciudad, $tipo, $sitio_web, $descripcion, $jornadas, $slug, $id]);
    }

    public static function eliminar($id) {
        $db = baseDatos::crearInstancia();
        $sql = "DELETE FROM universidades WHERE id_universidad = ?";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$id]);
    }

    public static function asegurarColumnaVisitas() {
        $db = baseDatos::crearInstancia();
        try {
            $db->query("SELECT visitas FROM universidades LIMIT 1");
        } catch (Exception $e) {
            try {
                $db->exec("ALTER TABLE universidades ADD COLUMN visitas INT NOT NULL DEFAULT 0");
            } catch (Exception $e2) {}
        }
    }

    public static function registrarVisita($id) {
        self::asegurarColumnaVisitas();
        $db = baseDatos::crearInstancia();
        try {
            $st = $db->prepare("UPDATE universidades SET visitas = visitas + 1 WHERE id_universidad = ?");
            return $st->execute([(int)$id]);
        } catch (Exception $e) {
            return false;
        }
    }

    public static function rankingVisitas($ciudad = '', $limite = 12) {
        self::asegurarColumnaVisitas();
        $db = baseDatos::crearInstancia();
        $limite = max(1, min(30, (int)$limite));
        try {
            if ($ciudad !== '') {
                $st = $db->prepare("SELECT nombre AS label, visitas AS value FROM universidades WHERE ciudad = ? ORDER BY visitas ASC, nombre ASC LIMIT $limite");
                $st->execute([$ciudad]);
            } else {
                $st = $db->query("SELECT nombre AS label, visitas AS value FROM universidades ORDER BY visitas ASC, nombre ASC LIMIT $limite");
            }
            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as &$r) { $r['value'] = (int)($r['value'] ?? 0); }
            return $rows;
        } catch (Exception $e) {
            return [];
        }
    }
}
?>
