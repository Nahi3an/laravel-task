<?php

use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// category route
require __DIR__ . '/category.php';
//product route
require __DIR__ . '/product.php';
Route::get('/', function () {
    return view('welcome');
});
Route::get('/access-error', function () {
    return view('auth.access-error');
})->name('access.error');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
