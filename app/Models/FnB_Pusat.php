<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FnB_Pusat extends Model
{
    protected $table = 'fnb_pusats';

    protected $fillable = [
        'fnb_id',
        'pusat_id',
        'harga',
    ];

    public function fnb()
    {
        return $this->belongsTo(FnB::class, 'fnb_id');
    }

    public function pusat()
    {
        return $this->belongsTo(Pusat::class, 'pusat_id');
    }
}
