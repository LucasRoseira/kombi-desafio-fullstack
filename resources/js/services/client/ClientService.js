export default class ClientService {
    constructor(baseUrl = '/api/clients') {
        this.baseUrl = baseUrl;
    }

    async getClients(perPage = 100, page = 1, filters = {}) {
        try {
            const params = new URLSearchParams({ per_page: perPage, page, ...filters });
            const response = await fetch(`${this.baseUrl}?${params.toString()}`, {
                headers: { 'Accept': 'application/json' },
            });
            if (!response.ok) throw new Error('Erro ao buscar fornecedores');
            return await response.json();
        } catch (error) {
            return { data: [], last_page: 1 };
        }
    }


    async getStates() {
        const response = await fetch('/api/clients/states', {
            headers: { 'Accept': 'application/json' },
        });
        return response.ok ? await response.json() : [];
    }

    async getCities(state) {
        const response = await fetch(`/api/clients/cities?state=${encodeURIComponent(state)}`, {
            headers: { 'Accept': 'application/json' },
        });
        return response.ok ? await response.json() : [];
    }

    async getSuppliers(filters = {}) {
        const params = new URLSearchParams(filters);
        const response = await fetch(`/api/clients?${params.toString()}`, {
            headers: { 'Accept': 'application/json' },
        });
        if (!response.ok) return [];
        const data = await response.json();
        return data.data || [];
    }

    async getSuppliersName(filters = {}) {
        const params = new URLSearchParams(filters);
        const response = await fetch(`/api/clients/suppliers?${params.toString()}`, {
            headers: { 'Accept': 'application/json' },
        });
        if (!response.ok) return [];
        return await response.json();
    }
}
