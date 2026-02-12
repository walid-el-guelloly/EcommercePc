import '../css/app.css';

// ---- Dark mode ----
function applyTheme(theme) {
    const root = document.documentElement;
    if (theme === 'dark') {
        root.classList.add('dark');
    } else {
        root.classList.remove('dark');
    }
}

const storedTheme = localStorage.getItem('theme');
if (storedTheme === 'dark' || storedTheme === 'light') {
    applyTheme(storedTheme);
} else {
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    applyTheme(prefersDark ? 'dark' : 'light');
}

window.addEventListener('DOMContentLoaded', () => {
    // Toggle dark mode
    const themeBtn = document.getElementById('theme-toggle');
    if (themeBtn) {
        themeBtn.addEventListener('click', () => {
            const isDark = document.documentElement.classList.contains('dark');
            const newTheme = isDark ? 'light' : 'dark';
            applyTheme(newTheme);
            localStorage.setItem('theme', newTheme);
        });
    }

    // ---- Navigation one-page : scroll + section active ----
    const navLinks = document.querySelectorAll('a[data-section]');
    const sections = document.querySelectorAll('[data-section-id]');

    if (navLinks.length && sections.length) {
        // Scroll fluide au clic
        navLinks.forEach(link => {
            link.addEventListener('click', e => {
                const targetId = link.dataset.section;
                const target = document.getElementById(targetId);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        const activeClasses = ['text-brand-600', 'border-brand-600'];
        const setActiveLink = (sectionId) => {
            navLinks.forEach(link => {
                if (link.dataset.section === sectionId) {
                    link.classList.add(...activeClasses);
                } else {
                    link.classList.remove(...activeClasses);
                }
            });
        };

        // Observer pour savoir quelle section est visible
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.dataset.sectionId;
                    setActiveLink(id);
                }
            });
        }, {
            threshold: 0.4, // la section est “active” quand ~40% visible
        });

        sections.forEach(section => observer.observe(section));

        // Section initiale active
        setActiveLink('hero');
    }
});