<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ResumenVeterinario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VeterinarioController extends Controller
{
    // Sin fechas: los últimos 7 días (de hace 6 días a hoy).
    public function resumen(Request $request, ResumenVeterinario $resumen): JsonResponse
    {
        $request->validate([
            'desde' => ['nullable', 'date_format:Y-m-d'],
            'hasta' => ['nullable', 'date_format:Y-m-d', 'after_or_equal:desde'],
        ], [
            'desde.date_format' => 'La fecha desde debe ser AAAA-MM-DD.',
            'hasta.date_format' => 'La fecha hasta debe ser AAAA-MM-DD.',
            'hasta.after_or_equal' => 'La fecha hasta no puede ser antes de la fecha desde.',
        ]);

        $desde = $request->filled('desde') ? Carbon::parse($request->query('desde')) : today()->subDays(6);
        $hasta = $request->filled('hasta') ? Carbon::parse($request->query('hasta')) : today();

        return response()->json($resumen($desde, $hasta));
    }
}
