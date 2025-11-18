export function renderDropdown(items, dropdown, input, onSelect) {
    dropdown.innerHTML = '';
    const search = input.value.toLowerCase();

    const filtered = items.filter(i => i.toLowerCase().includes(search));
    filtered.forEach(i => {
        const div = document.createElement('div');
        div.className = 'dropdown-item';
        div.textContent = i;
        div.addEventListener('click', () => {
            input.value = i;
            hideAllDropdowns();
            onSelect(i);
        });
        dropdown.appendChild(div);
    });

    dropdown.style.display = filtered.length ? 'block' : 'none';
}

export function setupDropdown(input, dropdown, items, onSelect) {
    input.addEventListener('input', () => renderDropdown(items, dropdown, input, onSelect));
    input.addEventListener('focus', () => renderDropdown(items, dropdown, input, onSelect));
}


export function hideAllDropdowns() {
    document.querySelectorAll('.dropdown-options, .city-dropdown, .supplier-dropdown').forEach(dd => {
        dd.style.display = 'none';
    });
}

document.addEventListener('click', (e) => {
    if (!e.target.closest('.dropdown-wrapper')) {
        hideAllDropdowns();
    }
});
