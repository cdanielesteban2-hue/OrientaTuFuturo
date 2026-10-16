<?php
// Procedural admin CRUD - included from ControladorUsuarios::adminGestion
if (!isset($_SESSION['usuario']) || ($_SESSION['usuario']['rol'] ?? '') !== 'admin') {
    header("Location: " . URL_BASE . "usuarios/login");
    exit;
}
include_once "conexion.php";
include_once "modelos/universidad.php";
include_once "modelos/beca.php";
include_once "modelos/programaacademico.php";
$tab = isset($_GET['tab']) ? $_GET['tab'] : (isset($_POST['tab']) ? $_POST['tab'] : 'universidades');
if (!in_array($tab, ['universidades','programas','becas'], true)) $tab = 'universidades';
$msg = '';
if (isset($_GET['del_uni'])) { Universidad::eliminar((int)$_GET['del_uni']); header("Location: " . URL_BASE . "usuarios/adminGestion?tab=universidades&ok=1"); exit; }
if (isset($_GET['del_beca'])) { Beca::eliminar((int)$_GET['del_beca']); header("Location: " . URL_BASE . "usuarios/adminGestion?tab=becas&ok=1"); exit; }
if (isset($_GET['del_prog'])) { ProgramasAcademicos::eliminar((int)$_GET['del_prog']); header("Location: " . URL_BASE . "usuarios/adminGestion?tab=programas&ok=1"); exit; }
if ($_POST && isset($_POST['accion'])) {
    $accion = $_POST['accion'];
    if ($accion === 'crear_uni') {
        $nombre = trim($_POST['nombre'] ?? '');
        if ($nombre !== '') {
            Universidad::crear($nombre, trim($_POST['ciudad'] ?? ''), trim($_POST['tipo'] ?? 'Privada'), trim($_POST['sitio_web'] ?? ''), trim($_POST['descripcion'] ?? ''), trim($_POST['jornadas'] ?? ''));
            try { $db = baseDatos::crearInstancia(); $id = (int)$db->lastInsertId(); if ($id) $db->prepare("UPDATE universidades SET slug = ? WHERE id_universidad = ?")->execute([Universidad::generarSlug($nombre), $id]); } catch (Exception $e) {}
            $msg = 'Universidad creada.';
        }
    } elseif ($accion === 'actualizar_uni') {
        $id = (int)($_POST['id'] ?? 0); $nombre = trim($_POST['nombre'] ?? '');
        if ($id && $nombre) { Universidad::actualizar($id, $nombre, trim($_POST['ciudad'] ?? ''), trim($_POST['tipo'] ?? 'Privada'), trim($_POST['sitio_web'] ?? ''), trim($_POST['descripcion'] ?? ''), trim($_POST['jornadas'] ?? ''), Universidad::generarSlug($nombre)); $msg = 'Universidad actualizada.'; }
    } elseif ($accion === 'crear_beca') {
        Beca::crear(trim($_POST['nombre_beca'] ?? ''), trim($_POST['campus'] ?? ''), trim($_POST['requisitos'] ?? ''), trim($_POST['fecha_limite'] ?? ''), trim($_POST['enlace'] ?? ''));
        $msg = 'Beca creada.';
    } elseif ($accion === 'actualizar_beca') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id) { Beca::actualizar($id, trim($_POST['nombre_beca'] ?? ''), trim($_POST['campus'] ?? ''), trim($_POST['requisitos'] ?? ''), trim($_POST['fecha_limite'] ?? ''), trim($_POST['enlace'] ?? '')); $msg = 'Beca actualizada.'; }
    } elseif ($accion === 'crear_prog') {
        $n = trim($_POST['n_programa'] ?? ''); $id_u = (int)($_POST['id_universidad'] ?? 0);
        if ($n && $id_u) {
            ProgramasAcademicos::crear($id_u, $n, trim($_POST['area'] ?? ''), trim($_POST['duracion'] ?? ''), ($_POST['costo'] !== '' ? $_POST['costo'] : null));
            try { $db = baseDatos::crearInstancia(); $id = (int)$db->lastInsertId(); if ($id) $db->prepare("UPDATE programas_academicos SET slug = ? WHERE id_programa = ?")->execute([ProgramasAcademicos::generarSlug($n), $id]); } catch (Exception $e) {}
            $msg = 'Carrera creada.';
        }
    } elseif ($accion === 'actualizar_prog') {
        $id = (int)($_POST['id'] ?? 0); $n = trim($_POST['n_programa'] ?? '');
        if ($id && $n) { ProgramasAcademicos::actualizar($id, (int)$_POST['id_universidad'], $n, trim($_POST['area'] ?? ''), trim($_POST['duracion'] ?? ''), ($_POST['costo'] !== '' ? $_POST['costo'] : null), ProgramasAcademicos::generarSlug($n)); $msg = 'Carrera actualizada.'; }
    }
    $tab = $_POST['tab'] ?? $tab;
}
if (isset($_GET['ok'])) $msg = $msg ?: 'Operación realizada.';
$edit_uni = isset($_GET['edit_uni']) ? Universidad::obtenerPorId((int)$_GET['edit_uni']) : null;
$edit_beca = isset($_GET['edit_beca']) ? Beca::obtenerPorId((int)$_GET['edit_beca']) : null;
$edit_prog = isset($_GET['edit_prog']) ? ProgramasAcademicos::obtenerPorId((int)$_GET['edit_prog']) : null;
$lista_unis = Universidad::listar();
$lista_becas = Beca::listar();
$todas_unis = $lista_unis;
$areas = ProgramasAcademicos::obtenerAreas();
try {
    $db = baseDatos::crearInstancia();
    $lista_progs = $db->query("SELECT p.*, u.nombre as universidad_nombre FROM programas_academicos p JOIN universidades u ON p.id_universidad = u.id_universidad ORDER BY p.id_programa DESC LIMIT 80")->fetchAll();
} catch (Exception $e) { $lista_progs = []; }
include_once "vistas/usuarios/admin_gestion.php";
