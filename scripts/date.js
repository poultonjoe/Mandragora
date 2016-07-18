export function setMinimumDate(minLeadTime = 1) {
    const now = new Date();
    const minDate = new Date(now.setDate(now.getDate() + minLeadTime));
    return minDate.toISOString().substr(0, 10);
}
