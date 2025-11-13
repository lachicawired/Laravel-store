<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEAM6 - Tienda</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Estilos personalizados (opcional) --}}
    <style>
        body {
            background-color: #121212;
            color: #fff;
        }

        .navbar-brand span {
            font-weight: 700;
            letter-spacing: 1px;
        }

        .dropdown-menu a:hover {
            background-color: #1f1f1f;
        }
    </style>
</head>
<body>
    {{-- 🔹 Navbar Global --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('products') }}">
                <img src="https://i.postimg.cc/Fd3NSTm4/unnamed.jpg" alt="TEAM6 Logo" width="40" height="40" class="me-2">
                <span>TEAM6</span>
            </a>

            {{-- Botón para versión móvil --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Contenido del navbar --}}
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About Us</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center ms-auto">
                    {{-- Carrito --}}
                    <a href="{{ route('cart.show') }}" class="btn btn-dark position-relative me-3">
                        🛒 Carrito
                        <span id="cart-counter" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ count(session('cart', [])) }}
                        </span>
                    </a>

                    {{-- Usuario --}}
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" id="userMenu"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end bg-dark text-white" aria-labelledby="userMenu">
                                <li>
                                    <a class="dropdown-item text-white" href="{{ route('profile.show') }}">👤 Mi perfil</a>
                                </li>
                                <li><hr class="dropdown-divider bg-secondary"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">🚪 Cerrar sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Iniciar sesión</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Registrarse</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- 🔹 Contenido dinámico --}}
    <div class="container mb-5">
        @yield('content')
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
