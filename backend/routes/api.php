<?php

use App\Http\Controllers\Api\HoyController;
use App\Http\Controllers\Api\SaludController;
use Illuminate\Support\Facades\Route;

Route::get('/salud', SaludController::class);
Route::get('/hoy', HoyController::class);
