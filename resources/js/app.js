import './bootstrap';

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// ---- SCROLL REVEAL ----
function initScrollReveal() {
    if (!prefersReducedMotion) {
        const revealElements = document.querySelectorAll('.animate-on-scroll');
        if (revealElements.length) {
            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) entry.target.classList.add('animate-visible');
                    });
                },
                { threshold: 0.05, rootMargin: '0px 0px -20px 0px' }
            );
            revealElements.forEach((el) => observer.observe(el));
            requestAnimationFrame(() => {
                requestAnimationFrame(() => document.body.classList.add('js-ready'));
            });
        } else {
            document.body.classList.add('js-ready');
        }
    } else {
        document.querySelectorAll('.animate-on-scroll').forEach((el) => el.classList.add('animate-visible'));
        document.body.classList.add('js-ready');
    }
}

// ---- HEADER SCROLL STATE ----
function initHeader() {
    const header = document.querySelector('#site-header');
    if (!header) return;
    const onScroll = () => header.classList.toggle('scrolled', window.scrollY > 20);
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
}

// ---- BACK TO TOP ----
function initBackToTop() {
    let btn = document.getElementById('back-to-top');
    if (!btn) {
        btn = document.createElement('button');
        btn.id = 'back-to-top';
        btn.type = 'button';
        btn.setAttribute('aria-label', 'Retour en haut');
        btn.innerHTML = '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>';
        document.body.appendChild(btn);
    }
    const toggle = () => btn.classList.toggle('visible', window.scrollY > 400);
    window.addEventListener('scroll', toggle, { passive: true });
    toggle();
    btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
}

// ---- MOBILE MENU ----
function initMobileMenu() {
    const toggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('mobile-menu');
    if (!toggle || !menu) return;

    function open() {
        menu.classList.remove('hidden');
        menu.classList.add('flex');
        toggle.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }
    function close() {
        menu.classList.add('hidden');
        menu.classList.remove('flex');
        toggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    toggle.addEventListener('click', () => {
        menu.classList.contains('hidden') ? open() : close();
    });
    menu.querySelectorAll('a').forEach((link) => link.addEventListener('click', close));
    window.addEventListener('resize', () => { if (window.innerWidth >= 768) close(); });
}

// ---- SCROLL PROGRESS BAR ----
function initScrollProgress() {
    const bar = document.createElement('div');
    bar.id = 'scroll-progress';
    document.body.prepend(bar);
    const update = () => {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        bar.style.width = (docHeight > 0 ? (scrollTop / docHeight) * 100 : 0) + '%';
    };
    window.addEventListener('scroll', update, { passive: true });
    update();
}

// ---- PAGE LOADER ----
function initLoader() {
    const loader = document.getElementById('page-loader');
    if (!loader) return;
    const hide = () => loader.classList.add('loaded');
    if (document.readyState === 'complete') {
        setTimeout(hide, 200);
    } else {
        window.addEventListener('load', () => setTimeout(hide, 200));
    }
    setTimeout(hide, 3000);
}

// ---- PARALLAX ----
function initParallax() {
    const els = document.querySelectorAll('.hero-parallax');
    if (!els.length || prefersReducedMotion) return;
    const update = () => {
        els.forEach(el => {
            const parent = el.closest('section') || el.parentElement;
            const rect = parent.getBoundingClientRect();
            if (rect.bottom < 0 || rect.top > window.innerHeight) return;
            const offset = (rect.top / window.innerHeight) * 25;
            el.style.transform = `translateY(${offset}px) scale(1.06)`;
        });
    };
    window.addEventListener('scroll', update, { passive: true });
    update();
}

// ---- ANIMATED COUNTERS ----
function initCounters() {
    const els = document.querySelectorAll('[data-count]');
    if (!els.length) return;
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            observer.unobserve(entry.target);
            const el = entry.target;
            const target = parseInt(el.dataset.count, 10);
            const prefix = el.dataset.countPrefix || '';
            const suffix = el.dataset.countSuffix || '';
            const duration = 1600;
            const start = performance.now();
            const tick = (now) => {
                const elapsed = now - start;
                const progress = Math.min(elapsed / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                el.textContent = prefix + Math.floor(eased * target) + suffix;
                if (progress < 1) requestAnimationFrame(tick);
            };
            requestAnimationFrame(tick);
        });
    }, { threshold: 0.5 });
    els.forEach(el => observer.observe(el));
}

