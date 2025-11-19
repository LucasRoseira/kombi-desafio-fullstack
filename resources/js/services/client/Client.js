import ClientService from './ClientService.js';
import { setupDropdown, hideAllDropdowns } from './Dropdown.js';
import { createPaginationContainer, renderPagination } from './Pagination.js';
import { showPopupMessage, initPopupMessage } from './PopupMessage.js';

export default function initClients() {
    const resultsWrapper = document.querySelector('.results-wrapper');
    if (!resultsWrapper) return;

    const resultTitle = document.querySelector('.result-title');
    const paginationContainer = createPaginationContainer(resultsWrapper);
    const clientService = new ClientService();
    let currentPage = 1;
    const perPage = 5;
    const filters = { state: '', city: '', supplier: '' };

    const stateInput = document.querySelector('.dropdown-wrapper input');
    const stateDropdown = document.querySelector('.dropdown-wrapper .dropdown-options');

    const cityInput = document.querySelector('.city-input');
    const cityDropdown = document.querySelector('.city-dropdown');

    const supplierInput = document.querySelector('.supplier-input');
    const supplierDropdown = document.querySelector('.supplier-dropdown');

    const filterBtn = document.querySelector('.btn-filtrar');
    
    const createForm = document.querySelector('#form-client');
    const createButton = createForm.querySelector('#btn-create');

    initPopupMessage();
    
    let allStates = [];
    let allCities = [];

    function clearCityAndSupplier() {
        filters.city = '';
        filters.supplier = '';
        cityInput.value = '';
        supplierInput.value = '';
        cityDropdown.innerHTML = '';
        supplierDropdown.innerHTML = '';
    }

    function clearSupplier() {
        filters.supplier = '';
        supplierInput.value = '';
        supplierDropdown.innerHTML = '';
    }

    stateInput.addEventListener('input', () => {
        if (!stateInput.value.trim()) {
            filters.state = '';
            clearCityAndSupplier();
            hideAllDropdowns();
        }
    });

    cityInput.addEventListener('input', () => {
        if (!cityInput.value.trim()) {
            filters.city = '';
            clearSupplier();
            hideAllDropdowns();
        }
    });

    async function loadStates() {
        allStates = await clientService.getStates();
        setupDropdown(stateInput, stateDropdown, allStates, async (selectedState) => {
            filters.state = selectedState;
            clearCityAndSupplier();
            await loadCities(selectedState);
        });
    }

    async function loadCities(state) {
        if (!state) return;
        allCities = await clientService.getCities(state);
        setupDropdown(cityInput, cityDropdown, allCities, async () => {
            filters.city = cityInput.value;
            clearSupplier();
            await loadSuppliers();
        });
    }

    async function loadSuppliers() {
        const state = stateInput.value.trim();
        const city = cityInput.value.trim();
        if (!state || !city) return;

        const suppliers = await clientService.getSuppliersName({ state, city });
        setupDropdown(supplierInput, supplierDropdown, suppliers, () => {
            filters.supplier = supplierInput.value;
        });
    }

    function renderClientBoxes(clients) {
        resultsWrapper.innerHTML = '';
        clients.forEach(client => {
            const box = document.createElement('div');
            box.className = 'results-box mt-4 p-3 text-start';
            box.innerHTML = `
                <p><strong>Nome:</strong> ${client.name}</p>
                <p><strong>Estado:</strong> ${client.state}</p>
                <p><strong>Cidade:</strong> ${client.city}</p>
            `;
            resultsWrapper.appendChild(box);
        });
    }

    async function renderResults(page = 1, firstLoad = false) {
        try {
            const response = await clientService.getClients(perPage, page, filters);
            const clients = response.data || [];
            const totalPages = response.last_page || 1;

            renderClientBoxes(clients);
            renderPagination(totalPages, page, paginationContainer, (p) => {
                currentPage = p;
                renderResults(p);
            }, response.prev_page_url, response.next_page_url);

            const noFiltersApplied = !filters.state && !filters.city && (!filters.supplier || filters.supplier === 'Selecione...');
            resultTitle.textContent = firstLoad || noFiltersApplied ? 'Todos os fornecedores' : 'Resultado do Filtro';
        } catch (err) {
            console.error('Erro ao carregar resultados:', err);
        }
    }

    filterBtn.addEventListener('click', async () => {
        currentPage = 1;
        await renderResults(currentPage);
    });

    async function initialize() {
        await loadStates();
        currentPage = 1;
        await renderResults(currentPage, true);
    }

    
    createButton.addEventListener('click', async (e) => {
        e.preventDefault();

        const name = document.querySelector('#create-name').value.trim();
        const email = document.querySelector('#create-email').value.trim();
        const phone = document.querySelector('#create-phone').value.trim();
        const cnpj = document.querySelector('#create-cnpj').value.trim();
        const cep = document.querySelector('#create-cep').value.trim();
        const state = document.querySelector('#create-state').value.trim();
        const city = document.querySelector('#create-city').value.trim();
        const street = document.querySelector('#create-street').value.trim();
        const number = document.querySelector('#create-number').value.trim();
        const neighborhood = document.querySelector('#create-neighborhood').value.trim();
        const agree = document.querySelector('#create-agree').checked;

        if (!name || !email || !phone || !cnpj || !cep || !state || !city || !street || !number) {
            return showPopupMessage('Por favor, preencha todos os campos obrigatórios.');
        }

        if (!agree) {
            return showPopupMessage('Você precisa aceitar os termos para prosseguir.');
        }

        const clientData = { name, email, phone, cnpj, cep, state, city, street, number, neighborhood, agree };

        try {
            const data = await clientService.createClient(clientData);
            showPopupMessage(data.message || 'Cliente cadastrado com sucesso!');
            createForm.reset();
            await renderResults(currentPage);
        } catch (err) {
            showPopupMessage('Erro: ' + (err.message || 'Não foi possível cadastrar o cliente.'));
        }
    });

    initialize();
}
