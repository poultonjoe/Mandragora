export function toggleAddressFields(e) {
    const dropdown = document.querySelector('#collection-method');
    if (e.type === 'change' && e.target === dropdown) {
        const container = document.querySelector('.address-fields');
        const addressFields = container.querySelectorAll('input, select');
        if (e.target.value === 'post') {
            container.style.display = 'initial';
            Array.from(addressFields).forEach(el => el.required = true);
        } else {
            container.style.display = 'none';
            Array.from(addressFields).forEach(el => el.required = false);
        }
    }
}
