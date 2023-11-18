<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Assessment;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssessmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the assessment can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list assessments');
    }

    /**
     * Determine whether the assessment can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Assessment  $model
     * @return mixed
     */
    public function view(User $user, Assessment $model)
    {
        return $user->hasPermissionTo('view assessments');
    }

    /**
     * Determine whether the assessment can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create assessments');
    }

    /**
     * Determine whether the assessment can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Assessment  $model
     * @return mixed
     */
    public function update(User $user, Assessment $model)
    {
        return $user->hasPermissionTo('update assessments');
    }

    /**
     * Determine whether the assessment can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Assessment  $model
     * @return mixed
     */
    public function delete(User $user, Assessment $model)
    {
        return $user->hasPermissionTo('delete assessments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Assessment  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete assessments');
    }

    /**
     * Determine whether the assessment can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Assessment  $model
     * @return mixed
     */
    public function restore(User $user, Assessment $model)
    {
        return false;
    }

    /**
     * Determine whether the assessment can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Assessment  $model
     * @return mixed
     */
    public function forceDelete(User $user, Assessment $model)
    {
        return false;
    }
}
