<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\ClienteController;

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
    return view('welcome');
});

Route::prefix('vehiculos')->group(function () {
    Route::get('/vehiculos', [VehiculoController::class, 'vehiculos'])->name('vehiculos');
    Route::post('/registroReportes', [VehiculoController::class, 'registroReportes'])->name('registroReportes');
});

Route::prefix('clientes')->group(function () {
    Route::get('/clientes', [ClienteController::class, 'clientes'])->name('clientes');
    Route::post('/registrarReservacion', [ClienteController::class, 'registrarReservacion'])->name('registrarReservacion');
});