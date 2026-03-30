<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Universitas extends Model
{
    use HasFactory;

    protected $table = 'universitas';

    protected $fillable = [
        'nama',
        'kota_id',
        'provinsi_id',
        'prodi_id',
        'kode_prodi',
        'minimal_nilai_utbk',
    ];

    // Relasi ke Prodi
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    // Relasi ke Kota
    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id');
    }

    // Relasi ke Provinsi
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }
}
