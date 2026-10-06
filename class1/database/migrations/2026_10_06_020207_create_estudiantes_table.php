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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->char('codigo',10)->unique();
            $table->char('dni',8)->unique();
            $table->string('nombre',60);
            $table->string('apellidos',60);
            $table->string('email',100)->unique();
            $table->date('fecha_nacimiento');
            $table->string('modalidad',15); // presencial | virtual
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
