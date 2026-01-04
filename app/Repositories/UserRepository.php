<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository {

    public function getAllUsers() {
        return User::orderBy('created_at', 'desc')->get();
    }

    public function getUserById($id) {
        return User::findOrFail($id);
    }

    public function getUserByPusat($pusat_id) {
        return User::whereHas('userPusats', function($query) use ($pusat_id) {
            $query->where('pusat_id', $pusat_id);
        })->orderBy('created_at', 'desc')->get();
    }

    public function getAllPemiliks() {
        return User::whereIn('role', ['admin', 'superadmin'])->orderBy('created_at', 'desc')->get();
    }

    public function createUser($data) {
        return User::create($data);
    }

    public function updateUser($id, $data) {
        $user = User::findOrFail($id);
        return $user->update($data);
    }

    public function deleteUser($id) {
        $user = User::findOrFail($id);
        return $user->delete();
    }

}
