"""
====================================================================
 fetcher.py — Descarga de páginas web con resiliencia
====================================================================
Provee dos estrategias de fetch:

  1. fetch_static(url)   → requests + BeautifulSoup (páginas estáticas)
  2. fetch_dynamic(url)  → Playwright (páginas con JS / SPA)

Incluye:
  - Rotación de User-Agent
  - Cabeceras HTTP realistas
  - Retardos aleatorios entre peticiones
  - Reintentos con backoff exponencial
  - Manejo de excepciones granular
====================================================================
"""

import logging
import random
import time
from typing import Optional

import requests
from bs4 import BeautifulSoup

from config import (
    BASE_HEADERS,
    DELAY_MAX,
    DELAY_MIN,
    MAX_RETRIES,
    REQUEST_TIMEOUT,
    RETRY_BACKOFF,
    USER_AGENTS,
)

logger = logging.getLogger(__name__)


# ── Helpers comunes ───────────────────────────────────────────────────────────

def _cabeceras_aleatorias() -> dict:
    """
    Construye un diccionario de cabeceras HTTP con un User-Agent aleatorio.
    Simula comportamiento de un navegador real para reducir detección.

    Returns:
        dict de cabeceras HTTP listas para usar con requests o Playwright.
    """
    headers = BASE_HEADERS.copy()
    headers["User-Agent"] = random.choice(USER_AGENTS)
    return headers


def _esperar() -> None:
    """
    Introduce un retardo aleatorio entre DELAY_MIN y DELAY_MAX segundos
    para no saturar el servidor objetivo y evitar bloqueos por rate limiting.
    """
    delay = random.uniform(DELAY_MIN, DELAY_MAX)
    logger.debug("Esperando %.2f segundos...", delay)
    time.sleep(delay)


# ── Fetch estático (requests + BeautifulSoup) ─────────────────────────────────

def fetch_static(url: str) -> Optional[BeautifulSoup]:
    """
    Descarga el HTML de una URL estática usando requests y lo parsea con
    BeautifulSoup. Incluye reintentos con backoff en caso de errores HTTP
    o de red.

    Args:
        url: URL de la página a descargar.

    Returns:
        Objeto BeautifulSoup del HTML, o None si todos los reintentos fallaron.

    Raises:
        No lanza excepciones al llamador; todos los errores se logean.
    """
    session = requests.Session()

    for intento in range(1, MAX_RETRIES + 1):
        try:
            headers = _cabeceras_aleatorias()
            logger.info("[Fetch Static] Intento %d/%d → %s", intento, MAX_RETRIES, url)

            response = session.get(
                url,
                headers=headers,
                timeout=REQUEST_TIMEOUT,
                allow_redirects=True,
            )
            response.raise_for_status()  # Lanza HTTPError para 4xx / 5xx

            # Forzar encoding correcto (algunos servidores no lo declaran bien)
            if response.encoding is None or response.encoding.lower() == "iso-8859-1":
                response.encoding = "utf-8"

            soup = BeautifulSoup(response.text, "lxml")
            logger.info("[Fetch Static] ✓ Descarga exitosa (%d bytes)", len(response.content))
            _esperar()
            return soup

        except requests.exceptions.HTTPError as e:
            status = e.response.status_code if e.response else "?"
            logger.warning("[Fetch Static] HTTP %s en '%s'", status, url)
            # 403 y 429 tienen poco sentido reintentar de inmediato
            if status in (403, 404):
                logger.error("[Fetch Static] Error definitivo %s, abortando.", status)
                return None

        except requests.exceptions.ConnectionError:
            logger.warning("[Fetch Static] Error de conexión para '%s'", url)

        except requests.exceptions.Timeout:
            logger.warning("[Fetch Static] Timeout en '%s'", url)

        except requests.exceptions.RequestException as e:
            logger.warning("[Fetch Static] Error de red inesperado: %s", e)

        # Backoff exponencial antes del siguiente intento
        if intento < MAX_RETRIES:
            backoff = RETRY_BACKOFF * intento
            logger.info("[Fetch Static] Reintentando en %d segundos...", backoff)
            time.sleep(backoff)

    logger.error("[Fetch Static] Todos los reintentos fallaron para '%s'", url)
    return None


# ── Fetch dinámico (Playwright) ───────────────────────────────────────────────

def fetch_dynamic(url: str, wait_selector: Optional[str] = None) -> Optional[BeautifulSoup]:
    """
    Renderiza una página web dinámica (SPA / JS-heavy) usando Playwright
    en modo headless y retorna el DOM post-renderizado como BeautifulSoup.

    Requiere instalación previa:
        pip install playwright
        playwright install chromium

    Args:
        url:           URL de la página a renderizar.
        wait_selector: Selector CSS a esperar antes de capturar el DOM.
                       Si es None, espera el evento 'networkidle'.

    Returns:
        Objeto BeautifulSoup del HTML renderizado, o None si falla.
    """
    try:
        # Import tardío para no requerir Playwright en entornos que no lo necesitan
        from playwright.sync_api import sync_playwright, TimeoutError as PlaywrightTimeout
    except ImportError:
        logger.error(
            "[Fetch Dynamic] Playwright no está instalado. "
            "Ejecuta: pip install playwright && playwright install chromium"
        )
        return None

    for intento in range(1, MAX_RETRIES + 1):
        try:
            logger.info("[Fetch Dynamic] Intento %d/%d → %s", intento, MAX_RETRIES, url)

            with sync_playwright() as pw:
                browser = pw.chromium.launch(
                    headless=True,
                    args=["--no-sandbox", "--disable-dev-shm-usage"],
                )
                context = browser.new_context(
                    user_agent=random.choice(USER_AGENTS),
                    locale="es-CO",
                    viewport={"width": 1366, "height": 768},
                    extra_http_headers={
                        k: v for k, v in BASE_HEADERS.items()
                        if k != "Accept-Encoding"  # Playwright gestiona esto
                    },
                )
                page = context.new_page()

                # Bloquear recursos pesados que no aportan al DOM de texto
                page.route(
                    "**/*.{png,jpg,jpeg,gif,svg,woff,woff2,ttf,mp4,mp3}",
                    lambda route: route.abort(),
                )

                page.goto(url, timeout=REQUEST_TIMEOUT * 1000)

                if wait_selector:
                    page.wait_for_selector(wait_selector, timeout=15_000)
                else:
                    page.wait_for_load_state("networkidle", timeout=20_000)

                html = page.content()
                browser.close()

            soup = BeautifulSoup(html, "lxml")
            logger.info("[Fetch Dynamic] ✓ Renderizado exitoso para '%s'", url)
            _esperar()
            return soup

        except PlaywrightTimeout:
            logger.warning("[Fetch Dynamic] Timeout esperando selector en '%s'", url)
        except Exception as e:
            logger.warning("[Fetch Dynamic] Error inesperado en intento %d: %s", intento, e)

        if intento < MAX_RETRIES:
            backoff = RETRY_BACKOFF * intento
            logger.info("[Fetch Dynamic] Reintentando en %d segundos...", backoff)
            time.sleep(backoff)

    logger.error("[Fetch Dynamic] Todos los reintentos fallaron para '%s'", url)
    return None
