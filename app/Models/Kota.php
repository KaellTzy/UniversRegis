<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kota extends Model
{
    use HasFactory;

    protected $table = 'kotas';

    protected $fillable = [
        'id_provinsi',
        'kota',
    ];

    public $timestamps = true;

    // Relasi: Kota dimiliki oleh satu Provinsi
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi');
    }

    // Relasi: Kota memiliki banyak Universitas
    public function universitas()
    {
        return $this->hasMany(Universitas::class, 'kota_id');
    }
}
