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
        Schema::create('horario_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreingId('id_horario')->constrained('horarios')->onDelete('cascade'); // relacionar con la tabla horarios
            $table->string('dia');
            $table->string('hora_entrada');
            $table->string('hora_salida');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horario_detalles');
    }
};
