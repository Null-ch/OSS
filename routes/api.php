<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
|--------------------------------------------------------------------------
| Auth\Register routes
|--------------------------------------------------------------------------
|
|
*/

Route::post('/register', [App\Http\Controllers\Api\RegisterController::class, 'register']);

Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
Route::get('/auth/check', [App\Http\Controllers\Api\AuthController::class, 'isAuthenticated']);

Route::middleware('auth:api')->group(function () {
});

/*
|--------------------------------------------------------------------------
| Client routes
|--------------------------------------------------------------------------
|
|
*/
Route::prefix('public')->group(function () {
    Route::prefix('cart')->group(function () {
        Route::get('/', [App\Http\Controllers\Api\Client\CartController::class, 'index'])->name('client.cart.index');
        Route::post('/update', [App\Http\Controllers\Api\Client\CartController::class, 'updateCart'])->name('client.cart.update');
        Route::post('/clear/{id}', [App\Http\Controllers\Api\Client\CartController::class, 'clearCart'])->name('client.cart.clear');
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [App\Http\Controllers\Api\Client\ProductController::class, 'index'])->name('client.products.index');
        Route::get('/show/{id}', [App\Http\Controllers\Api\Client\ProductController::class, 'show'])->name('client.product.show');
        Route::post('/check-availability', [App\Http\Controllers\Api\Client\ProductController::class, 'checkAvailability'])->name('client.products.check');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [App\Http\Controllers\Api\Client\CategoryController::class, 'index'])->name('client.categories.index');
        Route::get('/show/{id}', [App\Http\Controllers\Api\Client\CategoryController::class, 'show'])->name('client.categories.show');
        Route::get('/{id}/products', [App\Http\Controllers\Api\Client\CategoryController::class, 'getProducts'])->name('client.category.product.show');
        Route::get('/products', [App\Http\Controllers\Api\Client\CategoryController::class, 'getCategoriesWithProducts'])->name('client.categories.with.products');
    });

    Route::prefix('order')->group(function () {
        Route::post('/create', [App\Http\Controllers\Api\Client\OrderController::class, 'createOrder'])->name('client.order.create');
        Route::post('/cancel/{id}', [App\Http\Controllers\Api\Client\OrderController::class, 'cancelOrder'])->name('client.order.cancel');
    });

    Route::prefix('special-offer')->group(function () {
        Route::get('/', [App\Http\Controllers\Api\Client\CategoryController::class, 'index'])->name('client.special.offer.index');
        Route::get('/show/{id}', [App\Http\Controllers\Api\Client\CategoryController::class, 'show'])->name('client.special.offer.show');
        Route::get('/{id}/products', [App\Http\Controllers\Api\Client\CategoryController::class, 'getProducts'])->name('client.special.offer.show.all');
    });

    Route::prefix('delivery')->group(function () {
        Route::get('/', [App\Http\Controllers\Api\Client\DeliveryController::class, 'index'])->name('client.delivery.index');
        Route::get('/show/{id}', [App\Http\Controllers\Api\Client\DeliveryController::class, 'show'])->name('client.delivery.show');
    });
});
