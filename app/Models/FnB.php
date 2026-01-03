<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FnB extends Model
{

    protected $table = 'fnbs';

    protected $fillable = [
        'nama_fnb',
        'deskripsi',
        'foto_fnb',
    ];

    public function pusats()
    {
        return $this->belongsToMany(Pusat::class, 'fnb_pusats')
            ->withPivot('harga')
            ->withTimestamps();
    }

}
