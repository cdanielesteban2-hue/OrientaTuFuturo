# Manual de Programador — OrientaTuFuturo

Documento técnico para mantener, desplegar y extender el aplicativo web de orientación vocacional **OrientaTuFuturo**.

---

## 1. Descripción general

OrientaTuFuturo es una aplicación web MVC en **PHP + MySQL (PDO)** que ayuda a estudiantes a:

- Realizar un **test vocacional** basado en el modelo RIASEC (Holland), con referencias a Filadd, UDES y Universidad de Medellín.
- Explorar **universidades** y **programas académicos** de Colombia.
- Consultar **becas**.
- Practicar con **Pre-ICFES** (simulacros aleatorios).

Arquitectura: **Modelo – Vista – Controlador**, con plantilla común (`vistas/plantilla.php`), shell lateral (`app-shell`) y conexión Singleton a MySQL.

---

## 2. Estructura del repositorio

```
OrientaTuFuturo/
├── index.php                 # Front controller
├── ruteador.php              # Enrutamiento por URL
├── conexion.php              # PDO Singleton (local / InfinityFree)
├── controladores/            # Lógica de cada módulo
├── modelos/                  # Acceso a datos (SQL)
├── vistas/
│   ├── plantilla.php         # HTML base, CSS/JS, tema
│   ├── modulos/              # navbar, footer
│   ├── paginas/              # inicio, nosotros, error
│   ├── universidades/
│   ├── programas/
│   ├── becas/
│   ├── cuestionarios/
│   ├── simulacros/
│   └── usuarios/
├── recursos/
│   ├── css/                  # miestilo.css, app-shell.css
│   ├── js/                   # mouse-glow.js, tailwind.min.js
│   └── img/                  # logo, assets
└── MANUAL_PROGRAMADOR.md     # Este archivo
```

### Rutas típicas

| URL | Controlador | Acción |
|-----|-------------|--------|
| `/paginas/inicio` | ControladorPaginas | inicio |
| `/universidades/inicio` | ControladorUniversidades | inicio |
| `/programas/inicio` | ControladorProgramas | inicio |
| `/cuestionarios/inicio` | ControladorCuestionarios | inicio |
| `/simulacros/inicio` | ControladorSimulacros | inicio |
| `/usuarios/login` | ControladorUsuarios | login |

---

## 3. Requisitos del entorno

- PHP 7.4+ (recomendado 8.x) con extensiones **pdo_mysql**, **mbstring**, **json**
- MySQL 5.7+ / MariaDB 10.x
- Servidor web (Apache con `mod_rewrite` o equivalente)
- En producción: hosting tipo **InfinityFree** (ya configurado en `conexion.php`)

### Variables de conexión (`conexion.php`)

- **Local:** `localhost` / `orienta_tu_futuro` / `root` / sin contraseña  
- **Producción:** host y credenciales de InfinityFree (detecta por `SERVER_NAME`)

> **Importante:** no subir contraseñas reales a repositorios públicos. Usa variables de entorno o un archivo fuera del webroot cuando sea posible.

---

## 4. Base de datos (tablas principales)

| Tabla | Uso |
|-------|-----|
| `universidades` | Directorio institucional (nombre, ciudad, tipo, sitio_web, jornadas, slug…) |
| `programas_academicos` | Carreras vinculadas a universidades |
| `becas` | Oportunidades de financiación |
| `cuestionario` / `preguntas` / `respuesta` | Test vocacional |
| `usuario_cuestionario` | Registro de tests completados |
| `simulacros` / `simulacro_preguntas` | Banco Pre-ICFES |
| `simulacro_intentos` / `simulacro_respuestas` | Resultados de práctica |
| `usuarios` | Cuentas de estudiante |

Los precios de matrícula se **ocultan temporalmente** en la UI; el botón **«Consultar precios»** redirige al `sitio_web` oficial de la universidad.

---

## 5. Frontend y temas

- **CSS global:** `recursos/css/miestilo.css` (variables, botones, formularios, listas)
- **Shell (sidebar + topbar + dragón):** `recursos/css/app-shell.css`
- **Tema claro/oscuro:** atributo `data-theme` en `<html>`, guardado en `localStorage`
- **Cache-bust:** query `?v=YYYYMMDD…` en `vistas/plantilla.php` al cambiar CSS/JS
- **Fondo dragón:** imagen distinta para tema oscuro y claro (URLs en `app-shell.css`)

Colores de marca: azul oscuro, blanco, amarillo (`#eab308`) y negro.

---

## 6. Módulos clave

### 6.1 Test vocacional
- Modelo RIASEC (6 áreas).
- Progreso en inicio: % de preguntas respondidas o 100% si hay fila en `usuario_cuestionario`.

### 6.2 Pre-ICFES
- Preguntas aleatorias (`ORDER BY RAND()`).
- Intentos en `simulacro_intentos` (campo `puntaje`).
- Barra de progreso en inicio = **mejor puntaje real**; si no hay intentos o el mejor es 0 → **0%**.

