export function filePicker(e) {
    const {value} = e.target;
    const element = e.target.parentElement;
    const path = value.split('\\');
    const filename = path[path.length - 1];

    element.setAttribute('data-file', filename);
}
