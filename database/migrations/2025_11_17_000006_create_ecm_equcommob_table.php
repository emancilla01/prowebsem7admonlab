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
        Schema::create('ecm_equcommob', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo', 50)->unique();
            $table->string('descripcion', 200);
            $table->unsignedBigInteger('id_categoria');
            $table->string('tipo', 20);
            $table->string('estado', 20);
            $table->date('fecha_alta')->nullable();
            $table->timestamps();

            $table->foreign('id_categoria')->references('id')->on('categorias')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecm_equcommob');
    }
};
