<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle de Marca') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                
                <p><strong>ID:</strong> {{ $marca->id }}</p>
                <p><strong>Nombre:</strong> {{ $marca->nombre }}</p>

                <div class="mt-4">
                    <a href="{{ route('marcas.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg">Volver</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
