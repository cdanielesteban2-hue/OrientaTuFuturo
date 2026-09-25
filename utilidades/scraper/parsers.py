"""
====================================================================
 parsers.py — Funciones parser por universidad
====================================================================
Cada función recibe un objeto BeautifulSoup y retorna una lista de
diccionarios con los datos crudos extraídos de la página.

Estructura esperada de cada dict:
    {
        "n_programa": str,   # Nombre del programa (texto crudo)
        "duracion":   str,   # Duración (texto crudo, ej: "10 semestres")
        "costo":      str,   # Costo (texto crudo, ej: "$ 850.000")
    }

Los valores se normalizarán DESPUÉS en el orquestador (scraper.py).

IMPORTANTE:
  - Los selectores CSS/clases de HTML cambian con frecuencia.
  - Cada función tiene try-except individual por elemento para que
    un selector roto no cancele todo el scraping.
  - Si la estructura del sitio cambia, solo debes editar esta función.

Para agregar una nueva universidad:
  1. Añade la función `parser_<identificador>` aquí.
  2. Registra el perfil en config.UNIVERSIDADES_TARGET.
====================================================================
"""

import logging
from typing import Optional
from bs4 import BeautifulSoup, Tag

logger = logging.getLogger(__name__)


# ── Helpers compartidos ───────────────────────────────────────────────────────

def _texto(tag: Optional[Tag]) -> str:
    """Extrae texto limpio de un tag BeautifulSoup, o cadena vacía si es None."""
    return tag.get_text(separator=" ", strip=True) if tag else ""


def _primer_texto(soup: BeautifulSoup, *selectores: str) -> str:
    """
    Intenta múltiples selectores CSS en orden y retorna el texto del primero
    que encuentre. Útil cuando el sitio tiene variantes de layout.
    """
    for sel in selectores:
        tag = soup.select_one(sel)
        if tag:
            return _texto(tag)
    return ""


# ── Parser: Universidad Nacional de Colombia ──────────────────────────────────

def parser_unal(soup: BeautifulSoup) -> list[dict]:
    """
    Extrae programas académicos del sitio de la Universidad Nacional.
    URL objetivo: https://unal.edu.co/la-universidad/programas-academicos/

    Selectores actuales (verificar si el sitio actualiza su estructura):
      - Contenedor de cada programa: 'article.programa', 'div.programa-item'
      - Nombre: 'h3', 'h2.titulo-programa'
      - Duración: 'span.duracion', 'p.duracion'
      - Costo: 'span.costo', 'p.costo', 'td.valor-matricula'

    Args:
        soup: BeautifulSoup de la página de programas de la UNAL.

    Returns:
        Lista de dicts con campos n_programa, duracion, costo.
    """
    programas = []

    # ── Estrategia 1: tabla de programas ─────────────────────────────────
    try:
        filas = soup.select("table tbody tr")
        if filas:
            logger.debug("[UNAL] Encontradas %d filas en tabla.", len(filas))
            for fila in filas:
                celdas = fila.find_all("td")
                if len(celdas) >= 2:
                    try:
                        programas.append({
                            "n_programa": _texto(celdas[0]),
                            "duracion":   _texto(celdas[1]) if len(celdas) > 1 else "",
                            "costo":      _texto(celdas[2]) if len(celdas) > 2 else "",
                        })
                    except Exception as e:
                        logger.warning("[UNAL] Error en fila de tabla: %s", e)
            if programas:
                return programas
    except Exception as e:
        logger.warning("[UNAL] Estrategia tabla falló: %s", e)

    # ── Estrategia 2: cards / artículos de programa ───────────────────────
    try:
        contenedores = soup.select(
            "article.programa, div.programa-item, li.program-item, "
            "div.card-programa, div[class*='program']"
        )
        logger.debug("[UNAL] Encontrados %d contenedores de programa.", len(contenedores))

        for item in contenedores:
            try:
                nombre = _primer_texto(item,
                    "h3", "h2", "h4",
                    ".titulo", ".nombre-programa", ".program-title",
                    "a.program-name", "span.title",
                )
                duracion = _primer_texto(item,
                    ".duracion", ".semestres", "span[class*='duracion']",
                    "p.duracion", "dd.duracion",
                )
                costo = _primer_texto(item,
                    ".costo", ".matricula", ".valor", "span[class*='costo']",
                    "p.costo", "dd.costo", ".precio",
                )
                if nombre:
                    programas.append({
                        "n_programa": nombre,
                        "duracion":   duracion,
                        "costo":      costo,
                    })
            except Exception as e:
                logger.warning("[UNAL] Error en item de programa: %s", e)

    except Exception as e:
        logger.warning("[UNAL] Estrategia cards falló: %s", e)

    # ── Estrategia 3 (fallback): extracción genérica de texto ─────────────
    if not programas:
        logger.warning("[UNAL] Ninguna estrategia encontró programas. "
                       "La estructura del sitio pudo haber cambiado.")
        # Intento genérico: buscar cualquier lista de ítems con texto
        try:
            items = soup.select("ul.programas li, ol.programas li, .oferta-academica li")
            for item in items:
                nombre = _texto(item)
                if len(nombre) > 5:
                    programas.append({"n_programa": nombre, "duracion": "", "costo": ""})
        except Exception as e:
            logger.error("[UNAL] Fallback también falló: %s", e)

    return programas


# ── Parser: Universidad de Antioquia ──────────────────────────────────────────

