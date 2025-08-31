@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Editar Categoría</h2>

            <!-- Mensajes de error -->
            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $categoria->nombre) }}"
                           class="w-full mt-1 border-gray-300 rounded-md shadow-sm p-2" required>
                </div>

                <div class="mb-4">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="3"
                              class="w-full mt-1 border-gray-300 rounded-md shadow-sm p-2">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('categorias.index') }}" class="px-4 py-2 mr-2 bg-gray-500 text-white rounded-lg">Cancelar</a>
                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
