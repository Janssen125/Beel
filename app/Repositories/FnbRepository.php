<?php

namespace App\Repositories;

use App\Models\FnB;

class FnbRepository
{
    public function getAllFnBs()
    {
        return FnB::all();
    }

    public function getAllFnbsByPusatId($pusat_id)
    {
        return FnB::where('pusat_id', $pusat_id)->get();
    }

    public function getFnbById($id)
    {
        return FnB::findOrFail($id);
    }

    public function createFnb($data)
    {
        return FnB::create($data);
    }

    public function updateFnb($id, $data)
    {
        $fnb = FnB::findOrFail($id);

        return $fnb->update($data);
    }

    public function deleteFnb($id)
    {
        $fnb = FnB::findOrFail($id);

        return $fnb->delete();
    }
}
