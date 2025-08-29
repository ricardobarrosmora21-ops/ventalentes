@extends('layouts.app')

@section('title', 'Bienvenido')

@section('content')
    <div class="text-center">
        <h1 class="text-3xl font-bold mb-4">Bienvenido al Sistema de Ventas</h1>
        <p class="text-gray-600">Gestiona tus productos, categorías, marcas y ventas fácilmente.</p>

        <div class="mt-6">
            <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Ir al Dashboard</a>
        </div>
    </div>
@endsection
