@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-6">Listado de Productos</h2>

    <a href="{{ route('productos.create') }}"
        class="mb-4 inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
        + Nuevo Producto
    </a>

    <table class="w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Imagen</th>
                <th class="px-4 py-2 border">Nombre</th>
                <th class="px-4 py-2 border">Precio</th>
                <th class="px-4 py-2 border">Categoría</th>
                <th class="px-4 py-2 border">Marca</th>
                <th class="px-4 py-2 border">Presentaciones</th>
                <th class="px-4 py-2 border">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
                <tr>
                    <td class="px-4 py-2 border">{{ $producto->id }}</td>
                    <td class="px-4 py-2 border">
                        @if($producto->imagen)
                            <img src="{{ asset('storage/' . $producto->imagen) }}"
                                alt="{{ $producto->nombre }}"
                                class="w-16 h-16 object-cover rounded">
                        @else
                            <span class="text-gray-500">Sin imagen</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border">{{ $producto->nombre }}</td>
                    <td class="px-4 py-2 border">${{ number_format($producto->precio, 2) }}</td>
                    <td class="px-4 py-2 border">{{ $producto->categoria->nombre ?? '—' }}</td>
                    <td class="px-4 py-2 border">{{ $producto->marca->nombre ?? '—' }}</td>
                    <td class="px-4 py-2 border">
                        @if($producto->presentaciones->count())
                            <ul class="list-disc pl-4">
                                @foreach($producto->presentaciones as $presentacion)
                                    <li>{{ $presentacion->nombre }} (${{ number_format($presentacion->precio, 2) }})</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-500">Sin presentaciones</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border">
                        <a href="{{ route('productos.show', $producto) }}"
                            class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Ver</a>

                        <a href="{{ route('productos.edit', $producto) }}"
                            class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Editar</a>

                        <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700"
                                onclick="return confirm('¿Eliminar este producto?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
