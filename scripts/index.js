import setBackgroundHeight from './background';
import {toggleMenu, stickyHeader} from './header';
import {filePicker} from './file';

function bindHandlers() {
    window.addEventListener('resize', setBackgroundHeight);
    window.addEventListener('scroll', () => {
        stickyHeader();
        setBackgroundHeight();
    });
    const menuButton = document.querySelector('.menu-button');
    menuButton.addEventListener('click', toggleMenu, false);
    
    const fileInput = document.querySelector('.form-input-file');
    if (fileInput) fileInput.addEventListener('change', filePicker, false);
}

export default function init() {
    bindHandlers();
    setBackgroundHeight();
}
