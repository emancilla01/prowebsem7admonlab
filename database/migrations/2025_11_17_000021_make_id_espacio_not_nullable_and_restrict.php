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

        // Update existing NULLs to the default id
        DB::table('ecm_detequcom')->whereNull('id_espacio')->update(['id_espacio' => $default]);

        // Drop existing foreign key if present (lookup constraint name), then alter the column to NOT NULL and re-create FK with RESTRICT
        try {
            $results = DB::select(
                "SELECT CONSTRAINT_NAME as fk FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'ecm_detequcom' AND COLUMN_NAME = 'id_espacio' AND REFERENCED_TABLE_NAME = 'espacios_trabajo'"
            );
            if (!empty($results)) {
                foreach ($results as $row) {
                    $fk = $row->fk;
                    DB::statement("ALTER TABLE `ecm_detequcom` DROP FOREIGN KEY `" . $fk . "`");
                }
            }
        } catch (\Throwable $e) {
            // ignore failures dropping FK
        }

        // Modify column to NOT NULL using raw statement (avoids doctrine/dbal requirement)
        // MySQL syntax: MODIFY column_name INTEGER UNSIGNED NOT NULL
        $driver = DB::getDriverName();
        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE `ecm_detequcom` MODIFY `id_espacio` INT UNSIGNED NOT NULL');
        } elseif ($driver === 'sqlite') {
            // SQLite does not support MODIFY; fallback to Schema change (may fail)
            Schema::table('ecm_detequcom', function (Blueprint $table) {
                $table->unsignedInteger('id_espacio')->nullable(false)->change();
            });
        } else {
            // Attempt generic change (may require doctrine/dbal)
            Schema::table('ecm_detequcom', function (Blueprint $table) {
                $table->unsignedInteger('id_espacio')->nullable(false)->change();
            });
        }

        // Recreate foreign key with ON DELETE RESTRICT
        Schema::table('ecm_detequcom', function (Blueprint $table) {
            $table->foreign('id_espacio')->references('id_espacio')->on('espacios_trabajo')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ecm_detequcom', function (Blueprint $table) {
            try {
                $table->dropForeign(['id_espacio']);
            } catch (\Throwable $e) {
            }
        });

        $driver = DB::getDriverName();
        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE `ecm_detequcom` MODIFY `id_espacio` INT UNSIGNED NULL');
        } elseif ($driver === 'sqlite') {
            Schema::table('ecm_detequcom', function (Blueprint $table) {
                $table->unsignedInteger('id_espacio')->nullable()->change();
            });
        } else {
            Schema::table('ecm_detequcom', function (Blueprint $table) {
                $table->unsignedInteger('id_espacio')->nullable()->change();
            });
        }

        // Recreate FK to set null on delete (original behavior)
        Schema::table('ecm_detequcom', function (Blueprint $table) {
            $table->foreign('id_espacio')->references('id_espacio')->on('espacios_trabajo')->onDelete('set null');
        });
    }
};
