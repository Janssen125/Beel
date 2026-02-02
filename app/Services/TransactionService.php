<?php

namespace App\Services;

use App\Repositories\TransactionDetailRepository;
use App\Repositories\TransactionHeaderRepository;

class TransactionService
{
    protected TransactionHeaderRepository $transactionHeaderRepository;

    protected TransactionDetailRepository $transactionDetailRepository;

    public function __construct()
    {
        $this->transactionHeaderRepository = new TransactionHeaderRepository;
        $this->transactionDetailRepository = new TransactionDetailRepository;
    }

    public function getAllTransactions($user)
    {
        if ($user->role == 'superadmin') {
            return $this->transactionHeaderRepository->getAllTransaction();
        } elseif ($user->role == 'admin') {
            $pusat_id = $user->userPusats()->first()->pusat_id;

            return $this->transactionHeaderRepository->getAllTransactionByPusatId($pusat_id);
        }
    }

    public function getTransactionByPusatIdNomorMeja($pusat_id, $nomor_meja)
    {
        return $this->transactionHeaderRepository->getTransactionByPusatIdNomorMeja($pusat_id, $nomor_meja);
    }

    public function getTransactionById($id)
    {
        return $this->transactionHeaderRepository->getTransactionById($id);
    }

    public function getTransactionDetailById($id)
    {
        return $this->transactionDetailRepository->getTransactionDetailById($id);
    }

    public function createTransaction($data)
    {
        if (isset($data['details'])) {
            $details = $data['details'];
            unset($data['details']);
        }
        $transactionHeader = $this->transactionHeaderRepository->createTransaction($data);
        if (isset($details)) {
            foreach ($details as $detail) {
                $detail['transaction_header_id'] = $transactionHeader->id;
                $this->transactionDetailRepository->createTransaction($detail);
            }
        }

        return $transactionHeader;
    }

    public function createTransactionDetail($data)
    {
        return $this->transactionDetailRepository->createTransaction($data);
    }

    public function updateTransactionDetail($id, $data)
    {
        return $this->transactionDetailRepository->updateTransaction($id, $data);
    }

    public function deleteTransactionDetail($id)
    {
        return $this->transactionDetailRepository->deleteTransactionDetail($id);
    }

    public function updateTransaction($id, $data)
    {
        return $this->transactionHeaderRepository->updateTransaction($id, $data);
    }

    public function deleteTransaction($id)
    {
        return $this->transactionHeaderRepository->deleteTransaction($id);
    }
}
