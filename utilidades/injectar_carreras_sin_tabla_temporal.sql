-- ============================================================================
-- OrientaTuFuturo — catálogo de carreras sin tablas temporales
-- ============================================================================
-- Usar esta versión cuando el hosting muestre #1044 al ejecutar
-- CREATE TEMPORARY TABLE. No crea tablas, no altera el esquema y no necesita
-- privilegio CREATE: solo lee universidades e inserta en programas_academicos.
--
-- Los costos son REFERENCIALES en COP, no tarifas oficiales. Pueden variar por
-- sede, créditos, estrato, semestre y resolución de cada universidad.
-- El script es idempotente por universidad + nombre/slug de carrera.
--
-- Si también falla el SELECT sobre universidades, el usuario MySQL no tiene
-- acceso a la base seleccionada; en ese caso hay que corregir permisos/nombre
-- de base de datos en el panel del hosting.
-- ============================================================================

SET NAMES utf8mb4;

INSERT INTO programas_academicos
    (id_universidad, n_programa, area, duracion, costo, slug)
SELECT
    u.id_universidad,
    c.nombre,
    c.area,
    c.duracion,
    ROUND(
        CASE WHEN u.tipo = 0 THEN c.costo_publica ELSE c.costo_privada END
        * (1 + (MOD(u.id_universidad, 5) * 0.03)),
        -3
    ) AS costo,
    CONCAT(c.slug_base, '-', u.id_universidad) AS slug
