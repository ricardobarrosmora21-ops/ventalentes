<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function index()
    {
        $facturas = Factura::with(['cliente', 'detalles.presentacion'])->latest('fecha')->paginate(10);
        $total = $facturas->sum('total');

        return view('reportes.index', compact('facturas', 'total'));
    }

    public function detalle(Factura $factura)
    {
        $factura->load(['cliente', 'detalles.presentacion']);
        return view('reportes.detalle', compact('factura'));
    }

    // ✅ Nuevo método para generar PDF del reporte completo
    public function generarPDF()
    {
        $facturas = Factura::with(['cliente', 'detalles.presentacion'])->latest('fecha')->get();
        $total = $facturas->sum('total');

        $pdf = Pdf::loadView('reportes.pdf', compact('facturas', 'total'));
        return $pdf->download('reporte_ventas.pdf');
    }
}
