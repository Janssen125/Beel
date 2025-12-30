<?php

namespace App\Repositories;

use App\Models\Provinsi;

class ProvinsiRepository {

    public function getAllProvinsis() {
        return Provinsi::all();
    }

}