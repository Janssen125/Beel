<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    protected $table = 'transaction_headers';

    protected $fillable = [
        'staff_id',
        'nama_customer',
        'pusat_id',
        'status',
        'nomor_meja',
        'total_waktu',
        'harga_per_jam',
        'total_harga',
    ];

    public function pusat()
    {
        return $this->belongsTo(Pusat::class, 'pusat_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_header_id');
    }
}
