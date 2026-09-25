# 🎓 Módulo de Web Scraping Académico — OrientaTuFuturo

Módulo profesional de web scraping y automatización desarrollado en Python para extraer, normalizar y sincronizar programas académicos universitarios (nombre de carrera, duración en semestres, costo de matrícula, modalidad y área de conocimiento) directamente en la base de datos MySQL de **OrientaTuFuturo**.

---

## 🏗️ Arquitectura Modular

```
utilidades/scraper/
├── config.py             # Configuración centralizada, credenciales BD, timeouts y catálogo de universidades
├── fetcher.py            # Estrategias duales: Requests (estático) + Playwright (dinámico/JS) con reintentos
├── normalizer.py         # Limpieza profunda de precios (COP), duración, inferencia de áreas y sanitización
├── parsers.py            # Extractores semánticos con selectores resilientes (fallback múltiple)
├── database.py           # Conexión MySQL, transacciones seguras y operaciones UPSERT libres de duplicados
├── scraper.py            # Orquestador principal CLI con flags y reportería en tiempo real
├── test_normalizer.py    # Suite de pruebas unitarias para validación de datos
├── requirements.txt      # Dependencias del ecosistema Python
├── .env.example          # Plantilla de variables de entorno
└── README.md             # Esta documentación técnica
```

---

## 🚀 Requisitos e Instalación

### 1. Requisitos Previos
- **Python 3.9+** instalado en el sistema.
- **Servidor MySQL** (ej. XAMPP local o base de datos remota).

### 2. Instalación de Dependencias
Abre una terminal en el directorio del scraper:

```bash
cd c:\xampp\htdocs\proyecto_orientacion\utilidades\scraper
pip install -r requirements.txt
```

### 3. Instalación de Navegadores para Playwright (opcional para páginas dinámicas)
```bash
playwright install chromium
```

---

## ⚙️ Configuración (.env)

Copia el archivo `.env.example` a `.env`:

```bash
cp .env.example .env
```

Configura tus credenciales de base de datos según tu entorno:

```ini
SCRAPER_ENV=local

# Configuración MySQL
DB_HOST=localhost
DB_PORT=3306
DB_USER=root
DB_PASS=
DB_NAME=orienta_tu_futuro

# Parámetros de Resiliencia
MIN_DELAY_SECONDS=2.0
MAX_DELAY_SECONDS=5.0
HTTP_TIMEOUT_SECONDS=15
MAX_RETRIES=3
```

---

## 💻 Uso y Comandos CLI

El orquestador `scraper.py` incluye una interfaz CLI completa con argumentos flexibles:

### 1. Ejecutar Scraping Completo (Todas las universidades registradas)
```bash
python scraper.py
```

### 2. Modo Simulación (`--dry-run`)
Extrae y normaliza los datos sin realizar escrituras ni modificaciones en la base de datos MySQL (ideal para validar selectores):
```bash
python scraper.py --dry-run
```

### 3. Scrapear una Universidad Específica por ID (`--id`)
Ejecuta el proceso únicamente para una institución específica (ej. ID 1 = Universidad Nacional de Colombia):
```bash
python scraper.py --id 1
```

### 4. Modo Detallado / Depuración (`--verbose`)
Muestra el paso a paso de cada petición HTTP, tiempo de respuesta y trazabilidad de campos extraídos:
```bash
python scraper.py --id 1 --verbose
```

### 5. Combinación para Testing Seguro
```bash
python scraper.py --id 1 --dry-run --verbose
```

---

## 🧪 Pruebas Unitarias

Para verificar que los limpiadores de precios (`$ 12.500.000` → `12500000`), duraciones (`10 semestres` → `10`) y categorización de áreas funcionen adecuadamente:

```bash
python -m unittest test_normalizer.py
```

---

## 🛡️ Características de Resiliencia y Buenas Prácticas

1. **Estrategia UPSERT Idempotente**:
   - Evita duplicidad de registros evaluando la combinación `(id_universidad, nombre_programa)`.
   - Si el programa ya existe, actualiza únicamente los valores modificados (costo, duración, modalidad).
   - Si no existe, genera el ID y lo inserta limpiamente.

2. **Manejo Robusto de Fallos**:
   - Reintentos exponenciales con `backoff` ante errores temporales de red o timeouts (429, 500, 502, 503).
   - Rotación aleatoria de cabeceras `User-Agent` para evitar bloqueos por rate-limiting.
   - Delays aleatorios entre solicitudes respetando las políticas de cortesía de scraping.

3. **Selectores Resilientes**:
   - Estrategias en cascada: si cambia la clase CSS de una tabla, el parser intenta capturar tarjetas (`card`), listas o bloques semánticos alternativos.

4. **Auditoría y Logs**:
   - Creación automática de la tabla de auditoría `scraper_logs` en MySQL para registrar fecha, duración, programas insertados/actualizados y errores encontrados.
