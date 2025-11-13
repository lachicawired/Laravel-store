<!DOCTYPE html>
<html>
<head>
    <title>TEAM6 - Tienda Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        footer {
            background-color: #111;
            color: #aaa;
            padding: 40px 0;
            margin-top: 60px;
        }
        footer a {
            color: #bbb;
            text-decoration: none;
        }
        footer a:hover {
            color: white;
        }
        .social-icons a {
            font-size: 1.5rem;
            margin-right: 15px;
        }
        .logo-footer {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            margin-right: 10px;
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
                    <a class="nav-link" href="{{ route('about') }}">About Us</a>
                </li>
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
    <div class="container">
        <h1 class="mb-4 text-center">Productos disponibles</h1>

        <div class="row">
            @foreach($products as $p)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($p->image)
                            <img src="{{ $p->image }}" class="card-img-top" alt="{{ $p->name }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $p->name }}</h5>
                            <p class="card-text text-muted">{{ $p->description }}</p>
                            <p class="card-text fw-bold">${{ number_format($p->price, 2) }}</p>
                            <p class="text-muted mb-1">Stock disponible: <strong>{{ $p->stock }}</strong></p>

                            <form action="{{ route('cart.add', $p->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button 
                                    class="btn btn-primary add-to-cart" 
                                    data-id="{{ $p->id }}" 
                                    {{ $p->stock <= 0 ? 'disabled' : '' }}>
                                    🛒 Agregar al carrito
                                </button>

                                @if($p->stock <= 0)
                                    <small class="text-danger d-block mt-1">Agotado</small>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container text-center">
            <p class="mb-2">&copy; {{ date('Y') }} TEAM6 - Todos los derechos reservados.</p>
            <p class="mb-3">
                <a href="{{ route('products') }}" class="text-white text-decoration-none">Inicio</a> |
                <a href="{{ route('about') }}" class="text-white text-decoration-none">Sobre Nosotros</a> |
                <a href="{{ route('cart.show') }}" class="text-white text-decoration-none">Carrito</a>
            </p>

            <!-- Botón de logout -->
            @auth
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        🚪 Cerrar sesión
                    </button>
                </form>
            @endauth
        </div>
    </footer>

    <!-- JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js"></script>
    <script>
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.id;
                const token = '{{ csrf_token() }}';

                fetch('/cart/add/' + productId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({})
                })
                .then(res => res.json())
                .then(data => {
                    if(data.success){
                        const counter = document.getElementById('cart-counter');
                        if(counter){
                            counter.textContent = data.totalItems;
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
