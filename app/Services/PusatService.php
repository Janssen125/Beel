<?php

namespace App\Services;

use App\Repositories\PusatRepository;

class PusatService {

    protected PusatRepository $pusatRepository;

    public function __construct() {
        $this->pusatRepository = new PusatRepository();
    }

    public function getAllPusat() {
        return $this->pusatRepository->getAllPusat();
    }

    public function getPusatById($id) {
        return $this->pusatRepository->getPusatById($id);
    }

    public function createPusat($data) {
        return $this->pusatRepository->createPusat($data);
    }

    public function updatePusat($id, $data) {
        return $this->pusatRepository->updatePusat($id, $data);
    }

    public function deletePusat($id) {
        return $this->pusatRepository->deletePusat($id);
    }

}