<?php

use Illuminate\Support\Facades\Route;
use App\Models\Categoria;
use App\Models\Marca;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\DetalleFacturaController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProfileController;

// Catálogo público en la raíz
Route::get('/', [ProductoController::class, 'catalogo'])->name('welcome');

// Dashboard protegido por auth y verified
Route::get('/dashboard', [ProductoController::class, 'catalogo'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Grupo de rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    // CRUD de módulos principales
    Route::resources([
        'categorias' => CategoriaController::class,
        'marcas' => MarcaController::class,
        'clientes' => ClienteController::class,
        'productos' => ProductoController::class,
        'usuarios' => UsuarioController::class,
        'facturas' => FacturaController::class,
    ]);

    // Detalles de factura (anidado)
    Route::resource('facturas.detalles', DetalleFacturaController::class);

    // Ventas
    Route::resource('ventas', VentaController::class);

    // Exportación de ventas
    Route::get('/ventas/export', [VentaController::class, 'export'])->name('ventas.export');

    // Generar PDF de factura
    Route::get('/facturas/{factura}/pdf', [FacturaController::class, 'generarPDF'])->name('facturas.pdf');

    // Reportes
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/{factura}', [ReporteController::class, 'detalle'])->name('reportes.detalle');
    Route::get('/reportes/pdf', [ReporteController::class, 'generarPDF'])->name('reportes.pdf');

    // Perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update.post');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Ruta de prueba directa para vista de creación de productos
Route::get('/test-create', function () {
    $categorias = Categoria::all();
    $marcas = Marca::all();
    return view('productos.create', compact('categorias', 'marcas'));
});

// Rutas de autenticación (Laravel Breeze / Jetstream / UI)
require __DIR__ . '/auth.php';
