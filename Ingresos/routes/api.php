<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CoreController;
use App\Http\Controllers\IngresosApiController;
use App\Http\Controllers\EgresosApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/dashboard', [CoreController::class, 'api'])->name('index.api');

Route::prefix('ingreso')->name('ingreso.')->group(function () {
	Route::get('/', [IngresosApiController::class, 'index'])->name('index');
	Route::post('store', [IngresosApiController::class, 'store'])->name('store');
	Route::patch('{id}/update', [IngresosApiController::class, 'update'])->name('update');
	Route::delete('{id}/delete', [IngresosApiController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'egreso', 'as' => 'egreso.'], function () {
	Route::get('/', [EgresosApiController::class, 'index'])->name('index');
	Route::post('store', [EgresosApiController::class, 'store'])->name('store');
	Route::patch('{id}/update', [EgresosApiController::class, 'update'])->name('update');
	Route::delete('{id}/delete', [EgresosApiController::class, 'delete'])->name('delete');
});
