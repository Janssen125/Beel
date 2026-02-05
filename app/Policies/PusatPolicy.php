<?php

namespace App\Policies;

use App\Models\Pusat;
use App\Models\User;

class PusatPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'superadmin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pusat $pusat): bool
    {
        if ($user->role === 'superadmin') {
            return true;
        } elseif ($user->role == 'admin') {
            $user_pusat_id = $user->userPusats->pusat_id;

            return $user_pusat_id === $pusat->id;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'superadmin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pusat $pusat): bool
    {
        return $user->role === 'superadmin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pusat $pusat): bool
    {
        return $user->role === 'superadmin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pusat $pusat): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pusat $pusat): bool
    {
        return false;
    }
}
