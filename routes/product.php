<?php

use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;


Route::middleware(['checkAdmin'])->group(function () {
    Route::post('/products/import', [ProductController::class, 'import'])->name('products.import');
    Route::get('/products/export', [ProductController::class, 'export'])->name('products.export');
    Route::post('product/purchase', [ProductController::class, 'purchaseProduct'])->name('product.purchase');
    Route::resource('products', ProductController::class);
});
