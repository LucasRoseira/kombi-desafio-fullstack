<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lorem ipsum sit</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        @vite('resources/css/app.scss')
    @vite('resources/js/app.js')
    </head>
    <body>
        @include('partials.navbar')
        @include('partials.header')
        <section id="filters">
            @include('partials.filters')
        </section>
        @include('partials.results')
        <section id="logistica">
            @include('partials.logistic')
        </section>
        <section id="galeria">
            @include('partials.gallery')
        </section>
        <section id="create-client">
            @include('partials.create_client')
        </section>
        <footer id="footer">
            @include('partials.footer')
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
