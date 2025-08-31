<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva Factura') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('facturas.store') }}" method="POST">
                    @csrf

                    {{-- Cliente --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Cliente</label>
                        <select name="cliente_id" class="mt-1 block w-full rounded-md border-gray-300">
                            <option value="">Seleccione un cliente</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Fecha --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Fecha</label>
                        <input type="date" name="fecha" value="{{ now()->toDateString() }}"
                               class="mt-1 block w-full rounded-md border-gray-300">
                    </div>

                    {{-- Productos dinámicos --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Productos</label>
                        <table class="w-full text-sm text-left border">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="p-2">Producto</th>
                                    <th class="p-2">Cantidad</th>
                                    <th class="p-2">Precio</th>
                                    <th class="p-2">Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="detalle">
                                <tr>
                                    <td class="p-2">
                                        <select name="productos[0][producto_id]" class="w-full rounded-md border-gray-300">
                                            <option value="">Seleccione</option>
                                            @foreach($productos as $producto)
                                                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="p-2"><input type="number" name="productos[0][cantidad]" value="1" min="1" class="w-20 border rounded"></td>
                                    <td class="p-2"><input type="number" name="productos[0][precio]" step="0.01" class="w-24 border rounded"></td>
                                    <td class="p-2"><input type="text" readonly class="w-24 border rounded bg-gray-100"></td>
                                    <td class="p-2"><button type="button" class="text-red-600" onclick="removeRow(this)">X</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" onclick="addRow()" class="mt-2 px-3 py-1 bg-blue-600 text-white rounded">Agregar Producto</button>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('facturas.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg mr-2">Cancelar</a>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let row = 1;
        function addRow() {
            let detalle = document.getElementById('detalle');
            let tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="p-2">
                    <select name="productos[${row}][producto_id]" class="w-full rounded-md border-gray-300">
                        <option value="">Seleccione</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="p-2"><input type="number" name="productos[${row}][cantidad]" value="1" min="1" class="w-20 border rounded"></td>
                <td class="p-2"><input type="number" name="productos[${row}][precio]" step="0.01" class="w-24 border rounded"></td>
                <td class="p-2"><input type="text" readonly class="w-24 border rounded bg-gray-100"></td>
                <td class="p-2"><button type="button" class="text-red-600" onclick="removeRow(this)">X</button></td>
            `;
            detalle.appendChild(tr);
            row++;
        }
        function removeRow(btn) {
            btn.closest('tr').remove();
        }
    </script>
</x-app-layout>
