<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Question;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the question can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list questions');
    }

    /**
     * Determine whether the question can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Question  $model
     * @return mixed
     */
    public function view(User $user, Question $model)
    {
        return $user->hasPermissionTo('view questions');
    }

    /**
     * Determine whether the question can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create questions');
    }

    /**
     * Determine whether the question can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Question  $model
     * @return mixed
     */
    public function update(User $user, Question $model)
    {
        return $user->hasPermissionTo('update questions');
    }

    /**
     * Determine whether the question can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Question  $model
     * @return mixed
     */
    public function delete(User $user, Question $model)
    {
        return $user->hasPermissionTo('delete questions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Question  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete questions');
    }

    /**
     * Determine whether the question can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Question  $model
     * @return mixed
     */
    public function restore(User $user, Question $model)
    {
        return false;
    }

    /**
     * Determine whether the question can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Question  $model
     * @return mixed
     */
    public function forceDelete(User $user, Question $model)
    {
        return false;
    }
}
