<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionHeader;
use Illuminate\Support\Facades\Auth;
use App\Services\TransactionService;
use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Http\Requests\Transaction\UpdateStatusRequest;
use App\Http\Requests\Transaction\UpdateCloseTableRequest;

class TransactionController extends Controller
{

    protected TransactionService $transactionService;

    public function __construct()
    {
        $this->transactionService = new TransactionService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', TransactionHeader::class);
        $transactions = $this->transactionService->getAllTransactions(Auth::user());

        return view('pages.transactions.viewAllTransactions', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', TransactionHeader::class);
        return view('pages.transactions.createTransaction');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        $this->authorize('create', TransactionHeader::class);
        $result = $this->transactionService->createTransaction($request->validated());
        if($result) {
            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dibuat.');
        }
        else {
            return redirect()->back()->with('error', 'Transaksi gagal dibuat.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = $this->transactionService->getTransactionById($id);

        $this->authorize('view', $transaction);

        return view('pages.transactions.viewTransactionDetail', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort(404);
    }

    public function updateStatus(UpdateStatusRequest $request, string $id)
    {
        $transaction = $this->transactionService->getTransactionById($id);
        $this->authorize('update', $transaction);

        $result = $this->transactionService->updateTransaction($id, $request->validated());

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui transaksi.'
            ], 422);
        }

        session()->flash('success', 'Transaksi berhasil diperbarui.');

        return response()->json([
            'success' => true
        ]);
    }

    public function closeTable(UpdateCloseTableRequest $request, string $id)
    {
        $transaction = $this->transactionService->getTransactionById($id);
        $this->authorize('update', $transaction);

        $result = $this->transactionService->updateTransaction($id, $request->validated());
        if ($result) {
            return redirect()->route('transactions.show', $id)->with('success', 'Meja transaksi berhasil ditutup.');
        }
        return redirect()->route('transactions.show', $id)->with('error', 'Gagal menutup meja transaksi.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = $this->transactionService->getTransactionById($id);
        $this->authorize('delete', $transaction);
        $result = $this->transactionService->deleteTransaction($id);
        if(!$result){
            return redirect()->route('transactions.index')->with('error', 'Gagal menghapus transaksi.');
        }
        return redirect()->back()->with('success', 'Transaksi berhasil dihapus.');
    }

}
