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
        Schema::create('grupos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_grupo', 100);
            $table->string('clave_grupo', 50)->unique();
            $table->unsignedBigInteger('id_materia');
            $table->unsignedBigInteger('id_periodo');
            $table->unsignedBigInteger('id_personal');
            $table->unsignedBigInteger('id_carrera');
            $table->string('turno', 20)->nullable();
            $table->string('estatus', 20);
            $table->timestamps();

            $table->foreign('id_materia')->references('id')->on('materias')->onDelete('restrict');
            $table->foreign('id_periodo')->references('id')->on('periodos')->onDelete('restrict');
            $table->foreign('id_personal')->references('id')->on('personals')->onDelete('restrict');
            $table->foreign('id_carrera')->references('id_carrera')->on('carreras')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
