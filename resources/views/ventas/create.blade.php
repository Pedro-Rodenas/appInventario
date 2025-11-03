<!DOCTYPE html>
<html>

<head>
    <title>Registrar Venta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="p-4">
    <h2>Registrar Venta</h2>

    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Producto</label>
            <select name="producto_id" class="form-control" required>
                <option value="">-- Selecciona un producto --</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }} (Stock: {{ $producto->cantidad }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Cantidad a vender</label>
            <input type="number" name="cantidad_vendida" class="form-control" min="1" required>
        </div>
        <button class="btn btn-success">Registrar</button>
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</body>

</html>