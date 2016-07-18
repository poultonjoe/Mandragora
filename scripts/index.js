import setBackgroundHeight from './background';
import {toggleMenu, stickyHeader} from './header';
import {filePicker} from './file';
import {setMinimumDate} from './date';
import {toggleAddressFields} from './address';

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

    const dateInput = document.querySelector('.form-input-date');
    if (dateInput) dateInput.setAttribute('min', setMinimumDate());

    const collectionInput = document.querySelector('.collection-method');
    if (collectionInput) collectionInput.addEventListener('change', toggleAddressFields, false);
}

export default function init() {
    bindHandlers();
    setBackgroundHeight();
}
