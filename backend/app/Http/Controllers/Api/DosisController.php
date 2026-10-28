<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dosis;
use App\Services\EstadoDeHoy;
use Illuminate\Http\JsonResponse;

class DosisController extends Controller
{
    // "Ya se la di". En un solo paso: solo se marca si sigue sin dar, así dos toques seguidos no la dan dos veces.
    // Sirve también tarde: guarda la hora real.
    public function dar(Dosis $dosis): JsonResponse
    {
        $ahora = now();
        $marcadas = Dosis::whereKey($dosis->id)->whereNull('dada_en')->update(['dada_en' => $ahora, 'updated_at' => $ahora]);

        if ($marcadas === 0) {
            return response()->json([
                'mensaje' => $dosis->refresh()->textoYaDada(),
                'errores' => ['dosis' => ['ya_dada']],
            ], 409);
        }

        return response()->json([
            'dada_en' => $ahora->toIso8601String(),
            'mensaje' => 'Dada a las '.EstadoDeHoy::hora($ahora),
        ]);
    }
}
