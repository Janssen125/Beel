<?php

namespace App\Repositories;

use App\Models\Meja;

class MejaRepository {

    public function getMejaById($id) {
        return Meja::findOrFail($id);
    }

    public function getMejasByPusat($pusat_id) {
        return Meja::where('pusat_id', $pusat_id)
        ->with(['jenisMeja', 'activeTransaction'])
        ->orderby('nomor_meja', 'asc')->get();
    }

    public function createMeja($data) {
        return Meja::create($data);
    }

    public function updateMeja($id, $data) {
        $meja = Meja::findOrFail($id);
        return $meja->update($data);
    }

    public function deleteMeja($id) {
        $meja = Meja::findOrFail($id);
        return $meja->delete();
    }

}
