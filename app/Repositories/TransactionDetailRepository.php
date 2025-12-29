<?php

namespace App\Repositories;

use App\Models\TransactionDetail;

class TransactionDetailRepository {

    public function createTransaction($data) {
        return TransactionDetail::create($data);
    }

}
