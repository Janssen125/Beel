<?php

namespace App\Http\Controllers;

use App\Services\FnbService;
use App\Services\PusatService;
use App\Services\TransactionService;
use App\Services\UserService;

class SuperAdminController extends Controller
{
    protected UserService $userService;

    protected PusatService $pusatService;

    protected TransactionService $transactionService;

    protected FnbService $fnbService;

    public function __construct()
    {
        $this->userService = new UserService;
        $this->pusatService = new PusatService;
        $this->transactionService = new TransactionService;
        $this->fnbService = new FnbService;
        $this->middleware('can:isSuperAdmin');
    }

    public function index()
    {
        $users = $this->userService->getAllUsers(auth()->user());
        $pusats = $this->pusatService->getAllPusat();
        $transactions = $this->transactionService->getAllTransactions(auth()->user());
        $fnbs = $this->fnbService->getAllFnBs();

        $totalUser = $users->count();
        $totalPusat = $pusats->count();
        $totalTransaction = $transactions->count();
        $totalFnb = $fnbs->count();

        return view('pages.superadmin.dashboard', compact(
            'totalUser',
            'totalPusat',
            'totalTransaction',
            'totalFnb'
        ));
    }
}
