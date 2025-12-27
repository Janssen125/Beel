<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Pusat extends Model
{
    protected $table = 'user_pusats';

    protected $fillable = [
        'user_id',
        'pusat_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pusat()
    {
        return $this->belongsTo(Pusat::class, 'pusat_id');
    }
}
