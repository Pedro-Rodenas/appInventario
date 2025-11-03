<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="login-wrapper">
        <div class="login-card">
            <h3>Iniciar Sesión</h3>

            @if($errors->any())
                <div class="alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required
                        autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn-primary">Entrar</button>
            </form>

            <!-- Link a registro -->
            <p class="text-center mt-3 register-link">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}">Regístrate aquí</a>
            </p>
        </div>
    </div>
</body>

</html>