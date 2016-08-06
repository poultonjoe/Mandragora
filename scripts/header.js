export function stickyHeader() {
    const scroll = window.scrollY;
    const html = document.documentElement;

    if (scroll > 0) {
        html.classList.add('is-sticky');
    } else {
        html.classList.remove('is-sticky');
    }
}

export function toggleMenu(e) {    
    if (e.target.classList.contains('menu-button') || e.target.parentNode.classList.contains('menu-button')) {
        e.preventDefault();
        const html = document.documentElement;
        const menuButton = document.querySelector('.menu-button');

        html.classList.toggle('menu-visible');
    }
}
