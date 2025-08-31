@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-6">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-blue-700 mb-6">Crear Categoría</h1>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('categorias.store') }}">
            @csrf

            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 font-medium mb-1">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="w-full border rounded-lg p-2" required>
            </div>

            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700 font-medium mb-1">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="3" class="w-full border rounded-lg p-2"></textarea>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('categorias.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg mr-2 hover:bg-gray-600">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
