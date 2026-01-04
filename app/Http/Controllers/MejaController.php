<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MejaService;
use App\Http\Requests\Meja\StoreMejaRequest;
use App\Http\Requests\Meja\UpdateMejaRequest;

class MejaController extends Controller
{

    protected MejaService $mejaService;

    public function __construct()
    {
        $this->mejaService = new MejaService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort(404);
    }

    public function viewAll($pusat_id) {
        $this->authorize('viewAny', Meja::class);
        $mejas = $this->mejaService->getMejasByPusat($pusat_id);
        return view('pages.pusat.meja.viewMejas', compact('mejas'));
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
    public function store(StoreMejaRequest $request)
    {
        $this->authorize('create', Meja::class);
        $result = $this->mejaService->createMeja($request->validated());
        if($result){
            return redirect()->route('mejas.viewAll', $request->id)->with('success', 'Meja berhasil dibuat.');
        }
        return redirect()->back()->with('error', 'Meja gagal dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('view', Meja::class);
        $meja = $this->mejaService->getMejaById($id);
        return view('pages.pusat.meja.viewMejaDetail', compact('meja'));
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
    public function update(UpdateMejaRequest $request, string $id)
    {
        $meja = $this->mejaService->getMejaById($id);
        $this->authorize('update', $meja);
        $result = $this->mejaService->updateMeja($request->validated(), $id);
        if($result){
            return redirect()->route('mejas.viewAll')->with('success', 'Meja berhasil diperbarui.');
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
        if($result){
            return redirect()->route('mejas.viewAll')->with('success', 'Meja berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Meja gagal dihapus.');
    }
}
