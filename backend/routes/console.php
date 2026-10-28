<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Lo corre el arranque del contenedor. Siembra si no hay perros; con --fecha=AAAA-MM-DD (variable RESEMBRAR)
// borra y siembra de nuevo cuando hoy es esa fecha y lo sembrado no es de hoy (una sola vez ese día).
// Con --de-nuevo borra y siembra siempre (a mano, en local).
Artisan::command('refugio:sembrar {--de-nuevo} {--fecha=}', function () {
    $hoy = today()->toDateString();
    $fecha = $this->option('fecha') ?: null;

    if ($fecha !== null && ! preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
        $this->warn("RESEMBRAR={$fecha} no es una fecha AAAA-MM-DD; no se tiene en cuenta.");
        $fecha = null;
    }

    $sembradoEl = DB::table('ajustes')->where('clave', 'sembrado_el')->value('valor');
    $hayPerros = DB::table('perros')->exists();

    // Sin fecha de siembra, los perros vienen de una versión anterior de los seeders: se siembran de nuevo.
    $deNuevo = $this->option('de-nuevo')
        || ($fecha === $hoy && $sembradoEl !== $hoy)
        || ($hayPerros && $sembradoEl === null);

    if (! $deNuevo && $hayPerros) {
        $this->info("Ya hay perros en la base (sembrados el {$sembradoEl}); no se siembra de nuevo.");

        return;
    }

    if ($deNuevo) {
        // Fuera de la transacción: en MySQL un truncate la cerraría. Truncate reinicia los ids (Nube y Rocco quedan igual).
        Schema::withoutForeignKeyConstraints(function () {
            foreach (['dosis', 'tratamientos', 'reportes', 'vacunas', 'perros'] as $tabla) {
                DB::table($tabla)->truncate();
            }
        });
        $this->info('Se borraron los datos del refugio; se siembran de nuevo.');
    }

    // Si algo falla, no queda media siembra: las tablas quedan vacías y el próximo arranque siembra otra vez.
    DB::transaction(function () use ($hoy) {
        $this->call('db:seed', ['--force' => true]);
        DB::table('ajustes')->updateOrInsert(['clave' => 'sembrado_el'], ['valor' => $hoy, 'updated_at' => now()]);
    });

    $this->info("Sembrado el {$hoy}.");
})->purpose('Siembra los datos del refugio si no hay perros (--fecha: resiembra ese día; --de-nuevo: borra y siembra)');
