<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\DetalleFactura;
use App\Models\Presentacion;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::with('detalles.presentacion', 'cliente')->paginate(10);
        return view('facturas.index', compact('facturas'));
    }

    public function create()
    {
        $presentaciones = Presentacion::all();
        $clientes = Cliente::all();
        return view('facturas.create', compact('presentaciones', 'clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
        ]);

        $factura = Factura::create([
            'user_id'    => auth()->id(), // 🔥 ahora sí se guarda
            'cliente_id' => $request->cliente_id,
            'fecha'      => $request->fecha,
            'total'      => 0,
        ]);

        $total = 0;

        if ($request->has('detalles')) {
            foreach ($request->detalles as $detalle) {
                $subtotal = $detalle['cantidad'] * $detalle['precio_unitario'];
                DetalleFactura::create([
                    'factura_id'       => $factura->id,
                    'presentacion_id'  => $detalle['presentacion_id'],
                    'cantidad'         => $detalle['cantidad'],
                    'precio_unitario'  => $detalle['precio_unitario'],
                    'subtotal'         => $subtotal,
                ]);
                $total += $subtotal;
            }
        }

        $factura->update(['total' => $total]);

        return redirect()->route('facturas.index')->with('success', 'Factura creada correctamente.');
    }

    public function show(Factura $factura)
    {
        $factura->load(['cliente', 'detalles.presentacion.producto']);
        return view('facturas.show', compact('factura'));
    }

    public function edit(Factura $factura)
    {
        $factura->load('detalles.presentacion');
        $presentaciones = Presentacion::all();
        $clientes = Cliente::all();
        return view('facturas.edit', compact('factura', 'presentaciones', 'clientes'));
    }

    public function update(Request $request, Factura $factura)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
        ]);

        $factura->update([
            'cliente_id' => $request->cliente_id,
            'fecha' => $request->fecha,
        ]);

        $factura->detalles()->delete();
        $total = 0;

        if ($request->has('detalles')) {
            foreach ($request->detalles as $detalle) {
                $subtotal = $detalle['cantidad'] * $detalle['precio_unitario'];
                DetalleFactura::create([
                    'factura_id'       => $factura->id,
                    'presentacion_id'  => $detalle['presentacion_id'],
                    'cantidad'         => $detalle['cantidad'],
                    'precio_unitario'  => $detalle['precio_unitario'],
                    'subtotal'         => $subtotal,
                ]);
                $total += $subtotal;
            }
        }

        $factura->update(['total' => $total]);

        return redirect()->route('facturas.index')->with('success', 'Factura actualizada correctamente.');
    }

    public function destroy(Factura $factura)
    {
        $factura->detalles()->delete();
        $factura->delete();
        return redirect()->route('facturas.index')->with('success', 'Factura eliminada correctamente.');
    }

    // ✅ Generar PDF
    public function generarPDF(Factura $factura)
    {
        $factura->load(['cliente', 'detalles.presentacion.producto']);
        $pdf = Pdf::loadView('facturas.pdf', compact('factura'));
        return $pdf->download('factura_' . $factura->id . '.pdf');
    }
}
