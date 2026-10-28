<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Lo corre el arranque del contenedor: siembra solo la primera vez, para que redesplegar no duplique perros.
// Con --de-nuevo borra los datos del refugio y siembra otra vez (fechas relativas al día de hoy, p. ej. el día de la demo).
Artisan::command('refugio:sembrar {--de-nuevo}', function () {
    if ($this->option('de-nuevo')) {
        Schema::withoutForeignKeyConstraints(function () {
            foreach (['dosis', 'tratamientos', 'reportes', 'vacunas', 'perros'] as $tabla) {
                DB::table($tabla)->truncate();
            }
        });
        $this->info('Se borraron los datos del refugio; se siembran de nuevo.');
    } elseif (Schema::hasTable('perros') && DB::table('perros')->exists()) {
        $this->info('Ya hay perros en la base; no se siembra de nuevo.');

        return;
    }

    $this->call('db:seed', ['--force' => true]);
})->purpose('Siembra los datos del refugio si la tabla perros está vacía (--de-nuevo: borra y siembra)');
