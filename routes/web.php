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


// disk
Route::get('disk/{disk}', [\App\Http\Controllers\DiskController::class, 'show'])->name('api.disk.show');

// api
Route::get('api/disk', [\App\Http\Controllers\Api\DiskController::class, 'index'])->name('api.disk.index');
Route::post('api/disk', [\App\Http\Controllers\Api\DiskController::class, 'store'])->name('api.disk.store');
Route::put('api/disk/{disk}', [\App\Http\Controllers\Api\DiskController::class, 'update'])->name('api.disk.update');
Route::get('api/disk/{disk}', [\App\Http\Controllers\Api\DiskController::class, 'show'])->name('api.disk.show');
Route::delete('api/disk/{disk}', [\App\Http\Controllers\Api\DiskController::class, 'destroy'])->name('api.disk.destroy');

Route::get('api/disk/{disk}/file', [\App\Http\Controllers\Api\FileController::class, 'show'])->name('api.disk.file.show');
Route::get('api/disk/{disk}/file/download', [\App\Http\Controllers\Api\FileController::class, 'download'])->name('api.disk.file.download');
Route::delete('api/disk/{disk}/file', [\App\Http\Controllers\Api\FileController::class, 'destroy'])->name('api.disk.file.destroy');
