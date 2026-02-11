<?php

namespace Modules\Academique\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasseHasSemestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('classe_has_semestres')->insert([
            [
                'classe_id' => 1,
                'semestre_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'classe_id' => 1,
                'semestre_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'classe_id' => 2,
                'semestre_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
