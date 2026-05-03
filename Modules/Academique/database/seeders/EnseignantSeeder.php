<?php

namespace Modules\Academique\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnseignantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('enseignants')->insert([
            [
                'nom' => 'MOUCKAGNI',
                'prenom' => 'Gildas',
                'email' => 'mouckagni.gildas@gmail.com',
                'telephone' => '076998522',
                'specialite' => 'Mathématique',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'ANGOUANG',
                'prenom' => 'Tristand',
                'email' => 'tristand.angouang@gmail.com',
                'telephone' => '066998522',
                'specialite' => 'Réseaux Télécom',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
