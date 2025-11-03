@extends('layouts.app')

@section('title', 'Reportes del Sistema')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/reportes.css') }}">

    <div class="container-fluid py-4">
        <h1 class="mb-4 text-center fw-bold text-primary">Panel de Reportes del Sistema</h1>
        <p class="text-center text-muted mb-5">Visualiza tus ventas, productos y desempeño general del inventario.</p>

        <!-- ======= TARJETAS RESUMEN ======= -->
        <div class="row mb-5 text-center" id="resumen-cards">
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm bg-primary text-white">
                    <div class="card-body">
                        <h5>Total Ventas</h5>
                        <h2 id="totalVentas">S/ 0.00</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm bg-success text-white">
                    <div class="card-body">
                        <h5>Productos Vendidos</h5>
                        <h2 id="productosVendidos">0</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm bg-warning text-white">
                    <div class="card-body">
                        <h5>Clientes Atendidos</h5>
                        <h2 id="clientesAtendidos">0</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm bg-danger text-white">
                    <div class="card-body">
                        <h5>Productos Agotados</h5>
                        <h2 id="productosAgotados">0</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- ======= GRÁFICOS ======= -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">Ventas Mensuales</div>
                    <div class="card-body">
                        <canvas id="ventasMensuales"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">Productos Más Vendidos</div>
                    <div class="card-body">
                        <canvas id="productosVendidosChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">Evolución de Ventas (Últimos Meses)</div>
                    <div class="card-body">
                        <canvas id="evolucionVentas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", async () => {
            const res = await fetch("{{ route('reportes.datos') }}");
            const data = await res.json();

            // === TARJETAS ===
            document.getElementById('totalVentas').textContent = "S/ " + data.resumen.totalVentas;
            document.getElementById('productosVendidos').textContent = data.resumen.productosVendidos;
            document.getElementById('clientesAtendidos').textContent = data.resumen.clientesAtendidos;
            document.getElementById('productosAgotados').textContent = data.resumen.productosAgotados;

            // === FUNCION GENERICA PARA CREAR GRAFICOS ===
            function crearGrafico(ctx, tipo, etiquetas, datos, opcionesExtra = {}) {
                return new Chart(ctx, {
                    type: tipo,
                    data: {
                        labels: etiquetas,
                        datasets: [{
                            data: datos,
                            backgroundColor: ['#2B2D6E', '#D4AF37', '#4CAF50', '#E74C3C', '#3498DB'],
                            borderColor: '#fff',
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { position: 'bottom' } },
                        ...opcionesExtra
                    }
                });
            }

            // === GRAFICOS ===
            crearGrafico(
                document.getElementById('ventasMensuales'),
                'bar',
                data.ventasMensuales.map(v => v.mes),
                data.ventasMensuales.map(v => v.total),
                { scales: { y: { beginAtZero: true } } }
            );

            crearGrafico(
                document.getElementById('productosVendidosChart'),
                'pie',
                data.productosMasVendidos.map(p => p.nombre),
                data.productosMasVendidos.map(p => p.cantidad)
            );

            crearGrafico(
                document.getElementById('evolucionVentas'),
                'line',
                data.evolucion.map(e => e.mes),
                data.evolucion.map(e => e.total),
                { scales: { y: { beginAtZero: true } }, tension: 0.4, fill: true }
            );
        });
    </script>
@endsection