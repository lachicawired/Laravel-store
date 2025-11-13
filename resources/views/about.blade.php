<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros - TEAM6</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .team-member img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            object-fit: cover;
        }
        footer {
            background-color: #111;
            color: #bbb;
            padding: 40px 0;
            margin-top: 80px;
        }
        footer a {
            color: #bbb;
            text-decoration: none;
        }
        footer a:hover {
            color: #fff;
        }
    </style>
</head>
<body>

 <!-- Navbar -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4"> 
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('products') }}">
            <img src="https://i.postimg.cc/Fd3NSTm4/unnamed.jpg" alt="TEAM6 Logo" width="40" height="40" class="me-2">
            <span>TEAM6</span>
        </a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('custom-order.form') }}">Encargo Personal</a>
                </li>
            </ul>
        </div>

        <div class="d-flex align-items-center ms-auto">
            <a href="{{ route('cart.show') }}" class="btn btn-dark position-relative me-3">
                🛒 Carrito
                <span id="cart-counter" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ count(session('cart', [])) }}
                </span>
            </a>

            @auth
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end bg-dark text-white" aria-labelledby="userMenu">
                        <li><a class="dropdown-item text-white" href="{{ route('profile.show') }}">👤 Mi perfil</a></li>
                        <li><hr class="dropdown-divider bg-secondary"></li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Registrarse</a>
            @endauth
        </div>
    </div>
</nav>

<!-- Contenido principal -->
<div class="container text-center mt-5 mb-5">
    <h1 class="fw-bold mb-4">Sobre Nosotros</h1>
    <p class="lead text-muted mb-5">
        En <strong>TEAM6</strong> En TEAM6, entendemos que el coleccionismo es mucho más que un pasatiempo; es una pasión, una inversión y la búsqueda constante de lo extraordinario.
Nacimos de la frustración de ver cómo los coleccionistas en México se enfrentaban a barreras logísticas, de autenticidad y de acceso al intentar adquirir piezas de alto valor en el extranjero.
Decidimos crear una solución: un portal premium y de confianza dedicado a ser el puente entre los tesoros más exclusivos del mundo y los coleccionistas más exigentes de México.
    </p>

    <img src="https://i.postimg.cc/Fd3NSTm4/unnamed.jpg" class="img-fluid rounded shadow mb-5" style="max-width: 250px;" alt="TEAM6 Logo">

    <h3 class="fw-semibold mb-3">Nuestra Mision</h3>
    <p class="text-muted mb-5">
        TEAM6 se especializa en curar y facilitar la adquisición de artículos que definen el coleccionismo de alta gama.
Nuestro catálogo no es solo una lista de productos; es una selección rigurosa de piezas que cumplen con el más alto estándar de rareza y valor:

Importación sin fronteras: Traemos a tu alcance lo inalcanzable. Desde figuras de anime de edición limitada provenientes de Japón, hasta Trading Cards (TCG) graduadas por las principales agencias certificadoras o camisetas de jugadores match-worn.

Lujo sobre ruedas: Nos adentramos en el mundo de la inversión tangible, facilitando la importación y adquisición de automóviles de colección y deportivos exóticos, tratando cada transacción con la discreción y el rigor que se merecen.

Servicio de encargo personal: Si existe un artículo único en el mundo que deseas poseer, nuestro equipo se encarga de la búsqueda, la negociación y el proceso logístico para hacerlo llegar a tu puerta de forma segura y certificada.
    </p>

    <h2 class="fw-bold mb-4">Conoce al Equipo</h2>
    <div class="row justify-content-center">
        <div class="col-md-3 team-member mb-4">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRbMiZJA3T6HzD4F_-wJhfW75F5B0YI5TNLKA&s" alt="Miembro 1">
            <h5 class="mt-3">Lachica</h5>
            <p class="text-muted">Desarrollador de Backend</p>
        </div>
        <div class="col-md-3 team-member mb-4">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGqFpqaU6vSyeR2kDf5HguoASjzHzKFt6x_A&s" alt="Miembro 2">
            <h5 class="mt-3">Saul</h5>
            <p class="text-muted">Desarrollador de Frontend</p>
        </div>
        <div class="col-md-3 team-member mb-4">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTcv70yD8xo8AsNVsu8IwzfW5tKxlGUZ7OxqQ&s" alt="Miembro 3">
            <h5 class="mt-3">Andres</h5>
            <p class="text-muted">Desarrollador de Frontend</p>
        </div>
    </div>

    <a href="{{ route('products') }}" class="btn btn-primary mt-4">Volver a la Tienda</a>
</div>

<!-- Footer -->
<footer>
    <div class="container text-center">
        <p class="mb-1">&copy; {{ date('Y') }} TEAM6 - Todos los derechos reservados.</p>
        <p class="mb-0">
            <a href="{{ route('products') }}">Inicio</a> |
            <a href="{{ route('about') }}">Sobre Nosotros</a> |
            <a href="{{ route('cart.show') }}">Carrito</a>
        </p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
