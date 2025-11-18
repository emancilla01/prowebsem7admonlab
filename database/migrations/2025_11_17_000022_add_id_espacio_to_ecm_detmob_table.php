<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ensure there is at least one EspacioTrabajo to assign as default
        $default = DB::table('espacios_trabajo')->value('id_espacio');
        if (!$default) {
            $default = DB::table('espacios_trabajo')->insertGetId([
                'nombre_espacio' => 'Sin asignar',
                'tipo_espacio' => 'Desconocido',
                'ubicacion' => null,
                'capacidad' => null,
                'responsable' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Add nullable column if it doesn't exist
        if (!Schema::hasColumn('ecm_detmob', 'id_espacio')) {
            Schema::table('ecm_detmob', function (Blueprint $table) {
                $table->unsignedInteger('id_espacio')->nullable()->after('id_ecm');
            });
        }

        // Update existing NULLs to the default id
        DB::table('ecm_detmob')->whereNull('id_espacio')->update(['id_espacio' => $default]);

        // Drop any existing FK on the column (lookup constraint name), ignore errors
        try {
            $results = DB::select(
                "SELECT CONSTRAINT_NAME as fk FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'ecm_detmob' AND COLUMN_NAME = 'id_espacio' AND REFERENCED_TABLE_NAME = 'espacios_trabajo'"
            );
            if (!empty($results)) {
                foreach ($results as $row) {
                    $fk = $row->fk;
                    DB::statement("ALTER TABLE `ecm_detmob` DROP FOREIGN KEY `" . $fk . "`");
                }
            }
        } catch (\Throwable $e) {
            // ignore
        }

        // Modify column to NOT NULL using raw statement for MySQL
        $driver = DB::getDriverName();
        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE `ecm_detmob` MODIFY `id_espacio` INT UNSIGNED NOT NULL');
        } else {
            Schema::table('ecm_detmob', function (Blueprint $table) {
                $table->unsignedInteger('id_espacio')->nullable(false)->change();
            });
        }

        // Add foreign key with ON DELETE RESTRICT
        Schema::table('ecm_detmob', function (Blueprint $table) {
            $table->foreign('id_espacio')->references('id_espacio')->on('espacios_trabajo')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop FK if exists
        try {
            $results = DB::select(
                "SELECT CONSTRAINT_NAME as fk FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'ecm_detmob' AND COLUMN_NAME = 'id_espacio' AND REFERENCED_TABLE_NAME = 'espacios_trabajo'"
            );
            if (!empty($results)) {
                foreach ($results as $row) {
                    $fk = $row->fk;
                    DB::statement("ALTER TABLE `ecm_detmob` DROP FOREIGN KEY `" . $fk . "`");
                }
            }
        } catch (\Throwable $e) {
            // ignore
        }

        $driver = DB::getDriverName();
        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE `ecm_detmob` MODIFY `id_espacio` INT UNSIGNED NULL');
        } else {
            Schema::table('ecm_detmob', function (Blueprint $table) {
                $table->unsignedInteger('id_espacio')->nullable()->change();
            });
        }

        if (Schema::hasColumn('ecm_detmob', 'id_espacio')) {
            Schema::table('ecm_detmob', function (Blueprint $table) {
                $table->dropColumn('id_espacio');
            });
        }
    }
};
