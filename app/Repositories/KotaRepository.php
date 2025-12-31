<?php

namespace App\Repositories;

use App\Models\Kota;

class KotaRepository {

    public function getAllKotas() {
        return Kota::with('provinsi')->get();
    }

    public function getKotaById($id) {
        return Kota::with('provinsi')->find($id);
    }

    public function createKota($data) {
        return Kota::create($data);
    }

    public function updateKota($id, $data) {
        $kota = Kota::find($id);
        return $kota->update($data);
    }

    public function deleteKota($id) {
        $kota = Kota::find($id);
        return $kota->delete();
    }
}
