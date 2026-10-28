<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class SaludController extends Controller
{
    // Para saber si la API está en línea (Docker, Render, frontend).
    public function __invoke(): JsonResponse
    {
        return response()->json(['ok' => true]);
    }
}
