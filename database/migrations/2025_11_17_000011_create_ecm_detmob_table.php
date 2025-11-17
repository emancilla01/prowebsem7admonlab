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
        Schema::create('ecm_detmob', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_ecm');
            $table->string('codigo', 100)->nullable();
            $table->string('descripcion', 200)->nullable();
            $table->string('material', 100)->nullable();
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
        Schema::dropIfExists('ecm_detmob');
    }
};
