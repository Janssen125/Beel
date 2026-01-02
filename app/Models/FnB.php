<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FnB extends Model
{
    protected $table = 'fnb';

    protected $fillable = [
        'nama_fnb',
        'deskripsi',
        'foto_fnb',
    ];

    public function fnbPusats()
    {
        return $this->hasMany(FnB_Pusat::class, 'fnb_id');
    }

}
