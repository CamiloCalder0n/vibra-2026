<?php

namespace App\Services;

use App\Models\Perro;
use App\Models\Tratamiento;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

// "Para el veterinario": lo importante de un rango de días en una sola hoja. Fechas calculadas en PHP.
class ResumenVeterinario
{
    public function __invoke(Carbon $desde, Carbon $hasta): array
    {
        $inicio = $desde->copy()->startOfDay();
        $fin = $hasta->copy()->endOfDay();

        return [
            'desde' => $inicio->toDateString(),
            'hasta' => $fin->toDateString(),
            'revisar' => $this->revisar($inicio, $fin),
            'tratamientos' => $this->tratamientos($inicio, $fin),
            'recien_llegados' => Perro::whereBetween('llego_el', [$inicio->toDateString(), $fin->toDateString()])
                ->orderBy('llego_el')->orderBy('nombre')->get()
                ->map(fn (Perro $perro) => [
                    'id' => $perro->id,
                    'nombre' => $perro->nombre,
                    'descripcion' => $perro->descripcion,
                    'como_llego' => $perro->como_llego,
                    'vacunas_al_llegar' => $perro->vacunas,
                    'llego_el' => $perro->llego_el->toDateString(),
                ])->all(),
        ];
    }

    // Perros con reportes en el rango; primero los que tuvieron 3 días seguidos mal.
    private function revisar(Carbon $inicio, Carbon $fin): array
    {
        return Perro::whereHas('reportes', fn ($reportes) => $reportes->whereBetween('creado_en', [$inicio, $fin]))
            ->with(['reportes' => fn ($reportes) => $reportes->whereBetween('creado_en', [$inicio, $fin])->orderBy('creado_en')])
            ->get()
            ->map(function (Perro $perro) {
                $dias = $perro->reportes->map(fn ($reporte) => $reporte->creado_en->toDateString())->unique()->values();

                return [
                    'id' => $perro->id,
                    'nombre' => $perro->nombre,
                    'dias_con_reporte' => $dias->count(),
                    'sintomas' => $perro->reportes->pluck('sintomas')->flatten()->unique()->values()->all(),
                    'alerta' => $this->masDiasSeguidos($dias) >= 3,
                ];
            })
            ->sortBy(fn ($fila) => [$fila['alerta'] ? 0 : 1, -$fila['dias_con_reporte'], $fila['nombre']])
            ->values()->all();
    }

    // Tratamientos que se cruzan con el rango; las dosis se cuentan dentro del rango.
    private function tratamientos(Carbon $inicio, Carbon $fin): array
    {
        return Tratamiento::where('desde', '<=', $fin->toDateString())
            ->where('hasta', '>=', $inicio->toDateString())
            ->with(['perro', 'tomas' => fn ($tomas) => $tomas->whereBetween('programada_para', [$inicio, $fin])])
            ->orderBy('desde')
            ->get()
            ->map(fn (Tratamiento $tratamiento) => [
                'id' => $tratamiento->id,
                'perro_id' => $tratamiento->perro->id,
                'perro' => $tratamiento->perro->nombre,
                'medicamento' => $tratamiento->medicamento,
                'dosis' => $tratamiento->dosis,
                'horas' => $tratamiento->horas,
                'desde' => $tratamiento->desde->toDateString(),
                'hasta' => $tratamiento->hasta->toDateString(),
                'dosis_dadas' => $tratamiento->tomas->whereNotNull('dada_en')->count(),
                'dosis_total' => $tratamiento->tomas->count(),
            ])->all();
    }

    /** @param Collection<int, string> $dias fechas AAAA-MM-DD sin repetir, en orden */
    private function masDiasSeguidos(Collection $dias): int
    {
        $mejor = 0;
        $racha = 0;
        $anterior = null;

        foreach ($dias as $dia) {
            $racha = $anterior && Carbon::parse($anterior)->addDay()->toDateString() === $dia ? $racha + 1 : 1;
            $mejor = max($mejor, $racha);
            $anterior = $dia;
        }

        return $mejor;
    }
}
