<!DOCTYPE html>
<html>
<head>
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

    <a href="{{ url('/') }}" class="btn btn-secondary mb-3">← Seguir comprando</a>

    <h1 class="mb-4">🛍️ Carrito de Compras</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($cart) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
<tr>
    <td>
        <img src="{{ $item['image'] }}" width="60">
        {{ $item['name'] }}
    </td>
    <td class="price">${{ number_format($item['price'], 2) }}</td>

    <td>
    <button class="btn btn-sm btn-warning" 
            onclick="updateQuantity({{ $id }}, -1)" 
            id="btn-minus-{{ $id }}"
            {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>−</button>

    <span id="qty-{{ $id }}" data-stock="{{ $item['stock'] ?? \App\Models\Product::find($id)->stock }}">
        {{ $item['quantity'] }}
    </span>

    <button class="btn btn-sm btn-success" 
            onclick="updateQuantity({{ $id }}, 1)" 
            id="btn-plus-{{ $id }}"
            {{ $item['quantity'] >= (\App\Models\Product::find($id)->stock ?? 999) ? 'disabled' : '' }}>+</button>

    <p class="text-muted mt-1 mb-0">
        Stock: <strong>{{ $item['stock'] ?? 'N/A' }}</strong>
    </p>
</td>


    <td class="subtotal" id="subtotal-{{ $id }}">
        ${{ number_format($item['price'] * $item['quantity'], 2) }}
    </td>

    <td>
        <form action="{{ route('cart.remove', $id) }}" method="POST">
            @csrf
            <button class="btn btn-danger btn-sm">Eliminar</button>
        </form>
    </td>
</tr>
@endforeach

            </tbody>
        </table>

        <h3>Total: $<span id="total">
            {{ number_format(array_sum(array_map(fn($i) => $i['price']*$i['quantity'], $cart)), 2) }}
        </span></h3>

        <a href="{{ route('cart.checkout') }}" class="btn btn-success mt-3">Finalizar compra</a>

    @else
        <p>No hay productos en el carrito.</p>
    @endif

<script>
function updateQuantity(productId, change) {
    const qtyElement = document.getElementById(`qty-${productId}`);
    const maxStock = parseInt(qtyElement.dataset.stock);
    const btnMinus = document.getElementById(`btn-minus-${productId}`);
    const btnPlus = document.getElementById(`btn-plus-${productId}`);
    let newQuantity = parseInt(qtyElement.textContent) + change;

    // Evitar valores fuera de rango
    if (newQuantity < 1 || newQuantity > maxStock) return;

    fetch(`/cart/update/${productId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ quantity: newQuantity })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Actualiza cantidad
            qtyElement.textContent = newQuantity;

            // Actualiza subtotal y total
            document.getElementById(`subtotal-${productId}`).textContent = 
                `$${data.subtotal.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;
            document.getElementById('total').textContent = 
                data.total.toLocaleString('en-US', { minimumFractionDigits: 2 });

            // ✅ Deshabilita botones según cantidad
            btnMinus.disabled = newQuantity <= 1;
            btnPlus.disabled = newQuantity >= maxStock;
        } else if (data.error) {
            alert(data.error);
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>







</body>
</html>
