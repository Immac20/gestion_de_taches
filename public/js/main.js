function showTab(event, status) {
    const tabLinks = document.querySelectorAll('.tab-link');
    tabLinks.forEach(tab => tab.classList.remove('active'));

    event.currentTarget.classList.add('active');

    const rows = document.querySelectorAll('.tache-row');
    rows.forEach(row => row.classList.add('hidden'));

    if (status === 'all') {
        rows.forEach(row => row.classList.remove('hidden'));
    } else {
        const filteredRows = document.querySelectorAll(`.tache-row.${status.replace(' ', '-')}`);
        filteredRows.forEach(row => row.classList.remove('hidden'));
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const defaultTab = document.querySelector('.tab-link');
    if (defaultTab) {
        showTab({ currentTarget: defaultTab }, 'all');
    }
});
