<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class DemoController extends Controller
{
    // Botón de reiniciar la demo: borra los datos del refugio y los siembra otra vez con las fechas de hoy.
    public function reiniciar(): JsonResponse
    {
        Artisan::call('refugio:sembrar', ['--de-nuevo' => true]);

        return response()->json([
            'mensaje' => 'Listo, la demo volvió al comienzo.',
            'sembrado_el' => DB::table('ajustes')->where('clave', 'sembrado_el')->value('valor'),
        ]);
    }
}
