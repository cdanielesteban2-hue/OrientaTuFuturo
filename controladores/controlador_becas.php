<?php
include_once "modelos/beca.php";

class ControladorBecas {
    public function inicio() {
        $becas = Beca::listar();
        include_once "vistas/becas/inicio.php";
    }

    public function detalle() {
        if (!isset($_GET['id'])) {
            header("Location: " . URL_BASE . "becas/inicio");
            exit;
        }

        $id = $_GET['id'];
        $beca = Beca::obtenerPorId($id);

        if (!$beca) {
            header("Location: " . URL_BASE . "paginas/error");
            exit;
        }

        include_once "vistas/becas/detalle.php";
    }
}
?>
