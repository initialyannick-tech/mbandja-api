<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = array(
            [
                "nom" => "EDOU",
                "prenom" => "Yannick",
                "email" => "yannick@mbandja.com",
                "password" => "azerty",
                "password_changed" => "active",
                "role_id" => 1,
            ],
            [
                "nom" => "ASSEMBE",
                "prenom" => "Vinny",
                "email" => "vinny.assembe@mbandja.com ",
                "password" => "azerty",
                "password_changed" => "active",
                "role_id" => 1,
            ],
        );


        foreach ($users as $user) {
            User::create($user); // Cela déclenchera l'événement `creating`
        }
    }
}
