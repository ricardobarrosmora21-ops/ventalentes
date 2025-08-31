@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6">

            <a href="{{ route('presentaciones.create') }}" 
               class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Nueva Presentación
            </a>

            @if(session('success'))
                <div class="mb-4 text-green-600 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <table class="min-w-full border text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Nombre</th>
                        <th class="px-4 py-2 border">Descripción</th>
                        <th class="px-4 py-2 border">Precio</th>
                        <th class="px-4 py-2 border">Característica</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($presentaciones as $presentacion)
                        <tr>
                            <td class="px-4 py-2 border">{{ $presentacion->id }}</td>
                            <td class="px-4 py-2 border">{{ $presentacion->nombre }}</td>
                            <td class="px-4 py-2 border">{{ $presentacion->descripcion }}</td>
                            <td class="px-4 py-2 border">${{ number_format($presentacion->precio, 2) }}</td>
                            <td class="px-4 py-2 border">{{ $presentacion->caracteristica->nombre ?? '—' }}</td>
                            <td class="px-4 py-2 border">
                                <a href="{{ route('presentaciones.edit', $presentacion) }}" 
                                   class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Editar</a>
                                <form action="{{ route('presentaciones.destroy', $presentacion) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700"
                                            onclick="return confirm('¿Eliminar esta presentación?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $presentaciones->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