// ---- CARD TILT 3D ----
function initCardTilt() {
    const cards = document.querySelectorAll('.card-tilt');
    if (!cards.length || prefersReducedMotion || window.matchMedia('(pointer: coarse)').matches) return;
    cards.forEach(card => {
        // Don't set transition inline — let CSS control it during scroll reveal.
        // Only override during active mouse interaction.
        card.addEventListener('mouseenter', () => {
            card.style.transition = 'transform 0.1s ease';
        });
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const cx = rect.width / 2;
            const cy = rect.height / 2;
            const rotX = ((y - cy) / cy) * -7;
            const rotY = ((x - cx) / cx) * 7;
            card.style.transform = `perspective(900px) rotateX(${rotX}deg) rotateY(${rotY}deg) translateZ(6px)`;
        });
        card.addEventListener('mouseleave', () => {
            card.style.transition = 'transform 0.4s ease';
            card.style.transform = 'perspective(900px) rotateX(0) rotateY(0) translateZ(0)';
            // Clear inline transition after it completes so scroll reveal CSS takes over again
            setTimeout(() => { card.style.transition = ''; }, 420);
        });
    });
}

// ---- CUSTOM CURSOR (désactivé) ----
function initCursor() {}

// ---- TYPEWRITER ----
function initTypewriter() {
    const el = document.getElementById('typewriter-text');
    if (!el || prefersReducedMotion) return;
    let phrases;
    try { phrases = JSON.parse(el.dataset.phrases || '[]'); } catch { phrases = []; }
    if (!phrases.length) return;

    let phraseIdx = 0, charIdx = 0, deleting = false;

    function tick() {
        const current = phrases[phraseIdx];
        if (deleting) {
            charIdx--;
            el.textContent = current.slice(0, charIdx);
            if (charIdx === 0) {
                deleting = false;
                phraseIdx = (phraseIdx + 1) % phrases.length;
                setTimeout(tick, 400);
                return;
            }
            setTimeout(tick, 35);
        } else {
            charIdx++;
            el.textContent = current.slice(0, charIdx);
            if (charIdx === current.length) {
                deleting = true;
                setTimeout(tick, 2200);
                return;
            }
            setTimeout(tick, 75);
        }
    }
    tick();
}

// ---- FAQ ACCORDION ----
function initFaq() {
    document.querySelectorAll('.faq-trigger').forEach(trigger => {
        trigger.addEventListener('click', () => {
            const content = trigger.nextElementSibling;
            const isOpen = trigger.getAttribute('aria-expanded') === 'true';
            document.querySelectorAll('.faq-trigger').forEach(t => {
                if (t !== trigger) {
                    t.setAttribute('aria-expanded', 'false');
                    t.nextElementSibling.classList.remove('open');
                }
            });
            trigger.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
            content.classList.toggle('open', !isOpen);
        });
    });
}

// ---- CATEGORY FILTER ----
function initCategoryFilter() {
    const btns = document.querySelectorAll('.filter-btn');
    if (!btns.length) return;
    const items = document.querySelectorAll('[data-category]');

    btns.forEach(btn => {
        btn.addEventListener('click', () => {
            btns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const cat = btn.dataset.filter;
            items.forEach(item => {
                const show = cat === 'all' || item.dataset.category === cat;
                item.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                if (show) {
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                    item.style.display = '';
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(8px)';
                    setTimeout(() => { if (item.style.opacity === '0') item.style.display = 'none'; }, 300);
                }
            });
        });
    });
}

