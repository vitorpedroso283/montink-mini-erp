<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cupons & Pedidos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @livewireStyles
</head>

<body class="bg-light text-dark">
    <div class="d-flex justify-content-end p-2">
        <button class="btn btn-outline-dark position-relative" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas">
            Carrinho
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ session('cart.items') ? count(session('cart.items')) : 0 }}
            </span>
        </button>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Carrinho</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            @livewire('cart-manager')
        </div>
    </div>

    <div class="container py-4">
        {{ $slot }}
    </div>

    {{-- Scripts --}}
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>