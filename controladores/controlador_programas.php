<?php
include_once "modelos/programaacademico.php";
include_once "modelos/universidad.php";

class ControladorProgramas {
    public function inicio() {
        $area           = isset($_GET['area'])           ? trim($_GET['area'])           : '';
        $costoMax       = isset($_GET['costoMax'])       ? trim($_GET['costoMax'])       : '';
        $id_universidad = isset($_GET['id_universidad']) ? trim($_GET['id_universidad']) : '';
        $buscar         = isset($_GET['buscar'])         ? trim($_GET['buscar'])         : '';
        $pagina         = isset($_GET['pagina'])         ? max(1, (int)$_GET['pagina'])  : 1;
        $por_pagina     = 12;

        if ($_POST) {
            $area           = isset($_POST['area'])           ? trim($_POST['area'])           : '';
            $costoMax       = isset($_POST['costoMax'])       ? trim($_POST['costoMax'])       : '';
            $id_universidad = isset($_POST['id_universidad']) ? trim($_POST['id_universidad']) : '';
            $buscar         = isset($_POST['buscar'])         ? trim($_POST['buscar'])         : '';
            $pagina         = 1;
        }

        $total_registros = ProgramasAcademicos::contarFiltrados($area, $costoMax, $id_universidad, $buscar);
        $total_paginas   = max(1, ceil($total_registros / $por_pagina));
        $programas       = ProgramasAcademicos::filtrar($area, $costoMax, $id_universidad, $pagina, $por_pagina, $buscar);
        $areas           = ProgramasAcademicos::obtenerAreas();
        $universidades   = Universidad::listar();

        include_once "vistas/programas/inicio.php";
    }

    public function detalle() {
        // Soporte para ID numérico (?id=5) y slug (?id=ingenieria-de-sistemas-5)
        if (!isset($_GET['id'])) {
            header("Location: " . URL_BASE . "programas/inicio");
            exit;
        }

        $param = $_GET['id'];
        if (is_numeric($param)) {
            $programa = ProgramasAcademicos::obtenerPorId($param);
        } else {
            $programa = ProgramasAcademicos::obtenerPorSlug($param);
        }

        if (!$programa) {
            header("Location: " . URL_BASE . "paginas/error");
            exit;
        }

        include_once "vistas/programas/detalle.php";
    }

    public function comparar() {
        if (!isset($_GET['ids'])) {
            header("Location: " . URL_BASE . "usuarios/dashboard");
            exit;
        }

        $ids_string = $_GET['ids'];
        $ids_array = explode(',', $ids_string);
        
        $programas_comparar = [];
        foreach ($ids_array as $id) {
            $prog = ProgramasAcademicos::obtenerPorId(trim($id));
            if ($prog) {
                $programas_comparar[] = $prog;
            }
        }

        if (count($programas_comparar) < 2) {
            header("Location: " . URL_BASE . "usuarios/dashboard");
            exit;
        }

        include_once "vistas/programas/comparador.php";
    }
}


