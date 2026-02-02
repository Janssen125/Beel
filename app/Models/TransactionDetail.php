<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'transaction_details';

    protected $fillable = [
        'transaction_header_id',
        'nama_fnb',
        'harga',
        'quantity',
    ];

    public function transaction()
    {
        return $this->belongsTo(TransactionHeader::class, 'transaction_header_id');
    }
}
