export function createPaginationContainer(parent) {
    const container = document.createElement('div');
    container.className = 'pagination mt-3 d-flex justify-content-center gap-2';
    parent.parentNode.appendChild(container);
    return container;
}

export function createPageButton(label, onClick, disabled = false) {
    const btn = document.createElement('button');
    btn.innerHTML = label;
    btn.disabled = disabled;
    btn.className = 'btn btn-light';
    btn.addEventListener('click', onClick);
    return btn;
}

export function renderPagination(totalPages, currentPage, paginationContainer, onPageChange, prevPageUrl, nextPageUrl) {
    paginationContainer.innerHTML = '';

    const prevBtn = createPageButton('&larr;', () => {
        if (currentPage > 1) onPageChange(currentPage - 1);
    }, !prevPageUrl);
    paginationContainer.appendChild(prevBtn);

    const delta = 2;
    const pages = [];
    for (let i = 1; i <= totalPages; i++) {
        if (i === 1 || i === totalPages || (i >= currentPage - delta && i <= currentPage + delta)) pages.push(i);
        else if (pages[pages.length - 1] !== '...') pages.push('...');
    }

    pages.forEach(p => {
        if (p === '...') {
            const dots = document.createElement('span');
            dots.textContent = '...';
            dots.className = 'px-2';
            paginationContainer.appendChild(dots);
        } else {
            const pageBtn = createPageButton(p, () => onPageChange(p));
            if (p === currentPage) pageBtn.classList.add('active');
            paginationContainer.appendChild(pageBtn);
        }
    });

    const nextBtn = createPageButton('&rarr;', () => {
        if (currentPage < totalPages) onPageChange(currentPage + 1);
    }, !nextPageUrl);
    paginationContainer.appendChild(nextBtn);
}
