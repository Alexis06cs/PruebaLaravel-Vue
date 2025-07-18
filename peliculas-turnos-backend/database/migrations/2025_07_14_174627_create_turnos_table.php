<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('turnos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pelicula_id')->nullable()->constrained('peliculas')->nullOnDelete();
        $table->time('hora_inicio');
        $table->time('hora_fin');
        $table->string('sala');
        $table->string('estado')->default('activo');
        $table->timestamps();
    });

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turnos');
    }
};
