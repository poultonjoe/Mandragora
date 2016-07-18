export function toggleAddressFields(e) {
    const addressFields = document.querySelector('.address-fields');
    if (e.target.value === 'post') {
        addressFields.style.display = 'initial';
    } else {
        addressFields.style.display = 'none';
    }
}