def parser_udea(soup: BeautifulSoup) -> list[dict]:
    """
    Extrae programas académicos del sitio de la Universidad de Antioquia.
    URL objetivo: https://www.udea.edu.co/wps/portal/udea/web/inicio/admisiones/oferta-programas

    El sitio de UdeA usa un portal IBM WebSphere Portal (WPS) con una
    estructura de tablas estándar y puede tener paginación.

    Args:
        soup: BeautifulSoup de la página de oferta académica de UdeA.

    Returns:
        Lista de dicts con campos n_programa, duracion, costo.
    """
    programas = []

    # ── Estrategia 1: tabla de oferta académica ───────────────────────────
    try:
        # El portal WPS suele envolver el contenido en <div class="portlet-body">
        tablas = soup.select("table")
        for tabla in tablas:
            encabezados = [_texto(th).lower() for th in tabla.select("thead th, tr:first-child th")]
            logger.debug("[UDEA] Encabezados de tabla: %s", encabezados)

            # Detectar columnas relevantes por posición en el encabezado
            idx_nombre   = _encontrar_indice(encabezados, ["programa", "nombre", "carrera"])
            idx_duracion = _encontrar_indice(encabezados, ["duración", "semestres", "duración"])
            idx_costo    = _encontrar_indice(encabezados, ["costo", "matrícula", "valor", "precio"])

            filas = tabla.select("tbody tr")
            for fila in filas:
                celdas = fila.find_all("td")
                if not celdas:
                    continue
                try:
                    nombre   = _texto(celdas[idx_nombre])   if idx_nombre   is not None and idx_nombre   < len(celdas) else ""
                    duracion = _texto(celdas[idx_duracion]) if idx_duracion is not None and idx_duracion < len(celdas) else ""
                    costo    = _texto(celdas[idx_costo])    if idx_costo    is not None and idx_costo    < len(celdas) else ""

                    if nombre:
                        programas.append({
                            "n_programa": nombre,
                            "duracion":   duracion,
                            "costo":      costo,
                        })
                except Exception as e:
                    logger.warning("[UDEA] Error en fila: %s", e)

        if programas:
            return programas
    except Exception as e:
        logger.warning("[UDEA] Estrategia tabla falló: %s", e)

    # ── Estrategia 2: lista de programas como links ───────────────────────
    try:
        links_programa = soup.select(
            "a[href*='programa'], a[href*='carrera'], "
            "div.programa a, li.programa a, "
            ".wpb_content_element a[href*='programa']"
        )
        logger.debug("[UDEA] Encontrados %d links de programa.", len(links_programa))
        vistos = set()
        for link in links_programa:
            nombre = _texto(link)
            if nombre and nombre not in vistos and len(nombre) > 4:
                vistos.add(nombre)
                programas.append({"n_programa": nombre, "duracion": "", "costo": ""})
    except Exception as e:
        logger.warning("[UDEA] Estrategia links falló: %s", e)

    if not programas:
        logger.warning("[UDEA] No se encontraron programas. "
                       "El portal WPS puede requerir Playwright (tipo_render: dynamic).")

    return programas


# ── Plantilla para agregar nuevas universidades ───────────────────────────────

def parser_plantilla(soup: BeautifulSoup) -> list[dict]:
    """
    PLANTILLA — Copia y renombra esta función para cada nueva universidad.

    Pasos para implementar:
      1. Abre la URL en el navegador.
      2. Con DevTools (F12 → Inspector), identifica los selectores CSS
         de: nombre del programa, duración y costo.
      3. Reemplaza los selectores en las llamadas a soup.select() abajo.
      4. Registra la función en config.UNIVERSIDADES_TARGET.

    Args:
        soup: BeautifulSoup de la página objetivo.

    Returns:
        Lista de dicts {n_programa, duracion, costo}.
    """
    programas = []

    try:
        # Reemplaza "SELECTOR_CONTENEDOR" con el selector del contenedor de cada programa
        contenedores = soup.select("SELECTOR_CONTENEDOR")

        for item in contenedores:
            try:
                nombre   = _primer_texto(item, "SELECTOR_NOMBRE_1", "SELECTOR_NOMBRE_2")
                duracion = _primer_texto(item, "SELECTOR_DURACION_1")
                costo    = _primer_texto(item, "SELECTOR_COSTO_1")

                if nombre:
                    programas.append({
                        "n_programa": nombre,
                        "duracion":   duracion,
                        "costo":      costo,
                    })
            except Exception as e:
                logger.warning("[PLANTILLA] Error en item: %s", e)

    except Exception as e:
        logger.error("[PLANTILLA] Error general: %s", e)

    return programas


# ── Utilidades internas ───────────────────────────────────────────────────────

def _encontrar_indice(encabezados: list[str], palabras_clave: list[str]) -> Optional[int]:
    """
    Busca el índice de una columna en una lista de encabezados de tabla
    comparando con palabras clave (búsqueda parcial, insensible a mayúsculas).

    Args:
        encabezados:    Lista de textos de encabezado (en minúsculas).
        palabras_clave: Palabras a buscar dentro de los encabezados.

    Returns:
        Índice de la primera coincidencia, o None si no se encontró.
    """
    for palabra in palabras_clave:
        for i, enc in enumerate(encabezados):
            if palabra in enc:
                return i
    return None


# ── Registro de parsers disponibles ──────────────────────────────────────────
# Usado por el orquestador (scraper.py) para cargar dinámicamente la función.
PARSERS = {
    "parser_unal":      parser_unal,
    "parser_udea":      parser_udea,
    "parser_plantilla": parser_plantilla,
}
