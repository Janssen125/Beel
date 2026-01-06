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

    public function getMejaByPusatNomorMeja($pusat_id, $nomor) {
        return $this->mejaRepository->getMejaByPusatNomorMeja($pusat_id, $nomor);
    }

    public function createMeja($data) {
        $result = $this->getMejaByPusatNomorMeja($data['pusat_id'], $data['nomor_meja']);
        if(!$result){
            return $this->mejaRepository->createMeja($data);
        }
        return null;
    }

    public function updateMeja($data, $id)
    {
        $existing = $this->mejaRepository->getByPusatNomorMejaExceptId($data['pusat_id'], $data['nomor_meja'], $id);

        if ($existing) {
            return null;
        }

        return $this->mejaRepository->updateMeja($data, $id);
    }


    public function deleteMeja($id) {
        return $this->mejaRepository->deleteMeja($id);
    }

}
