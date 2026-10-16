<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orienta tu FUTURO</title>
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo constant('URL_BASE'); ?>recursos/css/miestilo.css?v=20261016g">
    <link rel="stylesheet" href="<?php echo constant('URL_BASE'); ?>recursos/css/app-shell.css?v=20261016g">
    <style>
      :root {
        --border-color: var(--border);
        --primary-light: var(--primary-soft);
        --accent-light: var(--accent-soft);
        --bg-body: var(--bg-main);
        --danger: #dc2626;
        --success: #059669;
        --warning: #d97706;
        --font-main: var(--font-sans);
        --shadow-premium: var(--shadow-lg);
        --radius-full: 9999px;
      }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="<?php echo constant('URL_BASE'); ?>recursos/js/tailwind.min.js"></script>
    <script>
      tailwind.config = {
        darkMode: ['class', '[data-theme="dark"]'],
        theme: {
          extend: {
            colors: { brand: { gold: '#eab308', blue: '#0b3d91', dark: '#0f172a', light: '#f0f2f7' } },
            fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'], heading: ['Outfit', 'sans-serif'] }
          }
        }
      }
    </script>
</head>
<body class="app-shell">
    <?php include_once "vistas/modulos/navbar.php"; ?>

    <div class="app-body">
        <main class="app-main">
            <?php include_once "./ruteador.php"; ?>
        </main>
        <?php include_once "vistas/modulos/footer.php"; ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const themeToggle = document.getElementById("theme-toggle");
            if (themeToggle) {
                themeToggle.addEventListener("click", function() {
                    const currentTheme = document.documentElement.getAttribute("data-theme");
                    const newTheme = currentTheme === "light" ? "dark" : "light";
                    document.documentElement.setAttribute("data-theme", newTheme);
                    localStorage.setItem("theme", newTheme);
                    const icon = themeToggle.querySelector("i");
                    if (icon) icon.className = newTheme === "dark" ? "fa-solid fa-sun" : "fa-solid fa-moon";
                });
                const initialTheme = document.documentElement.getAttribute("data-theme");
                const icon = themeToggle.querySelector("i");
                if (icon) icon.className = initialTheme === "dark" ? "fa-solid fa-sun" : "fa-solid fa-moon";
            }
            const btn = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('app-sidebar');
            if (btn && sidebar) {
                btn.addEventListener('click', function() { sidebar.classList.toggle('open'); });
            }
        });
    </script>
    <script src="<?php echo constant('URL_BASE'); ?>recursos/js/mouse-glow.js"></script>
</body>
</html>
