<?php

namespace App\Policies;

use App\Models\CryptoExchange;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CryptoExchangePolicy
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
        return $user->isAdminPanelAccount();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CryptoExchange  $cryptoExchange
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, CryptoExchange $cryptoExchange)
    {
        return $user->isAdminPanelAccount();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CryptoExchange  $cryptoExchange
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, CryptoExchange $cryptoExchange)
    {
        return $user->isAdminPanelAccount();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CryptoExchange  $cryptoExchange
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, CryptoExchange $cryptoExchange)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CryptoExchange  $cryptoExchange
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, CryptoExchange $cryptoExchange)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CryptoExchange  $cryptoExchange
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, CryptoExchange $cryptoExchange)
    {
        //
    }
}
