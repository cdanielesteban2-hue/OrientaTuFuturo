<?php
/**
 * Clase baseDatos
 * Implementa el patrón de diseño Singleton para gestionar la conexión a la base de datos MySQL mediante PDO.
 * Garantiza que exista una única conexión activa en toda la ejecución de la aplicación.
 */
class baseDatos {
    // Almacena la única instancia de la conexión PDO
    private static $instancia = NULL;

    /**
     * Crea y retorna la instancia única de conexión PDO.
     * Si ya existe una instancia creada, la retorna directamente.
     * 
     * @return PDO Instancia de la conexión a la base de datos.
     */
    public static function crearInstancia() {
        // Verifica si la instancia no ha sido creada previamente
        if (!isset(self::$instancia)) {
            // Habilita el reporte de errores lanzando excepciones de tipo PDOException
            $opcionesPDO[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            
            // Configura el modo de obtención de datos por defecto a un array asociativo
            $opcionesPDO[PDO::ATTR_DEFAULT_FETCH_MODE] = PDO::FETCH_ASSOC;
            
            try {
                // Detecta si se ejecuta en entorno local o en el servidor de producción
                $servidor = $_SERVER['SERVER_NAME'] ?? 'localhost';
                if ($servidor === 'localhost' || $servidor === '127.0.0.1') {
                    $host = 'localhost';
                    $db   = 'orienta_tu_futuro';
                    $user = 'root';
                    $pass = '';
                } else {
                    $host = 'sql309.infinityfree.com';
                    $db   = 'if0_42975485_OrientaTuFuturo';
                    $user = 'if0_42975485';
                    $pass = 'nAPKj4IpkB3h';
                }

                self::$instancia = new PDO("mysql:host={$host};dbname={$db};charset=utf8mb4", $user, $pass, $opcionesPDO);
            } catch (Exception $error) {
                // Si la conexión falla, detiene la ejecución de la aplicación mostrando el mensaje de error
                die("Error de conexión a la base de datos: " . $error->getMessage());
            }
        }
        // Retorna la instancia de conexión única (nueva o ya existente)
        return self::$instancia;
    }
}
?>
