<?php

namespace App\Http\Resources;

use App\Services\EstadoDeHoy;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

// Un perro en la lista de Mis perros.
class PerroResumenResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'foto_url' => $this->foto_url,
            'estado_hoy' => (new EstadoDeHoy($this->resource))->estadoHoy(),
        ];
    }
}
