export default function setBackgroundHeight() {
    const background = document.querySelector('.background');
    background.style.height = `${document.documentElement.offsetHeight}px`;
}
