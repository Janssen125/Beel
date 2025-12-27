<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pusat extends Model
{
    protected $table = 'pusats';

    protected $fillable = [
        'nama_pusat',
        'alamat',
        'pemilik_id',
        'kota_id',
        'provinsi_id',
    ];

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id');
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }

    public function meja()
    {
        return $this->hasMany(Meja::class, 'pusat_id');
    }

    public function pemilik()
    {
        return $this->belongsTo(User::class, 'pemilik_id');
    }

    public function fnbPusats()
    {
        return $this->hasMany(FnB_Pusat::class, 'pusat_id');
    }

    public function userPusats()
    {
        return $this->hasMany(User_Pusat::class, 'pusat_id');
    }

    public function transactionHeaders()
    {
        return $this->hasMany(TransactionHeader::class, 'pusat_id');
    }
}
