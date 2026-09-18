<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orienta tu FUTURO - Plataforma de Orientación Vocacional</title>
    
    <!-- Script síncrono para inicializar tema rápido y prevenir parpadeos -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.setAttribute('data-theme', 'dark');
            } else {
                document.documentElement.setAttribute('data-theme', 'light');
            }
        })();
    </script>
    
    <!-- Hojas de estilos personalizadas con URL_BASE -->
    <link rel="stylesheet" href="<?php echo constant('URL_BASE'); ?>recursos/css/miestilo.css?v=<?php echo time(); ?>">
    
    <!-- Iconos modernos de FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: ['class', '[data-theme="dark"]'],
        theme: {
          extend: {
            colors: {
              brand: {
                gold: '#facc15',
                darkgold: '#ca8a04',
                blue: '#2563eb',
                dark: '#0f172a',
                darker: '#020617',
                light: '#f8fafc'
              }
            },
            fontFamily: {
              sans: ['"Plus Jakarta Sans"', 'sans-serif'],
              heading: ['Outfit', 'sans-serif'],
            }
          }
        }
      }
    </script>
    
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="layout-container">

    <!-- Navegación -->
    <?php include_once "vistas/modulos/navbar.php"; ?>

    <!-- Contenido Dinámico Principal -->
    <main class="main-content">
        <?php include_once "./ruteador.php"; ?>
    </main>

    <!-- Pie de página -->
    <?php include_once "vistas/modulos/footer.php"; ?>

    <!-- Script de control del Modo Oscuro -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const themeToggle = document.getElementById("theme-toggle");
            if (themeToggle) {
                themeToggle.addEventListener("click", function() {
                    const currentTheme = document.documentElement.getAttribute("data-theme");
                    let newTheme = "light";
                    if (currentTheme === "light") {
                        newTheme = "dark";
                    }
                    
                    document.documentElement.setAttribute("data-theme", newTheme);
                    localStorage.setItem("theme", newTheme);
                    
                    // Actualizar icono dinámicamente
                    const icon = themeToggle.querySelector("i");
                    if (icon) {
                        if (newTheme === "dark") {
                            icon.className = "fa-solid fa-sun";
                        } else {
                            icon.className = "fa-solid fa-moon";
                        }
                    }
                });
                
                // Sincronizar icono inicial según el tema cargado
                const initialTheme = document.documentElement.getAttribute("data-theme");
                const icon = themeToggle.querySelector("i");
                if (icon) {
                    if (initialTheme === "dark") {
                        icon.className = "fa-solid fa-sun";
                    } else {
                        icon.className = "fa-solid fa-moon";
                    }
                }
            }
        });
    </script>

    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            offset: 50,
            duration: 800,
            easing: 'ease-out-cubic',
        });
    </script>
</body>
</html>
