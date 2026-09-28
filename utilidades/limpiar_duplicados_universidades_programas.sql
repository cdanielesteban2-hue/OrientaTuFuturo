-- ============================================================================
-- OrientaTuFuturo — auditoría y limpieza de duplicados
-- ============================================================================
-- IMPORTANTE:
--   1) Haz un respaldo de la base antes de limpiar.
--   2) El script empieza con @confirmar_limpieza = 0, por lo que SOLO AUDITA.
--   3) Revisa los resultados. Cambia a 1 y vuelve a ejecutar para limpiar.
--   4) No usa CREATE TEMPORARY TABLE, porque algunos hostings lo bloquean.
--
-- Criterio de universidad repetida:
--   mismo nombre y misma ciudad, ignorando mayúsculas y espacios exteriores.
--   Se conserva el registro con el id_universidad más bajo.
--
-- Criterio de carrera repetida:
--   mismo id_universidad y mismo nombre, ignorando mayúsculas y espacios.
--   Se conserva el registro con el id_programa más bajo.
--
-- Los programas y favoritos se conservan cuando es posible: si una universidad
-- duplicada tiene una carrera que no existe en la principal, se mueve a la
-- principal; si ya existe, se elimina solo el duplicado y se conservan sus
-- favoritos apuntando al registro que permanece.
-- ============================================================================

SET NAMES utf8mb4;
SET @confirmar_limpieza = 0;
START TRANSACTION;

-- --------------------------------------------------------------------------
-- 1. AUDITORÍA: universidades repetidas
-- --------------------------------------------------------------------------
SELECT
    MIN(u.id_universidad) AS id_que_se_conserva,
    GROUP_CONCAT(u.id_universidad ORDER BY u.id_universidad) AS ids_repetidos,
    u.nombre,
    u.ciudad,
    COUNT(*) AS cantidad
FROM universidades AS u
GROUP BY LOWER(TRIM(u.nombre)), LOWER(TRIM(COALESCE(u.ciudad, '')))
HAVING COUNT(*) > 1
ORDER BY u.nombre, u.ciudad;

-- --------------------------------------------------------------------------
-- 2. AUDITORÍA: carreras repetidas dentro de una misma universidad
-- --------------------------------------------------------------------------
SELECT
    u.id_universidad,
    u.nombre AS universidad,
    p.n_programa,
    COUNT(*) AS cantidad,
    GROUP_CONCAT(p.id_programa ORDER BY p.id_programa) AS ids_repetidos
FROM programas_academicos AS p
JOIN universidades AS u ON u.id_universidad = p.id_universidad
GROUP BY p.id_universidad, LOWER(TRIM(p.n_programa))
HAVING COUNT(*) > 1
ORDER BY u.nombre, p.n_programa;

-- --------------------------------------------------------------------------
-- 3. LIMPIEZA: carreras repetidas dentro de la misma universidad
-- --------------------------------------------------------------------------
-- Primero se eliminan los favoritos que apuntan a una carrera que se va a quitar.
DELETE up
FROM usuario_programa AS up
JOIN programas_academicos AS p
  ON p.id_programa = up.id_programa
JOIN programas_academicos AS p_conservado
  ON p_conservado.id_universidad = p.id_universidad
 AND LOWER(TRIM(p_conservado.n_programa)) = LOWER(TRIM(p.n_programa))
 AND p_conservado.id_programa < p.id_programa
WHERE @confirmar_limpieza = 1;

DELETE p
FROM programas_academicos AS p
JOIN programas_academicos AS p_conservado
  ON p_conservado.id_universidad = p.id_universidad
 AND LOWER(TRIM(p_conservado.n_programa)) = LOWER(TRIM(p.n_programa))
 AND p_conservado.id_programa < p.id_programa
WHERE @confirmar_limpieza = 1;

-- --------------------------------------------------------------------------
-- 4. LIMPIEZA: preparar universidades repetidas
-- --------------------------------------------------------------------------
-- Si la universidad duplicada tiene una carrera que ya existe en la principal,
-- elimina solo esa copia y sus favoritos. La carrera principal se conserva.
DELETE up
FROM usuario_programa AS up
JOIN programas_academicos AS p_duplicado
  ON p_duplicado.id_programa = up.id_programa
JOIN universidades AS u_duplicada
  ON u_duplicada.id_universidad = p_duplicado.id_universidad
JOIN universidades AS u_principal
  ON LOWER(TRIM(u_principal.nombre)) = LOWER(TRIM(u_duplicada.nombre))
 AND LOWER(TRIM(COALESCE(u_principal.ciudad, ''))) = LOWER(TRIM(COALESCE(u_duplicada.ciudad, '')))
 AND u_principal.id_universidad < u_duplicada.id_universidad
JOIN programas_academicos AS p_principal
  ON p_principal.id_universidad = u_principal.id_universidad
 AND LOWER(TRIM(p_principal.n_programa)) = LOWER(TRIM(p_duplicado.n_programa))
WHERE @confirmar_limpieza = 1
  AND NOT EXISTS (
      SELECT 1
      FROM universidades AS u_menor
      WHERE LOWER(TRIM(u_menor.nombre)) = LOWER(TRIM(u_duplicada.nombre))
        AND LOWER(TRIM(COALESCE(u_menor.ciudad, ''))) = LOWER(TRIM(COALESCE(u_duplicada.ciudad, '')))
        AND u_menor.id_universidad < u_principal.id_universidad
  );

