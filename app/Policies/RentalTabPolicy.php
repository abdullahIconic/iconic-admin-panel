<?php

namespace App\Policies;

use App\Models\RentalTab;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RentalTabPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RentalTab  $rentalTab
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, RentalTab $rentalTab)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RentalTab  $rentalTab
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, RentalTab $rentalTab)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RentalTab  $rentalTab
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, RentalTab $rentalTab)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RentalTab  $rentalTab
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, RentalTab $rentalTab)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RentalTab  $rentalTab
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, RentalTab $rentalTab)
    {
        //
    }
}
