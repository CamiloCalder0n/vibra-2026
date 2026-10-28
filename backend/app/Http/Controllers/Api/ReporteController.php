<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Perro;
use App\Models\Reporte;
use App\Services\EstadoDeHoy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReporteController extends Controller
{
    // "Un perro está mal": guarda los síntomas y dice si ya hay que llamar al veterinario.
    public function store(Request $request, Perro $perro): JsonResponse
    {
        $datos = $request->validate([
            'sintomas' => ['required', 'array', 'min:1'],
            'sintomas.*' => ['required', Rule::in(Reporte::SINTOMAS)],
            'nota_voz_url' => ['nullable', 'string', 'max:255'],
        ], [
            'sintomas.required' => "Toque lo que le pasa a {$perro->nombre}.",
            'sintomas.min' => "Toque lo que le pasa a {$perro->nombre}.",
            'sintomas.array' => "Toque lo que le pasa a {$perro->nombre}.",
            'sintomas.*.in' => 'Ese síntoma no está en la lista.',
        ]);

        $reporte = $perro->reportes()->create([
            'sintomas' => array_values(array_unique($datos['sintomas'])),
            'nota_voz_url' => $datos['nota_voz_url'] ?? null,
        ]);

        return response()->json([
            'id' => $reporte->id,
            'mensaje' => "Listo, quedó guardado lo de {$perro->nombre}",
            'alerta' => (new EstadoDeHoy($perro->load('reportesRecientes', 'dosisDeHoy.tratamiento')))->textoAlerta(),
        ], 201);
    }

    // "Me equivoqué, borrar" (o Deshacer). El estado de hoy se recalcula solo: no hay nada guardado aparte.
    public function destroy(Reporte $reporte): Response
    {
        $reporte->delete();

        return response()->noContent();
    }
}
