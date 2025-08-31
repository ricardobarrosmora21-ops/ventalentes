@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-6">
    <div class="bg-white shadow-xl rounded-lg p-6">
        <h2 class="text-2xl font-bold text-blue-700 mb-6">Nuevo Cliente</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-1">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="w-full border border-gray-300 rounded-md p-2" required>
            </div>

            <div class="mb-6">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-6">
                <label for="telefono" class="block text-sm font-semibold text-gray-700 mb-1">Teléfono</label>
                <input type="text" id="telefono" name="telefono" class="w-full border border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-6">
                <label for="direccion" class="block text-sm font-semibold text-gray-700 mb-1">Dirección</label>
                <textarea id="direccion" name="direccion" rows="3" class="w-full border border-gray-300 rounded-md p-2"></textarea>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('clientes.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg mr-2 hover:bg-gray-600">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
