<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrarse - TEAM6</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
		 label, p, a, h1, h2, h3, h4, h5, h6, span {
        color: white !important;
    }
        .card {
            background: #1f1f1f;
            border: none;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.4);
            width: 100%;
            max-width: 420px;
        }
        a { color: #0d6efd; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .form-control {
            background-color: #2a2a2a;
            border: 1px solid #333;
            color: white;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: none;
        }
    </style>
</head>
<body>
    <div class="card text-center">
        <img src="https://i.postimg.cc/Fd3NSTm4/unnamed.jpg" width="80" class="rounded-circle mb-3" alt="TEAM6 Logo">
        <h3 class="mb-4">Crea tu cuenta</h3>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3 text-start">
                <label for="name" class="form-label">Nombre</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="form-control">
            </div>

            <div class="mb-3 text-start">
                <label for="email" class="form-label">Correo electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-control">
            </div>

            <div class="mb-3 text-start">
                <label for="password" class="form-label">Contraseña</label>
                <input id="password" type="password" name="password" required class="form-control">
            </div>

            <div class="mb-3 text-start">
                <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required class="form-control">
            </div>

            <button type="submit" class="btn btn-primary w-100">Registrarme</button>

            <p class="mt-3 mb-0">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}">Inicia sesión</a>
            </p>
        </form>
    </div>
</body>
</html>
