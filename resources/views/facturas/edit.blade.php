@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Factura #{{ $factura->id }}</h1>

    <form action="{{ route('facturas.update', $factura->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Datos de la factura -->
        <div class="mb-3">
            <label for="cliente" class="form-label">Cliente</label>
            <input type="text" name="cliente" id="cliente" class="form-control" value="{{ old('cliente', $factura->cliente_nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', $factura->fecha->format('Y-m-d')) }}" required>
        </div>

        <!-- Tabla de detalles -->
        <h4>Detalles</h4>
        <table class="table" id="detallesTable">
            <thead>
                <tr>
                    <th>Presentación</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($factura->detalles as $i => $detalle)
                <tr>
                    <td>
                        <select name="detalles[{{ $i }}][presentacion_id]" class="form-select" required>
                            @foreach(App\Models\Presentacion::all() as $presentacion)
                                <option value="{{ $presentacion->id }}" {{ $detalle->presentacion_id == $presentacion->id ? 'selected' : '' }}>
                                    {{ $presentacion->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="detalles[{{ $i }}][cantidad]" class="form-control cantidad" value="{{ $detalle->cantidad }}" min="1" required></td>
                    <td><input type="number" name="detalles[{{ $i }}][precio_unitario]" class="form-control precio" value="{{ $detalle->precio_unitario }}" step="0.01" required></td>
                    <td><input type="number" class="form-control subtotal" value="{{ $detalle->subtotal }}" readonly></td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-row">Eliminar</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="button" id="addRow" class="btn btn-primary mb-3">Agregar detalle</button>

        <!-- Total -->
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" name="total" id="total" class="form-control" value="{{ $factura->total }}" readonly>
        </div>

        <button type="submit" class="btn btn-success">Actualizar Factura</button>
    </form>
</div>

<!-- Scripts para filas dinámicas -->
@section('scripts')
<script>
    let row = @json($factura->detalles->count());

    function actualizarSubtotales() {
        let total = 0;
        document.querySelectorAll('#detallesTable tbody tr').forEach(tr => {
            const cantidad = parseFloat(tr.querySelector('.cantidad').value) || 0;
            const precio = parseFloat(tr.querySelector('.precio').value) || 0;
            const subtotal = cantidad * precio;
            tr.querySelector('.subtotal').value = subtotal.toFixed(2);
            total += subtotal;
        });
        document.getElementById('total').value = total.toFixed(2);
    }

    document.getElementById('addRow').addEventListener('click', () => {
        const tbody = document.querySelector('#detallesTable tbody');
        const tr = document.createElement('tr');

        tr.innerHTML = `
            <td>
                <select name="detalles[${row}][presentacion_id]" class="form-select" required>
                    @foreach(App\Models\Presentacion::all() as $presentacion)
                        <option value="{{ $presentacion->id }}">{{ $presentacion->nombre }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="detalles[${row}][cantidad]" class="form-control cantidad" value="1" min="1" required></td>
            <td><input type="number" name="detalles[${row}][precio_unitario]" class="form-control precio" value="0" step="0.01" required></td>
            <td><input type="number" class="form-control subtotal" value="0" readonly></td>
            <td><button type="button" class="btn btn-danger btn-sm remove-row">Eliminar</button></td>
        `;
        tbody.appendChild(tr);
        row++;
        actualizarSubtotales();
    });

    document.querySelector('#detallesTable').addEventListener('input', e => {
        if(e.target.classList.contains('cantidad') || e.target.classList.contains('precio')) {
            actualizarSubtotales();
        }
    });

    document.querySelector('#detallesTable').addEventListener('click', e => {
        if(e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
            actualizarSubtotales();
        }
    });

    // Inicializar subtotales al cargar
    actualizarSubtotales();
</script>
@endsection

@endsection
