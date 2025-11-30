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
        Schema::create('entradasdetalle', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_entrada');
            $table->unsignedBigInteger('id_ecm_dete')->nullable();
            $table->unsignedBigInteger('id_ecm_detm')->nullable();
            $table->timestamps();

            $table->foreign('id_entrada')->references('id')->on('entradas')->onDelete('cascade');
            $table->foreign('id_ecm_dete')->references('id')->on('ecm_detequcom')->onDelete('set null');
            $table->foreign('id_ecm_detm')->references('id')->on('ecm_detmob')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradasdetalle');
    }
};
