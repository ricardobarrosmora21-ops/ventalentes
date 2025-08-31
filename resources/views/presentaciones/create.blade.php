<!-- resources/views/presentaciones/create.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Presentación</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <h2 class="text-2xl font-bold text-blue-700 mb-6">Nueva Presentación</h2>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('presentaciones.store') }}" class="bg-white p-6 rounded shadow max-w-xl mx-auto">
        @csrf
        <input type="text" name="nombre" placeholder="Nombre" class="w-full mb-4 p-2 border rounded" required>
        <textarea name="descripcion" placeholder="Descripción" rows="3" class="w-full mb-4 p-2 border rounded"></textarea>
        <input type="number" name="precio" step="0.01" min="0" placeholder="Precio" class="w-full mb-4 p-2 border rounded" required>
        <select name="caracteristica_id" class="w-full mb-4 p-2 border rounded" required>
            @foreach($caracteristicas as $caracteristica)
                <option value="{{ $caracteristica->id }}">{{ $caracteristica->nombre }}</option>
            @endforeach
        </select>
        <div class="flex justify-end">
            <a href="{{ route('presentaciones.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded mr-2">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Guardar</button>
        </div>
    </form>
</body>
</html>
