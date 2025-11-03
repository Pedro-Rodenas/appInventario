<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /* Listar ventas */
    public function index()
    {
        $ventas = Venta::with('producto')->get();
        return view('ventas.index', compact('ventas'));
    }

    /* Formulario nueva venta */
    public function create()
    {
        $productos = Producto::where('cantidad', '>', 0)->get();
        return view('ventas.create', compact('productos'));
    }

    /* Guardar venta */
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad_vendida' => 'required|integer|min:1'
        ]);

        $producto = Producto::find($request->producto_id);

        if ($producto->cantidad < $request->cantidad_vendida) {
            return redirect()->back()->with('error', 'No hay suficiente stock para esta venta.');
        }

        $total = $producto->precio * $request->cantidad_vendida;

        Venta::create([
            'producto_id' => $producto->id,
            'cantidad_vendida' => $request->cantidad_vendida,
            'precio_unitario' => $producto->precio,
            'total' => $total,
        ]);

        $producto->decrement('cantidad', $request->cantidad_vendida);

        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
    }

    /* Eliminar venta */
    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada.');
    }
}
