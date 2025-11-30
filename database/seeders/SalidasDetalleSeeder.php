<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Salida;
use App\Models\SalidaDetalle;
use App\Models\EntradaDetalle;

class SalidasDetalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $salidas = Salida::limit(10)->get();
        $entradas = EntradaDetalle::pluck('id')->all();

        if ($salidas->isEmpty() || empty($entradas)) {
            // Nothing to seed against
            return;
        }

        foreach ($salidas as $salida) {
            // Create between 1 and 3 detalle rows per Salida
            $count = rand(1, 3);
            $chosen = (array) array_rand(array_flip($entradas), min($count, count($entradas)));

            foreach ($chosen as $id_entradadetalle) {
                SalidaDetalle::firstOrCreate([
                    'id_salida' => $salida->id,
                    'id_entradadetalle' => $id_entradadetalle,
                ], [
                    'motivo_de_salida' => 'Salida de prueba ' . now()->format('YmdHis'),
                ]);
            }
        }
    }
}
