<?php
// Construye la ruta del archivo correspondiente al controlador solicitado
// Por ejemplo, si $getcontrolador es "paginas", buscará "controladores/controlador_paginas.php"
$archivoControlador = "controladores/controlador_" . $getcontrolador . ".php";

// Verifica si el archivo del controlador físico existe en el disco
if (file_exists($archivoControlador)) {
    // Importa el archivo del controlador para que su clase esté disponible
    include_once $archivoControlador;
    
    // Construye el nombre de la clase del controlador siguiendo la convención de nombres (ej: ControladorPaginas)
    // ucfirst() convierte la primera letra en mayúscula
    $controladorClase = "Controlador" . ucfirst($getcontrolador);
    
    // Verifica si la clase del controlador ha sido declarada correctamente
    if (class_exists($controladorClase)) {
        // Crea una nueva instancia del controlador dinámicamente
        $objcontrolador = new $controladorClase();
        
        // Verifica si el método (acción) solicitado existe dentro del controlador
        if (method_exists($objcontrolador, $getaccion)) {
            // Ejecuta la acción (método) solicitada en el controlador
            $objcontrolador->$getaccion();
        } else {
            // Si la acción no existe en el controlador, carga el controlador por defecto y muestra la página de error
            include_once "controladores/controlador_paginas.php";
            $objcontrolador = new ControladorPaginas();
            $objcontrolador->error();
        }
    } else {
        // Si la clase no fue declarada en el archivo, carga el controlador por defecto y muestra la página de error
        include_once "controladores/controlador_paginas.php";
        $objcontrolador = new ControladorPaginas();
        $objcontrolador->error();
    }
} else {
    // Si el archivo del controlador no existe físicamente, carga el controlador por defecto y muestra la página de error
    include_once "controladores/controlador_paginas.php";
    $objcontrolador = new ControladorPaginas();
    $objcontrolador->error();
}
?>
