import setBackgroundHeight from './background';
import {toggleMenu, stickyHeader} from './header';

function bindHandlers() {
    window.addEventListener('resize', setBackgroundHeight);
    window.addEventListener('scroll', () => {
        stickyHeader();
        setBackgroundHeight();
    });
    document.querySelector('.menu-button').addEventListener('click', function(e) {
        toggleMenu(e);
    }, false);
}

export default function init() {
    bindHandlers();
    setBackgroundHeight();
}
