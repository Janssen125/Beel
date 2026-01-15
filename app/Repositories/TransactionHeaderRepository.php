<?php

namespace App\Repositories;

use App\Models\TransactionHeader;

class TransactionHeaderRepository {

    public function getAllTransaction() {
        return TransactionHeader::orderBy('created_at', 'desc')->get();
    }

    public function getAllTransactionByPusatId($pusat_id) {
        return TransactionHeader::where('pusat_id', $pusat_id)->orderBy('created_at', 'desc')->get();
    }

    public function getTransactionByPusatIdNomorMeja($pusat_id, $nomor_meja) {
        return TransactionHeader::where('pusat_id', $pusat_id)
                                ->where('nomor_meja', $nomor_meja)
                                ->where('status', 'pending')
                                ->first();
    }

    public function getTransactionById($id) {
        return TransactionHeader::with(['staff', 'pusat', 'details'])->findOrFail($id);
    }

    public function createTransaction($data) {
        return TransactionHeader::create($data);
    }

    public function updateTransaction($id, $data) {
        $transaction = TransactionHeader::findOrFail($id);
        return $transaction->update($data);
    }

    public function deleteTransaction($id) {
        $transaction = TransactionHeader::findOrFail($id);
        return $transaction->delete();
    }

}
