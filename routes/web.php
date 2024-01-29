<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\IndexController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/home');
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', IndexController::class)->name('admin_index');

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user.index');
        Route::get('/{user}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.user.show');
        Route::get('/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.user.create');
        Route::post('/', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.user.store');
        Route::get('/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.user.edit');
        Route::patch('/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.user.update');
        Route::patch('/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.user.destroy');
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('admin.category.show');
        Route::get('/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/{category}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::patch('/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.category.update');
        Route::patch('/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin.category.destroy');
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.product.index');
        Route::get('/{product}', [App\Http\Controllers\Admin\ProductController::class, 'show'])->name('admin.product.show');
        Route::get('/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.product.create');
        Route::post('/', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.product.store');
        Route::get('/{product}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.product.edit');
        Route::patch('/{product}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.product.update');
        Route::patch('/{product}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.product.destroy');
    });

    Route::group(['prefix' => 'color'], function () {
        Route::get('/', [App\Http\Controllers\Admin\ColorController::class, 'index'])->name('admin.color.index');
        Route::get('/{color}', [App\Http\Controllers\Admin\ColorController::class, 'show'])->name('admin.color.show');
        Route::get('/create', [App\Http\Controllers\Admin\ColorController::class, 'create'])->name('admin.color.create');
        Route::post('/', [App\Http\Controllers\Admin\ColorController::class, 'store'])->name('admin.color.store');
        Route::get('/{color}/edit', [App\Http\Controllers\Admin\ColorController::class, 'edit'])->name('admin.color.edit');
        Route::patch('/{color}', [App\Http\Controllers\Admin\ColorController::class, 'update'])->name('admin.color.update');
        Route::patch('/{color}', [App\Http\Controllers\Admin\ColorController::class, 'destroy'])->name('admin.color.destroy');
    });
});


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Authentication routes are located here
|
*/
Auth::routes(['home' => '/home']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
