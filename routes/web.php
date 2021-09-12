<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('auth.signin');
});

Route::get('/register', [AuthController::class, 'signup'])->name('register');
Route::post('/create-user', [AuthController::class, 'customSignup'])->name('user.creation');


Route::get('/dashboard', [AuthController::class, 'dashboardView'])->name('dashboard');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/custom-signin', [AuthController::class, 'createSignin'])->name('signin.custom');


Route::prefix('products')->group(function () {
    Route::get('/index',[ProductController::class,'index'])->name('product.index');
    Route::get('/create',[ProductController::class,'create']);
    Route::get('/{id}',[ProductController::class,'show'])->name('product.show');
    Route::post('/', [ProductController::class,'store'])->name('product.store');
    Route::get('edit/{id}',[ProductController::class,'edit'])->name('product.edit');
    Route::delete('delete/{id}',[ProductController::class,'destroy'])->name('product.delete');
});

