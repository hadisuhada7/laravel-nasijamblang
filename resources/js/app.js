import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

/* Reveal-on-scroll observer (replaces framer-motion `whileInView`). */
const initReveal = () => {
    const items = document.querySelectorAll('.reveal');
    if (!('IntersectionObserver' in window) || items.length === 0) {
        items.forEach((el) => el.classList.add('is-visible'));
        return;
    }
    const io = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                }
            });
        },
        { rootMargin: '-80px 0px' }
    );
    items.forEach((el) => io.observe(el));
};

/* Scroll-spy for navbar active section (mirrors IntersectionObserver in Landing.jsx). */
const initScrollSpy = () => {
    const keys = ['philosophy', 'ingredients', 'techniques', 'tasting', 'serving', 'experience', 'nutrition', 'ethics'];
    const sections = keys.map((k) => document.getElementById(k)).filter(Boolean);
    if (sections.length === 0) return;

    const navButtons = document.querySelectorAll('[data-nav-key]');
    const setActive = (id) => {
        navButtons.forEach((btn) => {
            btn.dataset.active = btn.dataset.navKey === id ? 'true' : 'false';
        });
    };

    const io = new IntersectionObserver(
        (entries) => {
            const visible = entries
                .filter((e) => e.isIntersecting)
                .sort((a, b) => b.intersectionRatio - a.intersectionRatio);
            if (visible[0]) setActive(visible[0].target.id);
        },
        { rootMargin: '-45% 0px -45% 0px', threshold: [0, 0.25, 0.5, 1] }
    );
    sections.forEach((s) => io.observe(s));
};

document.addEventListener('DOMContentLoaded', () => {
    initReveal();
    initScrollSpy();

    /* Render lucide icons (loaded via CDN in <head>). */
    if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
    }
});
