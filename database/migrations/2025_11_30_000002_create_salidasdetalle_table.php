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
        Schema::create('salidasdetalle', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_salida');
            $table->unsignedBigInteger('id_entradadetalle');
            $table->string('motivo_de_salida', 255);
            $table->timestamps();

            $table->foreign('id_salida')
                ->references('id')->on('salidas')
                ->onDelete('cascade');

            $table->foreign('id_entradadetalle')
                ->references('id')->on('entradasdetalle')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salidasdetalle');
    }
};
