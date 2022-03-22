<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Permission;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        //
        return $admin->hasPermissionTo('Read-Permissions')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ', 403);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Permission $permission)
    {
        //
        return $admin->hasPermissionTo('Read-Permissions')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ', 403);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        //
        return $admin->hasPermissionTo('Create-Permissions')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ', 403);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Permission $permission)
    {
        //
        return $admin->hasPermissionTo('Update-Permissions')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ', 403);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Permission $permission)
    {
        //
        return $admin->hasPermissionTo('Delete-Permissions')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ', 403);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Permission $permission)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Permission $permission)
    {
        //
    }
}
