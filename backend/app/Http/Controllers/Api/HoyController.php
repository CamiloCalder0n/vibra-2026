<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ResumenDeHoy;
use Illuminate\Http\JsonResponse;

class HoyController extends Controller
{
    public function __invoke(ResumenDeHoy $resumen): JsonResponse
    {
        return response()->json($resumen());
    }
}
