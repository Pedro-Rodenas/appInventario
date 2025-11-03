@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Reporte de Productos Agotados</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos as $p)
                    <tr>
                        <td>{{ $p->nombre }}</td>
                        <td>{{ $p->descripcion }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">No hay productos agotados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection