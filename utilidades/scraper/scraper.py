"""
====================================================================
 scraper.py — Orquestador principal del módulo de scraping
====================================================================
Punto de entrada del scraper. Coordina todo el flujo:

  1. Carga el perfil de cada universidad (config.py)
  2. Descarga el HTML (fetcher.py)  →  static o dynamic
  3. Parsea el HTML (parsers.py)    →  función específica por univ.
  4. Normaliza los datos (normalizer.py)
  5. Hace UPSERT en MySQL (database.py)
  6. Genera un resumen JSON del resultado

Uso desde línea de comandos:
    # Scrapear todas las universidades configuradas
    python scraper.py

    # Solo una universidad específica (por id_universidad)
    python scraper.py --id 1

    # Modo dry-run (sin escribir en BD)
    python scraper.py --dry-run

    # Entorno de producción
    SCRAPER_ENV=prod python scraper.py
====================================================================
"""

import argparse
import json
import logging
import sys
from datetime import datetime
from pathlib import Path

# Asegurar que el directorio del módulo esté en el path
sys.path.insert(0, str(Path(__file__).parent))

from config import UNIVERSIDADES_TARGET
from database import get_connection, obtener_id_universidad, upsert_programa, registrar_log_scraper
from fetcher import fetch_static, fetch_dynamic
from normalizer import (
    normalizar_nombre,
    normalizar_duracion,
    normalizar_costo,
    normalizar_area,
    generar_slug,
)
from parsers import PARSERS

# ── Configuración de logging ──────────────────────────────────────────────────
LOG_DIR = Path(__file__).parent / "logs"
LOG_DIR.mkdir(exist_ok=True)

logging.basicConfig(
    level=logging.INFO,
    format="%(asctime)s [%(levelname)-8s] %(name)s — %(message)s",
    datefmt="%Y-%m-%d %H:%M:%S",
    handlers=[
        logging.StreamHandler(sys.stdout),
        logging.FileHandler(
            LOG_DIR / f"scraper_{datetime.now().strftime('%Y%m%d_%H%M%S')}.log",
            encoding="utf-8",
        ),
    ],
)
logger = logging.getLogger("scraper.main")


# ── Procesamiento de una universidad ─────────────────────────────────────────

def procesar_universidad(perfil: dict, dry_run: bool = False) -> dict:
    """
    Ejecuta el flujo completo de scraping para una universidad.

    Args:
        perfil:  Dict del perfil de universidad definido en config.py.
        dry_run: Si True, normaliza y logea pero NO escribe en la BD.

    Returns:
        Dict resumen: {universidad, encontrados, insertados, actualizados,
                       sin_cambio, errores, programas_fallidos}
    """
    nombre_univ  = perfil["nombre"]
    id_univ      = perfil["id_universidad"]
    urls         = perfil["url_programas"]
    tipo_render  = perfil.get("tipo_render", "static")
    nombre_parser = perfil["parser"]

    logger.info("═" * 60)
    logger.info("Procesando: %s  (id=%d)", nombre_univ, id_univ)
    logger.info("Modo render: %s | Parser: %s", tipo_render, nombre_parser)
    logger.info("═" * 60)

    resumen = {
        "universidad":  nombre_univ,
        "encontrados":  0,
        "insertados":   0,
        "actualizados": 0,
        "sin_cambio":   0,
        "errores":      0,
        "programas_fallidos": [],
    }

    # ── 1. Obtener función parser ─────────────────────────────────────────
    parser_fn = PARSERS.get(nombre_parser)
    if not parser_fn:
        logger.error("Parser '%s' no existe en parsers.PARSERS. Saltando.", nombre_parser)
        resumen["errores"] += 1
        return resumen

    # ── 2. Descargar y parsear cada URL ──────────────────────────────────
    todos_los_programas_crudos: list[dict] = []

    for url in urls:
        logger.info("Descargando: %s", url)

        if tipo_render == "dynamic":
            soup = fetch_dynamic(url)
        else:
            soup = fetch_static(url)

        if soup is None:
            logger.error("No se pudo descargar '%s'. Saltando esta URL.", url)
            resumen["errores"] += 1
            continue

        # Parsear con la función específica de la universidad
        try:
            crudos = parser_fn(soup)
            logger.info("Programas crudos extraídos de %s: %d", url, len(crudos))
            todos_los_programas_crudos.extend(crudos)
        except Exception as e:
            logger.error("Error en parser '%s' para '%s': %s", nombre_parser, url, e)
            resumen["errores"] += 1

    resumen["encontrados"] = len(todos_los_programas_crudos)

    if not todos_los_programas_crudos:
        logger.warning("No se encontraron programas para '%s'.", nombre_univ)
        return resumen

    # ── 3. Normalizar + UPSERT ────────────────────────────────────────────
    if dry_run:
        logger.info("[DRY-RUN] Se omite escritura en BD. Mostrando normalización:")
        for crudo in todos_los_programas_crudos:
            nombre   = normalizar_nombre(crudo.get("n_programa", ""))
            duracion = normalizar_duracion(crudo.get("duracion", ""))
            costo    = normalizar_costo(crudo.get("costo", ""))
            area     = normalizar_area(nombre or "")
            logger.info(
                "  [DRY] %-45s | dur=%-3s | costo=%-12s | área=%s",
                nombre, duracion, costo, area,
            )
        return resumen

    with get_connection() as conn:
        # Verificar que la universidad existe en la BD
        id_bd = obtener_id_universidad(conn, nombre_univ)
        if id_bd is None:
            logger.warning(
                "Universidad '%s' no encontrada en BD. "
                "Usando id_universidad=%d del perfil.",
                nombre_univ, id_univ,
            )
            id_bd = id_univ

        for crudo in todos_los_programas_crudos:
            # ── Normalización ─────────────────────────────────────────────
            nombre   = normalizar_nombre(crudo.get("n_programa", ""))
            duracion = normalizar_duracion(crudo.get("duracion", ""))
            costo    = normalizar_costo(crudo.get("costo", ""))
            area     = normalizar_area(nombre or "")

            if not nombre:
                logger.debug("Programa sin nombre, omitiendo.")
                resumen["errores"] += 1
                continue

            # ── UPSERT ───────────────────────────────────────────────────
            try:
                resultado = upsert_programa(
                    conn       = conn,
                    id_universidad = id_bd,
                    n_programa = nombre,
                    area       = area,
                    duracion   = duracion,
                    costo      = costo,
                    slug       = generar_slug(nombre, 0),  # ID temporal; DB lo asigna
                )

                accion = resultado["accion"]
                if accion == "INSERT":
                    resumen["insertados"] += 1
                    # Actualizar slug con el ID real
                    _actualizar_slug(conn, resultado["id_programa"], nombre)
                elif accion == "UPDATE":
                    resumen["actualizados"] += 1
                elif accion == "SIN_CAMBIO":
                    resumen["sin_cambio"] += 1
                else:
                    resumen["errores"] += 1
                    resumen["programas_fallidos"].append(nombre)

            except Exception as e:
                logger.error("Error al hacer UPSERT de '%s': %s", nombre, e)
                resumen["errores"] += 1
                resumen["programas_fallidos"].append(nombre)

        # ── Log en BD ─────────────────────────────────────────────────────
        registrar_log_scraper(
            conn,
            nombre_univ,
            resumen["encontrados"],
            resumen["insertados"],
            resumen["actualizados"],
            resumen["errores"],
        )

    return resumen


def _actualizar_slug(conn, id_programa: int, nombre: str) -> None:
    """
    Actualiza el slug de un programa recién insertado usando su ID real.

    Args:
        conn:        Conexión MySQL activa.
        id_programa: ID asignado por la BD.
        nombre:      Nombre del programa para generar el slug.
    """
    from normalizer import generar_slug
    from mysql.connector import Error as MySQLError
    slug = generar_slug(nombre, id_programa)
    try:
        cur = conn.cursor()
        cur.execute(
            "UPDATE programas_academicos SET slug = %s WHERE id_programa = %s",
            (slug, id_programa),
        )
        conn.commit()
        cur.close()
    except MySQLError as e:
        logger.warning("No se pudo actualizar slug para id=%d: %s", id_programa, e)


