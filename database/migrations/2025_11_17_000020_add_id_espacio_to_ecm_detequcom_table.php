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
        Schema::table('ecm_detequcom', function (Blueprint $table) {
            if (!Schema::hasColumn('ecm_detequcom', 'id_espacio')) {
                $table->unsignedInteger('id_espacio')->nullable()->after('id_ecm');
                $table->foreign('id_espacio')->references('id_espacio')->on('espacios_trabajo')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ecm_detequcom', function (Blueprint $table) {
            if (Schema::hasColumn('ecm_detequcom', 'id_espacio')) {
                $table->dropForeign(['id_espacio']);
                $table->dropColumn('id_espacio');
            }
        });
    }
};
