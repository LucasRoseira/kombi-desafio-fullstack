<section id="cadastro-cliente" class="container mt-4 text-center">
    <div class="btn-filter mt-3">
        <img src="{{ Vite::asset('resources/images/black_recycle_icon.png') }}" alt="">
        CADASTRAR CLIENTE
    </div>

    <h2 class="title-main mt-4">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vehicula
    </h2>

    <form class="mt-4 text-start mx-auto form-area">
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Nome completo</label>
                <input type="text" class="form-control custom-input">
            </div>

            <div class="col-md-3">
                <label class="form-label">E-mail</label>
                <input type="email" class="form-control custom-input">
            </div>

            <div class="col-md-3">
                <label class="form-label">Telefone</label>
                <input type="text" class="form-control custom-input">
            </div>

            <div class="col-md-3">
                <label class="form-label">CNPJ da empresa</label>
                <input type="text" class="form-control custom-input">
            </div>

            <div class="col-md-3">
                <label class="form-label">CEP</label>
                <input type="text" class="form-control custom-input">
            </div>

            <div class="col-md-3">
                <label class="form-label">Estado</label>
                <select class="form-select custom-select">
                    <option>Selecione o estado</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Cidade</label>
                <select class="form-select custom-select">
                    <option>Selecione a cidade</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Logradouro</label>
                <input type="text" class="form-control custom-input">
            </div>

            <div class="col-md-3">
                <label class="form-label">Número</label>
                <input type="text" class="form-control custom-input">
            </div>

            <div class="col-md-3">
                <label class="form-label">Complemento</label>
                <input type="text" class="form-control custom-input">
            </div>

            <div class="col-md-3 d-flex align-items-center justify-content-start mt-4">
                <input type="checkbox" class="me-2">
                <label class="me-2">Estou de acordo</label>
            </div>

            <!-- BOTÃO -->
            <div class="col-md-3 d-flex align-items-center justify-content-start mt-4">
                <button class="btn-dark btn-custom">
                    <img src="{{ Vite::asset('resources/images/arrow_right.png') }}" alt="">
                    CADASTRAR
                </button>
            </div>

        </div>
    </form>
</section>
