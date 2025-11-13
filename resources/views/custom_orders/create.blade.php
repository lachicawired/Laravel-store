@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg mx-auto" style="max-width: 600px; background-color: white;">
        <div class="card-body">
            <h2 class="text-center mb-4 text-dark">Encargar un objeto especial</h2>

            <form method="POST" action="{{ route('custom-order.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-dark">Nombre del objeto:</label>
                    <input type="text" name="name" class="form-control border-dark" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-dark">Descripción:</label>
                    <textarea name="description" class="form-control border-dark" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label text-dark">Precio:</label>
                    <input type="number" step="0.01" name="price" class="form-control border-dark" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-dark">País donde se encuentra:</label>
                    <input type="text" name="country" class="form-control border-dark" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-dark">URL de imagen:</label>
                    <input type="url" name="image_url" class="form-control border-dark" placeholder="https://example.com/imagen.jpg" required>
                </div>

                <div class="mb-4">
                    <label class="form-label text-dark">Tu correo electrónico:</label>
                    <input type="email" name="email" class="form-control border-dark" required>
                </div>

                <button type="submit" class="btn btn-dark w-100 py-2">
                    Enviar solicitud
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
