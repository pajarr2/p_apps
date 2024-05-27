<?php

use App\Http\Controllers\DefaultController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('authanticate', [DefaultController::class, 'authanticate'])->name('authanticate');
Route::post('store', [DefaultController::class, 'store'])->name('store');
Route::get('register', [DefaultController::class, 'register'])->name('register');
Route::get('/', [DefaultController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DefaultController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [DefaultController::class, 'logout'])->name('logout');
});
