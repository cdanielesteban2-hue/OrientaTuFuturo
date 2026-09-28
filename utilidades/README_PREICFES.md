# Pre-ICFES: modos y banco de preguntas

## Modos disponibles

- **Pre-ICFES**: prueba mixta aleatoria en modalidad corta, intermedia o normal.
- **Modalidad normal**: una sola prueba de 247 preguntas; muestra primero 123 y, al continuar, las 124 restantes. Cada sección tiene 4 horas.
- **Pre-ICFES profundizado**: selección de una materia concreta y elección de 10, 25 o 50 preguntas.

Materias incluidas:

1. Inglés
2. Ciencias Naturales
3. Lectura Crítica
4. Matemáticas
5. Sociales

## Resultado

Al finalizar, el módulo muestra:

- porcentaje de respuestas correctas;
- cantidad de aciertos;
- cantidad de respuestas por revisar;
- total de preguntas respondidas;
- respuesta correcta y respuesta marcada;
- explicación pedagógica de cada pregunta, especialmente útil para los errores.

## Cargar el banco inicial

Desde la raíz del proyecto y con PHP configurado para conectarse a la base de datos:

```bash
php utilidades/seeder_preicfes.php
```

El seeder es idempotente: crea los cinco simulacros y agrega 50 preguntas por materia sin duplicar las que ya existan. Esto permite cubrir las 247 preguntas del simulacro normal con un banco de 250 preguntas mixtas.

Los registros incluidos son un banco inicial editable desde el panel administrativo. Para una preparación oficial, conviene revisar y ampliar las preguntas con docentes o fuentes pedagógicas actualizadas.
