<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $table = 'mejas';

    protected $fillable = [
        'pusat_id',
        'jenis_meja_id',
        'nomor_meja',
        'harga_per_jam',
        'status',
    ];

    public function jenisMeja()
    {
        return $this->belongsTo(JenisMeja::class, 'jenis_meja_id');
    }

    public function pusat()
    {
        return $this->belongsTo(Pusat::class, 'pusat_id');
    }
}
