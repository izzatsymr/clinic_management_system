<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Answer;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the answer can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list answers');
    }

    /**
     * Determine whether the answer can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Answer  $model
     * @return mixed
     */
    public function view(User $user, Answer $model)
    {
        return $user->hasPermissionTo('view answers');
    }

    /**
     * Determine whether the answer can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create answers');
    }

    /**
     * Determine whether the answer can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Answer  $model
     * @return mixed
     */
    public function update(User $user, Answer $model)
    {
        return $user->hasPermissionTo('update answers');
    }

    /**
     * Determine whether the answer can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Answer  $model
     * @return mixed
     */
    public function delete(User $user, Answer $model)
    {
        return $user->hasPermissionTo('delete answers');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Answer  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete answers');
    }

    /**
     * Determine whether the answer can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Answer  $model
     * @return mixed
     */
    public function restore(User $user, Answer $model)
    {
        return false;
    }

    /**
     * Determine whether the answer can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Answer  $model
     * @return mixed
     */
    public function forceDelete(User $user, Answer $model)
    {
        return false;
    }
}
