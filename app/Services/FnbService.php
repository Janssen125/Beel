<?php

namespace App\Services;

use App\Repositories\FnbRepository;
use App\Repositories\PusatFnbRepository;

class FnbService {

    protected FnbRepository $fnbRepository;
    protected PusatFnbRepository $pusatFnbRepository;

    public function __construct() {
        $this->fnbRepository = new FnbRepository();
        $this->pusatFnbRepository = new PusatFnbRepository();
    }

    public function getAllFnBs() {
        return $this->fnbRepository->getAllFnBs();
    }

    public function getAllFnbsByPusatId($pusat_id) {
        return $this->pusatFnbRepository->getAllFnbsByPusatId($pusat_id);
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
