export function toggleAddressFields(e) {
    const dropdown = document.querySelector('#collection-method');
    if (e.type === 'change' && e.target === dropdown) {
        const container = document.querySelector('.address-fields');
        const region = container.querySelector('#region');
        if (e.target.value === 'post') {
            container.style.display = 'initial';
            region.required = true;
        } else {
            container.style.display = 'none';
            region.required = false;
        }
    }
}
