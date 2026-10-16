/**
 * Mouse Glow Effect — OrientaTuFuturo
 * Spotlight suave + glow en tarjetas (sin scale exagerado)
 */
(function () {
    'use strict';

    const spotlight = document.createElement('div');
    spotlight.id = 'mouse-spotlight';
    document.body.appendChild(spotlight);

    let mouseX = -500, mouseY = -500;
    let currentX = -500, currentY = -500;

    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });

    function lerp(a, b, t) { return a + (b - a) * t; }

    function animateSpotlight() {
        currentX = lerp(currentX, mouseX, 0.08);
        currentY = lerp(currentY, mouseY, 0.08);
        spotlight.style.transform = `translate(${currentX - 200}px, ${currentY - 200}px)`;
        requestAnimationFrame(animateSpotlight);
    }
    animateSpotlight();

    function applyCardGlow() {
        const glowTargets = document.querySelectorAll(
            '.card, .card-premium, .bento-card, .list-item-fav, ' +
            '.question-card, .auth-card, .carousel-card, .feature-card, ' +
            '.map-card-container, .filter-sidebar, .chart-container, ' +
            '.mock-card, .mock-banner, .carrera-row, .list-row, .uni-card'
        );

        glowTargets.forEach((card) => {
            // No aplicar tilt 3D a filas ni ficha/mapa
            const noTilt = card.classList.contains('carrera-row')
                || card.classList.contains('list-row')
                || card.classList.contains('ficha-sticky')
                || card.classList.contains('map-card-container')
                || card.classList.contains('filter-sidebar');

            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const xPct = (x / rect.width) * 100;
                const yPct = (y / rect.height) * 100;

                card.style.setProperty('--glow-x', `${xPct}%`);
                card.style.setProperty('--glow-y', `${yPct}%`);
                card.style.setProperty('--glow-opacity', '1');

                if (!noTilt) {
                    // Tilt muy sutil (antes era x6 y se veía exagerado)
                    const rotX = ((y / rect.height) - 0.5) * 2;
                    const rotY = ((x / rect.width) - 0.5) * -2;
                    card.style.transform = `perspective(900px) rotateX(${rotX}deg) rotateY(${rotY}deg) translateY(-2px)`;
                }
            });

            card.addEventListener('mouseleave', () => {
                card.style.setProperty('--glow-opacity', '0');
                if (!noTilt) {
                    card.style.transform = '';
                }
            });
        });
    }

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
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            applyCardGlow();
            applyButtonRipple();
        });
    } else {
        applyCardGlow();
        applyButtonRipple();
    }
})();
