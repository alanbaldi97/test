<?php

namespace App\Policies;

use App\Models\Flight;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FlightPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
        if(!$user->hasPermissionTo('view flights')) return $this->deny('No tiene permisos para ver lo vuelos');

        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Flight  $flight
     * @return mixed
     */
    public function view(User $user, Flight $flight)
    {
        //

        if(!$user->hasPermissionTo('view flights')) return $this->deny('No tiene permisos para esta vista');

        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        if(!$user->hasPermissionTo('create flight')) return $this->deny('No tiene permisos para crear vuelos');

        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Flight  $flight
     * @return mixed
     */
    public function update(User $user, Flight $flight)
    {
        //

        if(!$user->hasPermissionTo('update flight')) return $this->deny('No tiene permisos para actualizar vuelos');

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Flight  $flight
     * @return mixed
     */
    public function delete(User $user, Flight $flight)
    {
        //

        if(!$user->hasPermissionTo('delete flight')) return $this->deny('No tiene permisos para eliminar vuelos');

        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Flight  $flight
     * @return mixed
     */
    public function restore(User $user, Flight $flight)
    {
        //
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Flight  $flight
     * @return mixed
     */
    public function forceDelete(User $user, Flight $flight)
    {
        //
        return $user->hasRole('admin');
    }
}
