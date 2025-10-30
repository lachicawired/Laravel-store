<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h1 class="mb-4">✅ Compra realizada con éxito</h1>

    <p><strong>Número de orden:</strong> {{ $order->id }}</p>
    <p><strong>Fecha:</strong> {{ $order->created_at->timezone('America/Los_Angeles')->format('d/m/Y H:i') }}</p>
    <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>

    <h3>Productos:</h3>
    <ul>
        @foreach($order->items as $item)
            <li>{{ $item->name }} - ${{ number_format($item->price, 2) }} x {{ $item->quantity }}</li>
        @endforeach
    </ul>

    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Volver a Productos</a>
</body>
</html>