FROM universidades AS u
CROSS JOIN (
        SELECT 'ingenieria-de-sistemas' AS slug_base, 'Ingeniería de Sistemas' AS nombre, 'Ingeniería y Tecnología' AS area, 10 AS duracion, 950000 AS costo_publica, 14500000 AS costo_privada
        UNION ALL SELECT 'ingenieria-industrial' AS slug_base, 'Ingeniería Industrial' AS nombre, 'Ingeniería y Tecnología' AS area, 10 AS duracion, 900000 AS costo_publica, 13500000 AS costo_privada
        UNION ALL SELECT 'ingenieria-civil' AS slug_base, 'Ingeniería Civil' AS nombre, 'Ingeniería y Tecnología' AS area, 10 AS duracion, 900000 AS costo_publica, 14000000 AS costo_privada
        UNION ALL SELECT 'ingenieria-electronica' AS slug_base, 'Ingeniería Electrónica' AS nombre, 'Ingeniería y Tecnología' AS area, 10 AS duracion, 950000 AS costo_publica, 15000000 AS costo_privada
        UNION ALL SELECT 'ciencia-de-datos' AS slug_base, 'Ciencia de Datos' AS nombre, 'Ingeniería y Tecnología' AS area, 8 AS duracion, 950000 AS costo_publica, 14500000 AS costo_privada
        UNION ALL SELECT 'administracion-de-empresas' AS slug_base, 'Administración de Empresas' AS nombre, 'Ciencias Sociales y Humanidade' AS area, 10 AS duracion, 850000 AS costo_publica, 12500000 AS costo_privada
        UNION ALL SELECT 'contaduria-publica' AS slug_base, 'Contaduría Pública' AS nombre, 'Ciencias Sociales y Humanidade' AS area, 10 AS duracion, 800000 AS costo_publica, 11500000 AS costo_privada
        UNION ALL SELECT 'derecho' AS slug_base, 'Derecho' AS nombre, 'Ciencias Sociales y Humanidade' AS area, 10 AS duracion, 850000 AS costo_publica, 14500000 AS costo_privada
        UNION ALL SELECT 'psicologia' AS slug_base, 'Psicología' AS nombre, 'Ciencias de la Salud' AS area, 10 AS duracion, 850000 AS costo_publica, 13500000 AS costo_privada
        UNION ALL SELECT 'comunicacion-social' AS slug_base, 'Comunicación Social' AS nombre, 'Ciencias Sociales y Humanidade' AS area, 8 AS duracion, 800000 AS costo_publica, 12500000 AS costo_privada
        UNION ALL SELECT 'arquitectura' AS slug_base, 'Arquitectura' AS nombre, 'Artes y Diseño' AS area, 10 AS duracion, 950000 AS costo_publica, 15500000 AS costo_privada
        UNION ALL SELECT 'diseno-grafico' AS slug_base, 'Diseño Gráfico' AS nombre, 'Artes y Diseño' AS area, 8 AS duracion, 850000 AS costo_publica, 12500000 AS costo_privada
        UNION ALL SELECT 'medicina' AS slug_base, 'Medicina' AS nombre, 'Ciencias de la Salud' AS area, 12 AS duracion, 1200000 AS costo_publica, 24000000 AS costo_privada
        UNION ALL SELECT 'enfermeria' AS slug_base, 'Enfermería' AS nombre, 'Ciencias de la Salud' AS area, 9 AS duracion, 850000 AS costo_publica, 10500000 AS costo_privada
        UNION ALL SELECT 'odontologia' AS slug_base, 'Odontología' AS nombre, 'Ciencias de la Salud' AS area, 10 AS duracion, 1200000 AS costo_publica, 18000000 AS costo_privada
        UNION ALL SELECT 'economia' AS slug_base, 'Economía' AS nombre, 'Ciencias Sociales y Humanidade' AS area, 9 AS duracion, 850000 AS costo_publica, 13000000 AS costo_privada
        UNION ALL SELECT 'ingenieria-mecatronica' AS slug_base, 'Ingeniería Mecatrónica' AS nombre, 'Ingeniería y Tecnología' AS area, 10 AS duracion, 1000000 AS costo_publica, 15000000 AS costo_privada
        UNION ALL SELECT 'ingenieria-ambiental' AS slug_base, 'Ingeniería Ambiental' AS nombre, 'Ingeniería y Tecnología' AS area, 10 AS duracion, 900000 AS costo_publica, 13500000 AS costo_privada
        UNION ALL SELECT 'ingenieria-de-software' AS slug_base, 'Ingeniería de Software' AS nombre, 'Ingeniería y Tecnología' AS area, 10 AS duracion, 950000 AS costo_publica, 14500000 AS costo_privada
        UNION ALL SELECT 'ingenieria-de-telecomunicaciones' AS slug_base, 'Ingeniería de Telecomunicaciones' AS nombre, 'Ingeniería y Tecnología' AS area, 10 AS duracion, 950000 AS costo_publica, 14500000 AS costo_privada
        UNION ALL SELECT 'ingenieria-de-alimentos' AS slug_base, 'Ingeniería de Alimentos' AS nombre, 'Ingeniería y Tecnología' AS area, 10 AS duracion, 900000 AS costo_publica, 13500000 AS costo_privada
        UNION ALL SELECT 'ingenieria-de-petroleos' AS slug_base, 'Ingeniería de Petróleos' AS nombre, 'Ingeniería y Tecnología' AS area, 10 AS duracion, 1000000 AS costo_publica, 15000000 AS costo_privada
        UNION ALL SELECT 'matematicas' AS slug_base, 'Matemáticas' AS nombre, 'Ingeniería y Tecnología' AS area, 8 AS duracion, 850000 AS costo_publica, 12000000 AS costo_privada
        UNION ALL SELECT 'fisica' AS slug_base, 'Física' AS nombre, 'Ingeniería y Tecnología' AS area, 8 AS duracion, 850000 AS costo_publica, 12000000 AS costo_privada
        UNION ALL SELECT 'estadistica' AS slug_base, 'Estadística' AS nombre, 'Ingeniería y Tecnología' AS area, 8 AS duracion, 850000 AS costo_publica, 12500000 AS costo_privada
        UNION ALL SELECT 'ciencia-politica' AS slug_base, 'Ciencia Política' AS nombre, 'Ciencias Sociales y Humanidade' AS area, 8 AS duracion, 850000 AS costo_publica, 13000000 AS costo_privada
        UNION ALL SELECT 'negocios-internacionales' AS slug_base, 'Negocios Internacionales' AS nombre, 'Ciencias Sociales y Humanidade' AS area, 9 AS duracion, 850000 AS costo_publica, 14000000 AS costo_privada
        UNION ALL SELECT 'relaciones-internacionales' AS slug_base, 'Relaciones Internacionales' AS nombre, 'Ciencias Sociales y Humanidade' AS area, 8 AS duracion, 850000 AS costo_publica, 14000000 AS costo_privada
        UNION ALL SELECT 'trabajo-social' AS slug_base, 'Trabajo Social' AS nombre, 'Ciencias Sociales y Humanidade' AS area, 8 AS duracion, 800000 AS costo_publica, 11000000 AS costo_privada
        UNION ALL SELECT 'sociologia' AS slug_base, 'Sociología' AS nombre, 'Ciencias Sociales y Humanidade' AS area, 8 AS duracion, 800000 AS costo_publica, 11000000 AS costo_privada
        UNION ALL SELECT 'mercadeo' AS slug_base, 'Mercadeo' AS nombre, 'Ciencias Sociales y Humanidade' AS area, 8 AS duracion, 850000 AS costo_publica, 12500000 AS costo_privada
        UNION ALL SELECT 'finanzas' AS slug_base, 'Finanzas' AS nombre, 'Ciencias Sociales y Humanidade' AS area, 8 AS duracion, 850000 AS costo_publica, 13000000 AS costo_privada
        UNION ALL SELECT 'bacteriologia' AS slug_base, 'Bacteriología' AS nombre, 'Ciencias de la Salud' AS area, 10 AS duracion, 1000000 AS costo_publica, 15000000 AS costo_privada
        UNION ALL SELECT 'fisioterapia' AS slug_base, 'Fisioterapia' AS nombre, 'Ciencias de la Salud' AS area, 9 AS duracion, 900000 AS costo_publica, 13000000 AS costo_privada
        UNION ALL SELECT 'nutricion-y-dietetica' AS slug_base, 'Nutrición y Dietética' AS nombre, 'Ciencias de la Salud' AS area, 9 AS duracion, 900000 AS costo_publica, 13500000 AS costo_privada
        UNION ALL SELECT 'terapia-ocupacional' AS slug_base, 'Terapia Ocupacional' AS nombre, 'Ciencias de la Salud' AS area, 9 AS duracion, 900000 AS costo_publica, 13000000 AS costo_privada
        UNION ALL SELECT 'instrumentacion-quirurgica' AS slug_base, 'Instrumentación Quirúrgica' AS nombre, 'Ciencias de la Salud' AS area, 8 AS duracion, 900000 AS costo_publica, 13500000 AS costo_privada
        UNION ALL SELECT 'fonoaudiologia' AS slug_base, 'Fonoaudiología' AS nombre, 'Ciencias de la Salud' AS area, 9 AS duracion, 900000 AS costo_publica, 13000000 AS costo_privada
        UNION ALL SELECT 'salud-publica' AS slug_base, 'Salud Pública' AS nombre, 'Ciencias de la Salud' AS area, 8 AS duracion, 850000 AS costo_publica, 12000000 AS costo_privada
        UNION ALL SELECT 'diseno-industrial' AS slug_base, 'Diseño Industrial' AS nombre, 'Artes y Diseño' AS area, 10 AS duracion, 900000 AS costo_publica, 14000000 AS costo_privada
        UNION ALL SELECT 'artes-visuales' AS slug_base, 'Artes Visuales' AS nombre, 'Artes y Diseño' AS area, 8 AS duracion, 850000 AS costo_publica, 12500000 AS costo_privada
        UNION ALL SELECT 'musica' AS slug_base, 'Música' AS nombre, 'Artes y Diseño' AS area, 10 AS duracion, 850000 AS costo_publica, 13000000 AS costo_privada
        UNION ALL SELECT 'cine-y-television' AS slug_base, 'Cine y Televisión' AS nombre, 'Artes y Diseño' AS area, 10 AS duracion, 900000 AS costo_publica, 15000000 AS costo_privada
        UNION ALL SELECT 'diseno-de-modas' AS slug_base, 'Diseño de Modas' AS nombre, 'Artes y Diseño' AS area, 8 AS duracion, 850000 AS costo_publica, 13000000 AS costo_privada
        UNION ALL SELECT 'urbanismo' AS slug_base, 'Urbanismo' AS nombre, 'Artes y Diseño' AS area, 8 AS duracion, 900000 AS costo_publica, 14000000 AS costo_privada
) AS c
WHERE NOT EXISTS (
    SELECT 1
    FROM programas_academicos AS p
    WHERE p.id_universidad = u.id_universidad
      AND (
          TRIM(p.n_programa) = TRIM(c.nombre)
          OR p.slug = CONCAT(c.slug_base, '-', u.id_universidad)
      )
);

-- Verificación: carreras y universidades cubiertas.
SELECT
    (SELECT COUNT(*) FROM universidades) AS universidades_encontradas,
    (SELECT COUNT(*) FROM programas_academicos) AS programas_totales,
    (SELECT COUNT(*) FROM universidades AS u
      WHERE NOT EXISTS (SELECT 1 FROM programas_academicos AS p
                        WHERE p.id_universidad = u.id_universidad)) AS universidades_sin_programas;
