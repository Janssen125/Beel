<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use App\Services\UserService;

class AdminController extends Controller
{
    protected TransactionService $transactionService;

    protected UserService $userService;

    public function __construct()
    {
        $this->transactionService = new TransactionService;
        $this->userService = new UserService;
    }

    public function index()
    {
        $transactions = $this->transactionService->getAllTransactionByPusatId(auth()->user()->userPusats->first()->pusat_id);
        $users = $this->userService->getAllUsers(auth()->user());

        $totalTransaction = $transactions->count();
        $totalUser = $users->count() - 1;
        $topTransaction = $transactions->take(5);

        return view('pages.admin.dashboard', compact('totalTransaction', 'totalUser', 'topTransaction'));
    }
}
