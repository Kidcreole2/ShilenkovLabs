<?php

namespace Database\Seeders;

use App\Models\UsersAndRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateUserAndRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userAndRoles = [
            ["user_id" => "1", "role_id" => "1", "created_by" => "1"]
        ];

        foreach ($userAndRoles as $userAndRole) {
            UsersAndRoles::create($userAndRole);
        }
    }
}
