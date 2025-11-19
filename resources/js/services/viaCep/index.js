import ViaCepService from './ViaCepService';
import { setupDropdown, hideAllDropdowns } from '../client/Dropdown.js';
import { BRAZIL_STATES } from '../../utils/states.js';
import { maskCEP, maskCNPJ, maskPhone, maskEmail } from '../../utils/masks.js';

export default function initViaCepCadastro() {
    const viaCepService = new ViaCepService();

    const cepInput = document.querySelector('#create-cep');
    const streetInput = document.querySelector('#create-street');
    const neighborhoodInput = document.querySelector('#create-neighborhood');
    const stateInput = document.querySelector('#create-state');
    const cityInput = document.querySelector('#create-city');
    
    const cnpjInput = document.querySelector('#create-cnpj');
    const phoneInput = document.querySelector('#create-phone');
    const emailInput = document.querySelector('#create-email');

    const stateDropdown = document.querySelector('#create-state-dropdown');

    if (!cepInput || !stateInput || !stateDropdown || !cityInput) return;

    function applyMask(input, maskFn) {
        if (!input) return;
        input.addEventListener('input', () => {
            input.value = maskFn(input.value);
        });
    }

    applyMask(cepInput, maskCEP);
    applyMask(cnpjInput, maskCNPJ);
    applyMask(phoneInput, maskPhone);
    applyMask(emailInput, maskEmail);

    setupDropdown(stateInput, stateDropdown, BRAZIL_STATES, (selectedState) => {
        stateInput.value = selectedState;
        cityInput.value = '';
    });

    cepInput.addEventListener('blur', async () => {
        const cep = cepInput.value.trim();
        if (!cep) return;

        const result = await viaCepService.buscarCep(cep);

        if (result.erro) {
            console.warn(result.mensagem);
            return;
        }

        streetInput.value = result.rua || '';
        neighborhoodInput.value = result.bairro || '';
        stateInput.value = result.estado;
        cityInput.value = result.cidade;

        if (!BRAZIL_STATES.includes(result.estado)) BRAZIL_STATES.push(result.estado);
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('.dropdown-wrapper')) hideAllDropdowns();
    });
}
