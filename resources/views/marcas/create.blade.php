@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold text-blue-700 mb-6">Crear Marca</h1>

            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('marcas.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="nombre" class="block text-gray-700">Nombre de la Marca</label>
                    <input type="text" name="nombre" id="nombre" class="w-full border rounded-lg p-2" required>
                </div>

                <div class="mb-4">
                    <label for="descripcion" class="block text-gray-700">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="w-full border rounded-lg p-2"></textarea>
                </div>

                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="destacado" value="1" class="mr-2">
                        <span class="text-gray-700">¿Destacado?</span>
                    </label>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('marcas.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg mr-2">Cancelar</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
