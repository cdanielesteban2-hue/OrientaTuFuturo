# OrientaTuFuturo 🎓

Plataforma web de orientación vocacional y académica desarrollada en PHP con arquitectura MVC.

## 🚀 Características

- **Evaluaciones y Cuestionarios**: Tests vocacionales interactivos para guiar a los estudiantes en su toma de decisiones.
- **Simulacros de Examen**: Pruebas de preparación académica estructuradas por áreas de conocimiento.
- **Directorio de Universidades y Programas**: Información detallada sobre instituciones de educación superior y carreras disponibles.
- **Módulo de Becas**: Consulta y gestión de oportunidades de financiación y apoyo económico.
- **Panel Administrativo**: Control total sobre usuarios, programas, cuestionarios, simulacros y becas.

## 🛠️ Tecnologías Utilizadas

- **Backend**: PHP (Patrón MVC - Modelo Vista Controlador)
- **Base de Datos**: MySQL con PDO (conexión Singleton)
- **Frontend**: HTML5, CSS3, JavaScript
- **Servidor Local**: Apache (XAMPP)

## ⚙️ Instalación y Configuración

1. Clonar o copiar este repositorio en la carpeta `htdocs` de XAMPP:
   ```bash
   cd c:\xampp\htdocs
   git clone https://github.com/cdanielesteban2-hue/OrientaTuFuturo.git
   ```

2. Iniciar los servicios de **Apache** y **MySQL** desde el Panel de Control de XAMPP.

3. Importar la base de datos:
   - Acceder a [phpMyAdmin](http://localhost/phpmyadmin/).
   - Crear una base de datos llamada `orienta_tu_futuro`.
   - Importar el archivo SQL ubicado en `utilidades/orienta_tu_futuro.sql` (o permitir la ejecución automática mediante el seeder integrado).

4. Acceder a la plataforma en el navegador:
   ```
   http://localhost/proyecto_orientacion/
   ```
