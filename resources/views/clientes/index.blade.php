@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

            <div class="flex justify-between mb-4">
                <h3 class="text-lg font-medium">Listado de Clientes</h3>
                <a href="{{ route('clientes.create') }}"
                   class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Nuevo Cliente
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 text-green-600 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium uppercase">ID</th>
                            <th class="px-6 py-3 text-left font-medium uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left font-medium uppercase">Email</th>
                            <th class="px-6 py-3 text-left font-medium uppercase">Teléfono</th>
                            <th class="px-6 py-3 text-left font-medium uppercase">Dirección</th>
                            <th class="px-6 py-3 text-right font-medium uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td class="px-6 py-4">{{ $cliente->id }}</td>
                                <td class="px-6 py-4">{{ $cliente->nombre }}</td>
                                <td class="px-6 py-4">{{ $cliente->email }}</td>
                                <td class="px-6 py-4">{{ $cliente->telefono }}</td>
                                <td class="px-6 py-4">
                                    {{ \Illuminate\Support\Str::limit($cliente->direccion, 40, '...') }}
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('clientes.show', $cliente) }}" class="text-blue-600 hover:underline">Ver</a>
                                    <a href="{{ route('clientes.edit', $cliente) }}" class="text-yellow-600 hover:underline">Editar</a>
                                    <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('¿Eliminar este cliente?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $clientes->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
