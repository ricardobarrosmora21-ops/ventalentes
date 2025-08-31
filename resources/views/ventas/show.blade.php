@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6">

            <h2 class="text-xl font-bold mb-4">Factura #{{ $venta->numero }}</h2>

            <p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}</p>
            <p><strong>Total:</strong> ${{ number_format($venta->total, 2) }}</p>

            <hr class="my-4">

            <h3 class="text-md font-semibold mb-2">Detalle de productos</h3>
            <table class="w-full text-sm border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Producto</th>
                        <th class="px-4 py-2 border">Presentación</th>
                        <th class="px-4 py-2 border">Cantidad</th>
                        <th class="px-4 py-2 border">Precio Unitario</th>
                        <th class="px-4 py-2 border">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($venta->detalles as $detalle)
                        <tr>
                            <td class="px-4 py-2 border">{{ $detalle->presentacion->producto->nombre ?? '—' }}</td>
                            <td class="px-4 py-2 border">{{ $detalle->presentacion->nombre ?? '—' }}</td>
                            <td class="px-4 py-2 border">{{ $detalle->cantidad }}</td>
                            <td class="px-4 py-2 border">${{ number_format($detalle->precio_unitario, 2) }}</td>
                            <td class="px-4 py-2 border">${{ number_format($detalle->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 flex justify-between">
                <a href="{{ route('ventas.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                    Volver
                </a>

                <a href="{{ route('facturas.pdf', $venta->id) }}" target="_blank"
                   class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Descargar PDF
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
