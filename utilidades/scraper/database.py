"""
====================================================================
 database.py — Conexión a MySQL y operaciones UPSERT
====================================================================
Gestiona la conexión a la base de datos con el patrón context manager
(using 'with') y expone funciones de alto nivel para:

  1. Obtener el id_universidad a partir del nombre.
  2. Hacer UPSERT de un programa académico (evita duplicados).
  3. Registrar un log de ejecución del scraper.

Dependencias:
  pip install mysql-connector-python
====================================================================
"""

import logging
from contextlib import contextmanager
from typing import Optional

import mysql.connector
from mysql.connector import Error as MySQLError

from config import DB_CONFIG, ENV

logger = logging.getLogger(__name__)


# ── Conexión ─────────────────────────────────────────────────────────────────

@contextmanager
def get_connection():
    """
    Context manager que abre y cierra automáticamente la conexión MySQL.

    Uso:
        with get_connection() as conn:
            cursor = conn.cursor()
            ...

    Yields:
        mysql.connector.connection.MySQLConnection

    Raises:
        SystemExit: Si no puede conectarse (error crítico).
    """
    cfg = DB_CONFIG[ENV]
    conn = None
    try:
        conn = mysql.connector.connect(
            host=cfg["host"],
            port=cfg["port"],
            database=cfg["database"],
            user=cfg["user"],
            password=cfg["password"],
            charset=cfg["charset"],
            connection_timeout=15,
            autocommit=False,
        )
        logger.info("Conexión a MySQL establecida (%s / %s)", cfg["host"], cfg["database"])
        yield conn
    except MySQLError as e:
        logger.critical("No se pudo conectar a MySQL: %s", e)
        raise SystemExit(1) from e
    finally:
        if conn and conn.is_connected():
            conn.close()
            logger.debug("Conexión MySQL cerrada.")


# ── Consultas de apoyo ────────────────────────────────────────────────────────

def obtener_id_universidad(conn, nombre: str) -> Optional[int]:
    """
    Busca el id_universidad en la tabla `universidades` por nombre exacto.

    Args:
        conn:   Conexión MySQL activa.
        nombre: Nombre de la universidad tal como está en la BD.

    Returns:
        id_universidad (int) si existe, None si no se encuentra.
    """
    sql = "SELECT id_universidad FROM universidades WHERE nombre = %s LIMIT 1"
    try:
        cursor = conn.cursor(dictionary=True)
        cursor.execute(sql, (nombre,))
        row = cursor.fetchone()
        cursor.close()
        return row["id_universidad"] if row else None
    except MySQLError as e:
        logger.error("Error al consultar universidad '%s': %s", nombre, e)
        return None


def obtener_siguiente_id_programa(conn) -> int:
    """
    Obtiene el próximo id_programa disponible (MAX + 1).
    Necesario porque la tabla no tiene AUTO_INCREMENT configurado por defecto.

    Args:
        conn: Conexión MySQL activa.

    Returns:
        Siguiente id_programa disponible.
    """
    sql = "SELECT COALESCE(MAX(id_programa), 0) + 1 AS next_id FROM programas_academicos"
    cursor = conn.cursor(dictionary=True)
    cursor.execute(sql)
    row = cursor.fetchone()
    cursor.close()
    return row["next_id"]


# ── UPSERT principal ──────────────────────────────────────────────────────────

