<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupoLabShowGroupsSeeder extends Seeder
{
    /**
     * Show GrupoLab rows for groups 1-4 (for evidence).
     */
    public function run(): void
    {
        $rows = DB::table('grupos_labs')->whereIn('id_grupo', [1,2,3,4])->select('id','id_grupo','id_espacio','horario')->get();
        if ($rows->isEmpty()) {
            $this->command->info('No grupos_labs rows for groups 1-4.');
            return;
        }
        foreach ($rows as $r) {
            $this->command->info(json_encode((array)$r));
        }
    }
}
