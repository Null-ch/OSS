<?php

use Illuminate\Support\Facades\Route;
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


Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('home');
    Route::get('/cart', [App\Http\Controllers\IndexController::class, 'showCart'])->name('public.cart');
    Route::get('/shop', [App\Http\Controllers\IndexController::class, 'showShop'])->name('public.shop');
    Route::get('/item/{id}', [App\Http\Controllers\IndexController::class, 'showItem'])->name('public.item');
    
    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('/', IndexController::class)->name('admin.index');

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
            Route::get('/create/user', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.user.create');
            Route::get('/{user}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.user.show');
            Route::post('/store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.user.store');
            Route::get('/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.user.edit');
            Route::patch('/update/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.user.update');
            Route::delete('/delete/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.user.destroy');
        });

        Route::group(['prefix' => 'category'], function () {
            Route::get('/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories.index');
            Route::get('/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.category.create');
            Route::get('/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('admin.category.show');
            Route::post('/', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.category.store');
            Route::get('/{category}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.category.edit');
            Route::patch('/update/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.category.update');
            Route::delete('/delete/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin.category.destroy');
        });

        Route::group(['prefix' => 'product'], function () {
            Route::get('/', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products.index');
            Route::get('/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.product.create');
            Route::get('/{product}', [App\Http\Controllers\Admin\ProductController::class, 'show'])->name('admin.product.show');
            Route::post('/', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.product.store');
            Route::get('/{product}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.product.edit');
            Route::patch('/update/{product}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.product.update');
            Route::delete('/delete/{product}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.product.destroy');
        });

        // Route::group(['prefix' => 'color'], function () {
        //     Route::get('/', [App\Http\Controllers\Admin\ColorController::class, 'index'])->name('admin.colors.index');
        //     Route::get('/{color}', [App\Http\Controllers\Admin\ColorController::class, 'show'])->name('admin.color.show');
        //     Route::get('/create/color', [App\Http\Controllers\Admin\ColorController::class, 'create'])->name('admin.color.create');
        //     Route::post('/', [App\Http\Controllers\Admin\ColorController::class, 'store'])->name('admin.color.store');
        //     Route::get('/{color}/edit', [App\Http\Controllers\Admin\ColorController::class, 'edit'])->name('admin.color.edit');
        //     Route::patch('/update/{color}', [App\Http\Controllers\Admin\ColorController::class, 'update'])->name('admin.color.update');
        //     Route::delete('/delete/{color}', [App\Http\Controllers\Admin\ColorController::class, 'destroy'])->name('admin.color.destroy');
        // });

        Route::group(['prefix' => 'order'], function () {
            Route::get('/', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
            Route::get('/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.order.show');
            Route::get('/create/order', [App\Http\Controllers\Admin\OrderController::class, 'create'])->name('admin.order.create');
            Route::post('/', [App\Http\Controllers\Admin\OrderController::class, 'store'])->name('admin.order.store');
            Route::get('/{order}/edit', [App\Http\Controllers\Admin\OrderController::class, 'edit'])->name('admin.order.edit');
            Route::patch('/update/{order}', [App\Http\Controllers\Admin\OrderController::class, 'update'])->name('admin.order.update');
            Route::delete('/delete/{order}', [App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('admin.order.destroy');
        });
        Route::group(['prefix' => 'review'], function () {
            Route::get('/', [App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('admin.reviews.index');
            Route::get('/{review}', [App\Http\Controllers\Admin\ReviewController::class, 'show'])->name('admin.review.show');
            Route::get('/create/review', [App\Http\Controllers\Admin\ReviewController::class, 'create'])->name('admin.review.create');
            Route::post('/', [App\Http\Controllers\Admin\ReviewController::class, 'store'])->name('admin.review.store');
            Route::get('/{review}/edit', [App\Http\Controllers\Admin\ReviewController::class, 'edit'])->name('admin.review.edit');
            Route::patch('/{review}', [App\Http\Controllers\Admin\ReviewController::class, 'update'])->name('admin.review.update');
            Route::delete('/delete/{review}', [App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('admin.review.destroy');
        });
    });
});

/*
|--------------------------------------------------------------------------
| React routes
|--------------------------------------------------------------------------
|
| React routes are located here
|
*/


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Authentication routes are located here
|
*/

Auth::routes();
