<?php

namespace Modules\Academique\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('classes')->insert([
            [
                'code' => 'L1-INF',
                'libelle' => 'Licence 1 Informatique',
                'capacite' => 100,
                'session_id' => 1,
                'cycle_id' => 1,
                'frais_inscription' =>500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'L2-INF',
                'libelle' => 'Licence 2 Informatique',
                'capacite' => 80,
                'session_id' => 1,
                'cycle_id' => 1,
                'frais_inscription' =>550000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
