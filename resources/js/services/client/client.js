import ClientService from './ClientService';

export default function initClients() {
    const resultsWrapper = document.querySelector('.results-wrapper');
    if (!resultsWrapper) return;

    const resultTitle = document.querySelector('.result-title');
    const paginationContainer = createPaginationContainer(resultsWrapper);
    const clientService = new ClientService();
    let currentPage = 1;
    const perPage = 5;
    const filters = { state: '', city: '', supplier: '' };

    const stateInput = document.querySelector('.custom-input:nth-of-type(1)');
    const cityInput = document.querySelector('.city-input');
    const supplierSelect = document.querySelector('.combo');
    const filterBtn = document.querySelector('.btn-filtrar');

    async function loadStates() {
        if (!stateInput) return;
        const states = await clientService.getStates();
        const dataList = document.createElement('datalist');
        dataList.id = 'states-list';
        states.forEach(s => {
            const option = document.createElement('option');
            option.value = s;
            dataList.appendChild(option);
        });
        document.body.appendChild(dataList);
        stateInput.setAttribute('list', 'states-list');
    }

    async function loadCities(state) {
        if (!cityInput || !state) return;

        const cities = await clientService.getCities(state);
        let dataList = document.getElementById('cities-list');
        if (!dataList) {
            dataList = document.createElement('datalist');
            dataList.id = 'cities-list';
            document.body.appendChild(dataList);
        }

        dataList.innerHTML = '';
        cities.forEach(c => {
            const option = document.createElement('option');
            option.value = c;
            dataList.appendChild(option);
        });

        cityInput.setAttribute('list', 'cities-list');
    }

    async function loadSuppliersName() {
        if (!supplierSelect) return;

        const state = stateInput?.value.trim();
        const city = cityInput?.value.trim();
        if (!state || !city) return;

        const suppliers = await clientService.getSuppliersName({ state, city });

        supplierSelect.innerHTML = '<option selected>Selecione...</option>';
        suppliers.forEach(name => {
            const option = document.createElement('option');
            option.value = name;
            option.textContent = name;
            supplierSelect.appendChild(option);
        });
    }

    stateInput?.addEventListener('input', async () => {
        const state = stateInput.value.trim();
        filters.state = state;

        filters.city = '';
        filters.supplier = '';

        if (cityInput) cityInput.value = '';
        if (supplierSelect) supplierSelect.selectedIndex = 0;

        if (state) await loadCities(state);
        await loadSuppliersName();
    });

    cityInput?.addEventListener('input', async () => {
        const city = cityInput.value.trim();
        filters.city = city;

        filters.supplier = '';
        if (supplierSelect) supplierSelect.selectedIndex = 0;

        await loadSuppliersName();
    });

    supplierSelect?.addEventListener('change', () => {
        filters.supplier = supplierSelect.value;
    });

    async function renderResults(page = 1, firstLoad = false) {
        try {
            const response = await clientService.getClients(perPage, page, filters);
            const clients = response.data || [];
            const totalPages = response.last_page || 1;

            renderClientBoxes(clients);
            renderPagination(totalPages, response.prev_page_url, response.next_page_url);

            const noFiltersApplied = !filters.state && !filters.city && (!filters.supplier || filters.supplier === 'Selecione...');
            if (firstLoad || noFiltersApplied) {
                resultTitle.textContent = 'Todos os fornecedores';
            } else {
                resultTitle.textContent = 'Resultado do Filtro lorem ipsum dolor sit';
            }
        } catch (err) {
            console.error('Erro ao carregar resultados:', err);
        }
    }


    function renderClientBoxes(clients) {
        resultsWrapper.innerHTML = '';
        clients.forEach(client => {
            const box = document.createElement('div');
            box.className = 'results-box mt-4 p-3 text-start';
            box.innerHTML = `
                <p class="result-line"><strong>Nome:</strong> <span>${client.name}</span></p>
                <p class="result-line"><strong>Estado:</strong> <span>${client.state}</span></p>
                <p class="result-line"><strong>Cidade:</strong> <span>${client.city}</span></p>
            `;
            resultsWrapper.appendChild(box);
        });
    }

    function renderPagination(totalPages, prevPageUrl, nextPageUrl) {
        paginationContainer.innerHTML = '';

        const prevBtn = createPageButton('&larr;', () => {
            if (currentPage > 1) {
                currentPage--;
                renderResults(currentPage);
            }
        }, !prevPageUrl);
        paginationContainer.appendChild(prevBtn);

        createPageNumbers(totalPages);

        const nextBtn = createPageButton('&rarr;', () => {
            if (currentPage < totalPages) {
                currentPage++;
                renderResults(currentPage);
            }
        }, !nextPageUrl);
        paginationContainer.appendChild(nextBtn);
    }

    function createPaginationContainer(parent) {
        const container = document.createElement('div');
        container.className = 'pagination mt-3 d-flex justify-content-center gap-2';
        parent.parentNode.appendChild(container);
        return container;
    }

    function createPageButton(label, onClick, disabled = false) {
        const btn = document.createElement('button');
        btn.innerHTML = label;
        btn.disabled = disabled;
        btn.className = 'btn btn-light';
        btn.addEventListener('click', onClick);
        return btn;
    }

    function createPageNumbers(totalPages) {
        const delta = 2;
        const pages = [];
        for (let i = 1; i <= totalPages; i++) {
            if (i === 1 || i === totalPages || (i >= currentPage - delta && i <= currentPage + delta)) {
                pages.push(i);
            } else if (pages[pages.length - 1] !== '...') {
                pages.push('...');
            }
        }

        pages.forEach(p => {
            if (p === '...') {
                const dots = document.createElement('span');
                dots.textContent = '...';
                dots.className = 'px-2';
                paginationContainer.appendChild(dots);
            } else {
                const pageBtn = createPageButton(p, () => {
                    currentPage = p;
                    renderResults(currentPage);
                });
                if (p === currentPage) pageBtn.classList.add('active');
                paginationContainer.appendChild(pageBtn);
            }
        });
    }

    async function initialize() {
        await loadStates();
        currentPage = 1;
        await renderResults(currentPage, true);
    }

    async function onFilterClick() {
        const state = stateInput?.value.trim();
        const city = cityInput?.value.trim();
        const supplier = supplierSelect?.value;

        const appliedFilters = {};
        if (state) appliedFilters.state = state;
        if (city) appliedFilters.city = city;
        if (supplier && supplier !== 'Selecione...') appliedFilters.supplier = supplier;

        Object.assign(filters, appliedFilters);
        currentPage = 1;
        await renderResults(currentPage);
    }

    filterBtn?.addEventListener('click', onFilterClick);

    initialize();
}
