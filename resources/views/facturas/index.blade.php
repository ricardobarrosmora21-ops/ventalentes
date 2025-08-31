<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Facturas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-medium">Listado de Facturas</h3>
                    <a href="/facturas/create"
                       class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Nueva Factura
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase">Cliente</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase">Fecha</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase">Total</th>
                                <th class="px-6 py-3 text-right text-xs font-medium uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4">1</td>
                                <td class="px-6 py-4">Juan Pérez</td>
                                <td class="px-6 py-4">2025-08-30</td>
                                <td class="px-6 py-4">$150.00</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="/facturas/1" class="text-blue-600 hover:underline">Ver</a>
                                    <form action="/facturas/1" method="POST" class="inline">
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">2</td>
                                <td class="px-6 py-4">María Gómez</td>
                                <td class="px-6 py-4">2025-08-29</td>
                                <td class="px-6 py-4">$230.00</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="/facturas/2" class="text-blue-600 hover:underline">Ver</a>
                                    <form action="/facturas/2" method="POST" class="inline">
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 text-sm text-gray-500">
                    <p>Paginación aquí si se necesita</p>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
