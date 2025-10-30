<!DOCTYPE html>
<html>
<head>
    <title>Panel Admin - Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
<a href="{{ route('cart.show') }}" class="btn btn-dark mb-3">
    🛒 Ver carrito ({{ count(session('cart', [])) }})
</a>
    <h1 class="mb-4">Productos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
<form method="GET" action="{{ route('admin.products.index') }}" class="mb-3 d-flex">
    <input type="text" name="search" class="form-control me-2" placeholder="Buscar por nombre o ID" value="{{ request('search') }}">
    <button type="submit" class="btn btn-primary">Buscar</button>
</form>



    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Agregar Producto</a>

    <table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->description }}</td>
            <td>${{ number_format($p->price, 2) }}</td>
            <td>
                @if($p->image)
                    <img src="{{ $p->image }}" width="60">
                @endif
            </td>
            <td>
                <a href="{{ route('admin.products.edit', $p->id) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar producto?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

</body>
</html>
