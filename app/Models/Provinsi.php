<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $fillable = ['provinsi'];
    public function kota()
    {
        return $this->hasMany(Kota::class, 'id_provinsi');
    }
}
