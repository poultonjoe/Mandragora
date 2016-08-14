import Flatpickr from 'flatpickr';
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
    if (dateInput) {
        if (document.documentElement.lang === 'es-ES') {
            Flatpickr.init.prototype.l10n.weekdays = {
                shorthand: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']
            };

            Flatpickr.init.prototype.l10n.months = {
                shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                longhand: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
            };

            Flatpickr.init.prototype.l10n.ordinal = () => {
                return "º";
            };

            Flatpickr.init.prototype.l10n.firstDayOfWeek = 1;
        }

        new Flatpickr(dateInput, {
            dateFormat: 'Y-m-d',
            minDate: setMinimumDate()
        });
    }
}

export default function init() {
    bindHandlers();
    setBackgroundHeight();
}
