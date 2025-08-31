@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6">

            @if(session('success'))
                <div class="mb-4 text-green-600 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filtros -->
            <form method="GET" action="{{ route('ventas.index') }}" class="mb-6 flex flex-wrap gap-4">
                <input type="text" name="cliente" value="{{ request('cliente') }}"
                       placeholder="Buscar cliente..." class="px-4 py-2 border rounded w-1/3">

                <input type="date" name="desde" value="{{ request('desde') }}"
                       class="px-4 py-2 border rounded">

                <input type="date" name="hasta" value="{{ request('hasta') }}"
                       class="px-4 py-2 border rounded">

                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Filtrar
                </button>
            </form>

            <div class="flex justify-between mb-4">
                <h3 class="text-lg font-medium">Resumen</h3>
                <a href="{{ route('ventas.create') }}"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Nueva Venta
                </a>
            </div>

            <p class="mb-6"><strong>Total vendido en esta página:</strong> ${{ number_format($total ?? 0, 2) }}</p>

            <!-- Tabla de ventas -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Cliente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Productos</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($ventas as $venta)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $venta->id }}</td>
                                <td class="px-6 py-4">{{ $venta->cliente->nombre ?? 'Sin cliente' }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">${{ number_format($venta->total, 2) }}</td>
                                <td class="px-6 py-4">
                                    <ul class="list-disc list-inside text-gray-600">
                                        @foreach ($venta->detalles as $detalle)
                                            <li>
                                                {{ $detalle->presentacion->producto->nombre ?? '—' }}
                                                ({{ $detalle->presentacion->nombre ?? '—' }})
                                                x {{ $detalle->cantidad }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('ventas.show', $venta->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Ver</a>
                                    
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    <p>No hay ventas registradas</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $ventas->appends(request()->query())->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
