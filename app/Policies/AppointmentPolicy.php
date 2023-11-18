<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppointmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the appointment can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list appointments');
    }

    /**
     * Determine whether the appointment can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Appointment  $model
     * @return mixed
     */
    public function view(User $user, Appointment $model)
    {
        return $user->hasPermissionTo('view appointments');
    }

    /**
     * Determine whether the appointment can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create appointments');
    }

    /**
     * Determine whether the appointment can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Appointment  $model
     * @return mixed
     */
    public function update(User $user, Appointment $model)
    {
        return $user->hasPermissionTo('update appointments');
    }

    /**
     * Determine whether the appointment can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Appointment  $model
     * @return mixed
     */
    public function delete(User $user, Appointment $model)
    {
        return $user->hasPermissionTo('delete appointments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Appointment  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete appointments');
    }

    /**
     * Determine whether the appointment can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Appointment  $model
     * @return mixed
     */
    public function restore(User $user, Appointment $model)
    {
        return false;
    }

    /**
     * Determine whether the appointment can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Appointment  $model
     * @return mixed
     */
    public function forceDelete(User $user, Appointment $model)
    {
        return false;
    }
}
