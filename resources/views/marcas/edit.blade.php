@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-md mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Editar Marca</h2>

            <form action="{{ route('marcas.update', $marca) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $marca->nombre) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="3"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('descripcion', $marca->descripcion) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="caracteristica_id" class="block text-sm font-medium text-gray-700">Característica</label>
                    <select name="caracteristica_id" id="caracteristica_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @foreach($caracteristicas as $caracteristica)
                            <option value="{{ $caracteristica->id }}"
                                {{ $marca->caracteristica_id == $caracteristica->id ? 'selected' : '' }}>
                                {{ $caracteristica->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('marcas.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg mr-2">Cancelar</a>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
