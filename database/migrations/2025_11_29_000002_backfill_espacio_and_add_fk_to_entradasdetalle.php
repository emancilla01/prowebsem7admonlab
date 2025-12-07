<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ensure there is at least one espacio to reference
        $espacio = DB::table('espacios_trabajo')->select('id_espacio')->first();
        if (! $espacio) {
            $id = DB::table('espacios_trabajo')->insertGetId([
                'nombre_espacio' => 'Espacio por defecto',
                'tipo_espacio' => 'Desconocido',
                'ubicacion' => null,
                'capacidad' => null,
                'responsable' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $espacioId = $id;
        } else {
            $espacioId = $espacio->id_espacio;
        }

        // Backfill existing entradasdetalle rows to point to a valid espacio
        if (Schema::hasColumn('entradasdetalle', 'id_espaciotrabajo')) {
            // Set NULL or invalid references to the chosen espacioId
            DB::statement("UPDATE entradasdetalle ed LEFT JOIN espacios_trabajo et ON ed.id_espaciotrabajo = et.id_espacio SET ed.id_espaciotrabajo = ? WHERE et.id_espacio IS NULL", [$espacioId]);
        }

        // Make column NOT NULL and add foreign key
        if (Schema::hasColumn('entradasdetalle', 'id_espaciotrabajo')) {
            // alter column to be unsigned integer NOT NULL
            DB::statement('ALTER TABLE entradasdetalle MODIFY id_espaciotrabajo INT UNSIGNED NOT NULL');

            Schema::table('entradasdetalle', function (Blueprint $table) {
                $table->foreign('id_espaciotrabajo')
                    ->references('id_espacio')
                    ->on('espacios_trabajo')
                    ->onDelete('cascade');
            });
        }

        // Also make no_serie NOT NULL with empty string default for existing rows
        if (Schema::hasColumn('entradasdetalle', 'no_serie')) {
            DB::table('entradasdetalle')->whereNull('no_serie')->update(['no_serie' => '']);
            DB::statement("ALTER TABLE entradasdetalle MODIFY no_serie varchar(100) NOT NULL");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entradasdetalle', function (Blueprint $table) {
            try {
                $table->dropForeign(['id_espaciotrabajo']);
            } catch (\Exception $e) {
                // ignore
            }
        });

        // Make columns nullable again
        if (Schema::hasColumn('entradasdetalle', 'id_espaciotrabajo')) {
            DB::statement('ALTER TABLE entradasdetalle MODIFY id_espaciotrabajo INT UNSIGNED NULL');
        }

        if (Schema::hasColumn('entradasdetalle', 'no_serie')) {
            DB::statement("ALTER TABLE entradasdetalle MODIFY no_serie varchar(100) NULL");
        }
    }
};
