<section id="filtros" class="container text-center mt-4">

    <div class="btn-filter">
        <img src="{{ Vite::asset('resources/images/black_recycle_icon.png') }}" alt="">
        FILTRO LOREM IPSUM
    </div>

    <h2 class="title-main mt-4">Encontre lorem ipsum dolor sit amet, consectetur</h2>
    <p class="subtitle-main mt-2">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vehicula risus et eros sagittis semper.
    </p>

    <div class="filters-row">
        <div class="dropdown-wrapper col-12 col-md-2 text-start">
            <label class="form-label">Estado</label>
            <input type="text" class="form-control custom-input" placeholder="Digite o estado..." />
            <div class="dropdown-options"></div>
        </div>

        <div class="dropdown-wrapper col-12 col-md-2 text-start">
            <label class="form-label">Cidade</label>
            <input type="text" class="form-control custom-input city-input" placeholder="Digite a cidade...">
            <div class="dropdown-options city-dropdown"></div>
        </div>

        <div class="dropdown-wrapper col-12 col-md-3 text-start">
            <label class="form-label">Nome do fornecedor</label>
            <input type="text" class="form-control custom-input supplier-input" placeholder="Digite o fornecedor...">
            <div class="dropdown-options supplier-dropdown"></div>
        </div>

        <div class="col-12 col-md-2 d-flex align-items-end">
            <button class="btn-dark btn-custom btn-filtrar w-100">FILTRAR</button>
        </div>

    </div>
</section>
