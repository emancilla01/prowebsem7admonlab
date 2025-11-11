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
        Schema::create('espacios_trabajo', function (Blueprint $table) {
            $table->increments('id_espacio');
            $table->string('nombre_espacio');
            $table->string('tipo_espacio');
            $table->string('ubicacion')->nullable();
            $table->integer('capacidad')->nullable();
            $table->string('responsable')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('espacios_trabajo');
    }
};
