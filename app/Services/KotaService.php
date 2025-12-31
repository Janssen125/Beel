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

    public function getKotaById($id) {
        return $this->kotaRepository->getKotaById($id);
    }

    public function createKota($data) {
        return $this->kotaRepository->createKota($data);
    }

    public function updateKota($id, $data) {
        return $this->kotaRepository->updateKota($id, $data);
    }

    public function deleteKota($id) {
        return $this->kotaRepository->deleteKota($id);
    }
}
