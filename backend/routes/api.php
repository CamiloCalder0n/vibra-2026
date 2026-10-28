<?php

use App\Http\Controllers\Api\HoyController;
use App\Http\Controllers\Api\MedicinaController;
use App\Http\Controllers\Api\PerroController;
use App\Http\Controllers\Api\ReporteController;
use App\Http\Controllers\Api\SaludController;
use Illuminate\Support\Facades\Route;

Route::get('/salud', SaludController::class);
Route::get('/hoy', HoyController::class);

Route::apiResource('perros', PerroController::class)->only(['index', 'show', 'store', 'update']);
Route::post('/perros/{perro}/reportes', [ReporteController::class, 'store']);
Route::delete('/reportes/{reporte}', [ReporteController::class, 'destroy']);

Route::get('/medicinas/hoy', [MedicinaController::class, 'hoy']);
