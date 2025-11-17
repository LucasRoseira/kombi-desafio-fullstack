<section id="cadastro-cliente" class="container mt-5 text-center">
    <div class="tag-box mt-3">
        <img src="{{ Vite::asset('resources/images/black_recycle_icon.png') }}" alt="">
        CADASTRAR CLIENTE
    </div>
    <h2 class="title-main mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vehicula</h2>


    <form class="mt-4 text-start mx-auto form-area">
        <div class="row g-3">
            <div class="col-md-6"><input type="text" class="form-control" placeholder="Digite seu nome completo"></div>
            <div class="col-md-6"><input type="email" class="form-control" placeholder="Digite seu melhor email">
            </div>
            <div class="col-md-6"><input type="text" class="form-control"
                    placeholder="Digite seu número de telefone"></div>
            <div class="col-md-6"><input type="text" class="form-control" placeholder="Digite o CNPJ da empresa">
            </div>
            <div class="col-md-3"><input type="text" class="form-control" placeholder="Digite o CEP"></div>
            <div class="col-md-3"><select class="form-select custom-select">
                    <option>Selecione o estado</option>
                </select></div>
            <div class="col-md-3"><select class="form-select custom-select">
                    <option>Selecione a cidade</option>
                </select></div>
            <div class="col-md-3"><input type="text" class="form-control" placeholder="Digite o logradouro"></div>
            <div class="col-md-3"><input type="text" class="form-control" placeholder="Número"></div>
            <div class="col-md-9"><input type="text" class="form-control" placeholder="Complemento"></div>


            <div class="col-12 d-flex align-items-center mt-3">
                <input type="checkbox" class="me-2"><label>Estou de acordo com as Políticas de Privacidade</label>
            </div>


            <div class="col-12 text-center mt-4">
                <button class="btn-dark btn-custom">
                    <img src="{{ Vite::asset('resources/images/arrow_right.png') }}" alt="">
                    CADASTRAR
                </button>
            </div>

        </div>
    </form>
</section>
