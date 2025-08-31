<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\DetalleFactura;
use App\Models\Presentacion;
use App\Models\Cliente;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Factura::with('detalles.presentacion', 'cliente')->paginate(10);
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $presentaciones = Presentacion::with('producto')->get(); // traemos presentaciones con su producto
        $clientes = Cliente::all();
        return view('ventas.create', compact('presentaciones', 'clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
            'productos' => 'required|array|min:1',
            'productos.*.presentacion_id' => 'required|exists:presentaciones,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        $venta = Factura::create([
            'cliente_id' => $request->cliente_id,
            'fecha' => $request->fecha,
            'total' => 0,
        ]);

        $total = 0;

        foreach ($request->productos as $item) {
            $presentacion = Presentacion::findOrFail($item['presentacion_id']);
            $cantidad = $item['cantidad'];
            $precio = $presentacion->precio;
            $subtotal = $cantidad * $precio;

            DetalleFactura::create([
                'factura_id' => $venta->id,
                'presentacion_id' => $presentacion->id,
                'cantidad' => $cantidad,
                'precio_unitario' => $precio,
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        $venta->update(['total' => $total]);

        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
    }

    public function show(Factura $venta)
    {
        $venta->load(['cliente', 'detalles.presentacion.producto']);
        return view('ventas.show', compact('venta'));
    }

    public function edit(Factura $venta)
    {
        $presentaciones = Presentacion::with('producto')->get();
        $clientes = Cliente::all();
        $venta->load('detalles.presentacion');
        return view('ventas.edit', compact('venta', 'presentaciones', 'clientes'));
    }

    public function update(Request $request, Factura $venta)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
            'productos' => 'required|array|min:1',
            'productos.*.presentacion_id' => 'required|exists:presentaciones,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        $venta->update([
            'cliente_id' => $request->cliente_id,
            'fecha' => $request->fecha,
        ]);

        $venta->detalles()->delete();
        $total = 0;

        foreach ($request->productos as $item) {
            $presentacion = Presentacion::findOrFail($item['presentacion_id']);
            $cantidad = $item['cantidad'];
            $precio = $presentacion->precio;
            $subtotal = $cantidad * $precio;

            DetalleFactura::create([
                'factura_id' => $venta->id,
                'presentacion_id' => $presentacion->id,
                'cantidad' => $cantidad,
                'precio_unitario' => $precio,
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        $venta->update(['total' => $total]);

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente.');
    }

    public function destroy(Factura $venta)
    {
        $venta->detalles()->delete();
        $venta->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    }
}