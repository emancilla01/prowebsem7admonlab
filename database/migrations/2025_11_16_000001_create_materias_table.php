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
        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->string('clave', 50)->unique();
            $table->unsignedBigInteger('id_carrera');
            $table->boolean('requiere_lab')->default(false);
            $table->string('tipo_uso', 50)->nullable();
            $table->string('estatus', 20)->default('activo');
            $table->timestamps();

            $table->index('id_carrera');

            $table->foreign('id_carrera')
                ->references('id_carrera')
                ->on('carreras')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materias');
    }
};
