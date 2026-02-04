<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    public function getAllUsers($user)
    {
        if ($user->role == 'superadmin') {
            return $this->userRepository->getAllUsers();
        } elseif ($user->role == 'admin') {
            $pusat_id = $user->userPusats()->first()->pusat_id;

            return $this->userRepository->getUserByPusat($pusat_id);
        }
    }

    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function createUser($data)
    {
        return $this->userRepository->createUser($data);
    }

    public function updateUser($id, $data)
    {
        if (empty($data['password'])) {
            unset($data['password']);
        }

        return $this->userRepository->updateUser($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->deleteUser($id);
    }
}
