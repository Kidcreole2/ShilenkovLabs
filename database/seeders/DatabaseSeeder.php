<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CreateRoles::class);
        $this->call(CreatePermissions::class);
        $this->call(CreateRoleAndPermission::class);
        $this->call(CreateAdmin::class);
        $this->call(CreateUserAndRole::class);
    }
}
