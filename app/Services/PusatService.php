<?php

namespace App\Services;

use App\Repositories\PusatRepository;
use App\Repositories\PusatFnbRepository;

class PusatService {

    protected PusatRepository $pusatRepository;
    protected PusatFnbRepository $pusatFnbRepository;

    public function __construct() {
        $this->pusatRepository = new PusatRepository();
        $this->pusatFnbRepository = new PusatFnbRepository();
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

    public function getSelectedFnbs($pusat) {
        return $pusat->fnbs->mapWithKeys(fn ($fnb) => [
            $fnb->id => [
                'harga' => $fnb->pivot->harga
            ]
        ])->toArray();
    }

    public function syncFnbs($pusat, $data)
    {
        $payload = collect($data['fnbs'])
            ->mapWithKeys(fn ($item, $fnbId) => [
                $fnbId => ['harga' => $item['harga']]
            ])
            ->toArray();

        return $this->pusatFnbRepository->sync($pusat, $payload);
    }

}
