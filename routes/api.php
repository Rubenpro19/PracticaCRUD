<?php

use App\Http\Controllers\VehiculoController; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Route; 

Route::get('/user', function (Request $request) { 
    return $request->user(); 
})->middleware('auth:sanctum'); 

//CRUD DE VEHÍCULO
Route::get('/vehiculo', [VehiculoController::class, 'index'])->name('vehiculo.index'); 
Route::get('/vehiculo/{id}', [VehiculoController::class, 'show'])->name('vehiculo.show'); 
Route::post('/vehiculo', [VehiculoController::class, 'store'])->name('vehiculo.store'); 
Route::put('/vehiculo/{id}', [VehiculoController::class, 'update'])->name('vehiculo.update'); 
Route::delete('/vehiculo/{id}', [VehiculoController::class, 'destroy'])->name('vehiculo.destroy'); 