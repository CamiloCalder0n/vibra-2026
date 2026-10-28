<?php

namespace Database\Seeders;

use App\Models\Perro;
use Illuminate\Database\Seeder;

class TratamientoSeeder extends Seeder
{
    public function run(): void
    {
        // Rocco: cefalexina cada 12 h por 7 días, empezó hace 3 días a las 2:00 p. m.; hoy va en el día 4.
        // La de hoy a las 2:00 p. m. queda pendiente (dosis id 7) y la siguiente es mañana a las 2:00 a. m.
        $this->tratar('Rocco', 'Cefalexina', '1 pastilla', ['14:00', '02:00'], desde: -3, hasta: 3);

        // Canela: gotas para el ojo, mañana y noche; terminó ayer (no sale entre los que necesitan).
        $this->tratar('Canela', 'Gotas para el ojo', '2 gotas en el ojo izquierdo', ['07:00', '19:00'], desde: -7, hasta: -1);

        // Pirata: antiinflamatorio para la cojera, ya terminó (sale en el resumen del veterinario).
        $this->tratar('Pirata', 'Meloxicam', 'Media pastilla con la comida', ['08:00'], desde: -6, hasta: -2);
    }

    // Crea el tratamiento y sus dosis en orden: la primera el día `desde` a la primera hora de la lista,
    // y de ahí cada hora siguiente, hasta completar días × horas. Quedan dadas las anteriores al mediodía de hoy.
    private function tratar(string $perro, string $medicamento, string $dosis, array $horas, int $desde, int $hasta): void
    {
        $tratamiento = Perro::where('nombre', $perro)->firstOrFail()->tratamientos()->create([
            'medicamento' => $medicamento,
            'dosis' => $dosis,
            'horas' => $horas,
            'desde' => today()->addDays($desde),
            'hasta' => today()->addDays($hasta),
        ]);

        $enOrden = collect($horas)->sort()->values();
        $programada = today()->addDays($desde)->setTimeFromTimeString($horas[0]);
        $mediodia = today()->setTime(12, 0);

        for ($n = 0; $n < ($hasta - $desde + 1) * count($horas); $n++) {
            $tratamiento->tomas()->create([
                'programada_para' => $programada,
                'dada_en' => $programada->lt($mediodia) ? $programada->copy()->addMinutes(2 + ($n * 3) % 13) : null,
            ]);

            $siguiente = $enOrden->first(fn ($hora) => $hora > $programada->format('H:i'));
            $programada = $siguiente
                ? $programada->copy()->setTimeFromTimeString($siguiente)
                : $programada->copy()->addDay()->setTimeFromTimeString($enOrden->first());
        }
    }
}
