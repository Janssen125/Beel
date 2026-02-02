<?php

namespace App\Repositories;

use App\Models\TransactionDetail;

class TransactionDetailRepository
{
    public function getTransactionDetailById($id)
    {
        return TransactionDetail::with('transaction')->where('id', $id)->first();
    }

    public function createTransaction($data)
    {
        return TransactionDetail::create($data);
    }

    public function updateTransaction($id, $data)
    {
        return TransactionDetail::where('id', $id)->update($data);
    }

    public function deleteTransactionDetail($id)
    {
        return TransactionDetail::where('id', $id)->delete();
    }
}
