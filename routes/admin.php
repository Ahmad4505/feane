<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AddProductController;

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Product Routes
    Route::get('/product', [AddProductController::class, 'index'])->name('show_product');
    Route::get('/create_product', [AddProductController::class, 'create'])->name('create_product');
    Route::post('product/store', [AddProductController::class, 'store'])->name('product.store');
    Route::get('product/{product}', [AddProductController::class, 'show'])->name('product.show');
    Route::put('product/{product}', [AddProductController::class, 'update'])->name('product.update');
    Route::delete('product/{product}', [AddProductController::class, 'destroy'])->name('product.destroy');

    // End Product Routes


    // Category Routes

    Route::get('/category', [CategoryController::class, 'index'])->name('category.show');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::delete('category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::put('category/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('category/show/{category}', [CategoryController::class, 'show'])->name('category.catshow');
    // End Category Routes
});
