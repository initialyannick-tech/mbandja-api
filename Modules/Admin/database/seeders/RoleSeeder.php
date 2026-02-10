<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Models\Permission;
use Modules\Admin\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roles = array(
            [
                "libelle" => "Super Administrateur",
                "code" => "super_admin",
                "description" => "Ceci est le rôle du super administrateur",

            ],
            [
                "libelle" => "Comptable",
                "code" => "comptable",
                "description" => "Ceci est le rôle du comptable",
            ],
            [
                "libelle" => "Secrétariat",
                "code" => "secretariat",
                "description" => "Ce rôle est destiné aux Secrétaire",
            ],
        );


        DB::table('roles')->insert($roles);

       // Récupération des rôles
        $superAdmin = Role::where('code', 'super_admin')->first();
        // Récupération des permissions
        $allPermissions = Permission::all();
        // Attribution des permissions
        $superAdmin->permissions()->attach($allPermissions->pluck('id')); // Toutes les permissions
       
    }
}
