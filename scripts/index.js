import setBackgroundHeight from './background';
import {toggleMenu, stickyHeader} from './header';
import {filePicker} from './file';
import {setMinimumDate} from './date';
import {toggleAddressFields} from './address';
import {pagination} from './pagination';

function bindHandlers() {    
    // Add window listeners
    window.addEventListener('resize', setBackgroundHeight);
    window.addEventListener('scroll', () => {
        stickyHeader();
        setBackgroundHeight();
    });

    // Add document listeners
    document.addEventListener('click', e => {
        toggleMenu(e);
        
        const pager = document.querySelector('.load-more-button');
        if (pager) pagination(e);
    }, false);

    document.addEventListener('change', e => {
        const fileInput = document.querySelector('.form-input-file');
        if (fileInput) filePicker(e);

        const collectionInput = document.querySelector('.collection-method');
        if (collectionInput) toggleAddressFields(e);
    }, false);    

    const dateInput = document.querySelector('.form-input-date');
    if (dateInput) dateInput.setAttribute('min', setMinimumDate());   
}

export default function init() {
    bindHandlers();
    setBackgroundHeight();
}
