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
        Schema::table('entradasdetalle', function (Blueprint $table) {
            // add as nullable initially to avoid failing when existing rows exist
            if (! Schema::hasColumn('entradasdetalle', 'no_serie')) {
                $table->string('no_serie', 100)->nullable()->after('id_ecm_detm');
            }

            if (! Schema::hasColumn('entradasdetalle', 'id_espaciotrabajo')) {
                $table->unsignedInteger('id_espaciotrabajo')->nullable()->after('no_serie');
            }

            // FK will be added in a follow-up migration after backfilling existing rows
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entradasdetalle', function (Blueprint $table) {
            if (Schema::hasColumn('entradasdetalle', 'id_espaciotrabajo')) {
                // drop foreign if exists
                try {
                    $table->dropForeign(['id_espaciotrabajo']);
                } catch (\Exception $e) {
                    // ignore if foreign key does not exist
                }
                $table->dropColumn('id_espaciotrabajo');
            }

            if (Schema::hasColumn('entradasdetalle', 'no_serie')) {
                $table->dropColumn('no_serie');
            }
        });
    }
};
