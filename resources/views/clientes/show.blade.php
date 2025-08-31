@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Detalle Cliente</h2>

            <p class="mb-2"><strong>ID:</strong> {{ $cliente->id }}</p>
            <p class="mb-2"><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
            <p class="mb-2"><strong>Email:</strong> {{ $cliente->email }}</p>
            <p class="mb-2"><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
            <p class="mb-2"><strong>Dirección:</strong> {{ $cliente->direccion }}</p>

            <div class="mt-4">
                <a href="{{ route('clientes.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection
