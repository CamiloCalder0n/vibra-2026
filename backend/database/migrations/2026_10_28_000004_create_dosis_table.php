<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dosis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tratamiento_id')->constrained('tratamientos')->cascadeOnDelete();
            $table->dateTime('programada_para');
            $table->dateTime('dada_en')->nullable();    // nula hasta darla
            $table->timestamps();

            $table->unique(['tratamiento_id', 'programada_para']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosis');
    }
};
