<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle Factura') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                <p><strong>ID:</strong> {{ $factura->id }}</p>
                <p><strong>Cliente:</strong> {{ $factura->cliente->nombre }}</p>
                <p><strong>Fecha:</strong> {{ $factura->fecha }}</p>
                <p><strong>Total:</strong> ${{ number_format($factura->total, 2) }}</p>

                <h3 class="mt-4 font-semibold">Productos</h3>
                <table class="w-full mt-2 text-sm text-left border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-2">Producto</th>
                            <th class="p-2">Cantidad</th>
                            <th class="p-2">Precio</th>
                            <th class="p-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($factura->detalles as $detalle)
                            <tr>
                                <td class="p-2">{{ $detalle->producto->nombre }}</td>
                                <td class="p-2">{{ $detalle->cantidad }}</td>
                                <td class="p-2">${{ number_format($detalle->precio, 2) }}</td>
                                <td class="p-2">${{ number_format($detalle->cantidad * $detalle->precio, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    <a href="{{ route('facturas.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg">Volver</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