# ── CLI Principal ─────────────────────────────────────────────────────────────

def main() -> None:
    """
    Punto de entrada principal. Parsea argumentos CLI y ejecuta el scraper.
    """
    parser = argparse.ArgumentParser(
        description="Scraper de programas académicos — OrientaTuFuturo",
        formatter_class=argparse.RawDescriptionHelpFormatter,
        epilog="""
Ejemplos:
  python scraper.py                     # Todas las universidades
  python scraper.py --id 1             # Solo la universidad con id=1
  python scraper.py --dry-run          # Sin escribir en BD
  SCRAPER_ENV=prod python scraper.py   # Usar BD de producción
        """,
    )
    parser.add_argument(
        "--id",
        type=int,
        default=None,
        help="ID de universidad específica a scrapear (omitir = todas)",
    )
    parser.add_argument(
        "--dry-run",
        action="store_true",
        help="Normaliza y logea los datos pero NO escribe en la BD",
    )
    parser.add_argument(
        "--verbose",
        action="store_true",
        help="Activa nivel DEBUG en los logs",
    )
    args = parser.parse_args()

    if args.verbose:
        logging.getLogger().setLevel(logging.DEBUG)

    # ── Seleccionar universidades a procesar ──────────────────────────────
    if args.id is not None:
        objetivos = [u for u in UNIVERSIDADES_TARGET if u["id_universidad"] == args.id]
        if not objetivos:
            logger.error("No se encontró universidad con id=%d en UNIVERSIDADES_TARGET.", args.id)
            sys.exit(1)
    else:
        objetivos = UNIVERSIDADES_TARGET

    logger.info("Iniciando scraper — %d universidad(es) en cola.", len(objetivos))
    if args.dry_run:
        logger.info("⚠  MODO DRY-RUN: No se escribirá en la base de datos.")

    # ── Ejecutar ──────────────────────────────────────────────────────────
    resultados_totales = []
    for perfil in objetivos:
        resumen = procesar_universidad(perfil, dry_run=args.dry_run)
        resultados_totales.append(resumen)

    # ── Resumen final ─────────────────────────────────────────────────────
    logger.info("")
    logger.info("╔══════════════════════════════════════════════════════╗")
    logger.info("║              RESUMEN FINAL DEL SCRAPER              ║")
    logger.info("╠══════════════════════════════════════════════════════╣")
    total_ins = total_upd = total_err = total_enc = 0

    for r in resultados_totales:
        total_enc += r["encontrados"]
        total_ins += r["insertados"]
        total_upd += r["actualizados"]
        total_err += r["errores"]
        logger.info(
            "║  %-25s | +%3d ins | ~%3d upd | %3d err  ║",
            r["universidad"][:25],
            r["insertados"],
            r["actualizados"],
            r["errores"],
        )

    logger.info("╠══════════════════════════════════════════════════════╣")
    logger.info("║  TOTAL: %4d encontrados | +%3d ins | ~%3d upd | %3d err  ║",
                total_enc, total_ins, total_upd, total_err)
    logger.info("╚══════════════════════════════════════════════════════╝")

    # ── Guardar resumen JSON ──────────────────────────────────────────────
    output_file = LOG_DIR / f"resultado_{datetime.now().strftime('%Y%m%d_%H%M%S')}.json"
    with open(output_file, "w", encoding="utf-8") as f:
        json.dump(
            {
                "ejecutado_en": datetime.now().isoformat(),
                "dry_run": args.dry_run,
                "resultados": resultados_totales,
            },
            f,
            ensure_ascii=False,
            indent=2,
        )
    logger.info("Resumen JSON guardado en: %s", output_file)


if __name__ == "__main__":
    main()
