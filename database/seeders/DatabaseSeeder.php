<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Provinsi;
use App\Models\Prodi;
use App\Models\Kota;
use App\Models\Universitas;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(RoleSeeder::class);
        $this->call(ProvinsiSeeder::class);
        $this->call(ProdiSeeder::class);
        $this->call(KotaSeeder::class);
        $this->call(UniversitasSeeder::class);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
