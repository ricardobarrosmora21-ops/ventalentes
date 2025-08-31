@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">

                <a href="{{ route('marcas.create') }}"
                    class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Nueva Marca
                </a>

                <table class="min-w-full border text-sm text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">#</th>
                            <th class="px-4 py-2 border">Nombre</th>
                            <th class="px-4 py-2 border">Descripción</th>
                            <th class="px-4 py-2 border">Característica</th> <!-- ✅ Nueva columna -->
                            <th class="px-4 py-2 border">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($marcas as $marca)
                            <tr>
                                <td class="px-4 py-2 border">{{ $marca->id }}</td>
                                <td class="px-4 py-2 border">{{ $marca->nombre }}</td>
                                <td class="px-4 py-2 border">{{ $marca->descripcion }}</td>
                                <td class="px-4 py-2 border">
                                    {{ $marca->caracteristica->nombre ?? '—' }}
                                </td>
                                <td class="px-4 py-2 border">
                                    <a href="{{ route('marcas.edit', $marca) }}"
                                        class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Editar</a>
                                    <form action="{{ route('marcas.destroy', $marca) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700"
                                            onclick="return confirm('¿Eliminar esta marca?')">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection