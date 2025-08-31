@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6">Crear Producto</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nombre -->
            <div class="mb-4">
                <label for="nombre" class="block font-medium text-gray-700 mb-1">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="w-full border rounded p-2" required>
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <label for="descripcion" class="block font-medium text-gray-700 mb-1">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="w-full border rounded p-2"></textarea>
            </div>

            <!-- Precio -->
            <div class="mb-4">
                <label for="precio" class="block font-medium text-gray-700 mb-1">Precio</label>
                <input type="number" step="0.01" name="precio" id="precio" class="w-full border rounded p-2" required>
            </div>

            <!-- Stock -->
            <div class="mb-4">
                <label for="stock" class="block font-medium text-gray-700 mb-1">Stock</label>
                <input type="number" name="stock" id="stock" class="w-full border rounded p-2" required>
            </div>

            <!-- Categoría -->
            <div class="mb-4">
                <label for="categoria_id" class="block font-medium text-gray-700 mb-1">Categoría</label>
                <select name="categoria_id" id="categoria_id" class="w-full border rounded p-2" required>
                    <option value="">Seleccione una categoría</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Marca -->
            <div class="mb-4">
                <label for="marca_id" class="block font-medium text-gray-700 mb-1">Marca</label>
                <select name="marca_id" id="marca_id" class="w-full border rounded p-2" required>
                    <option value="">Seleccione una marca</option>
                    @foreach($marcas as $marca)
                        <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Imagen -->
            <div class="mb-4">
                <label for="imagen" class="block font-medium text-gray-700 mb-1">Imagen</label>
                <input type="file" name="imagen" id="imagen" class="w-full border rounded p-2">
            </div>

            <!-- Presentaciones -->
            <div class="mb-6">
                <h3 class="font-medium mb-2">Presentaciones (opcional)</h3>
                <div id="presentaciones-wrapper" class="space-y-3"></div>
                <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded" onclick="addPresentacion()">Añadir Presentación</button>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-2">
                <a href="{{ route('productos.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Guardar Producto</button>
            </div>
        </form>
    </div>
</div>

<script>
let presentacionIndex = 0;

function addPresentacion() {
    const wrapper = document.getElementById('presentaciones-wrapper');
    const html = `
        <div class="p-3 border rounded presentacion-item space-y-2">
            <div>
                <label class="block font-medium text-gray-700 mb-1">Nombre Presentación</label>
                <input type="text" name="presentaciones[${presentacionIndex}][nombre]" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block font-medium text-gray-700 mb-1">Precio</label>
                <input type="number" step="0.01" name="presentaciones[${presentacionIndex}][precio]" class="w-full border rounded p-2" required>
            </div>
            <button type="button" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700" onclick="removePresentacion(this)">Eliminar</button>
        </div>
    `;
    wrapper.insertAdjacentHTML('beforeend', html);
    presentacionIndex++;
}

function removePresentacion(button) {
    button.parentElement.remove();
}
</script>
@endsection
