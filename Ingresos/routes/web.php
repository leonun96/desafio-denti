<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoreController;
use App\Http\Controllers\IngresosController;
use App\Http\Controllers\EgresosController;

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

Route::get('/', [CoreController::class, 'index'])->name('index');

Route::prefix('ingreso')->name('ingreso.')->group(function () {
    Route::get('/', [IngresosController::class, 'index'])->name('index');
    Route::post('store', [IngresosController::class, 'store'])->name('store');
    Route::patch('{id}/update', [IngresosController::class, 'update'])->name('update');
    Route::delete('{id}/delete', [IngresosController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'egreso', 'as' => 'egreso.'], function () {
    Route::get('/', [EgresosController::class, 'index'])->name('index');
    Route::post('store', [EgresosController::class, 'store'])->name('store');
    Route::patch('{id}/update', [EgresosController::class, 'update'])->name('update');
    Route::delete('{id}/delete', [EgresosController::class, 'delete'])->name('delete');
});



