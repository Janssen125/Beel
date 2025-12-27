<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionHeader;

class SuperAdminController extends Controller
{
    public function __construct() {
        $this->middleware('can:isSuperAdmin');
    }

    public function index() {
        return view('pages.superadmin.dashboard');
    }

    public function users() {
        return view('pages.superadmin.users');
    }

    public function transactions() {
        $transactions = TransactionHeader::with(['staff', 'pusat'])->get()->sortByDesc('created_at');
        return view('pages.transactions.viewAllTransactions', compact('transactions'));
    }

    public function fnb() {
        return view('pages.superadmin.fnb');
    }

    public function pusat() {
        return view('pages.superadmin.pusat');
    }

    public function kota() {
        return view('pages.superadmin.kota');
    }

    public function provinsi() {
        return view('pages.superadmin.provinsi');
    }

}
