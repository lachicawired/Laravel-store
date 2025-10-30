<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/

// Página principal de productos
Route::get('/', [ProductController::class, 'index'])->name('products');

// Carrito (solo para usuarios autenticados)
Route::middleware(['auth'])->group(function() {
	Route::get('/cart/', [CartController::class, 'show'])->name('cart.show');
   Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/cart/confirmation', [CartController::class, 'confirmation'])->name('cart.confirmation');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
});

/*
|--------------------------------------------------------------------------
| Rutas Admin
|--------------------------------------------------------------------------
|
| Todas las rutas de administración requieren que el usuario esté autenticado
| y sea admin. Prefijo "admin" y nombres de rutas con "admin.".
|
*/

Route::prefix('admin')->middleware(['auth','admin'])->name('admin.')->group(function() {

    // Productos
    Route::get('products', [AdminController::class, 'products'])->name('products.index');
    Route::get('products/create', [AdminController::class, 'productsCreate'])->name('products.create');
    Route::post('products', [AdminController::class, 'productsStore'])->name('products.store');
    Route::get('products/{id}/edit', [AdminController::class, 'productsEdit'])->name('products.edit');
    Route::put('products/{id}', [AdminController::class, 'productsUpdate'])->name('products.update');
    Route::delete('products/{id}', [AdminController::class, 'productsDestroy'])->name('products.destroy');

    // Órdenes
    Route::get('orders', [AdminController::class, 'orders'])->name('orders.index');
    Route::put('orders/{id}/status', [AdminController::class, 'ordersUpdateStatus'])->name('orders.updateStatus');

    // Usuarios
    Route::get('users', [AdminController::class, 'users'])->name('users.index');
    Route::put('users/{id}/make-admin', [AdminController::class, 'makeAdmin'])->name('users.makeAdmin');
	

});
require __DIR__.'/auth.php';


