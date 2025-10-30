<!DOCTYPE html>
<html>
<head>
    <title>TEAM6 - Tienda Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar con logo y carrito -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('products') }}">
                <img src="https://i.postimg.cc/Fd3NSTm4/unnamed.jpg" 
                     alt="TEAM6 Logo" width="40" height="40" class="me-2">
                <span>TEAM6</span>
            </a>
            <div class="ms-auto">
                <a href="{{ route('cart.show') }}" class="btn btn-dark position-relative">
    🛒 Carrito
    <span id="cart-counter" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
        {{ count(session('cart', [])) }}
    </span>
</a>
            </div>
        </div>
    </nav>

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
							<p class="text-muted mb-1"> Stock disponible: <strong>{{ $p->stock }}</strong>
</p>

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
                // Actualizamos la bolita roja
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
