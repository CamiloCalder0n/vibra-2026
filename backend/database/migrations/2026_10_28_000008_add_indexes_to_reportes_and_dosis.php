<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Para "Hoy", la ficha (últimos 7 días) y Medicinas: reportes por perro y fecha, dosis por fecha y hora.
    public function up(): void
    {
        Schema::table('reportes', function (Blueprint $table) {
            $table->index(['perro_id', 'creado_en']);
        });

        Schema::table('dosis', function (Blueprint $table) {
            $table->index('programada_para');
        });
    }

    public function down(): void
    {
        Schema::table('reportes', function (Blueprint $table) {
            $table->dropIndex(['perro_id', 'creado_en']);
        });

        Schema::table('dosis', function (Blueprint $table) {
            $table->dropIndex(['programada_para']);
        });
    }
};
