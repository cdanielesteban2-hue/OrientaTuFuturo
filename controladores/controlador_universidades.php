<?php
include_once "modelos/universidad.php";
include_once "modelos/resenia.php";

class ControladorUniversidades {
    public function inicio() {
        $ciudad  = isset($_GET['ciudad'])  ? trim($_GET['ciudad'])  : '';
        $tipo    = isset($_GET['tipo'])    ? trim($_GET['tipo'])    : '';
        $buscar  = isset($_GET['buscar'])  ? trim($_GET['buscar'])  : '';
        $pagina  = isset($_GET['pagina'])  ? max(1, (int)$_GET['pagina']) : 1;
        $por_pagina = 9;

        if ($_POST) {
            $ciudad  = isset($_POST['ciudad'])  ? trim($_POST['ciudad'])  : '';
            $tipo    = isset($_POST['tipo'])    ? trim($_POST['tipo'])    : '';
            $buscar  = isset($_POST['buscar'])  ? trim($_POST['buscar'])  : '';
            $pagina  = 1;
        }

        $total_registros = Universidad::contarFiltrados($ciudad, $tipo, $buscar);
        $total_paginas   = max(1, ceil($total_registros / $por_pagina));
        $universidades   = Universidad::filtrar($ciudad, $tipo, $pagina, $por_pagina, $buscar);
        $ciudades        = Universidad::obtenerCiudades();

        include_once "vistas/universidades/inicio.php";
    }

    public function detalle() {
        if (!isset($_GET['id'])) {
            header("Location: " . URL_BASE . "universidades/inicio");
            exit;
        }

        $param = $_GET['id'];
        if (is_numeric($param)) {
            $universidad = Universidad::obtenerPorId($param);
        } else {
            $universidad = Universidad::obtenerPorSlug($param);
        }

        if (!$universidad) {
            header("Location: " . URL_BASE . "paginas/error");
            exit;
        }

        $id = $universidad['id_universidad'];
        Universidad::registrarVisita($id);
        $programas  = Universidad::obtenerProgramas($id);
        $resenias   = Resenia::obtenerPorUniversidad($id);
        $calificacion = Resenia::promedioCalificacion($id);

        include_once "vistas/universidades/detalle.php";
    }

    public function guardarResenia() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . URL_BASE . "usuarios/login");
            exit;
        }
        if ($_POST && isset($_POST['id_universidad'], $_POST['calificacion'], $_POST['comentario'])) {
            $id_usuario    = $_SESSION['usuario']['id'];
            $id_universidad = (int)$_POST['id_universidad'];
            $calificacion  = max(1, min(5, (int)$_POST['calificacion']));
            $comentario    = trim($_POST['comentario']);
            if (strlen($comentario) >= 10) {
                Resenia::crear($id_usuario, $id_universidad, $calificacion, $comentario);
            }
        }
        header("Location: " . URL_BASE . "universidades/detalle?id=" . ($_POST['id_universidad'] ?? ''));
        exit;
    }
}
?>
