<?php
// Inicia o reanuda la sesión de PHP para permitir el almacenamiento de datos persistentes del usuario
session_start();

// Inicia el búfer de salida (output buffering) para retener la salida en memoria antes de enviarla al navegador
// Esto permite realizar redirecciones seguras mediante header() sin recibir errores de "headers already sent"
ob_start();

// Obtiene la ruta del directorio del script actual de forma dinámica y reemplaza las barras invertidas '\\' por '/'
$script_dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

// Se asegura de que la ruta del directorio siempre termine con una barra inclinada '/'
if (substr($script_dir, -1) !== '/') {
    $script_dir .= '/';
}

// Determina si el protocolo de conexión es seguro (https) o estándar (http) evaluando la variable del servidor
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';

// Construye la URL base absoluta del proyecto uniendo el protocolo, el host y el directorio del script
$url_base = $protocol . '://' . $_SERVER['HTTP_HOST'] . $script_dir;

// Define la constante global 'URL_BASE' para que pueda utilizarse al enlazar hojas de estilo, scripts e imágenes de forma absoluta
define('URL_BASE', $url_base);

// Importa una única vez el archivo que contiene la clase encargada de sembrar los datos iniciales
include_once "modelos/seeder.php";
try {
    // Intenta ejecutar el sembrador de base de datos para poblar las tablas con registros de prueba si están vacías
    Seeder::ejecutar();
} catch (Exception $e) {
    // Si ocurre un error (por ejemplo, base de datos no configurada aún), se captura para evitar bloquear la carga del sitio
}

// Define los valores predeterminados para el enrutador MVC si no se especifican en la URL
$getcontrolador = "paginas";
$getaccion = "inicio";

// Verifica si existe la variable 'url' en la petición GET (generalmente redirigida y amigable mediante .htaccess)
if (isset($_GET['url'])) {
    // Elimina las barras diagonales '/' al final de la URL para normalizarla
    $url = rtrim($_GET['url'], '/');
    
    // Limpia y sanea la URL eliminando caracteres especiales no permitidos
    $url = filter_var($url, FILTER_SANITIZE_URL);
    
    // Divide la URL en fragmentos usando la barra '/' como delimitador (ej: controlador/accion/id)
    $url = explode('/', $url);

    // Si el primer segmento de la URL existe y no está vacío, lo define como el controlador a ejecutar
    if (isset($url[0]) && $url[0] !== '') {
        $getcontrolador = $url[0];
    }
    
    // Si el segundo segmento existe y no está vacío, lo define como la acción (método del controlador) a ejecutar
    if (isset($url[1]) && $url[1] !== '') {
        $getaccion = $url[1];
    }
    
    // Si existe un tercer segmento, lo asigna al parámetro $_GET['id'] para usarlo como parámetro en la consulta
    if (isset($url[2])) {
        $_GET['id'] = $url[2];
    }
}

// Carga la plantilla base o Layout Maestro, la cual incluirá el header, footer y la vista correspondiente
include_once("vistas/plantilla.php");
?>
