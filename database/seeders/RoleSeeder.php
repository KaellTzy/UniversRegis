<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Aku Atmint',
            'email' => 'UniversRegis@admin.org',
            'role' => 'admin',
            'password' => bcrypt('admin1234568'),
        ]);

        User::create([
            'name' => '1dlerosie',
            'email' => 'TimUnivers1@reviewer.org',
            'role' => 'reviewer',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Ada Wong',
            'email' => 'TimUnivers2@reviewer.org',
            'role' => 'reviewer',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'password' => bcrypt('12345678'),
        ]);
    }
}
