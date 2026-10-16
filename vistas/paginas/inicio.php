<?php
// Temporal: redirige mientras se restaura el archivo completo
// Si ves esta pantalla, avisa para subir inicio.php completo
header('Location: ' . (defined('URL_BASE') ? URL_BASE : '/') . 'universidades/inicio');
exit;
?>
