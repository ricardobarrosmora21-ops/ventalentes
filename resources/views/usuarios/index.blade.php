@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

            <h3 class="text-lg font-bold mb-4">Resumen</h3>
            <p><strong>Total vendido:</strong> ${{ number_format($total, 2) }}</p>

            <h3 class="text-lg font-bold mt-6 mb-4">Listado de facturas</h3>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Cliente</th>
                        <th class="px-4 py-2 border">Fecha</th>
                        <th class="px-4 py-2 border">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ventas as $factura)
                        <tr>
                            <td class="px-4 py-2 border">{{ $factura->id }}</td>
                            <td class="px-4 py-2 border">{{ $factura->cliente->nombre }}</td>
                            <td class="px-4 py-2 border">{{ $factura->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-2 border">${{ number_format($factura->total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div