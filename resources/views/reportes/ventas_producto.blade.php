@extends('layouts.app')

@section('title', 'Reporte de Ventas por Producto')

@section('content')
    <div class="container">
        <h2>Reporte de Ventas por Producto</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad Vendida</th>
                    <th>Total Recaudado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr>
                        <td>{{ $venta->producto->nombre }}</td>
                        <td>{{ $venta->total_vendido }}</td>
                        <td>S/ {{ number_format($venta->total_recaudado, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection