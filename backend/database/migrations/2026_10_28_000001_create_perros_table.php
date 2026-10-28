<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 60);
            $table->string('sexo', 10);                 // macho | hembra | no_se
            $table->string('descripcion', 120)->nullable();
            $table->string('edad_aprox', 30)->nullable();
            $table->string('foto_url')->nullable();
            $table->string('como_llego', 10);           // bien | flaco | herido | enfermo
            $table->string('vacunas', 10);              // si | no | no_se (lo que se sabía al llegar)
            $table->string('cuidados')->nullable();
            $table->date('llego_el');
            $table->string('estado', 15)->default('en_refugio'); // en_refugio | adoptado
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perros');
    }
};
