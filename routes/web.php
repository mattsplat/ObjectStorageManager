<?php

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

Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/ajax/native/dialog', [\App\Http\Controllers\NativeController::class, 'dialog'])->name('native.dialog');
Route::post('/ajax/native/clipboard', [\App\Http\Controllers\NativeController::class, 'clipboard'])->name('native.clipboard');
