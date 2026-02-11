<?php

namespace Modules\Academique\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('semestres')->insert([
            ['libelle' => 'Semestre 1', 'ordre' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['libelle' => 'Semestre 2', 'ordre' => '2', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
