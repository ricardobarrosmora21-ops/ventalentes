@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6">
            <div class="flex justify-between mb-4">
                <h3 class="text-lg font-medium">Listado de Categorías</h3>
                <a href="{{ route('categorias.create') }}" 
                   class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                    Nueva Categoría
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Descripción</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td class="px-6 py-4">{{ $categoria->id }}</td>
                                <td class="px-6 py-4">{{ $categoria->nombre }}</td>
                                <td class="px-6 py-4">{{ $categoria->descripcion }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('categorias.show', $categoria) }}" class="text-blue-600 hover:underline">Ver</a>
                                    <a href="{{ route('categorias.edit', $categoria) }}" class="text-yellow-600 hover:underline">Editar</a>
                                    <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $categorias->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
