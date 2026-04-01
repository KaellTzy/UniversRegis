<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniversitasSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Universitas Indonesia',
                'kota_id' => 1, // Jakarta/Depok
                'provinsi_id' => 1, // DKI Jakarta
                'prodi_id' => 1, // Informatika
                'kode_prodi' => 'UI-INF-01',
                'minimal_nilai_utbk' => '695.50',
                'created_at' => now(),
            ],
            [
                'nama' => 'Universitas Airlangga',
                'kota_id' => 2, // Surabaya
                'provinsi_id' => 4, // Jawa Timur
                'prodi_id' => 12, // Kedokteran
                'kode_prodi' => 'UNAIR-KED-02',
                'minimal_nilai_utbk' => '710.00',
                'created_at' => now(),
            ],
            [
                'nama' => 'Institut Teknologi Bandung',
                'kota_id' => 3, // Bandung
                'provinsi_id' => 3, // Jawa Barat
                'prodi_id' => 6, // Arsitektur
                'kode_prodi' => 'ITB-ARS-03',
                'minimal_nilai_utbk' => '705.25',
                'created_at' => now(),
            ],
            [
                'nama' => 'Universitas Gadjah Mada',
                'kota_id' => 8, // Yogyakarta
                'provinsi_id' => 5, // DI Yogyakarta
                'prodi_id' => 10, // Hukum
                'kode_prodi' => 'UGM-HKM-04',
                'minimal_nilai_utbk' => '680.40',
                'created_at' => now(),
            ],
            [
                'nama' => 'Universitas Diponegoro',
                'kota_id' => 5, // Semarang
                'provinsi_id' => 6, // Jawa Tengah
                'prodi_id' => 7, // Akuntansi
                'kode_prodi' => 'UNDIP-AKT-05',
                'minimal_nilai_utbk' => '655.00',
                'created_at' => now(),
            ],
        ];

        DB::table('universitas')->insert($data);
    }
}
