<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - TEAM6</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
			
            background-color: #121212;
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
			
        }

        .login-card {
            background: #1e1e1e;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.4);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
        }
        .login-card img {
            width: 70px;
            margin-bottom: 1rem;
        }
        a {
            color: #0d6efd;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-card text-center">
        <img src="https://i.postimg.cc/Fd3NSTm4/unnamed.jpg" alt="TEAM6 Logo" class="rounded-circle mb-3">
        <h3 class="mb-4">Bienvenido a <strong>TEAM6</strong></h3>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3 text-start">
                <label for="email" class="form-label">Correo electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" 
                       required autofocus 
                       class="form-control bg-dark text-white border-secondary">
            </div>

            <div class="mb-3 text-start">
                <label for="password" class="form-label">Contraseña</label>
                <input id="password" type="password" name="password" 
                       required 
                       class="form-control bg-dark text-white border-secondary">
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                    <label class="form-check-label" for="remember_me">Recuérdame</label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="small">¿Olvidaste tu contraseña?</a>
                @endif
            </div>

            <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>

            <p class="mt-3 mb-0">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}">Regístrate</a>
            </p>
        </form>
    </div>

</body>
</html>
