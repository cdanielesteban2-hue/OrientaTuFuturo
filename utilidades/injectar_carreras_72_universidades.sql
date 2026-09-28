-- ============================================================================
-- OrientaTuFuturo — Catálogo base de carreras y costos de matrícula
-- ============================================================================
-- Objetivo:
--   Insertar carreras de referencia para todas las universidades registradas.
--   El script es idempotente: puede ejecutarse más de una vez sin duplicar la
--   combinación (universidad, carrera).
--
-- Importante:
--   Los costos incluidos son valores de referencia para poblar el catálogo y
--   distinguir universidades públicas y privadas. No sustituyen la tarifa
--   oficial de cada periodo académico. Para precios oficiales se debe ejecutar
--   el scraper o actualizar el catálogo con la fuente institucional vigente.
--
-- La base de datos del proyecto usa costo como matrícula semestral en COP.
-- Para exigir exactamente 72 universidades antes de insertar, cambia:
--   SET @exigir_72_universidades = 0;
-- por:
--   SET @exigir_72_universidades = 1;
-- ============================================================================

SET NAMES utf8mb4;
SET @exigir_72_universidades = 0;
SET @total_universidades = (SELECT COUNT(*) FROM universidades);

START TRANSACTION;

DROP TEMPORARY TABLE IF EXISTS tmp_catalogo_carreras;

CREATE TEMPORARY TABLE tmp_catalogo_carreras (
    slug_base       VARCHAR(80)  NOT NULL PRIMARY KEY,
    nombre          VARCHAR(100) NOT NULL,
    area            VARCHAR(30)  NOT NULL,
    duracion        TINYINT      NOT NULL,
    costo_publica   DECIMAL(10,0) NOT NULL,
    costo_privada   DECIMAL(10,0) NOT NULL
) ENGINE = MEMORY DEFAULT CHARSET = utf8mb4;

INSERT INTO tmp_catalogo_carreras
    (slug_base, nombre, area, duracion, costo_publica, costo_privada)
VALUES
    ('ingenieria-de-sistemas',
     'Ingeniería de Sistemas',
     'Ingeniería y Tecnología', 10, 950000, 14500000),
    ('ingenieria-industrial',
     'Ingeniería Industrial',
     'Ingeniería y Tecnología', 10, 900000, 13500000),
    ('ingenieria-civil',
     'Ingeniería Civil',
     'Ingeniería y Tecnología', 10, 900000, 14000000),
    ('ingenieria-electronica',
     'Ingeniería Electrónica',
     'Ingeniería y Tecnología', 10, 950000, 15000000),
    ('ciencia-de-datos',
     'Ciencia de Datos',
     'Ingeniería y Tecnología', 8, 950000, 14500000),
    ('administracion-de-empresas',
     'Administración de Empresas',
     'Ciencias Sociales y Humanidade', 10, 850000, 12500000),
    ('contaduria-publica',
     'Contaduría Pública',
     'Ciencias Sociales y Humanidade', 10, 800000, 11500000),
    ('derecho',
     'Derecho',
     'Ciencias Sociales y Humanidade', 10, 850000, 14500000),
    ('psicologia',
     'Psicología',
     'Ciencias de la Salud', 10, 850000, 13500000),
    ('comunicacion-social',
     'Comunicación Social',
     'Ciencias Sociales y Humanidade', 8, 800000, 12500000),
    ('arquitectura',
     'Arquitectura',
     'Artes y Diseño', 10, 950000, 15500000),
    ('diseno-grafico',
     'Diseño Gráfico',
     'Artes y Diseño', 8, 850000, 12500000),
    ('medicina',
     'Medicina',
     'Ciencias de la Salud', 12, 1200000, 24000000),
    ('enfermeria',
     'Enfermería',
     'Ciencias de la Salud', 9, 850000, 10500000),
    ('odontologia',
     'Odontología',
     'Ciencias de la Salud', 10, 1200000, 18000000),
    ('economia',
     'Economía',
     'Ciencias Sociales y Humanidade', 9, 850000, 13000000),
    ('ingenieria-mecatronica',
     'Ingeniería Mecatrónica',
     'Ingeniería y Tecnología', 10, 1000000, 15000000),
    ('ingenieria-ambiental',
     'Ingeniería Ambiental',
     'Ingeniería y Tecnología', 10, 900000, 13500000),
    ('ingenieria-de-software',
     'Ingeniería de Software',
     'Ingeniería y Tecnología', 10, 950000, 14500000),
    ('ingenieria-de-telecomunicaciones',
     'Ingeniería de Telecomunicaciones',
     'Ingeniería y Tecnología', 10, 950000, 14500000),
    ('ingenieria-de-alimentos',
     'Ingeniería de Alimentos',
     'Ingeniería y Tecnología', 10, 900000, 13500000),
    ('ingenieria-de-petroleos',
     'Ingeniería de Petróleos',
     'Ingeniería y Tecnología', 10, 1000000, 15000000),
    ('matematicas',
     'Matemáticas',
     'Ingeniería y Tecnología', 8, 850000, 12000000),
    ('fisica',
     'Física',
     'Ingeniería y Tecnología', 8, 850000, 12000000),
    ('estadistica',
     'Estadística',
     'Ingeniería y Tecnología', 8, 850000, 12500000),
    ('ciencia-politica',
     'Ciencia Política',
     'Ciencias Sociales y Humanidade', 8, 850000, 13000000),
    ('negocios-internacionales',
     'Negocios Internacionales',
     'Ciencias Sociales y Humanidade', 9, 850000, 14000000),
    ('relaciones-internacionales',
     'Relaciones Internacionales',
     'Ciencias Sociales y Humanidade', 8, 850000, 14000000),
    ('trabajo-social',
     'Trabajo Social',
     'Ciencias Sociales y Humanidade', 8, 800000, 11000000),
    ('sociologia',
     'Sociología',
     'Ciencias Sociales y Humanidade', 8, 800000, 11000000),
    ('mercadeo',
     'Mercadeo',
     'Ciencias Sociales y Humanidade', 8, 850000, 12500000),
    ('finanzas',
     'Finanzas',
     'Ciencias Sociales y Humanidade', 8, 850000, 13000000),
    ('bacteriologia',
     'Bacteriología',
     'Ciencias de la Salud', 10, 1000000, 15000000),
    ('fisioterapia',
     'Fisioterapia',
     'Ciencias de la Salud', 9, 900000, 13000000),
    ('nutricion-y-dietetica',
     'Nutrición y Dietética',
     'Ciencias de la Salud', 9, 900000, 13500000),
    ('terapia-ocupacional',
     'Terapia Ocupacional',
     'Ciencias de la Salud', 9, 900000, 13000000),
    ('instrumentacion-quirurgica',
     'Instrumentación Quirúrgica',
     'Ciencias de la Salud', 8, 900000, 13500000),
    ('fonoaudiologia',
     'Fonoaudiología',
     'Ciencias de la Salud', 9, 900000, 13000000),
    ('salud-publica',
     'Salud Pública',
     'Ciencias de la Salud', 8, 850000, 12000000),
    ('diseno-industrial',
     'Diseño Industrial',
     'Artes y Diseño', 10, 900000, 14000000),
    ('artes-visuales',
     'Artes Visuales',
     'Artes y Diseño', 8, 850000, 12500000),
    ('musica',
     'Música',
     'Artes y Diseño', 10, 850000, 13000000),
    ('cine-y-television',
     'Cine y Televisión',
     'Artes y Diseño', 10, 900000, 15000000),
    ('diseno-de-modas',
     'Diseño de Modas',
     'Artes y Diseño', 8, 850000, 13000000),
    ('urbanismo',
     'Urbanismo',
     'Artes y Diseño', 8, 900000, 14000000)
