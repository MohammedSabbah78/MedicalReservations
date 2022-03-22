<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $adminAuth)
    {
        //
        return $adminAuth->hasPermissionTo('Read-Admins')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ', 403);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $adminAuth, Admin $admin)
    {
        //
        return $adminAuth->hasPermissionTo('Read-Admins')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ', 403);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $adminAuth)
    {
        //
        return $adminAuth->hasPermissionTo('Create-Admin')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ', 403);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $adminAuth, Admin $admin)
    {
        //
        return $adminAuth->hasPermissionTo('Update-Admin')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ', 403);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $adminAuth, Admin $admin)
    {
        //
        return $adminAuth->hasPermissionTo('Delete-Admin')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ', 403);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $adminAuth, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $adminAuth, Admin $admin)
    {
        //
    }
}
