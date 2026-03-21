document.querySelectorAll('a[href^="#"]').forEach((el) => {
    el.addEventListener('click', (event) => {
        const target = document.querySelector(el.getAttribute('href'));
        if (!target) return;
        event.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
});

/**
 * Lightbox cu animații intrare / ieșire
 */
function openLightbox(src, alt) {
    const overlay = document.createElement('div');
    overlay.className = 'js-lightbox-overlay fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6';
    overlay.setAttribute('role', 'dialog');
    overlay.setAttribute('aria-modal', 'true');
    overlay.setAttribute('aria-label', 'Imagine mărită');

    const closeBtn = document.createElement('button');
    closeBtn.type = 'button';
    closeBtn.className =
        'js-lightbox-close absolute top-3 right-3 sm:top-5 sm:right-5 z-10 flex h-11 w-11 items-center justify-center rounded-full bg-zinc-800/95 text-2xl text-zinc-100 shadow-lg ring-1 ring-zinc-600/50 transition hover:bg-zinc-700 hover:ring-accent/40';
    closeBtn.setAttribute('aria-label', 'Închide');
    closeBtn.innerHTML = '&times;';

    const inner = document.createElement('div');
    inner.className = 'js-lightbox-inner relative max-h-[90vh] max-w-[min(100%,96vw)]';

    const big = document.createElement('img');
    big.src = src;
    big.alt = alt || '';
    big.className = 'js-lightbox-img rounded-md';
    big.decoding = 'async';

    inner.appendChild(big);
    overlay.appendChild(closeBtn);
    overlay.appendChild(inner);
    document.body.appendChild(overlay);
    document.body.style.overflow = 'hidden';

    let closed = false;

    function close() {
        if (closed) return;
        closed = true;
        overlay.classList.add('lb-closing');

        const cleanup = () => {
            if (!overlay.parentNode) return;
            overlay.remove();
            document.body.style.overflow = '';
            document.removeEventListener('keydown', onKey);
        };

        const onEnd = (ev) => {
            if (ev.target !== overlay || !overlay.classList.contains('lb-closing')) return;
            overlay.removeEventListener('animationend', onEnd);
            clearTimeout(fallback);
            cleanup();
        };
        overlay.addEventListener('animationend', onEnd);
        const fallback = setTimeout(() => {
            overlay.removeEventListener('animationend', onEnd);
            cleanup();
        }, 500);
    }

    function onKey(ev) {
        if (ev.key === 'Escape') close();
    }

    document.addEventListener('keydown', onKey);
    closeBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        close();
    });
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) close();
    });
}

document.addEventListener('click', (e) => {
    const img = e.target.closest('img.js-lightbox');
    if (!img) return;
    e.preventDefault();
    openLightbox(img.currentSrc || img.src, img.alt);
});

document.addEventListener('keydown', (e) => {
    if (e.key !== 'Enter' && e.key !== ' ') return;
    const img = e.target.closest('img.js-lightbox');
    if (!img || document.querySelector('.js-lightbox-overlay')) return;
    e.preventDefault();
    openLightbox(img.currentSrc || img.src, img.alt);
});

/**
 * Pagina Produse: tab-uri Toate / Uși / Profile / Cornișă
 */
document.querySelectorAll('[data-produse-tabs]').forEach((root) => {
    const buttons = root.querySelectorAll('[data-tab]');
    const panels = root.querySelectorAll('[data-panel]');
    const activeBtn = 'border-accent text-accent bg-zinc-900';
    const inactiveBtn = 'border-zinc-700 text-zinc-300 bg-zinc-950';

    function show(tab) {
        buttons.forEach((btn) => {
            const on = btn.getAttribute('data-tab') === tab;
            btn.setAttribute('aria-selected', on ? 'true' : 'false');
            btn.className =
                'produse-tab px-4 py-2 rounded-full text-sm border transition hover:border-accent/60 ' +
                (on ? activeBtn : inactiveBtn);
        });
        panels.forEach((p) => {
            p.classList.toggle('hidden', p.getAttribute('data-panel') !== tab);
        });
    }

    buttons.forEach((btn) => {
        btn.addEventListener('click', () => show(btn.getAttribute('data-tab') || 'toate'));
    });
    show('toate');
});
