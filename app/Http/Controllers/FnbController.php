<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FnbService;
use App\Http\Requests\Fnb\StoreFnbRequest;
use App\Http\Requests\Fnb\UpdateFnbRequest;

class FnbController extends Controller
{

    protected FnbService $fnbService;

    public function __construct()
    {
        $this->fnbService = new FnbService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', FnB::class);
        $fnbs = $this->fnbService->getAllFnBs();
        return view('pages.fnb.viewAllFnbs', compact('fnbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', FnB::class);
        return view('pages.fnb.createFnb');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFnbRequest $request)
    {
        $this->authorize('create', FnB::class);
        $result = $this->fnbService->createFnb($request->validated());
        if($result){
            return redirect()->route('fnbs.index')->with('success', 'FnB berhasil dibuat.');
        }
        return redirect()->back()->with('error', 'FnB gagal dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fnb = $this->fnbService->getFnbById($id);
        $this->authorize('update', $fnb);
        return view('pages.fnb.editFnb', compact('fnb'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFnbRequest $request, string $id)
    {
        $fnb = $this->fnbService->getFnbById($id);
        $this->authorize('update', $fnb);
        $result = $this->fnbService->updateFnb($id, $request->validated());
        if($result){
            return redirect()->route('fnbs.index')->with('success', 'FnB berhasil diupdate.');
        }
        return redirect()->back()->with('error', 'FnB gagal diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fnb = $this->fnbService->getFnbById($id);
        $this->authorize('delete', $fnb);
        $result = $this->fnbService->deleteFnb($id);
        if($result){
            return redirect()->route('fnbs.index')->with('success', 'FnB berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'FnB gagal dihapus.');
    }
}
