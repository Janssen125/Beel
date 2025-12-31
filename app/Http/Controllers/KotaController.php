<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\KotaService;
use App\Services\ProvinsiService;
use App\Http\Requests\Kota\StoreKotaRequest;
use App\Http\Requests\Kota\UpdateKotaRequest;

class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected KotaService $kotaService;
    protected ProvinsiService $provinsiService;

    public function __construct()
    {
        $this->kotaService = new KotaService();
        $this->provinsiService = new ProvinsiService();
    }

    public function index()
    {
        $this->authorize('viewAny', Kota::class);
        $kotas = $this->kotaService->getAllKotas();
        $provinsis = $this->provinsiService->getAllProvinsis();
        return view('pages.kotas.viewAllKotas', compact(['kotas', 'provinsis']));
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
                return redirect()->back()->with('error', 'Kota gagal dibuat.');
            }
            return redirect()->back()->with('error', 'Kota gagal dibuat.');
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
        $kota = $this->kotaService->getKotaById($id);
        $this->authorize('update', $kota);
        $result = $this->kotaService->updateKota($id, $request->validated());
        if($result){
            return redirect()->route('kotas.index')->with('success', 'Kota berhasil diupdate.');
        }
        else {
            return redirect()->back()->with('error', 'Kota gagal diupdate.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kota = $this->kotaService->getKotaById($id);
        $this->authorize('delete', $kota);
        $result = $this->kotaService->deleteKota($id);
        if($result){
            return redirect()->route('kotas.index')->with('success', 'Kota berhasil dihapus.');
        }
        else {
            return redirect()->route('kotas.index')->with('error', 'Kota gagal dihapus.');
        }
    }
}
