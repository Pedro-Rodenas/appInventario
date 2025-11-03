<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Inventario')</title>

    <!-- Bootstrap y FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
</head>

<body>
    <aside id="sidebar" class="minimized">
        <div class="logo">
            <i class="fa-solid fa-boxes-stacked"></i>
            <span>Sistema</span>
        </div>
        <ul>
            <li onclick="window.location.href='{{ route('productos.index') }}'">
                <i class="fa-solid fa-box"></i>
                <span>Productos</span>
            </li>
            <li onclick="window.location.href='{{ route('ventas.index') }}'">
                <i class="fa-solid fa-cart-shopping"></i>
                <span>Ventas</span>
            </li>
            <li onclick="window.location.href='{{ route('reportes.index') }}'">
                <i class="fa-solid fa-chart-line"></i>
                <span>Reportes</span>
            </li>
            <!-- Logout -->
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="all:unset; cursor:pointer; display:flex; align-items:center;">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span style="margin-left:10px;">Cerrar Sesión</span>
                    </button>
                </form>
            </li>
        </ul>

    </aside>

    <main>
        @yield('content')
    </main>

    <script src="{{ asset('js/sidebar.js') }}"></script>
</body>

</html>