<!DOCTYPE html>
<html>
<head>
    <title>TEAM6 - Tienda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <a class="navbar-brand" href="{{ route('products') }}">
            <img src="https://i.postimg.cc/Fd3NSTm4/unnamed.jpg" alt="TEAM6" width="50" class="d-inline-block align-text-top">
            TEAM6
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('cart.show') }}">🛒 Carrito</a></li>
                @auth
                    @if(auth()->user()->is_admin)
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.products.index') }}">Admin Productos</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.orders.index') }}">Órdenes</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="#">{{ auth()->user()->name }}</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrar</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
