<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Lo corre el arranque del contenedor: siembra solo la primera vez, para que redesplegar no duplique perros.
Artisan::command('refugio:sembrar', function () {
    if (Schema::hasTable('perros') && DB::table('perros')->exists()) {
        $this->info('Ya hay perros en la base; no se siembra de nuevo.');

        return;
    }

    $this->call('db:seed', ['--force' => true]);
})->purpose('Siembra los datos del refugio si la tabla perros está vacía');
