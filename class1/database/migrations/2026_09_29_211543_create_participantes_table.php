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
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombres',60);
            $table->string('apellidos',60);
            $table->char('dni',8)->unique();
            $table->string('correo',100)->unique();
            $table->char('celular',9)->nullable();
            $table->date('fecha_nacimiento');
            $table->enum('modalidad',['presencial','virtual']);
            $table->boolean('es_estudiante')->default(false);
            $table->char('codigo_estudiante',9)->nullable();
            $table->unsignedBigInteger('ciclo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participantes');
    }
};
