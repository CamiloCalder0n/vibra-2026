<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tratamientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perro_id')->constrained('perros')->cascadeOnDelete();
            $table->string('medicamento', 80);
            $table->string('dosis', 80);                // texto: "1 pastilla"
            $table->json('horas');                      // ["08:00", "20:00"]
            $table->date('desde');
            $table->date('hasta');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tratamientos');
    }
};
