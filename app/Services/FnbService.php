<?php

namespace App\Services;

use App\Repositories\FnbRepository;

class FnbService {

    protected FnbRepository $fnbRepository;

    public function __construct() {
        $this->fnbRepository = new FnbRepository();
    }

    public function getAllFnBs() {
        return $this->fnbRepository->getAllFnBs();
    }

    public function getFnbById($id) {
        return $this->fnbRepository->getFnbById($id);
    }

    public function createFnb($data) {
        return $this->fnbRepository->createFnb($data);
    }

    public function updateFnb($id, $data) {
        return $this->fnbRepository->updateFnb($id, $data);
    }

    public function deleteFnb($id) {
        return $this->fnbRepository->deleteFnb($id);
    }
}