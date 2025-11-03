@extends('layouts.app')

@section('title', 'Gestión de Productos')

@section('content')
    <h1>Listado de Ventas</h1>

    <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-3">Registrar Venta</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Cantidad Vendida</th>
                <th>Precio Unitario</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->producto->nombre }}</td>
                    <td>{{ $venta->cantidad_vendida }}</td>
                    <td>S/ {{ $venta->precio_unitario }}</td>
                    <td><strong>S/ {{ $venta->total }}</strong></td>
                    <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST"
                            onsubmit="return confirm('¿Eliminar venta?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection