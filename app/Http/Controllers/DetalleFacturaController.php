<?php

namespace App\Http\Controllers;

use App\Models\DetalleFactura;
use App\Models\Factura;
use Illuminate\Http\Request;

class DetalleFacturaController extends Controller
{
    public function index()
    {
        $detalles = DetalleFactura::with('factura')->paginate(10);
        return view('detalles.index', compact('detalles'));
    }

    public function create()
    {
        // Necesitamos las facturas para asociar el detalle
        $facturas = Factura::all();
        return view('detalles.create', compact('facturas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'factura_id' => 'required|exists:facturas,id',
            'producto'   => 'required|string|max:255',
            'cantidad'   => 'required|integer|min:1',
            'precio'     => 'required|numeric|min:0',
        ]);

        DetalleFactura::create($request->all());

        return redirect()->route('detalles.index')->with('success', 'Detalle agregado correctamente.');
    }

    public function show(DetalleFactura $detalle)
    {
        return view('detalles.show', compact('detalle'));
    }

    public function edit(DetalleFactura $detalle)
    {
        $facturas = Factura::all();
        return view('detalles.edit', compact('detalle', 'facturas'));
    }

    public function update(Request $request, DetalleFactura $detalle)
    {
        $request->validate([
            'factura_id' => 'required|exists:facturas,id',
            'producto'   => 'required|string|max:255',
            'cantidad'   => 'required|integer|min:1',
            'precio'     => 'required|numeric|min:0',
        ]);

        $detalle->update($request->all());

        return redirect()->route('detalles.index')->with('success', 'Detalle actualizado correctamente.');
    }

    public function destroy(DetalleFactura $detalle)
    {
        $detalle->delete();
        return redirect()->route('detalles.index')->with('success', 'Detalle eliminado correctamente.');
    }
}
