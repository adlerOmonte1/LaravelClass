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
        Schema::create('escuelas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', length: 100);
        });



        // +++++++++++++++++++++++
        // COMO SE HACE AHORA
        // +++++++++++++++++++++++
        Schema::create('facultads', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', length: 100);
            $table->foreignId('facultad_id')->constrained('facultads');
        });


        // Agregar la clave foránea a la tabla escuelas
        // Para agregar una clave foránea, se utiliza el método foreignId

        // +++++++++++++++++++++++
        // para crear la tabla facultad se debe de cambiar el nombre de la migracion a 2026_09_15_221646_create_facultads_table.php para que se ejecute primero
        // +++++++++++++++++++++++
        Schema::table('escuelas', function (Blueprint $table) {
            $table->unsignedBigInteger('facultad_id');
            $table->foreign('facultad_id')->references('id')->on('facultads');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escuelas');
    }
};
