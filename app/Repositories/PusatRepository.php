<?php

namespace App\Repositories;

use App\Models\Pusat;

class PusatRepository
{
    public function getAllPusat()
    {
        return Pusat::with(['pemilik', 'kota'])->get();
    }

    public function getAllPusatByIds($id)
    {
        return Pusat::with(['pemilik', 'kota'])->where('id', $id)->get();
    }

    public function getPusatById($id)
    {
        return Pusat::with(['pemilik', 'kota'])->findOrFail($id);
    }

    public function createPusat(array $data)
    {
        return Pusat::create($data);
    }

    public function updatePusat($id, array $data)
    {
        $pusat = Pusat::findOrFail($id);
        if ($pusat) {
            $pusat->update($data);
            return $pusat;
        }
        return null;
    }

    public function deletePusat($id)
    {
        $pusat = Pusat::findOrFail($id);
        if ($pusat) {
            return $pusat->delete();
        }
        return false;
    }
}
