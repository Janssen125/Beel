<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePusatRequest;
use App\Http\Requests\UpdatePusatRequest;
use App\Http\Requests\PusatFnb\UpdatePusatFnbRequest;
use App\Services\PusatService;
use App\Services\FnBService;

class PusatController extends Controller
{

    protected PusatService $pusatService;
    protected FnBService $fnbService;

    public function __construct()
    {
        $this->pusatService = new PusatService();
        $this->fnbService = new FnBService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Pusat::class);
        $pusats = $this->pusatService->getAllPusat();
        return view('pages.pusat.viewAllPusats', compact('pusats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Pusat::class);
        return view('pages.pusat.createPusat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePusatRequest $request)
    {
        $this->authorize('create', Pusat::class);
        $result = $this->pusatService->createPusat($request->validated());
        if($result){
            return redirect()->route('pusats.index')->with('success', 'Pusat berhasil dibuat.');
        }
        return redirect()->back()->with('error', 'Pusat gagal dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pusat = $this->pusatService->getPusatById($id);
        $this->authorize('view', $pusat);
        return view('pages.pusat.viewPusatDetail', compact('pusat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pusat = $this->pusatService->getPusatById($id);
        $this->authorize('update', $pusat);
        return view('pages.pusat.editPusat', compact('pusat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePusatRequest $request, string $id)
    {
        $pusat = $this->pusatService->getPusatById($id);
        $this->authorize('update', $pusat);
        $result = $this->pusatService->updatePusat($id, $request->validated());
        if($result){
            return redirect()->route('pusats.index')->with('success', 'Pusat berhasil diupdate.');
        }
        return redirect()->back()->with('error', 'Pusat gagal diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pusat = $this->pusatService->getPusatById($id);
        $this->authorize('delete', $pusat);
        $result = $this->pusatService->deletePusat($id);
        if($result){
            return redirect()->route('pusats.index')->with('success', 'Pusat berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Pusat gagal dihapus.');
    }

    public function addFnb(string $id) {
        $pusat = $this->pusatService->getPusatById($id);
        $this->authorize('update', $pusat);
        $fnbs = $this->fnbService->getAllFnbs();
        $selectedFnbs = $this->pusatService->getSelectedFnbs($pusat);
        return view('pages.pusat.fnb.updateFnb', compact(['pusat', 'fnbs', 'selectedFnbs']));
    }

    public function syncFnbs(UpdatePusatFnbRequest $request, string $id)
    {
        $pusat = $this->pusatService->getPusatById($id);
        $this->authorize('update', $pusat);
        $result = $this->pusatService->syncFnbs($pusat, $request->validated());
        if($result){
            return redirect()->route('pusats.show', $pusat->id)->with('success', 'FnB berhasil di ubah.');
        }
        return redirect()->back()->with('error', 'FnB gagal diubah.');
    }

}
