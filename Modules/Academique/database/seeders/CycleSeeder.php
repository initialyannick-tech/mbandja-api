<?php

namespace Modules\Academique\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cycles')->insert([
            [
                'libelle' => 'Licence',
                'ordre' => '1',
                'session_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'libelle' => 'Master',
                'ordre' => '2',
                'session_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
