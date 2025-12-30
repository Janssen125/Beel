<?php

namespace App\Repositories;

use App\Models\Kota;

class KotaRepository {

    public function getAllKotas() {
        return Kota::with('provinsi')->get();
    }

    public function createKota($data) {
        return Kota::create($data);
    }

    public function updateKota($kota, $data) {
        $kota->update($data);
        return $kota;
    }

    public function deleteKota($kota) {
        return $kota->delete();
    }
}