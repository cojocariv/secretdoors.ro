document.querySelectorAll('a[href^="#"]').forEach((el) => {
    el.addEventListener('click', (event) => {
        const target = document.querySelector(el.getAttribute('href'));
        if (!target) return;
        event.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
});

/**
 * Lightbox: click sau Enter pe imagini cu .js-lightbox
 */
function openLightbox(src, alt) {
    const overlay = document.createElement('div');
    overlay.className =
        'js-lightbox-overlay fixed inset-0 z-[100] flex items-center justify-center bg-black/92 p-4';
    overlay.setAttribute('role', 'dialog');
    overlay.setAttribute('aria-modal', 'true');
    overlay.setAttribute('aria-label', 'Imagine marita');

    const closeBtn = document.createElement('button');
    closeBtn.type = 'button';
    closeBtn.className =
        'absolute top-4 right-4 z-10 flex h-11 w-11 items-center justify-center rounded-full bg-zinc-800 text-2xl text-zinc-100 hover:bg-zinc-700';
    closeBtn.setAttribute('aria-label', 'Inchide');
    closeBtn.innerHTML = '&times;';

    const big = document.createElement('img');
    big.src = src;
    big.alt = alt || '';
    big.className = 'max-h-[90vh] max-w-full object-contain shadow-2xl';
    big.decoding = 'async';

    overlay.appendChild(closeBtn);
    overlay.appendChild(big);
    document.body.appendChild(overlay);
    document.body.style.overflow = 'hidden';

    function close() {
        overlay.remove();
        document.body.style.overflow = '';
        document.removeEventListener('keydown', onKey);
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
