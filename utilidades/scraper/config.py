"""
====================================================================
 config.py — Configuración centralizada del módulo de scraping
====================================================================
"""

import os

# ── Entorno ──────────────────────────────────────────────────────────────────
ENV = os.getenv("SCRAPER_ENV", "local")   # "local" | "prod"

# ── Credenciales de Base de Datos ────────────────────────────────────────────
DB_CONFIG = {
    "local": {
        "host":     "localhost",
        "port":     3306,
        "database": "orienta_tu_futuro",
        "user":     "root",
        "password": "",
        "charset":  "utf8mb4",
    },
    "prod": {
        "host":     "sql309.infinityfree.com",
        "port":     3306,
        "database": "if0_42975485_OrientaTuFuturo",
        "user":     "if0_42975485",
        "password": "nAPKj4IpkB3h",
        "charset":  "utf8mb4",
    },
}

# ── Cabeceras HTTP (rotación básica anti-bloqueo) ────────────────────────────
USER_AGENTS = [
    "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 "
    "(KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36",
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 14_5) AppleWebKit/605.1.15 "
    "(KHTML, like Gecko) Version/17.4 Safari/605.1.15",
    "Mozilla/5.0 (X11; Linux x86_64; rv:127.0) Gecko/20100101 Firefox/127.0",
]

BASE_HEADERS = {
    "Accept":          "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
    "Accept-Language": "es-CO,es;q=0.9,en-US;q=0.7,en;q=0.5",
    "Accept-Encoding": "gzip, deflate, br",
    "Connection":      "keep-alive",
    "DNT":             "1",
}

# ── Delays entre peticiones (segundos) ───────────────────────────────────────
DELAY_MIN = 2.0
DELAY_MAX = 5.5

# ── Reintentos ante fallos de red ────────────────────────────────────────────
MAX_RETRIES   = 3
RETRY_BACKOFF = 4   # segundos extra por cada reintento

# ── Timeout de petición HTTP ─────────────────────────────────────────────────
REQUEST_TIMEOUT = 20  # segundos

# ── Áreas académicas reconocidas (normalización) ─────────────────────────────
AREA_MAP = {
    "ingeniería":       "Ingeniería y Tecnología",
    "tecnología":       "Ingeniería y Tecnología",
    "sistemas":         "Ingeniería y Tecnología",
    "computación":      "Ingeniería y Tecnología",
    "electrónica":      "Ingeniería y Tecnología",
    "mecánica":         "Ingeniería y Tecnología",
    "civil":            "Ingeniería y Tecnología",
    "medicina":         "Ciencias de la Salud",
    "enfermería":       "Ciencias de la Salud",
    "nutrición":        "Ciencias de la Salud",
    "salud":            "Ciencias de la Salud",
    "psicología":       "Ciencias de la Salud",
    "farmacia":         "Ciencias de la Salud",
    "odontología":      "Ciencias de la Salud",
    "derecho":          "Ciencias Sociales y Humanidades",
    "administración":   "Ciencias Sociales y Humanidades",
    "economía":         "Ciencias Sociales y Humanidades",
    "comunicación":     "Ciencias Sociales y Humanidades",
    "sociología":       "Ciencias Sociales y Humanidades",
    "ciencia política": "Ciencias Sociales y Humanidades",
    "diseño":           "Artes y Diseño",
    "arquitectura":     "Artes y Diseño",
    "artes":            "Artes y Diseño",
    "música":           "Artes y Diseño",
    "biología":         "Ciencias Básicas",
    "química":          "Ciencias Básicas",
    "física":           "Ciencias Básicas",
    "matemáticas":      "Ciencias Básicas",
    "agronomía":        "Ciencias Agropecuarias",
    "veterinaria":      "Ciencias Agropecuarias",
}

# ── Perfiles de universidades a scrapear ─────────────────────────────────────
#
# Cada perfil describe UNA universidad:
#   - id_universidad : PK en la tabla `universidades`
#   - nombre         : nombre exacto en la BD
#   - url_programas  : lista de URLs a visitar
#   - tipo_render    : "static" (requests) | "dynamic" (Playwright)
#   - parser         : nombre de la función en parsers.py
#
UNIVERSIDADES_TARGET = [
    {
        "id_universidad": 1,
        "nombre":         "Universidad Nacional de Colombia",
        "url_programas":  [
            "https://unal.edu.co/la-universidad/programas-academicos/",
        ],
        "tipo_render": "static",
        "parser":      "parser_unal",
    },
    {
        "id_universidad": 3,
        "nombre":         "Universidad de Antioquia",
        "url_programas":  [
            "https://www.udea.edu.co/wps/portal/udea/web/inicio/admisiones/oferta-programas",
        ],
        "tipo_render": "static",
        "parser":      "parser_udea",
    },
    # ── Para agregar más: copia el bloque de arriba y ajusta ──────────────
    # {
    #     "id_universidad": 2,
    #     "nombre":         "Universidad de los Andes",
    #     "url_programas":  ["https://uniandes.edu.co/es/programas"],
    #     "tipo_render": "dynamic",   # JS rendering -> Playwright
    #     "parser":      "parser_uniandes",
    # },
]
