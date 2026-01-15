<?php

namespace App\Repositories;

use App\Models\Meja;

class MejaRepository {

    public function getMejaById($id) {
        return Meja::with(['jenisMeja', 'activeTransaction'])->findOrFail($id);
    }

    public function getMejasByPusat($pusat_id) {
        return Meja::where('pusat_id', $pusat_id)
        ->with(['jenisMeja', 'activeTransaction'])
        ->orderby('nomor_meja', 'asc')->get();
    }

    public function getMejaByPusatNomorMeja($pusat_id, $nomor) {
        return Meja::where('pusat_id', $pusat_id)
            ->where('nomor_meja', $nomor)
            ->first();
    }

    public function getByPusatNomorMejaExceptId($pusatId, $nomorMeja, $exceptId)
{
    return Meja::where('pusat_id', $pusatId)
        ->where('nomor_meja', $nomorMeja)
        ->where('id', '!=', $exceptId)
        ->first();
}

    public function createMeja($data) {
        return Meja::create($data);
    }

    public function updateMeja($data, $id) {
        $meja = Meja::findOrFail($id);
        return $meja->update($data);
    }

    public function updateStatus($id, $status) {
        $meja = Meja::findOrFail($id);
        $meja->status = $status;
        return $meja->save();
    }

    public function deleteMeja($id) {
        $meja = Meja::findOrFail($id);
        return $meja->delete();
    }

}
