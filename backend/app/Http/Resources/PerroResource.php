<?php

namespace App\Http\Resources;

use App\Services\EstadoDeHoy;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

// La ficha del perro. Las fechas se formatean aquí: un Carbon suelto saldría en UTC.
class PerroResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $estado = new EstadoDeHoy($this->resource);

        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'sexo' => $this->sexo,
            'descripcion' => $this->descripcion,
            'edad_aprox' => $this->edad_aprox,
            'foto_url' => $this->foto_url,
            'como_llego' => $this->como_llego,
            'vacunas_al_llegar' => $this->vacunas, // si | no | no_se; "vacunas" es la lista de abajo
            'cuidados' => $this->cuidados,
            'llego_el' => $this->llego_el->toDateString(),
            'estado' => $this->estado,
            'estado_hoy' => $estado->estadoHoy(),
            'motivo' => $estado->motivo(),
            'ultimos_7_dias' => $estado->ultimos7Dias(),
            'alerta' => $estado->textoAlerta(),
            'vacunas' => $this->registroVacunas->sortBy('nombre')->map(fn ($vacuna) => [
                'nombre' => $vacuna->nombre,
                'aplicada_el' => $vacuna->aplicada_el?->toDateString(),
            ])->values(),
            // En curso o por empezar; los terminados salen en el resumen del veterinario.
            'tratamientos' => $this->tratamientos->filter(fn ($tratamiento) => $tratamiento->hasta->gte(today()))->map(fn ($tratamiento) => [
                'id' => $tratamiento->id,
                'medicamento' => $tratamiento->medicamento,
                'dosis' => $tratamiento->dosis,
                'horas' => $tratamiento->horas,
                'desde' => $tratamiento->desde->toDateString(),
                'hasta' => $tratamiento->hasta->toDateString(),
            ])->values(),
            // Para "Me equivoqué, borrar" en la ficha (DELETE /api/reportes/{id}); el más nuevo primero.
            'reportes' => $this->reportesRecientes->sortByDesc('creado_en')->map(fn ($reporte) => [
                'id' => $reporte->id,
                'sintomas' => $reporte->sintomas,
                'creado_en' => $reporte->creado_en->toIso8601String(),
            ])->values(),
        ];
    }
}
