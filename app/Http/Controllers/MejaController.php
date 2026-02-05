<?php

namespace App\Http\Controllers;

use App\Http\Requests\Meja\StoreMejaRequest;
use App\Http\Requests\Meja\UpdateMejaRequest;
use App\Services\FnbService;
use App\Services\JenisMejaService;
use App\Services\MejaService;
use App\Services\PusatService;
use App\Services\TransactionService;

class MejaController extends Controller
{
    protected MejaService $mejaService;

    protected PusatService $pusatService;

    protected JenisMejaService $jenisMejaService;

    protected TransactionService $transactionService;

    protected FnbService $fnbService;

    public function __construct()
    {
        $this->mejaService = new MejaService;
        $this->pusatService = new PusatService;
        $this->jenisMejaService = new JenisMejaService;
        $this->transactionService = new TransactionService;
        $this->fnbService = new FnBService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort(404);
    }

    public function viewAll($pusat_id)
    {
        if (auth()->user()->role == 'admin' || auth()->user()->role == 'staff') {
            $pusat = $this->pusatService->getPusatById(auth()->user()->userPusats->first()->pusat_id);

            if ($pusat->id != $pusat_id) {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses ke meja ini.');
            }

            $mejas = $this->mejaService->getMejasByPusat(auth()->user()->userPusats->first()->pusat_id);

            return view('pages.pusat.meja.viewMejas', compact(['mejas', 'pusat']));

        }
        $this->authorize('viewAny', Meja::class);
        $pusat = $this->pusatService->getPusatById($pusat_id);
        $mejas = $this->mejaService->getMejasByPusat($pusat_id);

        return view('pages.pusat.meja.viewMejas', compact(['mejas', 'pusat']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    public function createMeja($pusat_id)
    {
        $this->authorize('create', Meja::class);
        $pusat = $this->pusatService->getPusatById($pusat_id);
        $jenisMejas = $this->jenisMejaService->getAllJenisMejas();

        return view('pages.pusat.meja.createMeja', compact(['pusat', 'jenisMejas']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMejaRequest $request)
    {
        $this->authorize('create', Meja::class);
        if (auth()->user()->role !== 'superadmin') {
            $pusatId = auth()->user()->userPusats()->first()->pusat_id;
            if ($request->input('pusat_id') != $pusatId) {
                return redirect()->back()->with('error', 'Meja gagal dibuat.');
            }
        }
        $result = $this->mejaService->createMeja($request->validated());
        if ($result) {
            return redirect()->route('mejas.viewAll', $request->pusat_id)->with('success', 'Meja berhasil dibuat.');
        }

        return redirect()->back()->with('error', 'Meja gagal dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $meja = $this->mejaService->getMejaById($id);
        $this->authorize('view', $meja);
        $pusat_id = $meja->pusat_id;
        $transaction = $this->transactionService->getTransactionByPusatIdNomorMeja($pusat_id, $meja->nomor_meja);

        return view('pages.pusat.meja.viewMejaDetail', compact('transaction', 'meja'));
    }

    public function addOrder(string $id, string $transaction_id)
    {
        $meja = $this->mejaService->getMejaById($id);
        $this->authorize('view', $meja);
        $menus = $this->fnbService->getAllFnbsByPusatId($meja->pusat_id);

        return view('pages.pusat.meja.addOrder', compact(['meja', 'menus', 'transaction_id']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $meja = $this->mejaService->getMejaById($id);
        $this->authorize('update', $meja);
        $jenisMejas = $this->jenisMejaService->getAllJenisMejas();

        return view('pages.pusat.meja.editMeja', compact(['meja', 'jenisMejas']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMejaRequest $request, string $id)
    {
        $meja = $this->mejaService->getMejaById($id);
        $this->authorize('update', $meja);
        $result = $this->mejaService->updateMeja($request->validated(), $id);
        if ($result) {
            return redirect()->route('mejas.viewAll', $meja->pusat_id)->with('success', 'Meja berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Meja gagal diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $meja = $this->mejaService->getMejaById($id);
        $this->authorize('delete', $meja);
        $result = $this->mejaService->deleteMeja($id);
        if ($result) {
            return redirect()->route('mejas.viewAll')->with('success', 'Meja berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Meja gagal dihapus.');
    }
}
