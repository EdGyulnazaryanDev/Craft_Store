<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return in_array($user->role, ['admin', 'superadmin']);
    }

    public function view(User $user, Product $product)
    {
        return in_array($user->role, ['admin', 'superadmin']);
    }

    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'superadmin']);
    }

    public function update(User $user, Product $product)
    {
        return in_array($user->role, ['admin', 'superadmin']);
    }

    public function delete(User $user, Product $product)
    {
        return in_array($user->role, ['admin', 'superadmin']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        return false;
    }
}
