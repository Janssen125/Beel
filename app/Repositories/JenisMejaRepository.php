<?php

namespace App\Repositories;

use App\Models\JenisMeja;

class JenisMejaRepository {

    public function getJenisMejaById($id) {
        return JenisMeja::findOrFail($id);
    }

    public function getAllJenisMejas() {
        return JenisMeja::orderBy('nama_jenis_meja', 'asc')->get();
    }

    public function createJenisMeja($data) {
        return JenisMeja::create($data);
    }

    public function updateJenisMeja($id, $data) {
        $jenisMeja = JenisMeja::findOrFail($id);
        return $jenisMeja->update($data);
    }

    public function deleteJenisMeja($id) {
        $jenisMeja = JenisMeja::findOrFail($id);
        return $jenisMeja->delete();
    }

}
