<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JenisMejaService;
use App\Http\Requests\StoreJenisMejaRequest;
use App\Http\Requests\UpdateJenisMejaRequest;

class JenisMejaController extends Controller
{

    protected JenisMejaService $jenisMejaService;

    public function __construct()
    {
        $this->jenisMejaService = new JenisMejaService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', JenisMeja::class);
        $jenisMejas = $this->jenisMejaService->getAllJenisMejas();
        return view('pages.jenismeja.viewAllJenisMeja', compact('jenisMejas'));
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
    public function store(StoreJenisMejaRequest $request)
    {
        $this->authorize('create', JenisMeja::class);
        $result = $this->jenisMejaService->createJenisMeja($request->validated());
        if($result){
            return redirect()->route('jenis_mejas.index')->with('success', 'Jenis Meja berhasil dibuat.');
        }
        return redirect()->back()->with('error', 'Jenis Meja gagal dibuat.');
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
    public function update(UpdateJenisMejaRequest $request, string $id)
    {
        $jenisMeja = $this->jenisMejaService->getJenisMejaById($id);
        $this->authorize('update', $jenisMeja);
        $result = $this->jenisMejaService->updateJenisMeja($id, $request->validated());
        if($result){
            return redirect()->route('jenis_mejas.index')->with('success', 'Jenis Meja berhasil diupdate.');
        }
        return redirect()->back()->with('error', 'Jenis Meja gagal diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenisMeja = $this->jenisMejaService->getJenisMejaById($id);
        $this->authorize('delete', $jenisMeja);
        $result = $this->jenisMejaService->deleteJenisMeja($id);
        if($result){
            return redirect()->route('jenis_mejas.index')->with('success', 'Jenis Meja berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Jenis Meja gagal dihapus.');
    }
}
