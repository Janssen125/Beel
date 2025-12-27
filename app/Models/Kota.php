<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $table = 'kotas';

    protected $fillable = [
        'nama_kota',
        'provinsi_id',
    ];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }

    public function pusats()
    {
        return $this->hasMany(Pusat::class, 'kota_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'kota_id');
    }
}
