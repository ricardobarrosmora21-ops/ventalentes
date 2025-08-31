@extends('layouts.app')

@section('content')
<div class="py-12 max-w-7xl mx-auto px-6">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-center">Catálogo de Productos</h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($productos as $producto)
            <div class="border rounded overflow-hidden shadow hover:shadow-lg transition duration-300 bg-white">
                @guest
                    <a href="{{ route('register') }}"> <!-- Invitado va a registrarse -->
                @else
                    <a href="{{ route('ventas.create') }}"> <!-- Autenticado crea venta -->
                @endguest

                    @if($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" 
                             alt="{{ $producto->nombre }}" 
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">Sin imagen</span>
                        </div>
                    @endif
                </a>

                <div class="p-4">
                    <h3 class="font-semibold text-lg">{{ $producto->nombre }}</h3>
                    <p class="text-gray-600 mt-2">{{ $producto->descripcion }}</p>
                    <p class="text-blue-600 font-bold mt-2">${{ $producto->precio }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
