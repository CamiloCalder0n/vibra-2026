<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DosisResource;
use App\Models\Dosis;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MedicinaController extends Controller
{
    // Medicinas de hoy: todas las dosis del día (dadas y por dar) de los perros que están en el refugio.
    public function hoy(): AnonymousResourceCollection
    {
        $dosis = Dosis::whereBetween('programada_para', [today(), today()->endOfDay()])
            ->whereHas('tratamiento.perro', fn ($perro) => $perro->enRefugio())
            ->with('tratamiento.perro')
            ->orderBy('programada_para')
            ->get();

        return DosisResource::collection($dosis);
    }
}
