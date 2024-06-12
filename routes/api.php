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

Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);

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

Route::prefix('cart')->group(function () {
    Route::get('/', [App\Http\Controllers\Api\Client\CartController::class, 'index'])->name('client.cart.index');
    Route::post('/add', [App\Http\Controllers\Api\Client\CartController::class, 'addProduct'])->name('client.cart.add');
    Route::put('/update/{id}', [App\Http\Controllers\Api\Client\CartController::class, 'updateProduct'])->name('client.cart.update');
    Route::delete('/delete/{id}', [App\Http\Controllers\Api\Client\CartController::class, 'deleteProduct'])->name('client.cart.product.delete');
    Route::post('/check-availability', [App\Http\Controllers\Api\Client\CartController::class, 'checkAvailability'])->name('client.cart.add');
});

Route::prefix('products')->group(function () {
    Route::get('/', [App\Http\Controllers\Api\Client\ProductController::class, 'index'])->name('client.products.index');
    Route::get('/show/{id}', [App\Http\Controllers\Api\Client\ProductController::class, 'show'])->name('client.product.show');
});

Route::prefix('categories')->group(function () {
    Route::get('/', [App\Http\Controllers\Api\Client\CategoryController::class, 'index'])->name('client.categories.index');
    Route::get('/show/{id}', [App\Http\Controllers\Api\Client\CategoryController::class, 'show'])->name('client.categories.show');
    Route::get('/{id}/products', [App\Http\Controllers\Api\Client\CategoryController::class, 'getProducts'])->name('client.category.product.show');
});

Route::prefix('order')->group(function () {
    Route::get('/add', [App\Http\Controllers\Api\Client\OrderController::class, 'createOrder'])->name('client.cart.index');
});