<?php
class ControladorPaginas {
    public function inicio() {
        include_once "vistas/paginas/inicio.php";
    }

    public function nosotros() {
        include_once "vistas/paginas/nosotros.php";
    }

    public function error() {
        include_once "vistas/paginas/error.php";
    }

    public function terminos() {
        include_once "vistas/paginas/terminos.php";
    }
}
?>
