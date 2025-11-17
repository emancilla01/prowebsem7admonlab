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
        Schema::create('ecm_detequcom', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_ecm');
            $table->string('serial', 100)->nullable();
            $table->string('modelo', 100)->nullable();
            $table->string('marca', 100)->nullable();
            $table->string('descripcion', 200)->nullable();
            $table->string('estado', 20)->default('activo');
            $table->date('fecha_adquisicion')->nullable();
            $table->string('ubicacion', 100)->nullable();
            $table->timestamps();

            $table->foreign('id_ecm')->references('id')->on('ecm_equcommob')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecm_detequcom');
    }
};
