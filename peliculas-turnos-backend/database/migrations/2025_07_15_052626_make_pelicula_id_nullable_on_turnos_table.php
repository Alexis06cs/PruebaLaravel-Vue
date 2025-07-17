<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('turnos', function (Blueprint $table) {
            $table->dropForeign(['pelicula_id']); 
            $table->foreignId('pelicula_id')->nullable()->change(); 
            $table->foreign('pelicula_id')->references('id')->on('peliculas')->nullOnDelete(); 
        });
    }

    public function down(): void
    {
        Schema::table('turnos', function (Blueprint $table) {
            $table->dropForeign(['pelicula_id']);
            $table->foreignId('pelicula_id')->nullable(false)->change();
            $table->foreign('pelicula_id')->references('id')->on('peliculas')->onDelete('cascade');
        });
    }
};
