<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite('resources/css/app.scss')
    @vite('resources/js/app.js')
</head>

<body>

    @include('partials.navbar')
    @include('partials.header')
    @include('partials.filters')
    @include('partials.results')
    @include('partials.logistic')
    @include('partials.gallery')
    @include('partials.create_client')
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
