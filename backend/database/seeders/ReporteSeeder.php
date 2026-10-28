<?php

namespace Database\Seeders;

use App\Models\Perro;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ReporteSeeder extends Seeder
{
    public function run(): void
    {
        // Nube: 2 días comiendo poco y nada hoy. En la demo se reporta "Está decaída" y nace el aviso de 3 días.
        $this->reportar('Nube', ['comio_poco'], today()->subDays(2)->setTime(7, 50));
        $this->reportar('Nube', ['comio_poco'], today()->subDays(1)->setTime(8, 20));

        // Reportes sueltos de la semana: ninguno ayer ni hoy (cuentan como "necesita") y ninguno con días seguidos.
        $this->reportar('Zeus', ['herida'], today()->subDays(6)->setTime(17, 15));
        $this->reportar('Lucas', ['vomito'], today()->subDays(5)->setTime(9, 40));
        $this->reportar('Duque', ['decaido'], today()->subDays(5)->setTime(16, 5));
        $this->reportar('Pirata', ['cojea'], today()->subDays(4)->setTime(10, 30));
        $this->reportar('Coco', ['tose'], today()->subDays(4)->setTime(19, 45));
        $this->reportar('Tita', ['no_comio'], today()->subDays(3)->setTime(18, 0));
        $this->reportar('Mona', ['diarrea'], today()->subDays(2)->setTime(11, 25));
    }

    private function reportar(string $perro, array $sintomas, Carbon $cuando): void
    {
        Perro::where('nombre', $perro)->firstOrFail()->reportes()->create([
            'sintomas' => $sintomas,
            'creado_en' => $cuando,
        ]);
    }
}
