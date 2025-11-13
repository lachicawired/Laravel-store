@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Peticiones de Encargo</h1>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>País</th>
                <th>Email</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td class="text-center">
                        @if($order->image_url)
                            <img src="{{ $order->image_url }}" alt="Imagen" width="80" height="80" class="rounded">
                        @else
                            <span class="text-muted">Sin imagen</span>
                        @endif
                    </td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->description }}</td>
                    <td>${{ number_format($order->price, 2) }}</td>
                    <td>{{ $order->country }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
