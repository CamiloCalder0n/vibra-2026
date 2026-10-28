<?php

use App\Http\Controllers\Api\SaludController;
use Illuminate\Support\Facades\Route;

Route::get('/salud', SaludController::class);
