<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vacunas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perro_id')->constrained('perros')->cascadeOnDelete();
            $table->string('nombre', 15);               // moquillo | parvovirus | rabia
            $table->date('aplicada_el')->nullable();    // nula = falta
            $table->timestamps();

            $table->unique(['perro_id', 'nombre']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vacunas');
    }
};
