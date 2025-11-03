<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="login-wrapper">
        <div class="login-card">
            <h3>Crear Cuenta</h3>

            @if($errors->any())
                <div class="alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required
                        autofocus>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                        required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        required>
                </div>
                <button type="submit" class="btn-primary">Registrar</button>
            </form>

            <p style="text-align: center;" class="mt-3 text-center">
                ¿Ya tienes cuenta? <a href="{{ route('login') }}" style="color:#2B2D6E; font-weight:600;">Inicia
                    Sesión</a>
            </p>
        </div>
    </div>
</body>

</html>