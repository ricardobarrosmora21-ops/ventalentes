<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reporte de Ventas') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Total vendido: ${{ number_format($total, 2) }}</h3>

                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Cliente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($facturas as $factura)
                            <tr>
                                <td class="px-6 py-4">{{ $factura->id }}</td>
                                <td class="px-6 py-4">{{ $factura->cliente->nombre ?? '—' }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">${{ number_format($factura->total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $facturas->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
