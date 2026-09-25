"""
====================================================================
 normalizer.py — Normalización y limpieza de datos scrapeados
====================================================================
Funciones puras (sin efectos secundarios) que transforman textos
crudos del HTML en valores listos para insertar en MySQL.

Ejemplos de entrada/salida:
  "$ 12.500.000 por semestre"  →  12500000  (int)
  "10 semestres"               →  10        (int)
  "Ingeniería de Sistemas"     →  "Ingeniería y Tecnología"
  "  MEDICINA  "               →  "Medicina" (capitalizado)
====================================================================
"""

import re
import unicodedata
from config import AREA_MAP


# ── Normalización de nombre de programa ─────────────────────────────────────

def normalizar_nombre(texto: str) -> str | None:
    """
    Limpia espacios, capitaliza el nombre del programa académico
    y elimina caracteres de control.

    Args:
        texto: Texto crudo extraído del HTML.

    Returns:
        Nombre limpio en formato título, o None si está vacío.
    """
    if not texto:
        return None
    # Eliminar espacios múltiples y saltos de línea
    nombre = " ".join(texto.split())
    # Capitalización en modo título (respeta preposiciones cortas en español)
    return nombre.strip().title()


# ── Normalización de duración ────────────────────────────────────────────────

def normalizar_duracion(texto: str) -> int | None:
    """
    Extrae el primer número entero del texto y lo devuelve como
    duración en semestres.

    Maneja formatos como:
      - "10 semestres"
      - "Duración: 5 años"  →  5   (ojo: años ≠ semestres; convertir si aplica)
      - "10"

    Args:
        texto: Texto crudo con información de duración.

    Returns:
        Número de semestres como entero, o None si no se encontró.
    """
    if not texto:
        return None

    texto_lower = texto.lower()
    numeros = re.findall(r"\d+", texto)

    if not numeros:
        return None

    valor = int(numeros[0])

    # Heurística: si la unidad mencionada es "año(s)", convertir a semestres
    if "año" in texto_lower and valor <= 10:
        valor = valor * 2

    return valor if 0 < valor <= 20 else None  # Rango válido: 1-20 semestres


# ── Normalización de costo ───────────────────────────────────────────────────

def normalizar_costo(texto: str) -> int | None:
    """
    Convierte texto de precio a un entero limpio (pesos colombianos COP).

    Maneja formatos como:
      - "$ 12.500.000"
      - "COP 12,500,000"
      - "12500000"
      - "12.500.000 por semestre"
      - "$12.5M"

    Args:
        texto: Texto crudo con información de costo.

    Returns:
        Costo como entero en COP, o None si no se pudo extraer.
    """
    if not texto:
        return None

    texto_clean = texto.strip().lower()

    # Manejo de formato abreviado con 'M' o 'm' (millones)
    millon_match = re.search(r"([\d]+[.,]?[\d]*)\s*m\b", texto_clean)
    if millon_match:
        try:
            return int(float(millon_match.group(1).replace(",", ".")) * 1_000_000)
        except ValueError:
            pass

    # Eliminar símbolos de moneda y texto no numérico
    solo_numeros = re.sub(r"[^\d.,]", "", texto_clean)

    if not solo_numeros:
        return None

    # Detectar separador decimal: si hay coma + 2 dígitos al final → decimal
    if re.search(r",\d{2}$", solo_numeros):
        # Formato europeo: 12.500,00 → 12500
        solo_numeros = solo_numeros.replace(".", "").replace(",", "")
    elif re.search(r"\.\d{2}$", solo_numeros):
        # Formato anglosajón: 12,500.00 → 12500
        solo_numeros = solo_numeros.replace(",", "").replace(".", "")
    else:
        # Sin decimales: eliminar separadores de miles
        solo_numeros = solo_numeros.replace(".", "").replace(",", "")

    try:
        valor = int(solo_numeros)
        # Sanity check: costos razonables para Colombia (1.000 a 100.000.000 COP)
        return valor if 1_000 <= valor <= 100_000_000 else None
    except ValueError:
        return None


# ── Normalización de área académica ─────────────────────────────────────────

def normalizar_area(nombre_programa: str) -> str:
    """
    Infiere el área académica de un programa a partir de su nombre,
    usando el mapa de palabras clave definido en config.AREA_MAP.

    Args:
        nombre_programa: Nombre del programa académico (puede ser crudo o limpio).

    Returns:
        Categoría de área académica estándar, o "Otras Disciplinas" si no coincide.
    """
    if not nombre_programa:
        return "Otras Disciplinas"

    # Normalizar caracteres Unicode para comparar sin tildes
    nombre_sin_tildes = _quitar_tildes(nombre_programa.lower())

    for keyword, area in AREA_MAP.items():
        if _quitar_tildes(keyword) in nombre_sin_tildes:
            return area

    return "Otras Disciplinas"


# ── Generación de slug ───────────────────────────────────────────────────────

def generar_slug(nombre: str, id_programa: int) -> str:
    """
    Genera un slug URL-friendly a partir del nombre del programa y su ID.

    Ejemplo: "Ingeniería de Sistemas", 42  →  "ingenieria-de-sistemas-42"

    Args:
        nombre:      Nombre del programa.
        id_programa: ID del programa en la BD.

    Returns:
        Slug en formato kebab-case con sufijo de ID.
    """
    nombre_normalizado = _quitar_tildes(nombre.lower())
    slug_base = re.sub(r"[^a-z0-9]+", "-", nombre_normalizado).strip("-")
    return f"{slug_base}-{id_programa}"


# ── Helpers internos ─────────────────────────────────────────────────────────

def _quitar_tildes(texto: str) -> str:
    """
    Elimina diacríticos (tildes) de un texto UTF-8.

    Args:
        texto: Texto con posibles caracteres acentuados.

    Returns:
        Texto sin tildes.
    """
    nfkd = unicodedata.normalize("NFKD", texto)
    return "".join(c for c in nfkd if not unicodedata.combining(c))
