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
        Schema::create('software', function (Blueprint $table) {
            $table->increments('id_software');
            $table->string('nombre_software');
            $table->string('version')->nullable();
            $table->string('licencia')->nullable();
            $table->string('proveedor')->nullable();
            $table->date('fecha_instalacion')->nullable();
            $table->unsignedInteger('id_espacio')->nullable();
            $table->timestamps();

            // foreign key to espacios_trabajo (optional)
            $table->foreign('id_espacio')->references('id_espacio')->on('espacios_trabajo')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('software');
    }
};
