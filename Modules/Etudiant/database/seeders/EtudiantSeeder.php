<?php

namespace Modules\Etudiant\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtudiantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('etudiants')->insert([
            [
                'matricule' => '2026-MBO-140502-0001',
                'prenom' => 'Jean-Claude',
                'nom' => 'MBOUMBA',
                'date_naissance' => '2002-05-14',
                'lieu_naissance' => 'Libreville',
                'telephone' => '+24106000001',
                'email' => 'jeanclaude.mboumba@gmail.com',
                'adresse' => 'Nzeng-Ayong, Libreville',
                'sexe' => 'Homme',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'matricule' => '2026-NGU-031101-0002',
                'prenom' => 'Sandrine',
                'nom' => 'NGUEMA',
                'date_naissance' => '2001-11-03',
                'lieu_naissance' => 'Franceville',
                'telephone' => '+24106000002',
                'email' => 'sandrine.nguema@gmail.com',
                'adresse' => 'Quartier Sable, Franceville',
                'sexe' => 'Femme',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'matricule' => '2026-OBI-270203-0003',
                'prenom' => 'Patrick',
                'nom' => 'OBIANG',
                'date_naissance' => '2003-02-27',
                'lieu_naissance' => 'Port-Gentil',
                'telephone' => '+24106000003',
                'email' => 'patrick.obiang@gmail.com',
                'adresse' => 'Quartier Balise, Port-Gentil',
                'sexe' => 'Homme',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
