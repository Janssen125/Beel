<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionHeader;
use Illuminate\Support\Facades\Auth;
use App\Models\User_Pusat;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = [];
        $pusat_id = User_Pusat::where('user_id', Auth::user()->id)->first()->pusat_id;

        switch(Auth::user()->role){
            case 'superadmin':
                $transactions = TransactionHeader::with(['staff', 'pusat'])->orderBy('created_at', 'desc')->get();
                break;
            case 'admin':
                $transactions = TransactionHeader::with(['staff', 'pusat'])->orderBy('created_at', 'desc')->where('pusat_id', $pusat_id)->get();
                break;
            case 'staff':
                $transactions = TransactionHeader::with(['staff', 'pusat'])->orderBy('created_at', 'desc')->where('pusat_id', $pusat_id)->get();
                break;
            default:
                abort(403);
        }
        return view('pages.transactions.viewAllTransactions', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = TransactionHeader::with(['staff', 'pusat', 'details'])->findOrFail($id);
        return view('pages.transactions.viewTransactionDetail', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = TransactionHeader::findOrFail($id);
        if($transaction){
            $transaction->delete();
        } else {
            return redirect()->route('transactions.index')->with('error', 'Transaksi gagal dihapus.');
        }
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }

}
