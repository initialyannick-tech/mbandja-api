<?php

namespace Modules\Academique\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatiereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('matieres')->insert([
            [
                'unite_id' => 1,
                'code' => 'ALG101',
                'libelle' => 'Introduction à l\'Algorithme',
                'coefficient' => 2.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unite_id' => 1,
                'code' => 'PROG101',
                'libelle' => 'Programmation en C',
                'coefficient' => 3.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unite_id' => 2,
                'code' => 'MATH101',
                'libelle' => 'Analyse Mathématique',
                'coefficient' => 2.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
