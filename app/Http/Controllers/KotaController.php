<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\KotaService;
use App\Http\Requests\Kota\StoreKotaRequest;
use App\Http\Requests\Kota\UpdateKotaRequest;

class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected KotaService $kotaService;

    public function __construct(KotaService $kotaService)
    {
        $this->kotaService = $kotaService;
    }

    public function index()
    {
        $this->authorize('viewAny', Kota::class);
        $kotas = $this->kotaService->getAllKotas();
        return view('kotas.viewAllKotas', compact('kotas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKotaRequest $request)
    {
        $this->authorize('create', Kota::class);
        $result = $this->kotaService->createKota($request->validated());
        if($result){
            if($request->filled('redirect_to')) {
                return redirect()->route($request->input('redirect_to'))->with('success', 'Kota berhasil dibuat.');
            }
            return redirect()->route('kotas.index')->with('success', 'Kota berhasil dibuat.');
        }
        else {
            if($request->filled('redirect_to')) {
                return redirect()->route($request->input('redirect_to'))->with('error', 'Kota gagal dibuat.');
            }
            return redirect()->route('kotas.index')->with('error', 'Kota gagal dibuat.');
        }
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
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKotaRequest $request, string $id)
    {
        $this->authorize('update', Kota::class);
        $result = $this->kotaService->updateKota($id, $request->validated());
        if($result){
            return redirect()->route('kotas.index')->with('success', 'Kota berhasil diupdate.');
        }
        else {
            return redirect()->route('kotas.index')->with('error', 'Kota gagal diupdate.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', Kota::class);
        $result = $this->kotaService->deleteKota($id);
        if($result){
            return redirect()->route('kotas.index')->with('success', 'Kota berhasil dihapus.');
        }
        else {
            return redirect()->route('kotas.index')->with('error', 'Kota gagal dihapus.');
        }
    }
}