DELETE p_duplicado
FROM programas_academicos AS p_duplicado
JOIN universidades AS u_duplicada
  ON u_duplicada.id_universidad = p_duplicado.id_universidad
JOIN universidades AS u_principal
  ON LOWER(TRIM(u_principal.nombre)) = LOWER(TRIM(u_duplicada.nombre))
 AND LOWER(TRIM(COALESCE(u_principal.ciudad, ''))) = LOWER(TRIM(COALESCE(u_duplicada.ciudad, '')))
 AND u_principal.id_universidad < u_duplicada.id_universidad
JOIN programas_academicos AS p_principal
  ON p_principal.id_universidad = u_principal.id_universidad
 AND LOWER(TRIM(p_principal.n_programa)) = LOWER(TRIM(p_duplicado.n_programa))
WHERE @confirmar_limpieza = 1
  AND NOT EXISTS (
      SELECT 1
      FROM universidades AS u_menor
      WHERE LOWER(TRIM(u_menor.nombre)) = LOWER(TRIM(u_duplicada.nombre))
        AND LOWER(TRIM(COALESCE(u_menor.ciudad, ''))) = LOWER(TRIM(COALESCE(u_duplicada.ciudad, '')))
        AND u_menor.id_universidad < u_principal.id_universidad
  );

-- Mover a la universidad principal las carreras que solo estaban en la copia.
UPDATE programas_academicos AS p
JOIN universidades AS u_duplicada
  ON u_duplicada.id_universidad = p.id_universidad
JOIN universidades AS u_principal
  ON LOWER(TRIM(u_principal.nombre)) = LOWER(TRIM(u_duplicada.nombre))
 AND LOWER(TRIM(COALESCE(u_principal.ciudad, ''))) = LOWER(TRIM(COALESCE(u_duplicada.ciudad, '')))
 AND u_principal.id_universidad < u_duplicada.id_universidad
SET p.id_universidad = u_principal.id_universidad
WHERE @confirmar_limpieza = 1
  AND NOT EXISTS (
      SELECT 1
      FROM universidades AS u_menor
      WHERE LOWER(TRIM(u_menor.nombre)) = LOWER(TRIM(u_duplicada.nombre))
        AND LOWER(TRIM(COALESCE(u_menor.ciudad, ''))) = LOWER(TRIM(COALESCE(u_duplicada.ciudad, '')))
        AND u_menor.id_universidad < u_principal.id_universidad
  );

-- Mover reseñas a la universidad que se conserva.
UPDATE resenias AS r
JOIN universidades AS u_duplicada
  ON u_duplicada.id_universidad = r.id_universidad
JOIN universidades AS u_principal
  ON LOWER(TRIM(u_principal.nombre)) = LOWER(TRIM(u_duplicada.nombre))
 AND LOWER(TRIM(COALESCE(u_principal.ciudad, ''))) = LOWER(TRIM(COALESCE(u_duplicada.ciudad, '')))
 AND u_principal.id_universidad < u_duplicada.id_universidad
SET r.id_universidad = u_principal.id_universidad
WHERE @confirmar_limpieza = 1
  AND NOT EXISTS (
      SELECT 1
      FROM universidades AS u_menor
      WHERE LOWER(TRIM(u_menor.nombre)) = LOWER(TRIM(u_duplicada.nombre))
        AND LOWER(TRIM(COALESCE(u_menor.ciudad, ''))) = LOWER(TRIM(COALESCE(u_duplicada.ciudad, '')))
        AND u_menor.id_universidad < u_principal.id_universidad
  );

-- Eliminar las universidades repetidas ya vacías.
DELETE u_duplicada
FROM universidades AS u_duplicada
JOIN universidades AS u_principal
  ON LOWER(TRIM(u_principal.nombre)) = LOWER(TRIM(u_duplicada.nombre))
 AND LOWER(TRIM(COALESCE(u_principal.ciudad, ''))) = LOWER(TRIM(COALESCE(u_duplicada.ciudad, '')))
 AND u_principal.id_universidad < u_duplicada.id_universidad
WHERE @confirmar_limpieza = 1
  AND NOT EXISTS (
      SELECT 1
      FROM universidades AS u_menor
      WHERE LOWER(TRIM(u_menor.nombre)) = LOWER(TRIM(u_duplicada.nombre))
        AND LOWER(TRIM(COALESCE(u_menor.ciudad, ''))) = LOWER(TRIM(COALESCE(u_duplicada.ciudad, '')))
        AND u_menor.id_universidad < u_principal.id_universidad
  );

-- --------------------------------------------------------------------------
-- 5. VERIFICACIÓN FINAL
-- --------------------------------------------------------------------------
SELECT
    (SELECT COUNT(*) FROM universidades) AS universidades_totales,
    (SELECT COUNT(*) FROM programas_academicos) AS programas_totales,
    (SELECT COUNT(*)
       FROM universidades AS u
      WHERE NOT EXISTS (
          SELECT 1 FROM programas_academicos AS p
          WHERE p.id_universidad = u.id_universidad
      )) AS universidades_sin_carreras;

SELECT
    'Si @confirmar_limpieza = 0 no se borró ni modificó nada. Si lo cambiaste a 1, revisa los conteos anteriores.' AS resultado;

-- Con @confirmar_limpieza = 0, COMMIT no modifica datos.
-- Si cambias @confirmar_limpieza a 1 y aparece un error antes de terminar,
-- ejecuta ROLLBACK en la misma sesión. Si todo sale bien, este COMMIT confirma
-- la limpieza.
COMMIT;
