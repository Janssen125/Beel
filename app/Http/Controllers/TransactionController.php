<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\StoreTransactionDetailRequest;
use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Http\Requests\Transaction\UpdateCloseTableRequest;
use App\Http\Requests\Transaction\UpdateStatusRequest;
use App\Models\TransactionHeader;
use App\Services\MejaService;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    protected TransactionService $transactionService;

    protected MejaService $mejaService;

    public function __construct()
    {
        $this->transactionService = new TransactionService;
        $this->mejaService = new MejaService;
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

    public function createOrder($id)
    {
        $this->authorize('create', TransactionHeader::class);
        $meja = $this->mejaService->getMejaById($id);

        return view('pages.pusat.meja.createOrder', compact('meja'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        $this->authorize('create', TransactionHeader::class);
        $result = $this->transactionService->createTransaction($request->validated());
        if ($result) {
            $resultUpdateMejaStatus = $this->mejaService->updateStatus($request->input('meja_id'), 'diambil');
            if ($request->filled('redirect_to')) {
                return redirect($request->input('redirect_to'))->with('success', 'Transaksi berhasil dibuat.');
            }

            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dibuat.');
        } else {
            if ($request->filled('redirect_to')) {
                return redirect()->back()->with('error', 'Transaksi gagal dibuat.');
            }

            return redirect()->back()->with('error', 'Transaksi gagal dibuat.');
        }
    }

    public function storeOrder(StoreTransactionDetailRequest $request, string $meja_id, string $transaction_id)
    {
        if ($request->input('transaction_header_id') != $transaction_id) {
            return redirect()->back()->with('error', 'Pesanan gagal ditambahkan.');
        }

        $this->authorize('create', TransactionHeader::class);
        $result = $this->transactionService->createTransactionDetail($request->validated());
        if ($result) {
            return redirect()->route('mejas.show', $meja_id)->with('success', 'Pesanan berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Pesanan gagal ditambahkan.');
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

        if (! $result) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui transaksi.',
            ], 422);
        }

        session()->flash('success', 'Transaksi berhasil diperbarui.');

        return response()->json([
            'success' => true,
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
        if (! $result) {
            return redirect()->route('transactions.index')->with('error', 'Gagal menghapus transaksi.');
        }

        return redirect()->back()->with('success', 'Transaksi berhasil dihapus.');
    }
}
