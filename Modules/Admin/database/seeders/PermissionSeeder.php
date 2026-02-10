<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                "libelle" => "Gestion des utilisateurs",
                "code" => "user.management",
            ],
            [
                "libelle" => "Gestion des rôles et permissions",
                "code" => "role.management",
            ],
            [
                "libelle" => "Gestion des établissements",
                "code" => "etablissement.management",
            ],
            [
                "libelle" => "Gestion des facultés",
                "code" => "faculte.management",
            ],
            [
                "libelle" => "Gestion des départements",
                "code" => "departement.management",
            ],
            [
                "libelle" => "Gestion des filières",
                "code" => "filiere.management",
            ],
            [
                "libelle" => "Gestion des niveaux (Licence, Master, Doctorat)",
                "code" => "niveau.management",
            ],
            [
                "libelle" => "Gestion des étudiants",
                "code" => "etudiant.management",
            ],
            [
                "libelle" => "Gestion des enseignants",
                "code" => "enseignant.management",
            ],
            [
                "libelle" => "Gestion des inscriptions",
                "code" => "inscription.management",
            ],
            [
                "libelle" => "Gestion des unités d’enseignement (UE)",
                "code" => "ue.management",
            ],
            [
                "libelle" => "Gestion des matières",
                "code" => "matiere.management",
            ],
            [
                "libelle" => "Gestion des emplois du temps",
                "code" => "emploi_temps.management",
            ],
            [
                "libelle" => "Gestion des notes et évaluations",
                "code" => "note.management",
            ],
            [
                "libelle" => "Gestion des années académiques",
                "code" => "annee_academique.management",
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission); // Cela déclenchera l'événement `creating`
        }

    }
}
