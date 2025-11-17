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
        Schema::create('grupos_labs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_grupo');
            $table->unsignedInteger('id_espacio');
            $table->string('horario', 100)->nullable();
            $table->timestamps();

            $table->foreign('id_grupo')->references('id')->on('grupos')->onDelete('restrict');
            $table->foreign('id_espacio')->references('id_espacio')->on('espacios_trabajo')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos_labs');
    }
};
