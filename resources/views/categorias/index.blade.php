<x-app-layout>
    @section('title', 'Categorías')

    <!-- Header Section -->
    <div class="px-6 py-2 border-b border-gray-100 dark:border-gray-700">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    <span class="inline-flex items-center">
                        <i class="fas fa-folder-open mr-3 text-purple-500"></i>
                        Gestión de Categorías
                    </span>
                </h2>
                <p class="mt-1 text-xs md:text-sm text-gray-500 dark:text-gray-400">
                    Administra y organiza tus categorías de productos
                </p>
            </div>

            <!-- Breadcrumb -->
            <nav class="mt-4 md:mt-0" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center text-purple-600 hover:text-purple-700 dark:text-purple-400 dark:hover:text-purple-300 transition-colors">
                            <i class="fas fa-home mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <span class="text-gray-500 dark:text-gray-400">Categorías</span>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- Card Container  --}}
    <div class="w-full overflow-hidden rounded-lg shadow-xs mt-3">
        <div class="bg-white rounded-lg shadow-md dark:bg-gray-800">
            {{-- Card Header  --}}
            <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
                <div class="flex items-center text-gray-700 dark:text-gray-300">
                    <i class="fas fa-table mr-2"></i>
                    <span>Listado de Categorías</span>
                </div>
                {{-- Botón de Agregar Categoría --}}
                <button
                    class="flex items-center justify-center p-3 bg-purple-600 hover:bg-purple-700 text-white rounded-full shadow-lg transition-all duration-200"
                    type="button" data-modal-target="crearCategoriaModal" data-modal-toggle="crearCategoriaModal">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

            {{-- Tabla --}}
            <div class="p-4">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                                <th class="px-4 py-3">Nombre</th>
                                <th class="px-4 py-3">Descripción</th>
                                <th class="px-4 py-3">Estado / Destacado</th>
                                <th class="px-4 py-3 text-center"><i class="fa-solid fa-wrench"></i></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($categorias as $categoria)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-2 font-bold text-gray-900 dark:text-gray-200">
                                        {{ $categoria->caracteristica->nombre }}
                                    </td>
                                    <td class="px-4 py-2">{{ $categoria->caracteristica->descripcion }}</td>
                                    <td class="px-4 py-2">
                                        @if ($categoria->caracteristica->estado == 1)
                                            <i class="fa-solid fa-circle-check text-green-500"></i>
                                        @else
                                            <i class="fa-solid fa-circle-xmark text-gray-400"></i>
                                        @endif

                                        @if ($categoria->caracteristica->destacado == 1)
                                            <i class="fa fa-star text-blue-400 ml-2"></i>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 flex justify-center gap-2">
                                        {{-- Botón Editar --}}
                                        <button
                                            class="p-2 text-blue-500 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700"
                                            type="button" data-modal-toggle="editarCategoriaModal"
                                            data-id="{{ $categoria->id }}">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>

                                        {{-- Botón Eliminar / Restaurar --}}
                                        <button
                                            class="p-2 rounded-lg {{ $categoria->caracteristica->estado == 1 ? 'text-red-500 hover:bg-red-50' : 'text-yellow-500 hover:bg-yellow-50' }} dark:hover:bg-gray-700"
                                            onclick="abrirModalConfirmacion('{{ $categoria->id }}', '{{ $categoria->caracteristica->estado }}')">
                                            @if ($categoria->caracteristica->estado == 1)
                                                <i class="fa-regular fa-trash-can"></i>
                                            @else
                                                <i class="fa-solid fa-arrow-rotate-right"></i>
                                            @endif
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Incluyo los modales --}}
    @include('categorias.partials.create-modal')
    @include('categorias.partials.edit-modal')
    @include('categorias.partials.confirm-modal')

    {{-- Script --}}
    @push('js')
        @include('categorias.partials.scripts')
    @endpush
</x-app-layout>
