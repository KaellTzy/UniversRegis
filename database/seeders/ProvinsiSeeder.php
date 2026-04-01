<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinsi = [
            ['provinsi' => 'Aceh'],
            ['provinsi' => 'Sumatera Utara'],
            ['provinsi' => 'Jawa Barat'],
            ['provinsi' => 'Jawa Tengah'],
            ['provinsi' => 'Jawa Timur'],
            ['provinsi' => 'DKI Jakarta'],
            // Tambahkan lainnya...
        ];

        foreach ($provinsi as $p) {
            \App\Models\Provinsi::create($p);
        }
    }
}
