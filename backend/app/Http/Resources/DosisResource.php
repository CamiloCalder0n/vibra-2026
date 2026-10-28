<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

// Una fila de la pantalla Medicinas.
class DosisResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'dosis_id' => $this->id,
            'perro_id' => $this->tratamiento->perro->id,
            'perro' => $this->tratamiento->perro->nombre,
            'medicamento' => $this->tratamiento->medicamento,
            'dosis' => $this->tratamiento->dosis,
            'hora' => $this->programada_para->format('H:i'),
            'dada_en' => $this->dada_en?->toIso8601String(),
        ];
    }
}
