<?php

namespace Database\Seeders;

use App\Models\Provinsi; // Pastikan model Provinsi sudah ada
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KotaSeeder extends Seeder
{
    public function run(): void
    {
        // Kita ambil ID provinsi terlebih dahulu agar datanya sinkron
        // Asumsi: Anda sudah menjalankan ProvinsiSeeder sebelumnya
        $aceh = DB::table('provinsis')->where('provinsi', 'LIKE', '%Aceh%')->first();
        $sumut = DB::table('provinsis')->where('provinsi', 'LIKE', '%Sumatera Utara%')->first();
        $jabar = DB::table('provinsis')->where('provinsi', 'LIKE', '%Jawa Barat%')->first();
        $jatim = DB::table('provinsis')->where('provinsi', 'LIKE', '%Jawa Timur%')->first();

        $data = [
            // Kota di Aceh
            ['id_provinsi' => $aceh->id ?? 1, 'kota' => 'Banda Aceh', 'created_at' => now()],
            ['id_provinsi' => $aceh->id ?? 1, 'kota' => 'Lhokseumawe', 'created_at' => now()],

            // Kota di Sumatera Utara
            ['id_provinsi' => $sumut->id ?? 2, 'kota' => 'Medan', 'created_at' => now()],
            ['id_provinsi' => $sumut->id ?? 2, 'kota' => 'Binjai', 'created_at' => now()],

            // Kota di Jawa Barat
            ['id_provinsi' => $jabar->id ?? 3, 'kota' => 'Bandung', 'created_at' => now()],
            ['id_provinsi' => $jabar->id ?? 3, 'kota' => 'Bekasi', 'created_at' => now()],
            ['id_provinsi' => $jabar->id ?? 3, 'kota' => 'Depok', 'created_at' => now()],

            // Kota di Jawa Timur
            ['id_provinsi' => $jatim->id ?? 4, 'kota' => 'Surabaya', 'created_at' => now()],
            ['id_provinsi' => $jatim->id ?? 4, 'kota' => 'Malang', 'created_at' => now()],
            ['id_provinsi' => $jatim->id ?? 4, 'kota' => 'Kediri', 'created_at' => now()],
        ];

        DB::table('kotas')->insert($data);
    }
}
