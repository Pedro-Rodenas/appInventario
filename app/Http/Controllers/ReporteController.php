<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index()
    {
        return view('reportes.index');
    }

    public function obtenerDatos()
    {
        // ======= RESUMEN =======
        $totalVentas = Venta::sum('total') ?? 0;
        $productosVendidos = Venta::sum('cantidad_vendida') ?? 0;
        $clientesAtendidos = Venta::count('id');
        $productosAgotados = Producto::where('cantidad', '<=', 0)->count();

        // ======= VENTAS MENSUALES =======
        // Usamos MONTH() y SUM(total)
        $ventasMensuales = Venta::selectRaw('MONTH(created_at) as mes_num, SUM(total) as total')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'), 'asc')
            ->get()
            ->map(function ($v) {
                $meses = [
                    1 => 'Enero',
                    2 => 'Febrero',
                    3 => 'Marzo',
                    4 => 'Abril',
                    5 => 'Mayo',
                    6 => 'Junio',
                    7 => 'Julio',
                    8 => 'Agosto',
                    9 => 'Setiembre',
                    10 => 'Octubre',
                    11 => 'Noviembre',
                    12 => 'Diciembre'
                ];
                return [
                    'mes' => $meses[$v->mes_num],
                    'total' => $v->total
                ];
            });

        // ======= PRODUCTOS MÁS VENDIDOS =======
        $productosMasVendidos = Venta::select('producto_id', DB::raw('SUM(cantidad_vendida) as cantidad'))
            ->groupBy('producto_id')
            ->orderByDesc('cantidad')
            ->take(5)
            ->get()
            ->map(function ($v) {
                $producto = Producto::find($v->producto_id);
                return [
                    'nombre' => $producto ? $producto->nombre : 'Producto eliminado',
                    'cantidad' => $v->cantidad
                ];
            });

        // ======= EVOLUCIÓN VENTAS ÚLTIMOS MESES =======
        $evolucion = Venta::selectRaw("FORMAT(created_at, 'yyyy-MM') as mes, SUM(total) as total")
            ->groupBy(DB::raw("FORMAT(created_at, 'yyyy-MM')"))
            ->orderBy('mes', 'asc')
            ->get();


        return response()->json([
            'resumen' => [
                'totalVentas' => $totalVentas,
                'productosVendidos' => $productosVendidos,
                'clientesAtendidos' => $clientesAtendidos,
                'productosAgotados' => $productosAgotados,
            ],
            'ventasMensuales' => $ventasMensuales,
            'productosMasVendidos' => $productosMasVendidos,
            'evolucion' => $evolucion,
        ]);
    }
}
