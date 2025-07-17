<?php
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\TurnoController;

Route::get('/turnos/disponibles', [TurnoController::class, 'disponibles']);
Route::post('/turnos/asignar/{id}', [TurnoController::class, 'asignarTurno']);
Route::post('/turnos/liberar/{id}', [TurnoController::class, 'liberar']);


Route::apiResource('peliculas', PeliculaController::class);
Route::apiResource('turnos', TurnoController::class);

Route::get('/prueba', function () {
    return response()->json(['mensaje' => 'API funcionando']);



});
