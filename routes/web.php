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

Route::get('/', [\App\Http\Controllers\WebController::class, 'index'])->name('rov.index');
Route::post('/', [\App\Http\Controllers\RoaCheckController::class, 'index'])->name('rov.check');

Route::get('/dropRpkiInvalidCheck', [\App\Http\Controllers\DropInvalidCheckController::class, 'index'])->name('dropRpkiInvalidCheck');
