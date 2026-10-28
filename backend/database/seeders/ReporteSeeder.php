<?php

namespace Database\Seeders;

use App\Models\Perro;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ReporteSeeder extends Seeder
{
    public function run(): void
    {
        // Nube: 3 días comiendo poco y hoy decaída → alerta "Llame al veterinario".
        $this->reportar('Nube', ['comio_poco'], today()->subDays(3)->setTime(8, 10));
        $this->reportar('Nube', ['comio_poco'], today()->subDays(2)->setTime(7, 50));
        $this->reportar('Nube', ['comio_poco'], today()->subDays(1)->setTime(8, 20));
        $this->reportar('Nube', ['decaido'], $this->hoyALas(7, 30));

        // Reportes sueltos de la semana: ninguno hoy y ninguno con 3 días seguidos.
        $this->reportar('Zeus', ['herida'], today()->subDays(6)->setTime(17, 15));
        $this->reportar('Lucas', ['vomito'], today()->subDays(5)->setTime(9, 40));
        $this->reportar('Lucero', ['decaido'], today()->subDays(5)->setTime(16, 5));
        $this->reportar('Pirata', ['cojea'], today()->subDays(4)->setTime(10, 30));
        $this->reportar('Tita', ['no_comio'], today()->subDays(3)->setTime(18, 0));
        $this->reportar('Mona', ['diarrea'], today()->subDays(2)->setTime(11, 25));
        $this->reportar('Coco', ['tose'], today()->subDays(1)->setTime(19, 45));
    }

    private function reportar(string $perro, array $sintomas, Carbon $cuando): void
    {
        Perro::where('nombre', $perro)->firstOrFail()->reportes()->create([
            'sintomas' => $sintomas,
            'creado_en' => $cuando,
        ]);
    }

    // Hoy a esa hora, o ahora mismo si todavía es más temprano (un reporte nunca queda en el futuro).
    private function hoyALas(int $hora, int $minuto): Carbon
    {
        $cuando = today()->setTime($hora, $minuto);

        return $cuando->isFuture() ? now() : $cuando;
    }
}
