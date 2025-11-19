<section id="cadastro-cliente" class="container mt-4 text-center">
    <div class="btn-filter mt-3">
        <img src="{{ Vite::asset('resources/images/black_recycle_icon.png') }}" alt="">
        CADASTRAR CLIENTE
    </div>

    <h2 class="title-main mt-4">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vehicula
    </h2>

    <form class="mt-4 text-start mx-auto form-area" id="form-client">
        <div class="row g-3">

            <div class="col-md-3">
                <label class="form-label">Nome completo</label>
                <input type="text" id="create-name" class="form-control custom-input"
                    placeholder="Digite o nome completo">
            </div>

            <div class="col-md-3">
                <label class="form-label">E-mail</label>
                <input type="email" id="create-email" class="form-control custom-input" placeholder="Digite o e-mail">
            </div>

            <div class="col-md-3">
                <label class="form-label">Telefone</label>
                <input type="text" id="create-phone" class="form-control custom-input"
                    placeholder="Digite seu número de telefone">
            </div>

            <div class="col-md-3">
                <label class="form-label">CNPJ da empresa</label>
                <input type="text" id="create-cnpj" class="form-control custom-input"
                    placeholder="Digite o CNPJ da empresa">
            </div>

            <div class="col-md-3">
                <label class="form-label">CEP</label>
                <input type="text" id="create-cep" class="form-control custom-input"
                    placeholder="Digite o CEP da empresa">
            </div>

            <div class="col-md-3 dropdown-wrapper ">
                <label class="form-label">Estado</label>
                <input type="text" id="create-state" class="form-control custom-input"
                    placeholder="Selecione o estado">
                <div id="create-state-dropdown" class="dropdown-options"></div>
            </div>

            <div class="col-md-3">
                <label class="form-label">Cidade</label>
                <input type="text" id="create-city" class="form-control custom-input" placeholder="Digite a cidade">
            </div>

            <div class="col-md-3">
                <label class="form-label">Logradouro</label>
                <input type="text" id="create-street" class="form-control custom-input"
                    placeholder="Digite o nome da rua">
            </div>

            <div class="col-md-3">
                <label class="form-label">Número</label>
                <input type="text" id="create-number" class="form-control custom-input"
                    placeholder="Digite o número">
            </div>

            <div class="col-md-3">
                <label class="form-label">Complemento</label>
                <input type="text" id="create-neighborhood" class="form-control custom-input"
                    placeholder="Digite o complemento, se houver">
            </div>

            <div class="col-md-3 d-flex align-items-center justify-content-start mt-5">
                <input type="checkbox" id="create-agree" class="custom-check me-2">
                <label for="create-agree">Estou de acordo</label>
            </div>

            <div class="col-md-3 d-flex align-items-center justify-content-start mt-4">
                <button class="btn-dark btn-custom" id="btn-create">
                    <img src="{{ Vite::asset('resources/images/arrow_right.png') }}" alt="">
                    CADASTRAR
                </button>
            </div>

        </div>
    </form>
    <div id="popup-message" class="popup-message">
        <div class="popup-content">
            <span id="popup-close" class="popup-close">&times;</span>
            <p id="popup-text"></p>
        </div>
    </div>

</section>
