@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6">

            <h1 class="text-2xl font-bold text-gray-800 mb-2">Reporte de Ventas</h1>
            <p class="text-sm text-gray-500 mb-6">Resumen de facturas registradas</p>

            <h2 class="text-lg font-semibold mb-4">Resumen</h2>
            <p class="mb-6"><strong>Total vendido:</strong> ${{ number_format($total, 2) }}</p>

            <h2 class="text-lg font-semibold mb-4">Listado de Facturas</h2>
            <table class="min-w-full border border-gray-300 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Cliente</th>
                        <th class="px-4 py-2 border">Fecha</th>
                        <th class="px-4 py-2 border">Total</th>
                        <th class="px-4 py-2 border">Detalles</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($facturas as $factura)
                        <tr>
                            <td class="px-4 py-2 border">{{ $factura->id }}</td>
                            <td class="px-4 py-2 border">{{ $factura->cliente->nombre ?? '—' }}</td>
                            <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2 border">${{ number_format($factura->total, 2) }}</td>
                            <td class="px-4 py-2 border">
                                <ul class="list-disc list-inside text-gray-600">
                                    @foreach($factura->detalles as $detalle)
                                        <li>
                                            {{ $detalle->presentacion->nombre ?? 'N/A' }} —
                                            {{ $detalle->cantidad }} x ${{ number_format($detalle->precio_unitario, 2) }}
                                            = ${{ number_format($detalle->subtotal, 2) }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-2 border text-center text-gray-500">
                                No hay facturas registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-6">
                {{ $facturas->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
