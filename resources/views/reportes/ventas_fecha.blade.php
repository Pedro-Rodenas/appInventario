@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Reporte de Ventas por Fecha</h2>

        <form method="GET" action="{{ route('reportes.ventas.fecha') }}" class="mb-3">
            <label>Desde:</label>
            <input type="date" name="inicio" value="{{ $inicio ?? '' }}">
            <label>Hasta:</label>
            <input type="date" name="fin" value="{{ $fin ?? '' }}">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>

        @if(isset($ventas))
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Total (S/)</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ventas as $v)
                        <tr>
                            <td>{{ $v->producto->nombre }}</td>
                            <td>{{ $v->cantidad }}</td>
                            <td>{{ $v->total }}</td>
                            <td>{{ $v->fecha_venta }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No hay ventas en el rango seleccionado</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endif
    </div>
@endsection