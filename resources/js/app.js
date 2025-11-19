import './bootstrap';
import initClients from './services/client/index';
import initViaCep from './services/viaCep';

document.addEventListener('DOMContentLoaded', () => {
    initClients();
    initViaCep();
});

function smoothScrollTo(target, duration = 1000) {
    const start = window.pageYOffset;
    const end = target.getBoundingClientRect().top + window.pageYOffset;
    const distance = end - start;
    let startTime = null;

    function animation(currentTime) {
        if (!startTime) startTime = currentTime;
        const timeElapsed = currentTime - startTime;
        const progress = Math.min(timeElapsed / duration, 1);

        const ease = progress < 0.5
            ? 2 * progress * progress
            : 1 - Math.pow(-2 * progress + 2, 2) / 2;

        window.scrollTo(0, start + distance * ease);

        if (timeElapsed < duration) {
            requestAnimationFrame(animation);
        }
    }

    requestAnimationFrame(animation);
}

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            smoothScrollTo(target, 1000);
        }
    });
});
