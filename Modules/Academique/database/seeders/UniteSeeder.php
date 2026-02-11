<?php

namespace Modules\Academique\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('unites')->insert([
            [
                'code' => 'UE-L1-S1-ALG',
                'libelle' => 'Algorithme et Programmation',
                'classe_id' => 1,
                'semestre_id' => 1,
                'session_id' => 1,
                'credit' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'UE-L1-S1-MATH',
                'libelle' => 'Mathématiques Générales',
                'classe_id' => 1,
                'semestre_id' => 1,
                'session_id' => 1,
                'credit' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
