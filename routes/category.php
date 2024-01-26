<?php

use App\Http\Controllers\Category\CategoryController;
use Illuminate\Support\Facades\Route;

// Route::post('x', [CategoryController::class, 'store']);
Route::resource('categories', CategoryController::class);
