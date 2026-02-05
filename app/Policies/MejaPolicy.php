<?php

namespace App\Policies;

use App\Models\Meja;
use App\Models\User;

class MejaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->role == 'superadmin') {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Meja $meja): bool
    {
        if ($user->role == 'superadmin') {
            return true;
        } elseif ($user->role == 'admin' || $user->role == 'staff') {
            $pusat_id = $user->userPusats()->first()->pusat_id;

            return $meja->pusat_id == $pusat_id;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role == 'superadmin' || $user->role == 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Meja $meja): bool
    {
        if ($user->role == 'superadmin') {
            return true;
        } elseif ($user->role == 'admin') {
            $pusat_id = $user->userPusats()->first()->pusat_id;

            return $meja->pusat_id == $pusat_id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Meja $meja): bool
    {
        if ($user->role == 'superadmin') {
            return true;
        } elseif ($user->role == 'admin') {
            $pusat_id = $user->userPusats()->first()->pusat_id;

            return $meja->pusat_id == $pusat_id;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Meja $meja): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Meja $meja): bool
    {
        return false;
    }
}
