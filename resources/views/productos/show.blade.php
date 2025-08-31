@extends('layouts.app')

@section('title', 'Detalle del Producto')

@section('content')
<div class="py-6">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ $producto->nombre }}</h2>

            {{-- Imagen --}}
            @if($producto->imagen)
                <div class="mb-6">
                    <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}"
                         class="w-32 h-32 object-cover rounded">
                </div>
            @endif

            {{-- Información general --}}
            <div class="mb-4">
                <p><strong>Descripción:</strong> {{ $producto->descripcion ?? '—' }}</p>
                <p><strong>Precio base:</strong> ${{ number_format($producto->precio, 2) }}</p>
                <p><strong>Stock:</strong> {{ $producto->stock }}</p>
                <p><strong>Categoría:</strong> {{ $producto->categoria->nombre ?? '—' }}</p>
                <p><strong>Marca:</strong> {{ $producto->marca->nombre ?? '—' }}</p>
            </div>

            {{-- Presentaciones --}}
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Presentaciones</h3>
                @if($producto->presentaciones->count())
                    <ul class="list-disc pl-4">
                        @foreach($producto->presentaciones as $presentacion)
                            <li>
                                <strong>{{ $presentacion->nombre }}</strong> —
                                ${{ number_format($presentacion->precio, 2) }}
                                <span class="text-sm text-gray-500">({{ $presentacion->descripcion ?? 'Sin descripción' }})</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">Este producto no tiene presentaciones registradas.</p>
                @endif
            </div>

            {{-- Botones --}}
            <div class="mt-6 flex justify-end gap-2">
                <a href="{{ route('productos.edit', $producto) }}"
                   class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Editar</a>
                <a href="{{ route('productos.index') }}"
                   class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection
