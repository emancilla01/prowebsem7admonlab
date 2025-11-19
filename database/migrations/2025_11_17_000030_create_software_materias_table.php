<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('software_materias', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_software');
            $table->unsignedBigInteger('id_materia');
            $table->string('observaciones', 255)->nullable();
            $table->timestamps();

            $table->index('id_software');
            $table->index('id_materia');

            $table->foreign('id_software')->references('id_software')->on('software')->onDelete('restrict');
            $table->foreign('id_materia')->references('id')->on('materias')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('software_materias');
    }
};
