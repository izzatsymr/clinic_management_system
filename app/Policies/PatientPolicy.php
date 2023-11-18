<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the patient can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list patients');
    }

    /**
     * Determine whether the patient can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Patient  $model
     * @return mixed
     */
    public function view(User $user, Patient $model)
    {
        return $user->hasPermissionTo('view patients');
    }

    /**
     * Determine whether the patient can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create patients');
    }

    /**
     * Determine whether the patient can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Patient  $model
     * @return mixed
     */
    public function update(User $user, Patient $model)
    {
        return $user->hasPermissionTo('update patients');
    }

    /**
     * Determine whether the patient can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Patient  $model
     * @return mixed
     */
    public function delete(User $user, Patient $model)
    {
        return $user->hasPermissionTo('delete patients');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Patient  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete patients');
    }

    /**
     * Determine whether the patient can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Patient  $model
     * @return mixed
     */
    public function restore(User $user, Patient $model)
    {
        return false;
    }

    /**
     * Determine whether the patient can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Patient  $model
     * @return mixed
     */
    public function forceDelete(User $user, Patient $model)
    {
        return false;
    }
}
