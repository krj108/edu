<?php

namespace Modules\Users\App\Policies;

use App\Models\User;
use Modules\Users\App\Models\Admin;

class AdminPolicy
{
    /**
     * Determine if the user can update a specific admin profile.
     *
     * @param User $user
     * @param Admin $admin
     * @return bool
     */
    public function update(User $user, Admin $admin): bool
    {
        return $user->hasRole('Super Admin') || $user->id === $admin->user_id;
    }

    /**
     * Determine if the user can view any admin profile.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin']);
    }

    /**
     * Determine if the user can view a specific admin profile.
     *
     * @param User $user
     * @param Admin $admin
     * @return bool
     */
    public function view(User $user, Admin $admin): bool
    {
        return $user->hasRole('Super Admin') || $user->id === $admin->user_id;
    }

    /**
     * Determine if the user can delete an admin profile.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->hasRole('Super Admin');
    }
}
