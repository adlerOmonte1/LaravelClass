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
        Schema::create('perfils', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estudiante_id')->unique(); // relacion 1-1
            $table->char('celular',9)->nullable();
            $table->string('direccion', 150)->nullable();
            $table->text('bibliografia')->nullable();
            $table->timestamps();

            $table->foreign('estudiante_id')->references('id')
                ->on('estudiantes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfils');
    }
};
