<?php

namespace App\Services;

use App\Repositories\MejaRepository;

class MejaService {

    protected MejaRepository $mejaRepository;

    public function __construct() {
        $this->mejaRepository = new MejaRepository();
    }

    public function getMejaById($id) {
        return $this->mejaRepository->getMejaById($id);
    }

    public function getMejasByPusat($pusat_id) {
        return $this->mejaRepository->getMejasByPusat($pusat_id);
    }

    public function createMeja($data) {
        return $this->mejaRepository->createMeja($data);
    }

    public function updateMeja($id, $data) {
        return $this->mejaRepository->updateMeja($id, $data);
    }

    public function deleteMeja($id) {
        return $this->mejaRepository->deleteMeja($id);
    }

}
