/**
 * Mouse Glow Effect — OrientaTuFuturo
 * Crea un efecto de spotlight/brillo que sigue al mouse,
 * con acentos de color azul (#2563eb), amarillo (#facc15) y blanco.
 */
(function () {
    'use strict';

    // ── 1. Cursor spotlight ──────────────────────────────────────────────
    const spotlight = document.createElement('div');
    spotlight.id = 'mouse-spotlight';
    document.body.appendChild(spotlight);

    let mouseX = -500, mouseY = -500;
    let currentX = -500, currentY = -500;
    let rafId;

    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });

    function lerp(a, b, t) { return a + (b - a) * t; }

    function animateSpotlight() {
        currentX = lerp(currentX, mouseX, 0.08);
        currentY = lerp(currentY, mouseY, 0.08);
        spotlight.style.transform = `translate(${currentX - 200}px, ${currentY - 200}px)`;
        rafId = requestAnimationFrame(animateSpotlight);
    }
    animateSpotlight();

    // ── 2. Glow reactivo en tarjetas ─────────────────────────────────────
    function applyCardGlow() {
        const glowTargets = document.querySelectorAll(
            '.card, .card-premium, .bento-card, .list-item-fav, ' +
            '.question-card, .auth-card, .carousel-card, .feature-card, ' +
            '.map-card-container, .filter-sidebar, .chart-container'
        );

        glowTargets.forEach((card) => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const xPct = (x / rect.width) * 100;
                const yPct = (y / rect.height) * 100;

                card.style.setProperty('--glow-x', `${xPct}%`);
                card.style.setProperty('--glow-y', `${yPct}%`);
                card.style.setProperty('--glow-opacity', '1');

                // Tilt sutil
                const rotX = ((y / rect.height) - 0.5) * 6;
                const rotY = ((x / rect.width) - 0.5) * -6;
                card.style.transform = `perspective(800px) rotateX(${rotX}deg) rotateY(${rotY}deg) translateY(-4px)`;
            });

            card.addEventListener('mouseleave', () => {
                card.style.setProperty('--glow-opacity', '0');
                card.style.transform = '';
            });
        });
    }

    // ── 3. Efecto ripple en botones ──────────────────────────────────────
    function applyButtonRipple() {
        const buttons = document.querySelectorAll(
            '.btn, .btn-primary, .btn-gold, .btn-outline-light, ' +
            '.btn-secondary, .btn-outline, .btn-accent, [class*="btn-"]'
        );

        buttons.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                const rect = btn.getBoundingClientRect();
                const ripple = document.createElement('span');
                ripple.className = 'btn-ripple';
                ripple.style.left = `${e.clientX - rect.left}px`;
                ripple.style.top = `${e.clientY - rect.top}px`;
                btn.appendChild(ripple);
                setTimeout(() => ripple.remove(), 600);
            });

            // Glow al hover
            btn.addEventListener('mousemove', (e) => {
                const rect = btn.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                btn.style.setProperty('--btn-gx', `${x}px`);
                btn.style.setProperty('--btn-gy', `${y}px`);
            });
        });
    }

    // ── 4. Links de navbar con chispa ────────────────────────────────────
    function applyNavbarSpark() {
        const navLinks = document.querySelectorAll('.navbar-item a');
        navLinks.forEach((link) => {
            link.addEventListener('mouseenter', () => {
                link.style.color = 'var(--primary)';
            });
            link.addEventListener('mouseleave', () => {
                link.style.color = '';
            });
        });
    }

    // ── 5. Shimmer en el navbar al hacer scroll ──────────────────────────
    function applyNavbarScroll() {
        const navbar = document.querySelector('.navbar');
        if (!navbar) return;
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        }, { passive: true });
    }

    // ── 6. Partículas flotantes de fondo ─────────────────────────────────
    function createParticles() {
        const container = document.createElement('div');
        container.id = 'bg-particles';
        document.body.prepend(container);

        const count = 18;
        const colors = ['#2563eb', '#facc15', '#ffffff', '#3b82f6', '#fde047'];

        for (let i = 0; i < count; i++) {
            const p = document.createElement('span');
            p.className = 'bg-particle';
            const size = Math.random() * 8 + 3;
            p.style.cssText = `
                width: ${size}px;
                height: ${size}px;
                left: ${Math.random() * 100}vw;
                top: ${Math.random() * 100}vh;
                background: ${colors[Math.floor(Math.random() * colors.length)]};
                animation-duration: ${Math.random() * 20 + 15}s;
                animation-delay: ${Math.random() * -20}s;
                opacity: ${Math.random() * 0.12 + 0.04};
            `;
            container.appendChild(p);
        }
    }

    // ── Init ─────────────────────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', () => {
        applyCardGlow();
        applyButtonRipple();
        applyNavbarSpark();
        applyNavbarScroll();
        createParticles();

        // Re-aplicar al cargar contenido dinámico
        const observer = new MutationObserver(() => {
            applyCardGlow();
            applyButtonRipple();
        });
        observer.observe(document.body, { childList: true, subtree: true });
    });

})();
