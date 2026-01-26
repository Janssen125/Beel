<?php

namespace App\Repositories;

use App\Models\FnB_Pusat;

class PusatFnbRepository
{
    public function getAllFnbsByPusatId($pusat_id)
    {
        return FnB_Pusat::with('fnb')->where('pusat_id', $pusat_id)->get();
    }

    public function sync($pusat, $data)
    {
        return $pusat->fnbs()->sync($data);
    }
}
