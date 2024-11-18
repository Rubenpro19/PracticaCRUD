<?php

use App\Http\Controllers\VehiculoControllers; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Routes; 

Route::get('/user', function (Request $request) { 
    return $request->user(); 
})->middleware('auth:sanctum'); 

//CRUD DE VEHÍCULO
Routes::get('/vehiculo', [VehiculoControllers::class, 'index'])->name('vehiculo.index'); 
Routes::get('/vehiculo/{id}', [VehiculoControllers::class, 'show'])->name('vehiculo.show'); 
Routes::post('/vehiculo', [VehiculoControllers::class, 'store'])->name('vehiculo.store'); 
Routes::put('/vehiculo/{id}', [VehiculoControllers::class, 'update'])->name('vehiculo.update'); 
Routes::delete('/vehiculo/{id}', [VehiculoControllers::class, 'destroy'])->name('vehiculo.destroy'); 