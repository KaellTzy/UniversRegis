<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        $daftarProdi = [
            ['nama' => 'Teknik Informatika'],
            ['nama' => 'Sistem Informasi'],
            ['nama' => 'Teknik Sipil'],
            ['nama' => 'Teknik Elektro'],
            ['nama' => 'Teknik Mesin'],
            ['nama' => 'Arsitektur'],
            ['nama' => 'Akuntansi'],
            ['nama' => 'Manajemen'],
            ['nama' => 'Ilmu Komunikasi'],
            ['nama' => 'Hukum'],
            ['nama' => 'Psikologi'],
            ['nama' => 'Kedokteran'],
            ['nama' => 'Farmasi'],
            ['nama' => 'Pendidikan Matematika'],
            ['nama' => 'Sastra Inggris'],
        ];

        // Pastikan nama tabel di database adalah 'prodis' atau 'program_studis'
        DB::table('prodis')->insert($daftarProdi);
    }
}
