@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Editar Producto</h2>

                {{-- Errores de validación --}}
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('productos.update', $producto) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nombre --}}
                    <div class="mb-4">
                        <label for="nombre" class="block text-gray-700 font-medium mb-1">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="w-full border rounded-lg p-2"
                               value="{{ old('nombre', $producto->nombre) }}" required>
                    </div>

                    {{-- Descripción --}}
                    <div class="mb-4">
                        <label for="descripcion" class="block text-gray-700 font-medium mb-1">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="3"
                                  class="w-full border rounded-lg p-2">{{ old('descripcion', $producto->descripcion) }}</textarea>
                    </div>

                    {{-- Precio --}}
                    <div class="mb-4">
                        <label for="precio" class="block text-gray-700 font-medium mb-1">Precio</label>
                        <input type="number" step="0.01" id="precio" name="precio" class="w-full border rounded-lg p-2"
                               value="{{ old('precio', $producto->precio) }}" required>
                    </div>

                    {{-- Stock --}}
                    <div class="mb-4">
                        <label for="stock" class="block text-gray-700 font-medium mb-1">Stock</label>
                        <input type="number" id="stock" name="stock" class="w-full border rounded-lg p-2"
                               value="{{ old('stock', $producto->stock) }}" required>
                    </div>

                    {{-- Categoría --}}
                    <div class="mb-4">
                        <label for="categoria_id" class="block text-gray-700 font-medium mb-1">Categoría</label>
                        <select id="categoria_id" name="categoria_id" class="w-full border rounded-lg p-2" required>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Marca --}}
                    <div class="mb-4">
                        <label for="marca_id" class="block text-gray-700 font-medium mb-1">Marca</label>
                        <select id="marca_id" name="marca_id" class="w-full border rounded-lg p-2" required>
                            @foreach($marcas as $marca)
                                <option value="{{ $marca->id }}" {{ $producto->marca_id == $marca->id ? 'selected' : '' }}>
                                    {{ $marca->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Imagen --}}
                    <div class="mb-4">
                        <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen</label>
                        <input type="file" name="imagen" id="imagen" class="mt-1 block w-full">

                        @if($producto->imagen)
                            <div class="mt-2">
                                <img src="{{ $producto->url_imagen }}"
                                     alt="{{ $producto->nombre }}"
                                     class="w-24 h-24 object-cover rounded">
                            </div>
                        @endif
                    </div>

                    {{-- 🔥 Presentaciones --}}
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Presentaciones</h3>
                        <div id="presentaciones-container" class="space-y-4">
                            @foreach($producto->presentaciones as $index => $presentacion)
                                <div class="p-4 border rounded bg-gray-50 relative">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Presentación #{{ $index + 1 }}
                                    </label>
                                    <div class="flex flex-col sm:flex-row gap-4">
                                        <div class="w-full sm:w-1/2">
                                            <label class="text-sm text-gray-600">Nombre</label>
                                            <input type="text" name="presentaciones[{{ $index }}][nombre]"
                                                   value="{{ $presentacion->nombre }}" class="w-full p-2 border rounded" required>
                                        </div>
                                        <div class="w-full sm:w-1/2">
                                            <label class="text-sm text-gray-600">Precio</label>
                                            <input type="number" name="presentaciones[{{ $index }}][precio]" step="0.01" min="0"
                                                   value="{{ $presentacion->precio }}" class="w-full p-2 border rounded" required>
                                        </div>
                                    </div>
                                    <input type="hidden" name="presentaciones[{{ $index }}][id]" value="{{ $presentacion->id }}">
                                    <button type="button"
                                            class="absolute top-2 right-2 text-red-600 text-sm eliminar-btn">✕</button>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" id="agregar-presentacion"
                                class="mt-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            + Agregar presentación
                        </button>
                    </div>

                    {{-- Botones --}}
                    <div class="flex justify-end">
                        <a href="{{ route('productos.index') }}"
                           class="px-4 py-2 bg-gray-600 text-white rounded-lg mr-2">Cancelar</a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    let presentacionIndex = {{ $producto->presentaciones->count() }};

    function actualizarLabels() {
        document.querySelectorAll('#presentaciones-container > div').forEach((wrapper, index) => {
            let label = wrapper.querySelector('label');
            if (label) {
                label.textContent = "Presentación #" + (index + 1);
            }
        });
    }

    // Agregar nueva presentación
    document.getElementById('agregar-presentacion').addEventListener('click', function () {
        const container = document.getElementById('presentaciones-container');

        const wrapper = document.createElement('div');
        wrapper.classList.add('p-4', 'border', 'rounded', 'bg-gray-50', 'relative');

        const label = document.createElement('label');
        label.classList.add('block', 'text-sm', 'font-medium', 'text-gray-700', 'mb-2');
        label.textContent = "Presentación nueva";

        const fields = document.createElement('div');
        fields.classList.add('flex', 'flex-col', 'sm:flex-row', 'gap-4');
        fields.innerHTML = `
            <div class="w-full sm:w-1/2">
                <label class="text-sm text-gray-600">Nombre</label>
                <input type="text" name="presentaciones[${presentacionIndex}][nombre]" 
                    placeholder="Nombre presentación" class="w-full p-2 border rounded" required>
            </div>
            <div class="w-full sm:w-1/2">
                <label class="text-sm text-gray-600">Precio</label>
                <input type="number" name="presentaciones[${presentacionIndex}][precio]" 
                    step="0.01" min="0" placeholder="Precio" class="w-full p-2 border rounded" required>
            </div>
        `;

        const eliminarBtn = document.createElement('button');
        eliminarBtn.type = 'button';
        eliminarBtn.textContent = '✕';
        eliminarBtn.classList.add('absolute', 'top-2', 'right-2', 'text-red-600', 'text-sm');
        eliminarBtn.addEventListener('click', () => {
            wrapper.remove();
            actualizarLabels();
        });

        wrapper.appendChild(label);
        wrapper.appendChild(fields);
        wrapper.appendChild(eliminarBtn);
        container.appendChild(wrapper);

        presentacionIndex++;
        actualizarLabels();
    });

    // Botones eliminar existentes
    document.querySelectorAll('.eliminar-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            this.closest('.p-4').remove();
            actualizarLabels();
        });
    });
});
</script>
@endpush
