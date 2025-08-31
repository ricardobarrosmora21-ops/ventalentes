@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6">Registrar Venta</h2>

            <form action="{{ route('ventas.store') }}" method="POST">
                @csrf

                <!-- Cliente -->
                <div class="mb-4">
                    <label for="cliente_id" class="block font-medium text-gray-700">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="w-full border rounded p-2" required>
                        <option value="">Seleccione un cliente</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="fecha" class="block font-medium text-gray-700">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="w-full border rounded p-2" value="{{ date('Y-m-d') }}"
                        required>
                </div>

                <!-- Productos -->
                <div class="mb-4">
                    <h3 class="font-medium mb-2">Productos</h3>
                    <table class="w-full border">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2 border">Producto</th>
                                <th class="px-4 py-2 border">Cantidad</th>
                                <th class="px-4 py-2 border">Precio Unitario</th>
                                <th class="px-4 py-2 border">Subtotal</th>
                                <th class="px-4 py-2 border">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="productos-table">
                            <tr>
                                <td class="px-4 py-2 border">
                                    <select name="productos[0][presentacion_id]"
                                        class="w-full border rounded p-2 producto-select" required>
                                        <option value="">Seleccione un producto</option>
                                        @foreach($presentaciones as $presentacion)
                                            <option value="{{ $presentacion->id }}" data-precio="{{ $presentacion->precio }}">
                                                {{ $presentacion->producto->nombre }} - {{ $presentacion->nombre }}
                                                (${{ number_format($presentacion->precio, 2) }})
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-4 py-2 border">
                                    <input type="number" name="productos[0][cantidad]"
                                        class="w-full border rounded p-2 cantidad" value="1" min="1" required>
                                </td>
                                <td class="px-4 py-2 border">
                                    <input type="text" class="w-full border rounded p-2 precio" value="0" readonly>
                                </td>
                                <td class="px-4 py-2 border">
                                    <input type="text" class="w-full border rounded p-2 subtotal" value="0" readonly>
                                </td>
                                <td class="px-4 py-2 border text-center">
                                    <button type="button" class="text-red-600 remove-row">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" id="add-product" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">Añadir
                        Producto</button>
                </div>

                <!-- Total -->
                <div class="mb-4 text-right">
                    <label class="font-bold">Total: </label>
                    <span id="total">0</span>
                </div>

                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Registrar Venta</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productosTable = document.getElementById('productos-table');
            const addProductBtn = document.getElementById('add-product');
            const totalSpan = document.getElementById('total');
            let rowIndex = 1;

            function updateTotals() {
                let total = 0;
                productosTable.querySelectorAll('tr').forEach(row => {
                    const select = row.querySelector('.producto-select');
                    const cantidad = row.querySelector('.cantidad');
                    const precioInput = row.querySelector('.precio');
                    const subtotalInput = row.querySelector('.subtotal');

                    if (select && select.selectedOptions.length > 0) {
                        const precio = parseFloat(select.selectedOptions[0].dataset.precio || 0);
                        const cant = parseInt(cantidad.value) || 1;
                        const subtotal = precio * cant;
                        precioInput.value = precio.toFixed(2);
                        subtotalInput.value = subtotal.toFixed(2);
                        total += subtotal;
                    }
                });
                totalSpan.textContent = total.toFixed(2);
            }

            addProductBtn.addEventListener('click', function () {
                const newRow = document.createElement('tr');
                newRow.innerHTML = productosTable.rows[0].innerHTML.replace(/\[0\]/g, `[${rowIndex}]`);
                productosTable.appendChild(newRow);
                rowIndex++;
                updateTotals();
            });

            productosTable.addEventListener('change', function (e) {
                if (e.target.classList.contains('producto-select') || e.target.classList.contains('cantidad')) {
                    updateTotals();
                }
            });

            productosTable.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-row')) {
                    e.target.closest('tr').remove();
                    updateTotals();
                }
            });

            updateTotals();
        });
    </script>
@endsection