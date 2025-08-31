@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Editar Cliente</h2>

            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $cliente->nombre) }}"
                           class="w-full border border-gray-300 rounded-md p-2" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $cliente->email) }}"
                           class="w-full border border-gray-300 rounded-md p-2" required>
                </div>

                <div class="mb-4">
                    <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $cliente->telefono) }}"
                           class="w-full border border-gray-300 rounded-md p-2">
                </div>

                <div class="mb-4">
                    <label for="direccion" class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                    <textarea id="direccion" name="direccion" rows="3"
                              class="w-full border border-gray-300 rounded-md p-2">{{ old('direccion', $cliente->direccion) }}</textarea>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('clientes.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg mr-2">Cancelar</a>
                    <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
