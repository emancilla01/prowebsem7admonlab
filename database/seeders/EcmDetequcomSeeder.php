<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EcmDetequcom;
use App\Models\EcmEqucommob;
use Illuminate\Support\Arr;

class EcmDetequcomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ecmIds = EcmEqucommob::pluck('id')->toArray();
        if (empty($ecmIds)) {
            $this->command->info('No ECM records found; skipping EcmDetequcomSeeder.');
            return;
        }

        foreach (range(1, 30) as $i) {
            EcmDetequcom::factory()->create([
                'id_ecm' => Arr::random($ecmIds),
            ]);
        }

        $this->command->info('EcmDetequcomSeeder: created 30 equipo records.');
    }
}
