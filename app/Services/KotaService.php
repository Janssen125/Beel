<?php

namespace App\Services;

use App\Repositories\KotaRepository;

class KotaService {
    protected KotaRepository $kotaRepository;

    public function __construct() {
        $this->kotaRepository = new KotaRepository();
    }

    public function getAllKotas() {
        return $this->kotaRepository->getAllKotas();
    }

    public function createKota($data) {
        return $this->kotaRepository->createKota($data);
    }

    public function updateKota($kota, $data) {
        return $this->kotaRepository->updateKota($kota, $data);
    }

    public function deleteKota($kota) {
        return $this->kotaRepository->deleteKota($kota);
    }
}
