<?php

namespace App\Services;

use App\Repositories\JenisMejaRepository;

class JenisMejaService
{
    protected JenisMejaRepository $jenisMejaRepository;

    public function __construct()
    {
        $this->jenisMejaRepository = new JenisMejaRepository();
    }

    public function getJenisMejaById($id)
    {
        return $this->jenisMejaRepository->getJenisMejaById($id);
    }

    public function getAllJenisMejas()
    {
        return $this->jenisMejaRepository->getAllJenisMejas();
    }

    public function createJenisMeja($data)
    {
        return $this->jenisMejaRepository->createJenisMeja($data);
    }

    public function updateJenisMeja($id, $data)
    {
        return $this->jenisMejaRepository->updateJenisMeja($id, $data);
    }

    public function deleteJenisMeja($id)
    {
        return $this->jenisMejaRepository->deleteJenisMeja($id);
    }
}