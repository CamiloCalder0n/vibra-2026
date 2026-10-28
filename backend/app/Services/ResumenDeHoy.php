<?php

namespace App\Services;

use App\Models\Perro;

// La pantalla Hoy: quién necesita atención, qué medicinas faltan y cuántos están bien. Ningún número va fijo.
class ResumenDeHoy
{
    private const ORDEN = ['mal' => 0, 'medicina' => 1, 'nuevo' => 2];

    public function __invoke(): array
    {
        $estados = Perro::enRefugio()->conLoDeHoy()->orderBy('nombre')->get()
            ->map(fn (Perro $perro) => new EstadoDeHoy($perro));

        // Primero los que tienen aviso de veterinario, luego mal, medicina y nuevos.
        $necesitan = $estados->filter->necesita()
            ->sortBy(fn (EstadoDeHoy $estado) => [$estado->alerta() ? 0 : 1, self::ORDEN[$estado->motivos()[0]], $estado->perro->nombre])
            ->values();

        return [
            'fecha' => today()->toDateString(),
            'necesitan' => $necesitan->map(fn (EstadoDeHoy $estado) => [
                'id' => $estado->perro->id,
                'nombre' => $estado->perro->nombre,
                'motivo' => $estado->motivo(),
                'alerta' => $estado->alerta(),
            ])->all(),
            'medicinas_pendientes' => $estados
                ->flatMap(fn (EstadoDeHoy $estado) => $estado->dosisPendientes()->map(fn ($dosis) => [
                    'dosis_id' => $dosis->id,
                    'perro' => $estado->perro->nombre,
                    'medicamento' => $dosis->tratamiento->medicamento,
                    'hora' => $dosis->programada_para->format('H:i'),
                    'programada_para' => $dosis->programada_para,
                ]))
                ->sortBy('programada_para')
                ->map(fn ($fila) => collect($fila)->except('programada_para')->all())
                ->values()->all(),
            'en_refugio' => $estados->count(),
            'bien' => $estados->count() - $necesitan->count(),
        ];
    }
}