### 6.3 Universidades / Programas / Becas
- Listas en filas horizontales, filtros laterales, paginación compacta.
- Detalle de universidad: ficha + mapa Leaflet (sin sticky que tape el mapa).

---

## 7. Despliegue en InfinityFree

1. Subir el código (Git pull o File Manager).
2. Verificar que `conexion.php` apunte a la BD de producción.
3. Importar el SQL de estructura/datos en phpMyAdmin del hosting.
4. Comprobar permisos de lectura en `recursos/`.
5. Probar login, test, Pre-ICFES y listados.
6. Tras cambios de CSS/JS, subir también `plantilla.php` (nuevo `?v=`).

---

## 8. Flujo de desarrollo recomendado

1. Trabajar en local con la misma estructura de BD.
2. Commits claros en GitHub (`main`).
3. Probar en producción tras cada bloque funcional.
4. No editar a ciegas en el File Manager sin reflejar en Git.

---

## 9. Dónde colocar capturas de pantalla

Usa esta guía al documentar el proyecto (memoria, informe o wiki). Carpeta sugerida en el repo:

```
docs/capturas/
  01-inicio-dashboard.png
  02-sidebar-navegacion.png
  03-test-vocacional.png
  04-pre-icfes.png
  05-universidades-listado.png
  06-universidad-detalle-mapa.png
  07-carreras-listado.png
  08-becas.png
  09-tema-claro.png
  10-tema-oscuro.png
  11-login-registro.png
  12-mi-panel.png
```

### Ubicación de cada captura en el manual / informe

| # | Captura | Sección del manual / informe | Qué debe mostrar |
|---|---------|------------------------------|------------------|
| 01 | Inicio / dashboard | **1. Descripción general** o **Presentación del sistema** | Pantalla de inicio con tarjetas, progreso y botón Comenzar |
| 02 | Sidebar | **2. Estructura** o **Interfaz de usuario** | Menú lateral completo: logo «OrientaTuFuturo» y enlaces |
| 03 | Test vocacional | **6.1 Test vocacional** | Pregunta del test o pantalla de resultados RIASEC |
| 04 | Pre-ICFES | **6.2 Pre-ICFES** | Simulacro en curso o resumen de puntaje |
| 05 | Universidades | **6.3 Universidades** | Listado con filtros y filas de universidades |
| 06 | Detalle + mapa | **6.3 Universidades** | Ficha de datos + mapa sin solapamiento |
| 07 | Carreras | **6.3 Programas** | Filas de carreras con botón «Consultar precios» |
| 08 | Becas | **6.3 Becas** | Listado o detalle de una beca |
| 09 | Tema claro | **5. Frontend y temas** | Misma vista de inicio en tema claro (dragón con fondo claro) |
| 10 | Tema oscuro | **5. Frontend y temas** | Misma vista en tema oscuro |
| 11 | Login / registro | **Autenticación** | Formulario de ingreso o registro |
| 12 | Mi Panel | **Usuario autenticado** | Dashboard del estudiante (favoritos, atajos) |

### Consejos para las capturas

- Resolución mínima recomendada: **1280×720** (o captura completa de ventana del navegador).
- Usa datos reales de prueba (universidades colombianas, nombres legibles).
- Evita mostrar contraseñas o datos personales reales de terceros.
- En el informe impreso, inserta la captura **justo debajo** del párrafo que la explica, con pie: *«Figura X. Descripción breve»*.
- En Markdown del repo: `![Figura X – descripción](docs/capturas/01-inicio-dashboard.png)`.

---

## 10. Problemas frecuentes

| Síntoma | Causa probable | Solución |
|---------|----------------|----------|
| Cambios CSS no se ven | Caché del navegador / hosting | Subir `plantilla.php` con nuevo `?v=` y Ctrl+F5 |
| Datos insertados no aparecen | BD local ≠ BD producción | Revisar `conexion.php` y phpMyAdmin del hosting |
| Pre-ICFES al 100% sin haber practicado | Intentos con puntaje 0 contados como hechos | Usar mejor puntaje; si es 0 → barra en 0% (ya corregido) |
| Mapa tapado por ficha | `position: sticky` en ficha | Ficha en flujo normal (`position: relative`) |
| Hover que agranda demasiado | Tilt 3D en `mouse-glow.js` | Tilt reducido; filas de carreras sin transform |

---

## 11. Extensiones futuras sugeridas

- API o scraping controlado de precios de matrícula (con permiso y fuentes oficiales).
- Más áreas y preguntas en Pre-ICFES (lectura, ciencias, inglés).
- Exportar resultados del test a PDF.
- Panel administrador web para CRUD de universidades y preguntas.

---

*Última actualización del manual: octubre 2026 — alineado con la versión del shell, progreso dinámico y botón «Consultar precios».*
