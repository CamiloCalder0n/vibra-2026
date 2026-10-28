<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // La semana anterior del Refugio Yesenia, con fechas relativas a hoy (ficticio).
        $this->call([
            PerroSeeder::class,
            TratamientoSeeder::class,
            ReporteSeeder::class,
        ]);
    }
}