;

--
-- El factor por ID evita que todos los registros tengan exactamente el mismo
-- precio, sin perder el carácter reproducible del catálogo de referencia.
-- Los costos se redondean al millar más cercano.
--
INSERT INTO programas_academicos
    (id_universidad, n_programa, area, duracion, costo, slug)
SELECT
    u.id_universidad,
    c.nombre,
    c.area,
    c.duracion,
    ROUND(
        (CASE
            WHEN u.tipo = 0 THEN c.costo_publica
            ELSE c.costo_privada
         END)
        * (1 + (MOD(u.id_universidad, 5) * 0.03)),
        -3
    ) AS costo,
    CONCAT(c.slug_base, '-', u.id_universidad) AS slug
FROM universidades AS u
CROSS JOIN tmp_catalogo_carreras AS c
WHERE (@exigir_72_universidades = 0 OR @total_universidades = 72)
  AND NOT EXISTS (
      SELECT 1
      FROM programas_academicos AS p
      WHERE p.id_universidad = u.id_universidad
        AND (
            TRIM(p.n_programa) = TRIM(c.nombre)
            OR p.slug = CONCAT(c.slug_base, '-', u.id_universidad)
        )
  );

-- Verificación posterior a la inserción.
SELECT
    @total_universidades AS universidades_encontradas,
    (SELECT COUNT(*) FROM tmp_catalogo_carreras) AS carreras_del_catalogo,
    (SELECT COUNT(*)
       FROM programas_academicos AS p
       JOIN universidades AS u ON u.id_universidad = p.id_universidad
      WHERE p.slug LIKE '%-%') AS programas_totales,
    (SELECT COUNT(*)
       FROM universidades AS u
      WHERE NOT EXISTS (
          SELECT 1
          FROM programas_academicos AS p
          WHERE p.id_universidad = u.id_universidad
      )) AS universidades_sin_programas,
    CASE
        WHEN @total_universidades = 72 THEN 'OK: se procesaron las 72 universidades registradas.'
        ELSE CONCAT(
            'AVISO: se encontraron ', @total_universidades,
            ' universidades; revisa el catálogo si esperabas 72.'
        )
    END AS estado;

DROP TEMPORARY TABLE IF EXISTS tmp_catalogo_carreras;
COMMIT;

-- Consulta útil para auditar la cobertura por universidad:
-- SELECT u.id_universidad, u.nombre, COUNT(p.id_programa) AS carreras
-- FROM universidades u
-- LEFT JOIN programas_academicos p ON p.id_universidad = u.id_universidad
-- GROUP BY u.id_universidad, u.nombre
-- ORDER BY u.id_universidad;
