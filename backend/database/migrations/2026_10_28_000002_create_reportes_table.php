<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perro_id')->constrained('perros')->cascadeOnDelete();
            $table->json('sintomas');                   // ["comio_poco", "decaido", ...]
            $table->string('nota_voz_url')->nullable();
            $table->timestamp('creado_en');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
