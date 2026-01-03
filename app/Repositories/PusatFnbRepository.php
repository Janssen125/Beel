<?php

namespace App\Repositories;

use App\Models\FnB_Pusat;

class PusatFnbRepository
{
    public function getAllFnbsByPusat($pusat)
    {
        return FnB_Pusat::where('pusat_id', $pusat->id)->with(['fnb', 'pusat'])->get();
    }

    public function sync($pusat, $data)
    {
        return $pusat->fnbs()->sync($data);
    }
}

