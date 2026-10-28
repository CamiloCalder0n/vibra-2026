<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePerroRequest;
use App\Http\Resources\PerroResource;
use App\Http\Resources\PerroResumenResource;
use App\Models\Perro;
use App\Services\EstadoDeHoy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\Rule;

class PerroController extends Controller
{
    // filtro de la URL → motivo de EstadoDeHoy
    private const FILTROS = ['mal' => 'mal', 'medicina' => 'medicina', 'nuevos' => 'nuevo'];

    public function index(Request $request): AnonymousResourceCollection
    {
        $request->validate(
            ['filtro' => ['nullable', Rule::in(array_keys(self::FILTROS))]],
            ['filtro.in' => 'El filtro debe ser mal, medicina o nuevos.'],
        );

        $perros = Perro::enRefugio()->conLoDeHoy()->orderBy('nombre')->get();

        if ($filtro = $request->query('filtro')) {
            $perros = $perros->filter(fn (Perro $perro) => in_array(self::FILTROS[$filtro], (new EstadoDeHoy($perro))->motivos(), true));
        }

        return PerroResumenResource::collection($perros->values());
    }

    public function show(Perro $perro): PerroResource
    {
        return $this->ficha($perro);
    }

    public function store(StorePerroRequest $request): JsonResponse
    {
        $perro = Perro::create($request->validated());

        return $this->fichaConMensaje($perro, "Bienvenido, {$perro->nombre}. Ya está en Mis perros.", 201);
    }

    private function ficha(Perro $perro): PerroResource
    {
        return new PerroResource($perro->load(['reportesRecientes', 'dosisDeHoy.tratamiento', 'registroVacunas', 'tratamientos']));
    }

    // La ficha y un mensaje para la pantalla. No se usa additional(): Laravel volvería a envolver todo en "data".
    private function fichaConMensaje(Perro $perro, string $mensaje, int $codigo): JsonResponse
    {
        return response()->json([...$this->ficha($perro)->resolve(), 'mensaje' => $mensaje], $codigo);
    }
}
