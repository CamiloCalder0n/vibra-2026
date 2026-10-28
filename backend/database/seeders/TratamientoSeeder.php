<?php

namespace Database\Seeders;

use App\Models\Perro;
use Illuminate\Database\Seeder;

class TratamientoSeeder extends Seeder
{
    public function run(): void
    {
        // Rocco: cefalexina cada 12 h por 7 días; hoy va en el día 4 y la de las 8:00 a. m. está pendiente.
        $this->tratar('Rocco', 'Cefalexina', '1 pastilla', ['08:00', '20:00'], desde: -3, hasta: 3);

        // Canela: gotas para el ojo, mañana y noche.
        $this->tratar('Canela', 'Gotas para el ojo', '2 gotas en el ojo izquierdo', ['07:00', '19:00'], desde: -5, hasta: 2);

        // Pirata: antiinflamatorio para la cojera, ya terminó (sale en el resumen del veterinario).
        $this->tratar('Pirata', 'Meloxicam', 'Media pastilla con la comida', ['08:00'], desde: -6, hasta: -2);
    }

    // Crea el tratamiento y una dosis por día y hora. Las de días pasados quedan dadas; las de hoy en adelante, pendientes.
    private function tratar(string $perro, string $medicamento, string $dosis, array $horas, int $desde, int $hasta): void
    {
        $tratamiento = Perro::where('nombre', $perro)->firstOrFail()->tratamientos()->create([
            'medicamento' => $medicamento,
            'dosis' => $dosis,
            'horas' => $horas,
            'desde' => today()->addDays($desde),
            'hasta' => today()->addDays($hasta),
        ]);

        for ($dia = $desde; $dia <= $hasta; $dia++) {
            foreach ($horas as $j => $hora) {
                [$h, $m] = explode(':', $hora);
                $programada = today()->addDays($dia)->setTime((int) $h, (int) $m);

                $tratamiento->tomas()->create([
                    'programada_para' => $programada,
                    'dada_en' => $dia < 0 ? $programada->copy()->addMinutes(2 + (abs($dia) * 3 + $j * 5) % 13) : null,
                ]);
            }
        }
    }
}
