<!DOCTYPE html>
<html>
<head>
    <title>Órdenes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h1 class="mb-4">Órdenes</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Productos</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $o)
            <tr>
                <td>{{ $o->id }}</td>
                <td>{{ $o->created_at->timezone('America/Los_Angeles')->format ('d/m/Y H:i') }}</td>
                <td>${{ number_format($o->total, 2) }}</td>
                <td>{{ $o->status }}</td>
                <td>
                    <ul>
                        @foreach($o->items as $item)
                            <li>{{ $item->name }} x {{ $item->quantity }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <form action="{{ route('admin.orders.updateStatus', $o->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-select mb-2">
                            <option value="pendiente" {{ $o->status=='pendiente'?'selected':'' }}>Pendiente</option>
                            <option value="completada" {{ $o->status=='completada'?'selected':'' }}>Completada</option>
                            <option value="cancelada" {{ $o->status=='cancelada'?'selected':'' }}>Cancelada</option>
                        </select>
                        <button class="btn btn-sm btn-success">Actualizar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
