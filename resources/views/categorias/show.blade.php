@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Detalle de Categoría</h2>

            <h3 class="text-lg font-bold mb-4">{{ $categoria->nombre }}</h3>

            <p class="mb-2"><span class="font-semibold">ID:</span> {{ $categoria->id }}</p>
            <p class="mb-2"><span class="font-semibold">Descripción:</span> {{ $categoria->descripcion }}</p>
            <p class="mb-2"><span class="font-semibold">Creado:</span> {{ $categoria->created_at->format('d/m/Y H:i') }}</p>
            <p class="mb-2"><span class="font-semibold">Actualizado:</span> {{ $categoria->updated_at->format('d/m/Y H:i') }}</p>

            <div class="mt-4">
                <a href="{{ route('categorias.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection
