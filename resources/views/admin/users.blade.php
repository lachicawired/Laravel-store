@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center text-light mb-4">Usuarios Registrados</h1>

    <!-- Buscador -->
    <form method="GET" action="{{ route('admin.users.index') }}" class="mb-4 d-flex justify-content-center">
        <input type="text" name="search" value="{{ request('search') }}" 
            class="form-control w-50 me-2" placeholder="Buscar por ID o nombre...">
        <button type="submit" class="btn btn-primary">🔍 Buscar</button>
    </form>

    <!-- Tabla de usuarios -->
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle">
            <thead class="table-secondary text-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Admin</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_admin ? 'Sí' : 'No' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No se encontraron usuarios</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
