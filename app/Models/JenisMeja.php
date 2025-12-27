<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisMeja extends Model
{
    protected $table = 'jenis_mejas';

    protected $fillable = [
        'nama_jenis_meja',
    ];

    public function mejas()
    {
        return $this->hasMany(Meja::class, 'jenis_meja_id');
    }
}
