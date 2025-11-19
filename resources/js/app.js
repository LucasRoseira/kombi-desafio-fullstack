import './bootstrap';
import initClients from './services/client/Client';
import initViaCep from './services/viaCep';

document.addEventListener('DOMContentLoaded', () => {
    initClients();
    initViaCep();
});
