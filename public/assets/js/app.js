document.querySelectorAll('a[href^="#"]').forEach((el) => {
    el.addEventListener('click', (event) => {
        const target = document.querySelector(el.getAttribute('href'));
        if (!target) return;
        event.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
});
