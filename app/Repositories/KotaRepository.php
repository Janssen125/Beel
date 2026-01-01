<?php

namespace App\Repositories;

use App\Models\Kota;

class KotaRepository {

    public function getAllKotas() {
        return Kota::with('provinsi')->get();
    }

    public function getKotaById($id) {
        return Kota::with('provinsi')->findOrFail($id);
    }

    public function createKota($data) {
        return Kota::create($data);
    }

    public function updateKota($id, $data) {
        $kota = Kota::findOrFail($id);
        return $kota->update($data);
    }

    public function deleteKota($id) {
        $kota = Kota::findOrFail($id);
        return $kota->delete();
    }
}
