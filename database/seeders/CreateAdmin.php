<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['username' => 'Administrator', 'email' => 'admin@mail.com', 'password' => 'qwertwww@1Y', 'birthday' => '2000-12-31']
        ];

        foreach($users as $user) {
            User::create($user);
        }
    }
}