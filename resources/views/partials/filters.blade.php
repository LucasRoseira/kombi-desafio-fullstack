<section id="filtros" class="container text-center mt-4">

    <div class="btn-filter">
        <img src="{{ Vite::asset('resources/images/black_recycle_icon.png') }}" alt="">
        FILTRO LOREM IPSUM
    </div>

    <h2 class="title-main mt-4">Encontre lorem ipsum dolor sit amet, consectetur</h2>
    <p class="subtitle-main mt-2">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vehicula risus et eros sagittis semper.
    </p>

    <div class="row mt-4 g-3 justify-content-center">

    <div class="col-12 col-md-3 text-start">
        <label class="form-label">Estado</label>
        <input type="text" class="form-control custom-input" placeholder="Digite o estado...">
    </div>

    <div class="col-12 col-md-3 text-start">
        <label class="form-label">Cidade</label>
        <input type="text" class="form-control custom-input city-input" placeholder="Digite a cidade...">
    </div>

        <div class="col-12 col-md-3 text-start">
            <label class="form-label">Nome do fornecedor</label>
            <select class="form-select combo custom-select">
                <option selected>Selecione...</option>
            </select>
        </div>
        <div class="col-12 col-md-3 d-flex align-items-end">
            <button class="btn-dark btn-custom btn-filtrar w-100">FILTRAR</button>
        </div>
    </div>
</section>
