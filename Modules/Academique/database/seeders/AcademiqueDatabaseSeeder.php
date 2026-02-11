<?php

namespace Modules\Academique\Database\Seeders;

use Illuminate\Database\Seeder;

class AcademiqueDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $this->call([
            SessionSeeder::class,
            SemestreSeeder::class,
            CycleSeeder::class,
            ClasseSeeder::class,
            ClasseHasSemestreSeeder::class,
            UniteSeeder::class,
            MatiereSeeder::class,
         ]);
    }
}
