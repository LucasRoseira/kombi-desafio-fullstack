export default class ViaCepService {
    async buscarCep(cep) {
        try {
            const apenasNumeros = cep.replace(/\D/g, '');

            if (apenasNumeros.length !== 8) {
                return { erro: true, mensagem: "CEP inválido" };
            }

            const response = await fetch(`https://viacep.com.br/ws/${apenasNumeros}/json/`);

            if (!response.ok) {
                return { erro: true, mensagem: "Erro ao consultar ViaCEP" };
            }

            const data = await response.json();

            if (data.erro) {
                return { erro: true, mensagem: "CEP não encontrado" };
            }

            return {
                erro: false,
                cep: data.cep,
                rua: data.logradouro,
                bairro: data.bairro,
                cidade: data.localidade,
                estado: data.uf
            };

        } catch (err) {
            return { erro: true, mensagem: "Erro inesperado" };
        }
    }
}
