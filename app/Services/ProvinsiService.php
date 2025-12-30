<?php

namespace App\Services;

use App\Repositories\ProvinsiRepository;

class ProvinsiService {
    protected ProvinsiRepository $provinsiRepository;

    public function __construct() {
        $this->provinsiRepository = new ProvinsiRepository();
    }

    public function getAllProvinsis() {
        return $this->provinsiRepository->getAllProvinsis();
    }
}