// ---- CAROUSEL ----
function initCarousels() {
    document.querySelectorAll('.go-carousel').forEach(carousel => {
        const track = carousel.querySelector('.go-carousel-track');
        const slides = carousel.querySelectorAll('.go-carousel-slide');
        const dotsContainer = carousel.querySelector('.go-carousel-dots');
        if (!track || !slides.length) return;

        let current = 0;
        const total = slides.length;

        if (dotsContainer) {
            slides.forEach((_, i) => {
                const dot = document.createElement('button');
                dot.className = 'go-carousel-dot' + (i === 0 ? ' active' : '');
                dot.setAttribute('aria-label', `Slide ${i + 1}`);
                dot.addEventListener('click', () => goTo(i));
                dotsContainer.appendChild(dot);
            });
        }

        function goTo(idx) {
            current = (idx + total) % total;
            track.style.transform = `translateX(-${current * 100}%)`;
            if (dotsContainer) {
                dotsContainer.querySelectorAll('.go-carousel-dot').forEach((d, i) => {
                    d.classList.toggle('active', i === current);
                });
            }
        }

        let timer = setInterval(() => goTo(current + 1), 5000);
        carousel.addEventListener('mouseenter', () => clearInterval(timer));
        carousel.addEventListener('mouseleave', () => { timer = setInterval(() => goTo(current + 1), 5000); });

        let startX = 0;
        carousel.addEventListener('touchstart', e => { startX = e.touches[0].clientX; }, { passive: true });
        carousel.addEventListener('touchend', e => {
            const diff = startX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 50) goTo(diff > 0 ? current + 1 : current - 1);
        });
    });
}

// ---- LIGHTBOX ----
function initLightbox() {
    const triggers = document.querySelectorAll('[data-lightbox]');
    if (!triggers.length) return;

    const overlay = document.createElement('div');
    overlay.className = 'go-lightbox-overlay';
    overlay.setAttribute('role', 'dialog');
    overlay.setAttribute('aria-modal', 'true');
    overlay.innerHTML = `
        <button class="go-lightbox-close" aria-label="Fermer">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
        <button class="go-lightbox-prev" aria-label="Précédent">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <img src="" alt="" class="go-lightbox-img">
        <button class="go-lightbox-next" aria-label="Suivant">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
        </button>
    `;
    document.body.appendChild(overlay);

    const img = overlay.querySelector('.go-lightbox-img');
    const images = [];
    let current = 0;

    function open(idx) {
        current = idx;
        img.src = images[current].src;
        img.alt = images[current].alt;
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
        overlay.querySelector('.go-lightbox-close').focus();
    }
    function close() {
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }
    function next() { current = (current + 1) % images.length; img.src = images[current].src; }
    function prev() { current = (current - 1 + images.length) % images.length; img.src = images[current].src; }

    overlay.querySelector('.go-lightbox-close').addEventListener('click', close);
    overlay.querySelector('.go-lightbox-next').addEventListener('click', next);
    overlay.querySelector('.go-lightbox-prev').addEventListener('click', prev);
    overlay.addEventListener('click', e => { if (e.target === overlay) close(); });
    document.addEventListener('keydown', e => {
        if (!overlay.classList.contains('active')) return;
        if (e.key === 'Escape') close();
        if (e.key === 'ArrowRight') next();
        if (e.key === 'ArrowLeft') prev();
    });

    triggers.forEach(el => {
        const idx = images.length;
        images.push({ src: el.dataset.lightbox, alt: el.dataset.lightboxAlt || '' });
        el.style.cursor = 'zoom-in';
        el.addEventListener('click', () => open(idx));
    });
}

// ---- VIEW TRANSITIONS (MPA — géré en CSS via @view-transition) ----
function initViewTransitions() {
    // Les transitions cross-document sont gérées par la règle CSS @view-transition { navigation: auto }
    // Pas de JS nécessaire pour les MPA modernes (Chrome 126+)
}

// ---- INIT ----
function init() {
    initScrollReveal();
    initHeader();
    initBackToTop();
    initMobileMenu();
    initScrollProgress();
    initLoader();
    initParallax();
    initCounters();
    initCardTilt();
    initCursor();
    initTypewriter();
    initFaq();
    initCategoryFilter();
    initCarousels();
    initLightbox();
    initViewTransitions();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}
