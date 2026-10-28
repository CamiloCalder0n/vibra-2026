<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // dateTime guarda la hora de Bogotá tal cual; timestamp en MySQL la convierte según la zona de la conexión.
    public function up(): void
    {
        Schema::table('reportes', function (Blueprint $table) {
            $table->dateTime('creado_en')->change();
        });
    }

    public function down(): void
    {
        Schema::table('reportes', function (Blueprint $table) {
            $table->timestamp('creado_en')->change();
        });
    }
};
