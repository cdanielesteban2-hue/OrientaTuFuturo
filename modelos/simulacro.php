<?php
include_once "conexion.php";
class Simulacro {
    public static function obtenerTodos() {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT * FROM simulacros ORDER BY id_simulacro ASC";
        $consulta = $db->query($sql);
        return $consulta->fetchAll();
    }

    public static function obtenerPorId($id) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT * FROM simulacros WHERE id_simulacro = ?";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id]);
        return $consulta->fetch();
    }

    public static function obtenerPreguntas($id_simulacro) {
        $db = baseDatos::crearInstancia();
        // ORDER BY RAND() para que cada intento sea diferente e interactivo
        $sql = "SELECT * FROM simulacro_preguntas WHERE id_simulacro = ? ORDER BY RAND()";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id_simulacro]);
        return $consulta->fetchAll();
    }

    public static function obtenerPreguntasAleatorias($limite = 25) {
        $db = baseDatos::crearInstancia();
        $limite = max(1, min(247, (int) $limite));
        $sql = "SELECT p.*, s.materia, s.titulo AS simulacro_titulo
                FROM simulacro_preguntas p
                JOIN simulacros s ON p.id_simulacro = s.id_simulacro
                WHERE s.materia IN ('Inglés', 'Ciencias Naturales', 'Lectura Crítica', 'Matemáticas', 'Sociales')
                ORDER BY RAND()
                LIMIT " . $limite;
        return $db->query($sql)->fetchAll();
    }

    public static function obtenerPreguntasPorIds(array $ids) {
        $ids = array_values(array_filter(array_map('intval', $ids), static function ($id) {
            return $id > 0;
        }));
        if (empty($ids)) return [];
        $db = baseDatos::crearInstancia();
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $consulta = $db->prepare("SELECT p.*, s.materia, s.titulo AS simulacro_titulo
                                  FROM simulacro_preguntas p
                                  JOIN simulacros s ON p.id_simulacro = s.id_simulacro
                                  WHERE p.id_pregunta IN ($placeholders)");
        $consulta->execute($ids);
        $preguntas = $consulta->fetchAll();
        $orden = array_flip($ids);
        usort($preguntas, static function ($a, $b) use ($orden) {
            return ($orden[$a['id_pregunta']] ?? 0) <=> ($orden[$b['id_pregunta']] ?? 0);
        });
        return $preguntas;
    }

    public static function obtenerPreguntasPorMateria($materia, $limite = 25) {
        $db = baseDatos::crearInstancia();
        $limite = max(1, min(25, (int) $limite));
        $sql = "SELECT p.*, s.materia, s.titulo AS simulacro_titulo
                FROM simulacro_preguntas p
                JOIN simulacros s ON p.id_simulacro = s.id_simulacro
                WHERE s.materia = ?
                ORDER BY RAND()
                LIMIT " . $limite;
        $consulta = $db->prepare($sql);
        $consulta->execute([$materia]);
        return $consulta->fetchAll();
    }

    public static function obtenerMateriasPreIcfes() {
        return ['Inglés', 'Ciencias Naturales', 'Lectura Crítica', 'Matemáticas', 'Sociales'];
    }

    public static function obtenerSimulacroPorMateria($materia) {
        $db = baseDatos::crearInstancia();
        $consulta = $db->prepare("SELECT * FROM simulacros WHERE materia = ? ORDER BY id_simulacro ASC LIMIT 1");
        $consulta->execute([$materia]);
        return $consulta->fetch();
    }

    public static function obtenerModalidadesAleatorias() {
        return [
            'corto' => [
                'titulo' => 'Pre-ICFES aleatorio — Simulacro corto',
                'descripcion' => '60 preguntas mixtas de todas las materias. Tiempo límite: 2 horas.',
                'preguntas' => 60,
                'segundos' => 2 * 60 * 60,
                'duracion' => '2 horas'
            ],
            'intermedio' => [
                'titulo' => 'Pre-ICFES aleatorio — Simulacro intermedio',
                'descripcion' => '120 preguntas mixtas de todas las materias. Tiempo límite: 4 horas.',
                'preguntas' => 120,
                'segundos' => 4 * 60 * 60,
                'duracion' => '4 horas'
            ],
            'normal' => [
                'titulo' => 'Pre-ICFES aleatorio — Simulacro normal',
                'descripcion' => '247 preguntas en una sola prueba: primero 123 y luego 124. Cada sección tiene 4 horas, igual que el tiempo y número de preguntas del ICFES real.',
                'preguntas' => 247,
                'segundos' => 4 * 60 * 60,
                'duracion' => '4 horas por sección'
            ],
        ];
    }

    public static function obtenerSimulacroAleatorio($modalidad = 'corto') {
        $modalidades = self::obtenerModalidadesAleatorias();
        $config = $modalidades[$modalidad] ?? $modalidades['corto'];
        $db = baseDatos::crearInstancia();
        $consulta = $db->prepare("SELECT * FROM simulacros WHERE titulo = ? LIMIT 1");
        $consulta->execute([$config['titulo']]);
        $simulacro = $consulta->fetch();
        if ($simulacro) return $simulacro;

        $insertar = $db->prepare("INSERT INTO simulacros (titulo, descripcion, materia, color, icono) VALUES (?, ?, ?, ?, ?)");
        $insertar->execute([
            $config['titulo'],
            $config['descripcion'],
            'Mixto',
            '#2563eb',
            'fa-solid fa-shuffle'
        ]);
        return self::obtenerPorId($db->lastInsertId());
    }

    public static function guardarIntento($id_usuario, $id_simulacro, $puntaje) {
        $db = baseDatos::crearInstancia();
        $sql = "INSERT INTO simulacro_intentos (id_usuario, id_simulacro, puntaje) VALUES (?, ?, ?)";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id_usuario, $id_simulacro, $puntaje]);
        return $db->lastInsertId();
    }

    public static function guardarRespuesta($id_intento, $id_pregunta, $respuesta_usuario, $es_correcta) {
        $db = baseDatos::crearInstancia();
        $sql = "INSERT INTO simulacro_respuestas (id_intento, id_pregunta, respuesta_usuario, es_correcta) VALUES (?, ?, ?, ?)";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id_intento, $id_pregunta, $respuesta_usuario, $es_correcta]);
    }

    public static function obtenerIntento($id_intento) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT i.*, s.titulo, s.materia 
                FROM simulacro_intentos i
                JOIN simulacros s ON i.id_simulacro = s.id_simulacro
                WHERE i.id_intento = ?";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id_intento]);
        return $consulta->fetch();
    }

    public static function obtenerRespuestasIntento($id_intento) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT r.*, p.pregunta, p.opcion_a, p.opcion_b, p.opcion_c, p.opcion_d, p.correcta, p.justificacion
                FROM simulacro_respuestas r
                JOIN simulacro_preguntas p ON r.id_pregunta = p.id_pregunta
                WHERE r.id_intento = ? ORDER BY p.id_pregunta ASC";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id_intento]);
        return $consulta->fetchAll();
    }

    public static function obtenerIntentosUsuario($id_usuario) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT i.*, s.titulo, s.materia, s.color, s.icono 
                FROM simulacro_intentos i
                JOIN simulacros s ON i.id_simulacro = s.id_simulacro
                WHERE i.id_usuario = ? ORDER BY i.fecha DESC";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id_usuario]);
        return $consulta->fetchAll();
    }

    public static function crear($titulo, $materia, $color, $icono, $descripcion) {
        $db = baseDatos::crearInstancia();
        $sql = "INSERT INTO simulacros (titulo, materia, color, icono, descripcion) VALUES (?, ?, ?, ?, ?)";
        $consulta = $db->prepare($sql);
        $consulta->execute([$titulo, $materia, $color, $icono, $descripcion]);
        return $db->lastInsertId();
    }

    public static function actualizar($id, $titulo, $materia, $color, $icono, $descripcion) {
        $db = baseDatos::crearInstancia();
        $sql = "UPDATE simulacros SET titulo = ?, materia = ?, color = ?, icono = ?, descripcion = ? WHERE id_simulacro = ?";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$titulo, $materia, $color, $icono, $descripcion, $id]);
    }

    public static function eliminar($id) {
        $db = baseDatos::crearInstancia();
        $db->prepare("DELETE r FROM simulacro_respuestas r JOIN simulacro_intentos i ON r.id_intento = i.id_intento WHERE i.id_simulacro = ?")->execute([$id]);
        $db->prepare("DELETE FROM simulacro_intentos WHERE id_simulacro = ?")->execute([$id]);
        $db->prepare("DELETE FROM simulacro_preguntas WHERE id_simulacro = ?")->execute([$id]);
        $consulta = $db->prepare("DELETE FROM simulacros WHERE id_simulacro = ?");
        return $consulta->execute([$id]);
    }

    public static function crearPregunta($id_simulacro, $pregunta, $opcion_a, $opcion_b, $opcion_c, $opcion_d, $correcta, $justificacion = '') {
        $db = baseDatos::crearInstancia();
        $sql = "INSERT INTO simulacro_preguntas (id_simulacro, pregunta, opcion_a, opcion_b, opcion_c, opcion_d, correcta, justificacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$id_simulacro, $pregunta, $opcion_a, $opcion_b, $opcion_c, $opcion_d, $correcta, $justificacion]);
    }

    public static function actualizarPregunta($id_pregunta, $pregunta, $opcion_a, $opcion_b, $opcion_c, $opcion_d, $correcta, $justificacion = '') {
        $db = baseDatos::crearInstancia();
        $sql = "UPDATE simulacro_preguntas SET pregunta = ?, opcion_a = ?, opcion_b = ?, opcion_c = ?, opcion_d = ?, correcta = ?, justificacion = ? WHERE id_pregunta = ?";
        $consulta = $db->prepare($sql);
        return $consulta->execute([$pregunta, $opcion_a, $opcion_b, $opcion_c, $opcion_d, $correcta, $justificacion, $id_pregunta]);
    }

    public static function eliminarPregunta($id_pregunta) {
        $db = baseDatos::crearInstancia();
        $db->prepare("DELETE FROM simulacro_respuestas WHERE id_pregunta = ?")->execute([$id_pregunta]);
        $consulta = $db->prepare("DELETE FROM simulacro_preguntas WHERE id_pregunta = ?");
        return $consulta->execute([$id_pregunta]);
    }

    public static function obtenerPreguntaPorId($id_pregunta) {
        $db = baseDatos::crearInstancia();
        $sql = "SELECT * FROM simulacro_preguntas WHERE id_pregunta = ?";
        $consulta = $db->prepare($sql);
        $consulta->execute([$id_pregunta]);
        return $consulta->fetch();
    }
}
?>
