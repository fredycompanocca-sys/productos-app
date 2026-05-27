<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Models\Categoria;
use App\Models\Producto;

// ──────────────────────────────────────────────────────────────────────
// RUTAS PÚBLICAS (no requieren sesión iniciada)
// ──────────────────────────────────────────────────────────────────────

Route::get('/', function () {
    return view('home', [
        'totalCategorias' => Categoria::count(),
        'totalProductos'  => Producto::count(),
    ]);
})->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {

    // Categorías
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');

    // Productos
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');

    // Galería de productos
    Route::get('/galeria', [ProductoController::class, 'galeria'])->name('productos.galeria');

    // Detalle de un producto
    Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');
    
    Route::get('/carrito/confirmar', [CarritoController::class, 'confirmar'])->name('carrito.confirmar');
    // Carrito
    Route::get('/carrito',               [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::post('/carrito/quitar/{id}',  [CarritoController::class, 'quitar'])->name('carrito.quitar');
    Route::post('/carrito/vaciar',       [CarritoController::class, 'vaciar'])->name('carrito.vaciar');

});