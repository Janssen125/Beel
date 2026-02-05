<?php

namespace App\Policies;

use App\Models\TransactionHeader;
use App\Models\User;

class TransactionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TransactionHeader $transactionHeader): bool
    {
        if ($user->role == 'superadmin') {
            return true;
        } elseif ($user->role == 'admin' || $user->role == 'staff') {
            $pusat_id = $user->userPusats()->first()->pusat_id;

            return $transactionHeader->pusat_id == $pusat_id;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TransactionHeader $transactionHeader): bool
    {
        if ($user->role == 'superadmin') {
            return true;
        } elseif ($user->role == 'admin' || $user->role == 'staff') {
            $pusat_id = $user->userPusats()->first()->pusat_id;

            return $transactionHeader->pusat_id == $pusat_id;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TransactionHeader $transactionHeader): bool
    {
        if ($user->role == 'superadmin') {
            return true;
        } elseif ($user->role == 'admin' || $user->role == 'staff') {
            $pusat_id = $user->userPusats()->first()->pusat_id;

            return $transactionHeader->pusat_id == $pusat_id;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TransactionHeader $transactionHeader): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TransactionHeader $transactionHeader): bool
    {
        return false;
    }
}
