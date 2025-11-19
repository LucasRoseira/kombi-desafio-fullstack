<section id="logistica" class="text-center mt-2">

    <div class="btn-filter mt-3">
        <img src="{{ Vite::asset('resources/images/black_recycle_icon.png') }}" alt="">
        LOGÍSTICA REVERSA
    </div>

    <div class="gallery-box p-4 pt-2 pb-2 mx-auto">
        <h3 class="gallery-title">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vehicula
        </h3>

        <p class="gallery-text mt-3">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vehicula risus et eros sagittis semper.
            Integer vulputate, est ac molestie tempus, sem nunc ultricies odio, et tristique purus lacus ac leo.
        </p>
    </div>


    <button class="btn-dark btn-custom mt-4">
        <img src="{{ Vite::asset('resources/images/arrow_right.png') }}" alt="">
        SABER MAIS
    </button>
    @include('partials.gallery')
</section>
