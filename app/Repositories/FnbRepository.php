<?php

namespace App\Repositories;

use App\Models\FnB;

class FnbRepository
{
    public function getAllFnBs() {
        return FnB::all();
    }

    public function getFnbById($id) {
        return FnB::find($id);
    }

    public function createFnb($data) {
        return FnB::create($data);
    }

    public function updateFnb($id, $data) {
        $fnb = FnB::find($id);
        return $fnb->update($data);
    }

    public function deleteFnb($id) {
        $fnb = FnB::find($id);
        return $fnb->delete();
    }
}