def upsert_programa(
    conn,
    id_universidad: int,
    n_programa: str,
    area: str,
    duracion: Optional[int],
    costo: Optional[int],
    slug: str,
) -> dict:
    """
    Realiza un UPSERT (INSERT ... ON DUPLICATE KEY UPDATE) del programa académico.

    La clave de unicidad se basa en el par (n_programa, id_universidad):
      - Si no existe: inserta el registro.
      - Si existe:    actualiza duracion y costo (sin tocar n_programa ni slug).

    NOTA: MySQL requiere un índice UNIQUE en (n_programa, id_universidad) para
    que ON DUPLICATE KEY UPDATE funcione. Si no existe, ejecuta primero:

        ALTER TABLE programas_academicos
        ADD UNIQUE KEY uq_prog_univ (n_programa(80), id_universidad);

    Args:
        conn:           Conexión MySQL activa.
        id_universidad: FK hacia la tabla universidades.
        n_programa:     Nombre limpio del programa.
        area:           Categoría académica normalizada.
        duracion:       Semestres de duración (puede ser None).
        costo:          Costo en COP (puede ser None).
        slug:           Slug URL del programa.

    Returns:
        dict con campos: {"accion": "INSERT"|"UPDATE"|"SIN_CAMBIO", "id_programa": int}
    """
    # ── 1. Verificar si ya existe ─────────────────────────────────────────
    sql_check = """
        SELECT id_programa, duracion, costo
        FROM   programas_academicos
        WHERE  n_programa = %s AND id_universidad = %s
        LIMIT  1
    """
    cursor = conn.cursor(dictionary=True)
    cursor.execute(sql_check, (n_programa, id_universidad))
    existente = cursor.fetchone()
    cursor.close()

    try:
        if existente:
            # ── 2a. Actualizar solo si hay cambios reales ─────────────────
            id_prog = existente["id_programa"]
            hubo_cambio = (
                existente["duracion"] != duracion or
                int(existente["costo"] or 0) != int(costo or 0)
            )
            if hubo_cambio:
                sql_update = """
                    UPDATE programas_academicos
                    SET    duracion = %s,
                           costo    = %s,
                           area     = %s
                    WHERE  id_programa = %s
                """
                cur = conn.cursor()
                cur.execute(sql_update, (duracion, costo, area, id_prog))
                conn.commit()
                cur.close()
                logger.info("  [UPDATE] id=%s | %s", id_prog, n_programa)
                return {"accion": "UPDATE", "id_programa": id_prog}
            else:
                logger.debug("  [SIN CAMBIO] id=%s | %s", id_prog, n_programa)
                return {"accion": "SIN_CAMBIO", "id_programa": id_prog}

        else:
            # ── 2b. Insertar nuevo programa ───────────────────────────────
            nuevo_id = obtener_siguiente_id_programa(conn)
            sql_insert = """
                INSERT INTO programas_academicos
                    (id_programa, id_universidad, n_programa, area, duracion, costo, slug)
                VALUES
                    (%s, %s, %s, %s, %s, %s, %s)
            """
            cur = conn.cursor()
            cur.execute(sql_insert, (
                nuevo_id, id_universidad, n_programa,
                area, duracion, costo, slug,
            ))
            conn.commit()
            cur.close()
            logger.info("  [INSERT] id=%s | %s", nuevo_id, n_programa)
            return {"accion": "INSERT", "id_programa": nuevo_id}

    except MySQLError as e:
        conn.rollback()
        logger.error("Error en UPSERT para '%s': %s", n_programa, e)
        return {"accion": "ERROR", "id_programa": -1}


# ── Log de ejecución ─────────────────────────────────────────────────────────

def registrar_log_scraper(
    conn,
    universidad: str,
    total_encontrados: int,
    insertados: int,
    actualizados: int,
    errores: int,
) -> None:
    """
    Guarda un resumen de la ejecución del scraper.
    Si la tabla `scraper_logs` no existe, la crea automáticamente.

    Args:
        conn:              Conexión MySQL activa.
        universidad:       Nombre de la universidad scrapeada.
        total_encontrados: Programas hallados en el HTML.
        insertados:        Programas nuevos insertados.
        actualizados:      Programas existentes actualizados.
        errores:           Registros que fallaron.
    """
    # Auto-crear tabla de logs si no existe
    sql_create = """
        CREATE TABLE IF NOT EXISTS scraper_logs (
            id          INT AUTO_INCREMENT PRIMARY KEY,
            universidad VARCHAR(150) NOT NULL,
            encontrados INT DEFAULT 0,
            insertados  INT DEFAULT 0,
            actualizados INT DEFAULT 0,
            errores     INT DEFAULT 0,
            ejecutado_en DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    """
    sql_insert = """
        INSERT INTO scraper_logs
            (universidad, encontrados, insertados, actualizados, errores)
        VALUES (%s, %s, %s, %s, %s)
    """
    try:
        cur = conn.cursor()
        cur.execute(sql_create)
        cur.execute(sql_insert, (universidad, total_encontrados, insertados, actualizados, errores))
        conn.commit()
        cur.close()
        logger.info("Log guardado: %s | +%d insertar | ~%d actualizar | %d errores",
                    universidad, insertados, actualizados, errores)
    except MySQLError as e:
        logger.warning("No se pudo guardar el log de scraper: %s", e)
